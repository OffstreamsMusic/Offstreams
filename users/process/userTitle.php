<?php

	if (isset($_GET['user'])) {
		
		$user = $_GET['user'];
		
		$sql = "SELECT `username` FROM `users` WHERE LOWER(`username`) = LOWER('$user')";
		$query = $conn->query($sql);
		$row = $query->fetch_assoc();
		
		// IF USER IS EDITING PAGE
		if (isset($_GET['change'])) {
			
			// GET EDIT TYPE IF IT EXISTS
			if (isset($_GET['edit'])) {
				
				if ($_GET['edit'] == "profile") {
					$edit = "Profile";
				} elseif($_GET['edit'] == "image") {
					$edit = "Image";
				} else {
					$edit = "";
				}
		
				echo $row['username'] . ": Edit " . $edit . " | Offstreams";
				
			}
			
		// USER IS NOT EDITING A PAGE
		} else {
			
			echo $row['username'] . " | Offstreams";
			
		}
		
	}

?>