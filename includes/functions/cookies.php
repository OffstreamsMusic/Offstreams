<?php

	// Create cookie class
	// Extends cleanInput for the random string generator
	class createCookie extends cleanInput {
		
		
		public $unsetTime;
		public $thirtyDays;
		private $secure;
		
		
		
		public function __construct() {
			$this->unsetTime = time() - 3600;
			$this->thirtyDays = time() + (60 * 60 * 24 * 30);
			$this->secure = sha1(SALT . isset($_SESSION['username']) . SALT);
		}
		
		
		
		public function createUserCookies() {
			
			// User Id cookie
			setcookie('OSTR-ID', $_SESSION['user_id'], $this->thirtyDays, "/");
			// Password check
			setcookie('OSTR-ID-2', $this->secure, $this->thirtyDays, "/");
		}
		
		
		
		public function callCookie($type) {
			
			if (isset($_COOKIE[$type])) {
				echo $_COOKIE[$type];
			} else {
				echo "Does Not Exist";
			}
			
		}
		
		
		
		public function checkUser() {
			
			global $conn;
			
			// CHECK IF SESSION EXISTS
			if (isset($_SESSION['user_id'], $_SESSION['username'])) {
				
				// Reset sessions
				$_SESSION['user_id'] = $_SESSION['user_id'];
				$_SESSION['username'] = $_SESSION['username'];
				
			// ELSE SESSION DOES NOT EXIST
			} else {
				
				// COOKIES EXIST, RESET USER
				if (isset($_COOKIE['OSTR-ID'], $_COOKIE['OSTR-ID-2'])) {
					
					$sql = "SELECT * FROM `users`
								WHERE `user_id` = '" . $_COOKIE['OSTR-ID'] . "' AND `user_cookie` = '" . $_COOKIE['OSTR-ID-2'] . "'";
					$query = $conn->query($sql);
					
					// THERE IS ONE USER MATCH
					if ($query->num_rows == 1) {
						
						$row = $query->fetch_assoc();
						
						// Regenerate Session
						session_regenerate_id(true);
						
						$_SESSION['user_id'] = $row['user_id'];
						$_SESSION['username'] = $row['username'];
						$_SESSION['access'] = $row['user_access'];
						$_SESSION['active'] = $row['user_active'];
						$_SESSION['loggedIn'] = true;
						
						$this->createUserCookies();
						
					// There are no matches
					} else {
						
					}
					
				// Cookie doesn't exist, log user out	
				} else {
					
					$values = array("user_id", "username", "access", "active");
					// UNSET SESSIONS
					for ($i = 0; $i < count($values); $i++) {
						unset($_SESSION[$values[$i]]);
					}
					
					$_SESSION['loggedIn'] = false;
					
					session_destroy();
					@session_start();
					
					#echo "Jesus";
					
					$this->unsetCookies($values);
					
					#header("Location: " . $_SERVER['REQUEST_URI']);
					#exit;
					
				}
				
			}
		}
		
		
		
		public function unsetCookies($cookies = array()) {
			
			$count = count($cookies);
			
			$values = array(isset($_SESSION['user_id']), $this->secure);
			
			// If there are cookies present
			if ($count > 0) {
				
				for ($i = 0; $i < $count; $i++) {
					
					setcookie($cookies[$i], "", $this->unsetTime, "/");
					
				}
				
				return true;
			
			// No cookie values to remove
			} else {
				
				return false;
				
			}
			
		}
		
	}
	
	
	
	
	
	
	
	
	
	

?>