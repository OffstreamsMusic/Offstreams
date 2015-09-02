<?php

	class bandPageView {
		
		
		// Create values from bands
		public function __construct($values = array()) {
			global $zepp;
			
			foreach ($values as $key => $val) {
				// Set zepped values
				$this->{$key} = $zepp->zeppCode("zepp", "symbol", $val);
			}
		}
		
		public function bandImageSrc($type, $source) {
			
			switch($type) {
				
				case "image":
					$folder = "";
					break;
				
				case "header":
					$folder = "headers/";
					break;
				
				default:
					return "Wrong source type given for parameter one";
					break;
			}
			
			// Default band header
			if (empty($source) && $type == "header") {
				$source = "defaultBandHeader.jpg";
			}
			
			$location = BASE_URI . "images/bands/" . $folder . $source;
			return $location;
		}
		
	}

?>