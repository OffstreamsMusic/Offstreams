<?php

	// INCLUDED INSIDE "/USER/INDEX.PHP"

	$sql = "SELECT * FROM `users`
				WHERE `username` = '$user'";
	$query = $conn->query($sql);
	$row = $query->fetch_assoc();
	
	// Set up location array
	$location = array($row['user_city'], $row['user_state'], $row['user_country']);
	$loc = array();
	
	
	// Class calls
	$clean = new cleanInput;
	#$img = new imageManipulate;
	
	// Parse Array with only elements that exist
	foreach($location as $locate) {
		if(empty($locate)){
			continue;
		}
		if ($locate == "United States") {
			$locate = "U.S.";
		}
		$loc[] .= $locate;
	}
	
	// Edited $location
	$userLocation = $s->strpLast($loc);
	$memSince = date("M j, Y", $row['user_created']);
	$userName = ucwords($row['user_name']);
	$month = $clean->numToMonth(substr($row['user_birthday'], 0, 2));
	$day = substr($row['user_birthday'], 2, 2);
	$year = substr($row['user_birthday'], 4, 4);
	
	// If User has bithday entered
	if ($row['user_birthday']) {
		$bday = $month . " " . $day . ", " . $year;
	} else {
		$bday = null;
	}
	
	
	// If image doesn't exist, use default
	if ($row['user_image'] == null) {
		$row['user_image'] = "defaultProfilePic.png";
	}
	
	// Image Location
	$imgLocation = BASE_URI . "images/users/profilePic/" . $row['user_image'];
	if (file_exists($imgLocation)) {
		$imgLocation = BASE_URI . "images/users/profilePic/" . $row['user_image'];
	} else {
		//$imgLocation = BASE_URI . "images/users/profilePic/defaultProfilePic.png";
	}
	
	$maxWidth = 230;
	$maxHeight = 230;
	list($width, $height) = getimagesize($imgLocation);
	
	// If Picture is landscape
	if ($width > $height) {
		
		// If picture is bigger than maximum size
		if ($width > $maxWidth) {
			$ratio = $maxHeight / $height;
			$height = $maxHeight;
			$width = $ratio * $width;
			$widthMargin = (($width / 2) - ($maxWidth / 2));
			$heightMargin = 0;
			
		// If picture is smaller than maximum size
		} elseif ($width < $maxWidth) {
			$ratio = $maxHeight / $height;
			$height = $ratio * $height;
			$width = $ratio * $maxWidth;
			$widthMargin = (($width / 2) - ($maxWidth / 2));
			$heightMargin = 0;
		}
	
	// If Picture is portrait
	} elseif ($width < $height) {
		
		// If picture is bigger than maximum size
		if ($height > $maxHeight) {
			$ratio = $maxWidth / $width;
			$width = $maxWidth;
			$height = $ratio * $height;
			$heightMargin = (($height / 2) - ($maxHeight / 2));
			$widthMargin = 0;
		
		// If picture is smaller than maximum size
		} elseif ($height < $maxHeight) {
			$ratio = $maxWidth / $width;
			$width = $ratio * $width;
			$height = $ratio * $maxHeight;
			$heightMargin = (($height / 2) - ($maxHeight / 2));
			$widthMargin = 0;
		}
		
	} else {
		$width = $maxWidth;
		$height = $maxHeight;
		$heightMargin = 0;
		$widthMargin = 0;
	}
	
	$profilePicStyling = "width: " . $width . "px; " . "height: " . $height . "px; margin-top: -" . $heightMargin . "px; margin-left: -" . $widthMargin . "px;";
	
	
	$pieces = array("Name:" => $userName, "Location:" => $userLocation,
							"Gender:" => ucfirst($row['user_gender']), "Birthday" => $bday, "Mem. Since:" => $memSince,
							"Active:" => ucfirst($row['user_active']), "Acc. Type:" => ucfirst($row['user_access']));
							
?>