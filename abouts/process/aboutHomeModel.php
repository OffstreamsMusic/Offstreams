<?php

	class aboutHomeModel {
		
		function __construct() {
			global $conn;
			$this->conn = $conn;
		}
		
		public function queryFAQ($cols = array()) {
			
			$columns = implode(", ", $cols);
			$sql = "SELECT " . $columns . " FROM
						`faq` ORDER BY `faq_id` ASC";
			$query = $this->conn->query($sql);
			
			if ($query->num_rows > 0) {
				
				$results = array();
				while($row = $query->fetch_assoc()){
					foreach ($row as $key => $val) {
						$this->faq[$key][] = $val;
					}
				}
				return $this->faq;
				
			
				
			} else {
				
				return null;
				
			}
			
		}
		
	}

?>