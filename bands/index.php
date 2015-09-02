<?php
	
	
	// ACTUAL BAND PAGE CONTROL
	if (isset($_GET['band'])) {
		
		
		
		///////////////////////////
		// INCLUDED PAGES	////
		///////////////////////////
		require ("../includes/header.php");
		include(BASEPATH . "bands/process/bandPageModel.php");
		include(BASEPATH . "bands/widgets/bandPageView.php");
		
		
		
		///////////////////////////
		// CALL CLASSES		 ///
		///////////////////////////
		$zepp = new zeppTranslate;
		$camel = new camelCaseSplit;
		$image = new imageCentering;
		
		
		
		////////////////////////////////////
		// URL SPLIT AND CONVERT  ////
		////////////////////////////////////
		$val = $camel->camelCase("break", $_GET['band']);
		$bandZepp = $zepp->zeppCode("string", "zepp", $val);
		
		
		
		///////////////////////////
		// MODEL				////
		////////////////////////////
		
		$model = new bandPageModel($conn);
		
		// VALUES TO PULL
		$columns = array("band_name", "band_image", "band_header");
		
		// Store pulled values
		$row = $model->queryBand($bandZepp, $columns);
		#print_r($row);
		
		
		
		////////////////////////////
		// VIEWS				////
		////////////////////////////
		$refer = array("bandName", "bandImage");
		$view = new bandPageView($row);
		
		
		
		////////////////////////////
		// DEVELOP				 ////
		////////////////////////////
		$imgWidth = 375;
		$imgHeight = 250;
		$imgLoc = $view->bandImageSrc("image", $view->band_image);
		$imgStyle = $image->imgSpecs($imgLoc, $imgWidth, $imgHeight);
		$imgHeaderLoc = $view->bandImageSrc("header", $view->band_header);
		$imgHeaderStyle = $image->imgSpecs($imgHeaderLoc, 900, 200);
			
		
		/////////////////////////////
		// BOOTSTRAP				//
		/////////////////////////////
		require("bootstrap/bandPageBootstrap.php");
		
		
	
	// BASE FILES	
	} else {
		
		include(BASEPATH . "bands/process/bandHomepage.php");
		include(BASEPATH . "bands/widgets/bandHomepage.html");
		
	}

?>