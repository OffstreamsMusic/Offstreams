<?php require ("../includes/header.php"); ?>
<?php

	// LEGAL URL SYNTAX:
	//  base_uri/users/edit.php?user=$1&change=$2&edit=$3
	//
	// EXAMPLE: base_uri/users/edit.php?user=raptorjesus67&change=edit&edit=profile
	// REWRITTEN: base_uri/user/raptorjesus67/edit/profile

	$argsNoEdit = $_GET['user'] . ", " . $_GET['change'] . ", " . $_SESSION['username'];
	$userCheck = ($s->lower($_GET['user']) == $s->lower($_SESSION['username']));
	$editPage = $_GET['change'] . " == edit";

	// USER IS LOGGED IN AND EDITING PAGE
	if (isset($argsNoEdit) && isset($_GET['edit']) && $editPage && $userCheck){
		
		$user = $_GET['user'];
		
		//Load profile widget
		include (BASEPATH . "users/process/profileInfo.php");
		include (BASEPATH . "users/widgets/profileInfo.html");
		
		
		// USER IS EDITING PROFILE INFO
		if ($_GET['edit'] == "profile") {
			//Load profile editing widget
			include (BASEPATH . "users/process/editProfileInfo.php");
			include (BASEPATH . "users/widgets/editprofileInfo.html");
		}
		
		
		// USER IS EDITING PROFILE IMAGE
		if ($_GET['edit'] == "image") {
			// Load image editing widget
			include (BASEPATH . "users/process/editProfileImage.php");
			include (BASEPATH . "users/widgets/editProfileImage.html");
		}
		
		
		// Load poll widget
		include (BASEPATH . "polls/process/pollWidget.php");
		include (BASEPATH . "polls/widgets/pollWidget.html");
		
		
	} elseif (isset($argsNoEdit) && $editPage && $userCheck) {
		
		header("Location: " . BASE_URI . "user/" . $_GET['user'] . "/edit/profile");
		exit;
		
	// USER IS NOT LOGGED IN
	} else {
		
		header("Location: " . BASE_URI . "user/" . $_GET['user']);
		exit;
		
	}
?>