<?php
	
	class bandPageModel {
		
		private $conn;
		
		public function __construct($conn) {
			$this->conn = $conn;
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
			
			if ($query->num_rows == 1) {
				return $query->fetch_assoc();
			} else {
				return null;
			}
			
		}
		
		public function modelResults() {
			
			global $name;
			global $get;
			
			$rows = $this->queryBand($name, $get);
			
			$row = array();
			while ($rows) {
				foreach($rows as $value) {
					$row[] = $value;
				}
			}
			
			return $row;
			
		}
	}
	
	
	

?>