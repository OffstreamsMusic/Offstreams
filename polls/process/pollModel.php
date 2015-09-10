<?php

	class PollModel {
		
		private $conn;
		public $userId;
		public $loggedIn;
		public $poll;
		
		public function __construct($conn) {
			
			$this->conn = $conn;
			$this->loggedIn = false;
			
		}
		
		
		public function isLoggedIn() {
			
			if (isset($_SESSION['username'])) {
				
				$this->loggedIn = true;
				$this->userId = $_SESSION['user_id'];
				
				return true;
				
			} else {
				
				return false;
				
			}
		}
		
		
		
		// DETERMINES IF USER IS LOGGED IN AND ON THEIR PAGE
		public function isUserPage() {
			
			// If User is logged in and on user page
			if (isset($_SESSION['username'], $_GET['user'])) {
				
				// If user is logged in and on their page
				if (strtolower($_GET['user']) == strtolower($_SESSION['username'])) {
					
					$this->loggedIn = true;
					$this->userId = $_SESSION['user_id'];
					
					return true;
				
				// user is not logged in and on their page
				} else {
					
					$this->loggedIn = false;
					
					return false;
				
				}
			
			// User is not logged in or on a user page
			} else {
				
				$this->loggedIn = false;
				
				return false;
			
			}
		}
		
		
		
		// CHECKS FOR ALL POLLS THE USER HAS COMPLETED
		private function userCompleted() {
			
			// Select all polls that user has done
			if ($this->loggedIn) {
				
				// In case there are no rows
				$rows = array();
				
				$sql = "SELECT `poll_id` FROM `pollusers` WHERE `user_id` = " . $this->userId;
				$query = $this->conn->query($sql);
				while ($row = $query->fetch_assoc()) {
					$rows[] = $row['poll_id'];
				}
				
				return $rows;
				
			// User is not logged in return nothing
			} else {
				
				return null;
				
			}
			
		}
		
		
		
		// SELECTS ONE RANDOM POLL THAT A USER HAS NOT YET PARTICIPATED IN
		private function selectPoll($rows) {
		
			if ($this->loggedIn) {
				
				// If there is at least one row
				if (count($rows) > 0) {
					
					
					
					// There is only one row
					if (count($rows) == 1) {
						
						$rows = $rows[0];
						
					// There are multiple rows
					} else {
					
						$rows = implode(", ", $rows);
						
					}
					
					$where = "WHERE `poll_id` NOT IN (" . $rows . ") ";
					
				// There are no rows
				} else {
					
					$where = null;
					
				}
				
				$sql = "SELECT `poll_id`, `poll_title`
						  FROM `polls` 
						  " . $where . "
						  ORDER BY RAND() LIMIT 1";
						  
				$query = $this->conn->query($sql);
				
				$row = array();
				while ($row = $query->fetch_assoc()) {
					
					$this->pollName['poll_id'] = $row['poll_id'];
					$this->pollName['poll_title'] = $row['poll_title'];
					
				}
				
				return $this->pollName;
				
			}
			
		}
		
		
		
		// PULLS ALL POSSIBLE ANSWERS BASED ON THE POLL ID THAT WAS SELECTED AT RANDOM
		private function pullAnswers($pollId) {
			
			if ($this->loggedIn) {
				
				
				// In case the poll has no answers
				$this->pollAns = array();
				
				$sql = "SELECT `pollAns_name`, `pollAns_id`
						  FROM `pollanswers`
						  WHERE `poll_id` = " . $pollId;
				$query = $this->conn->query($sql);
				
				while ($row = $query->fetch_assoc()) {
					
					$this->pollAns[$row['pollAns_id']] = $row['pollAns_name'];
					
				}
				
				return $this->pollAns;
				
			}
			
		}
		
		
		// RETURN POLL AND ALL ANSWERS IN ARRAY
		//
		//		Array (
		//			[name] => Array (
		//				[poll_id] => $1
		//				[poll_title] => $2
		//			)
		//
		//			[answer] => Array (
		//				[#] => Array (
		//					[#] => $3
		//					[#] => $4
		//				)
		//			)
		//		)
		//
		
		public function newPoll() {
			
			if (isset($_SESSION['username'])) {
				
				$this->isLoggedIn();
				$rows = $this->userCompleted();
				
				$this->poll['name'] = $this->selectPoll($rows);
				$this->poll['answer'] = $this->pullAnswers($this->poll['name']['poll_id']);
				
				return $this->poll;
			
			}
			
		}
		
		
		
	}

?>