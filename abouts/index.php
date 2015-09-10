<?php

	#require("../includes/header.php");

	// SPECIFIC TYPE OF ABOUT PAGE
	if (isset($_GET['type'])) {
		
		///////////////////////////
		// INCLUDED PAGES	////
		///////////////////////////
		include("aboutType.php");
	
	
	
	
	
	// ABOUT MAIN PAGE
	} else {
		
		///////////////////////////
		// INCLUDED PAGES	////
		///////////////////////////
		include ("process/aboutHomeModel.php");
		include ("widgets/aboutHomeView.php");
		
		
		
		///////////////////////////
		// CALL CLASSES		 ///
		///////////////////////////
		$zepp = new zeppTranslate;
		$camel = new camelCaseSplit;
		$image = new imageCentering;
		
		
		
		///////////////////////////
		// MODEL				////
		////////////////////////////
		$model = new aboutHomeModel($conn);
		
		// VALUES TO PULL
		$faqCols = array("faq_id", "faq_question", "faq_answer");
		
		// Store pulled values
		$faq = $model->queryFAQ($faqCols);
		
		
		
		////////////////////////////
		// VIEWS				////
		////////////////////////////
		$view = new aboutHomeView($row);
		
		
		
		////////////////////////////
		// DEVELOP				 ////
		////////////////////////////
		
		
		
		/////////////////////////////
		// BOOTSTRAP				//
		/////////////////////////////
		require("bootstrap/aboutHomeBootstrap.php");
		
		
		
	}


?>