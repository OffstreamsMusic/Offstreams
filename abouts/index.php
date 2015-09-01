<?php

	if (isset($_GET['type'])) {
		
		require ("../includes/header.php");
		
	
	// ABOUT MAIN PAGE
	} else {
		
		include (BASEPATH . "abouts/process/aboutHome.php");
		include (BASEPATH . "abouts/widgets/aboutHome.html");
		
	}

?>