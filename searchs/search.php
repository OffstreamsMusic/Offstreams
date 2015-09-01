<?php

	require ("../includes/header.php");

	if (isset($_GET['search'])) {
		
		$camel = new camelCaseSplit;
		$q = new siteSearch;
		$clean = new cleanInput;
		
		$search[] = array(	"bands" => array("band_name", "band_id", "band_image"),
									"albums" => array("album_name", "album_id", "album_image"));
		
		$searchTerm = $camel->camelCase("break", $_GET['search']);
		$clean->arrayView($search);
		
		$result = $q->sqlQuery($search, $searchTerm);
		$query = $conn->query($result);
		
		echo $result . "<br>";
		
		while($row = $query->fetch_assoc()){
			
			$val =  $zepp->zeppCode("zepp", "symbol", $row['name']);
			echo $val . " - " . $row['type'];
			
		}
		
		
		
		
		#echo $searchTerm;
		
	} else {
		
		echo "Search";
		
	}

?>