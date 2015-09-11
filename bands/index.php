<?php
	
	
	// ACTUAL BAND PAGE CONTROL
	if (isset($_GET['band'])) {
		
		
		
		///////////////////////////
		// INCLUDED PAGES	////
		///////////////////////////
		require ("../includes/header.php");
		include(BASEPATH . "bands/process/bandPageModel.php");
		include(BASEPATH . "bands/widgets/bandPageView.php");
		include(BASEPATH . "polls/process/pollModel.php");
		include(BASEPATH . "polls/widgets/pollView.php");
		include(BASEPATH . "albums/process/albumModel.php");
		include(BASEPATH . "albums/widgets/albumView.php");
		
		
		
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
		$album = new AlbumModel;
		$poll = new PollModel($conn);
		
		// VALUES TO PULL
		$columns = array("band_name", "band_image", "band_header",
								  "band_city", "band_state", "band_country",
								  "band_bio", "band_formed", "band_disbanded",
								  "band_google", "band_itunes", "band_amazon",
								  "band_merchLink");
		
		// Store pulled values
		$row = $model->queryBand($bandZepp, $columns);
		$pollData = $poll->newPoll();
		$album->listAlbums();
		
		
		
		////////////////////////////
		// VIEWS				////
		////////////////////////////
		$view = new bandPageView($row);
		$polls = new PollView($pollData);
		$aView = new AlbumView($album);
		$side = $polls->setFloat("right");
		
		
		
		////////////////////////////
		// DEVELOP				 ////
		////////////////////////////
		$imgWidth = 375;
		$imgHeight = 250;
		$imgLoc = $view->bandImageSrc("image", $view->band_image);
		$imgStyle = $image->imgSpecs($imgLoc, $imgWidth, $imgHeight);
		$imgHeaderLoc = $view->bandImageSrc("header", $view->band_header);
		$imgHeaderStyle = $image->imgSpecs($imgHeaderLoc, 900, 200);
		
		
		$model->modelResults();
		$model->band['formed'] = substr($model->band['formed'], 0, 4);
		$model->band["active"] = $model->band["formed"] . " - " . $model->band['disbanded'];
		$view->merchButtons();
		#print_r($model->band);
		#echo $model->band["google"];
		
		// band info [$title => $information]
		$infoTitles = array("Hometown" => array("location"),
								   "Years Active" => array("active"),
								   "About" =>  array("bio"),
								   "Google Play" =>  array("google"),
								   "iTunes" =>  array("itunes"),
								   "Amazon" =>  array("amazon"),
								   "Merch" =>  array("merchLink"));
								   
								   
		
		
		
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