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
			
			global $camel;	# Must be declared beforehand
			global $zepp;		# Must be declared beforehand
			
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
				
			// More than one or none, return null
			} else {
				
				return null;
				
			}
		}
		
		
		
		// GET ALL ALBUMS FOR GIVEN BAND
		private function getAlbums($id = null, $sort) {

			
			$sql = "SELECT * FROM `albums`
					  WHERE `band_id` = '" . $id . "'
					  ORDER BY `album_released` " . $sort;
					  
			$query = $this->conn->query($sql);
			
			// Declare iteration
			$i = 0;
			while ($row = $query->fetch_assoc()){
				
				foreach ($row as $key => $val) {
					
					// # means iteration of albums
					// $this->album[#][$key] = $val
					$this->album[$i][str_replace("album_", "", $key)] = $val;
					
				}
				
				// Increase the iteration
				$i++;
				
			}
			
			return $this->album;
			
		}
		
		
		// LIST ALBUMS TO PAGE
		public function listAlbums($sort = "DESC") {
			
			$bandId = $this->getBand();
			$this->getAlbums($bandId, $sort);
			
		}
		
	}

?>