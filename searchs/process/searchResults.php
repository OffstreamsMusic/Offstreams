<?php

	require ("../../includes/config/config.php");
	
	if (isset($_POST['searchResult'])) {
		
		$searchTerm = $_POST['searchResult'];
		
		// IF THERE IS NO VALUE
		if ($searchTerm == null) {
			
			echo "";
			
		// SEARCH IF THERE IS VALUE
		} else {
		
			$camel = new camelCaseSplit;
			$q = new siteSearch;
			$clean = new cleanInput;
			$img = new imageCentering;
			
			$search[] = array(	"bands" => array("band_name", "band_id", "band_image"),
										"albums" => array("album_name", "album_id", "album_image"),
										"users" => array("username", "user_id", "user_image"));
			
			$searchTerm = $zepp->zeppCode("symbol", "zepp", $searchTerm);
			
			$result = $q->sqlQuery($search, $searchTerm);
			$query = $conn->query($result);
			
			if ($query->num_rows > 0) {
			
				while($row = $query->fetch_assoc()){
					
					// GET VALUES FOR ARRAY
					$name = $zepp->zeppCode("zepp", "symbol", $row['name']);			# Convert db zepp code back to symbols
					$linkZepp = $zepp->zeppCode("zepp", "string", $row['name']);			# Convert db zepp code back to strings
					$row['type'] = ucfirst($row['type']);											# Make row type uppercase
					
					// GET IMAGE SIZE SPECS
					$type = strtolower($row['type']) . "s";
					$imgLoc = BASEPATH . "images/" . $type . "/" . $row['image'];
					list($width, $height) = getimagesize($imgLoc);
					$jesus = $img->imgSpecs($imgLoc, 90, 70);
					
					// CREATE VALUES FOR JSON ARRAY
					$val[] = array('id' => $row['id'], 
										'name' => $name, 
										'img' => $row['type'] . "s" . "/" . $row['image'], 
										'type' => $row['type'],
										'link' => $linkZepp,
										'imgHeight' => $height,
										'imgWidth' => $width,
										'stuff' => $jesus);
					
				}
			
			// RETURN JSON ARRAY
			echo json_encode($val);
			
			} else {
				
				$val = null;
				echo json_encode($val);
				
			}
			
		}
		
	}
	


?>