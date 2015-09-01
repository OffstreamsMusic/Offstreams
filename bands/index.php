<?php  ?>
<?php
	
	
	// ACTUAL BAND PAGE CONTROL
	if (isset($_GET['band'])) {
		
		require ("../includes/header.php");
		
		include(BASEPATH . "bands/process/bandPageModel.php");
		include(BASEPATH . "bands/widgets/bandPageView.php");
		
		$zepp = new zeppTranslate;
		$camel = new camelCase;
		
		$val = $camel->camelCase("break", $_GET['band']);
		$bandZepp = $zepp->zeppCode("string", "zepp", $val);
		
		
		$columns = array("band_name", "band_image");
		
		#$view = new bandPageView($conn);
		#$row = $view->queryBand($bandZepp, $columns);
		#echo $row['band_name'];
		echo $bandZepp;
		
	
	// BASE FILES	
	} else {
		
		include(BASEPATH . "bands/process/bandHomepage.php");
		include(BASEPATH . "bands/widgets/bandHomepage.html");
		
	}

?>