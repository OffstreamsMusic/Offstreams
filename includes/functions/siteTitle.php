<?php
		// FUNCTIONS:
		//
		//		MAIN ---> zeppCode():
		//			- The function used to convert between zepp code,
		//				symbols, and strings.
		//
		//		Private ---> zeppArray():
		//			- For storing zepp codes, their symbols, and associated strings
		//
		//		!! Looping through every value may appear to be "slow", but the default "zepp" codes
		//		!! couldn't even be registered by the computer as even a microscopic fraction of a second.
		//
		//		!! Tested on:
		//				OS:	Windows 7
		//				RAM:	8GB
		//				CPU:	Intel i7, 2.5GHz, quad-core, 6MB cache
	class siteTitle {
		
		private function queryTable($get, $col, $table){
			
			$sql = "SELECT " . $col . " FROM " . $table . 
					" WHERE " . $col . " = '" . $get . "'";
					
			return $sql;
			
			
		}
		
		public function createTitle($get, $col = null, $table = null) {
			
			$default = " | Offstreams";
			global $conn;
			
			if ($table != null && $col != null) {
				
				$sql = $this->queryTable($get, $col, $table);
				$query = $conn->query($sql);
				
				if ($query->num_rows == 1) {
					
					$row = $query->fetch_assoc();
					return $row[$col] . $default;
					
				} else {
					
					return $get . $default;
					
				}
				
				
			} else {
				
				return $get . $default;
				
			}
			
		}
		
		
		// See if page is being edited
		public function isEdit() {
			
			if (isset($_GET['edit'])) {
				return "Edit";
			} else {
				return "";
			}
			
		}
		
	}
	
?>