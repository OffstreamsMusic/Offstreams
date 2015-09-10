<?php
	
	
	// ACTUAL BAND PAGE CONTROL
	if (isset($_GET['poll'])) {
		
		
		
		///////////////////////////
		// INCLUDED PAGES	////
		///////////////////////////
		require ("../includes/header.php");
		include(BASEPATH . "polls/process/pollModel.php");
		include(BASEPATH . "polls/widgets/pollView.php");
		
		
		
		///////////////////////////
		// CALL CLASSES		 ///
		///////////////////////////
		#$zepp = new zeppTranslate;
		#$camel = new camelCaseSplit;
		#$image = new imageCentering;
		
		
		
		///////////////////////////
		// MODEL				////
		////////////////////////////
		$model = new PollModel($conn);
		
		echo $model->newPoll();
		
		
		////////////////////////////
		// VIEWS				////
		////////////////////////////
		$view = new PollView;
		
		
		
		////////////////////////////
		// DEVELOP				 ////
		////////////////////////////
		
			
		
		/////////////////////////////
		// BOOTSTRAP				//
		/////////////////////////////
		#require("bootstrap/bandPageBootstrap.php");
		
		
	
	// BASE FILES	
	} else {
		
		// DEFAULT POLL PAGE
		
	}

?>