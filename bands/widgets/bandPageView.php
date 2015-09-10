<?php

	class bandPageView {
		
		public $band;
		public $merchArray = array("google", "itunes", "amazon", "merchLink");
		
		
		
		// Create values from bands
		public function __construct($values = array()) {
			global $zepp;
			global $row;
			
			$this->band = $row;
			
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
		
		
		
		private function merchAvailable($link) {
			
			global $model;
			
			// If merchandise link has a value
			if ($model->band[$link] != null) {
				
				$button = "
					<a href='" . $model->band[$link] . "' target='_blank' class='aWhite'>
						<img src='" . BASE_URI . "images/$link.png' style='height: 35px;' id='$link-Image' class='merchButton'/>
					</a>
						  ";
				
				$model->band[$link] = $button;
				
			} else {
				
				// Band has no merch for sale
				if ($link == "merchLink") {
					
					$button = "Band has no merch for sale";
					
				// Music not available on major seller
				} else {
					
					$button = "Not Available on " . $link;
					
				}
				
				// Reset original link value to the button's HTML or "N/A" error
				$model->band[$link] = $button;
				
			}
			
		}
		
		
		// DECLARE MERCH BUTTONS
		public function merchButtons() {
			
			global $model;
			
			$array = $this->merchArray;
			
			
			// Create link button
			foreach ($array as $link) {
				
				echo $this->merchAvailable($link);
				
			}
			
			#return $model->band;
			
		}
		
		
		
		
		public function bandInfoTitles($type, $titles = array()) {
			
			global $model;
			
			switch ($type) {
				
				case "title":
					$t = "title";
					break;
				
				case "info":
					$t = "info";
					break;
					
				// Return false if $type parameter is missing
				default:
					return false;
					break;
				
			}
			
			
			// keep value for color change
			$counter = 0;
			
			// Get the name for each title
			foreach ($titles as $title => $info) {
				
				
				// Set color amount
				if ($counter % 2 == 0) {
					$color = "evenGray";
				} else {
					$color = "oddWhite";
				}
				
				
				// Title
				if ($t == "title") {
					$listItem = "
					<p class='bandInfo $color' id='$title'>
						$title
					</p>";
				
				// Info
				} elseif ($t == "info") {
					
					
					
					#echo $model->band[$info[0]];
					foreach ($info as $val) {
						
						#echo $val;
						$information = $model->band[$val];
						#echo $model->band[$val];
						
					}
					
					
					$listItem = "
					<p class='bandInfoValues $color'>
						$information
					</p>";
				
				}
				
				
								
				$counter++;
				
				echo $listItem;
			}
			
		}
		
		
	}

?>