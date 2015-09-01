<?php

	// If user is selected in url
	if (isset($_GET['user']) || isset($_SESSION['username'])) {
		
		// if person is logged in and on their page
		if (isset($_SESSION['username']) && $s->lower($_SESSION["username"]) == $s->lower($_GET['user'])) {
			
			// User is editing their page
			if (isset($_GET['change'], $_GET['edit']) && $_GET['change'] == "edit") {
				
				
				// USER IS EDITING PROFILE
				if ($_GET['edit'] == "profile") {
					
					$sql = "SELECT `user_name`, `user_city`, `user_state`, `user_country`, `user_gender`, `user_bio`, `user_birthday`
								FROM `users`
								WHERE `username` = '$user'";
					$query = $conn->query($sql);
					$row = $query->fetch_assoc();
					
					$month = substr($row['user_birthday'], 0, 2);
					$day = substr($row['user_birthday'], 2, 2);
					$year = substr($row['user_birthday'], 4, 4);
					
					$clean = new cleanInput;
					
					
					
				// Redirect User to url user's page
				} else {
					
					header ("Location: " . BASE_URI . "user/" . $s->lower($_GET['user']));
					exit;
					
				}
				
				
			// Redirect User to url user's page
			} else {
				
				header ("Location: " . BASE_URI . "user/" . $s->lower($_GET['user']));
				exit;
				
			}
			
		// Redirect User to url user's page
		} else {
			
			header ("Location: " . BASE_URI . "user/" . $s->lower($_GET['user']));
			exit;
			
		}
		
	} else {
		
		// Relocate user to homepage
		header ("Location: " . BASE_URI);
		exit;
		
	}

?>