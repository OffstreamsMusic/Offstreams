<?php

	class bandPageView {
		
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
			
			$cols = implode(", ", $get);
			$sql = "SELECT " . $cols . " FROM `bands` WHERE `band_name` = '$name'";
			$query = $this->conn->query($sql);
			
			#if ($query->num_rows == 1) {
				return $query->fetch_assoc();
			#} else {
			#	return false;
			#}
			
		}
	}

?>