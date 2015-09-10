<?php

	class AlbumModel {
		
		private $conn;
		public $album;
		
		public function __construct() {
			
			global $conn;
			
			$this->conn = $conn;
			
		}
		
		
		
		// GET BAND ID BASED ON BAND NAME IN PARAMETER
		private function getBand($band = null) {
			
			global $camel;
			global $zepp;
			
			// Parameter empty
			if ($band == null) {
				
				// On band page
				if (isset($_GET['band'])) {
					
					$band = $camel->camelCase("break", $_GET['band']);
					$band = $zepp->zeppCode("string", "zepp", $band);
					
				// Not on band page, Return false
				} else {
					
					return false;
					
				}
				
			// Parameter provided
			} else {
				
				$band = $band;
				
			}
			
			// SQL STATMENT
			$sql = "SELECT `band_id` FROM `bands`
					  WHERE `band_name` = '" . $band . "'";
			$query = $this->conn->query($sql);
			
			// Make sure there is only 1 result
			if ($query->num_rows == 1) {
				
				$row = $query->fetch_assoc();
				
				return $row['band_id'];
				
			} else {
				
				return null;
				
			}
			
			
		}
		
		
		private function getAlbums($id = null) {

			
			$sql = "SELECT * FROM `albums`
					  WHERE `band_id` = '" . $id . "'";
					  
			$query = $this->conn->query($sql);
			
			while ($row = $query->fetch_assoc()){
				
				foreach ($row as $key => $val) {
					$this->album[ltrim($key, "album_")] = $val;
				}
				
			}
			
			return $this->album;
			
		}
		
		
		public function listAlbums() {
			
			$bandId = $this->getBand();
			$this->getAlbums($bandId);
			
		}
		
	}

?>