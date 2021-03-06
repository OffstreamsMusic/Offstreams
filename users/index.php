<?php require ("../includes/header.php"); ?>
<?php

	if (isset($_GET['user'])){
		
		$user = $_GET['user'];
		
		$sql = "SELECT `username` FROM `users`
					WHERE LOWER(`username`) = LOWER('$user')";
		$query = $conn->query($sql);
		
		// If User Exists
		if ($query->num_rows == 1) {
			
			$row = $query->fetch_assoc();
			
			// Load new member starting survey
			#Survey Process
			#Survey Widget
			
			//Load profile widget
			include (BASEPATH . "users/process/profileInfo.php");
			include (BASEPATH . "users/widgets/profileInfo.html");
			
			// Load poll widget
			include (BASEPATH . "polls/process/pollWidget.php");
			include (BASEPATH . "polls/widgets/pollWidget.html");
			
			
			
		// User doesn't exist
		} else {
			
			header("Location: " . BASE_URI);
			exit;
			
		}
		
	
	// Redirect if the user goes into the "/user/" directory
	} else {
		
		header("Location: " . BASE_URI);
		exit;
		
	}

?>