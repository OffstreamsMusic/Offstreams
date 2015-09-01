<?php
	require ("../includes/config/config.php");

	if (isset($_POST['loginSubmit'])){
	
		$login = array();
		$login[0] = $_POST['username'];
		$login[1] = $_POST['password'];
		
		$clean = new cleanInput;
		
		for ($i = 0; $i < count($login); $i++) {
			$login[$i] = $clean->sanitize($login[$i]);
		}
		
		$pass = sha1($login[1]);
		
		$sql = "SELECT `user_id`, `username`, `user_password`, `user_active`, `user_access` 
					FROM `users` 
					WHERE `username` = '$login[0]' AND `user_password` = '$pass'";
					
		$query = $conn->query($sql);
		$num_rows = $query->num_rows;
		
		$row = $query->fetch_assoc();
		
		// If there is an exact match
		// Login user and go to page
		if ($num_rows == 1) {
			
			
			$active = $row['user_active'];
			$access = $row['user_access'];
			
			$_SESSION['username'] = $row['username'];
			$_SESSION['user_id'] = $row['user_id'];
			$_SESSION['access'] = $access;
			$_SESSION['active'] = $active;
			$_SESSION['loggedIn'] = true;
			
			$cookie->createUserCookies();
			
			$sql = "UPDATE users 
						SET user_cookie = '" . sha1(SALT . isset($_SESSION['username']) . SALT) . "' 
						WHERE username = '" . $row['username'] . "'";
			$query = $conn->query($sql);
			
			header("Location: " . BASE_URI . "user/" . $login[0]);
			exit;
			
		// Something went wrong
		} else {
			
			$sql = "SELECT `username`, `user_password` FROM `users`
						WHERE `username` = '$login[0]'";
			$query = $conn->query($sql) or die($conn->error);
			$row = $query->fetch_assoc();
			
			$login[0] = strtolower($login[0]);
			$row['username'] = strtolower($row['username']);
			
			
			// Username does not exist
			if ($login[0] != $row['username']){
				
				header("Location: " . BASE_URI . "index.php?e=5");
				exit;
				
			// Username exists, but password is incorrect
			} elseif ($login[0] == $row['username'] && $pass != $row['user_password']) {
				
				header("Location: " . BASE_URI . "index.php?e=6");
				exit;
				
			}
		}
		
		
	// User did not use login form
	} else {
		
		header("Location: " . BASE_URI);
		exit;
		
	}
	

?>