<?php
	
	$title = new siteTitle;
	$url = new urlSplit;
	
	$arg = $url->splitURL();
	$method = $arg[0][0];
	
	#print_r($arg);
	#echo $method;
	
	switch($method) {
		
		// Generate user page Title
		case "user":
			$user = $title->createTitle($_GET['user'], "username", "users");
			echo $title->isEdit() . " " . $user;
			break;
			
		case "cat":
			$cat = $title->createTitle($_GET['cat'], "nav_name", "navigation");
			echo $cat;
			break;
			
		default:
			echo "Offstreams - Discover your next favorite band";
			break;
	}

?>