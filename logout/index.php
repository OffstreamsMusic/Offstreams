<?php

	require("../includes/config/config.php");

	if (isset($_SESSION['username'])) {
		
		$values = array("username", "password", "active", "access");
		$cookies = array("OSTR-ID", "OSTR-ID-2");
		
		// UNSET SESSIONS
		for ($i = 0; $i < count($values); $i++) {
			unset($_SESSION[$values[$i]]);
		}
		
		// Unset cookies
		$cookie->unsetCookies($cookies);
		
		$_SESSION['loggedIn'] = false;
		
		header ("Location: " . BASE_URI);
		exit;
		
	} else {
		
		header ("Location: " . BASE_URI);
		exit;
		
	}

?>