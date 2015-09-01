<?php

	include ("../../includes/config/config.php");

	if (isset($_POST['myData'])) {
		
		$obj = $_POST['myData'];

		$sql = "SELECT * FROM `songs` WHERE `song_name` = '$obj'";
		$query = $conn->query($sql);
		$row = $query->fetch_assoc();
		
		echo $row['song_uri'];
		
	} else {
		
		echo "Error";
		
	}
	
	
	

?>