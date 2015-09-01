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
		
		public function bandImage($source, $height, $width) {
			$location = BASE_URI . "images/bands/" . $source;
			return $location;
		}
		
	}

?>