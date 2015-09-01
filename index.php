<?php require ("includes/header.php"); ?>
<?php

	if (isset($_GET['cat'])){
		
		$cat = $_GET['cat'];
			
		$sql = "SELECT `nav_name`, `nav_url` FROM `navigation`
				WHERE LOWER(`nav_url`) = LOWER('$cat')";
		$query = $conn->query($sql);
			
		
		// If Page Exists
		if ($query->num_rows == 1) {
			
			
			// Include Respective pages for each
			while($row = $query->fetch_assoc()) {
				
				$name = $row['nav_url'] . "s";
				include(BASEPATH . $name . "/index.php");
				
			}
			
			
		// Page doesn't exist
		} else {
			
			header("Location: " . BASE_URI);
			exit;
			
		}
		
	
	// Redirect if the user goes into the "/$cat/" directory
	} else {
		
		include(BASEPATH . "includes/process/homePage.php");
		include(BASEPATH . "includes/process/homePage.html");
	}

?>
