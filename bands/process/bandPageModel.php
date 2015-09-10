<?php
	
	class bandPageModel {
		
		private $conn;
		public $band;
		
		public function __construct($conn) {
			$this->conn = $conn;
			$this->band;
		}
		
		/*
		public function bandName($get) {
			$sql = "SELECT `band_name` FROM `bands` WHERE `band_name` = '$get'";
			$query = $this->conn->($sql);
			 
		}*/
		
		
		public function queryBand($name, $get = array()) {
			
			if (count($get) > 1) {
				$gets = implode(", ", $get);
			} else {
				$gets = $get;
			}
			
			
			
			$sql = "SELECT " . $gets . " FROM `bands` WHERE `band_name` = '$name'";
			$query = $this->conn->query($sql);
			
			if (@$query->num_rows == 1) {
				$row = $query->fetch_assoc();
				return $row;
			} else {
				return null;
			}
			
		}
		
		
		private function locationResults() {
			
			// values to be inserted into location
			$location = array("city", "state", "country");
			foreach ($location as $val) {
				
				// If value is empty, skip
				if ($val == null) {
					
					continue;
					
				} else {
					
					// Set up values for implode
					$loc[] = $this->band[$val];
					
				}
				
				// Make it so it's [city, state, country]
				$this->band['location'] = implode(", ", $loc);
				
			}
		}
		
		
		public function modelResults() {
			
			global $row;
			
			foreach($row as $key => $value) {
				$this->band[str_replace("band_", "", $key)] = $value;
			}
			
			$this->locationResults();
			
		}
		
	}
	
	
	

?>