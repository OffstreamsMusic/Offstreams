<?php 

	class urlSplit {
		
		private $url;
		
		// CREATE CLASS VARIABLES
		public function __construct() {
			$this->url = $_SERVER['QUERY_STRING'];
		}
		
		
		private function trimURL() {
			$parameters = explode('/', rtrim($this->url, '/'));
			
			return $parameters[0];
		}
		
		private function trimParams() {
			
			$param = $this->trimURL();
			
			// If there is a parameter present
			if ($param != null){
				
				// If there are more than one string set
				if (strpos($param, '&') !== false) {
					
					$paramArray = explode("&", $param);
					return $paramArray;
				
				// There is just one string set
				} else {
					
					return $param;
					
				}
				
			// The url has no parameters
			} else {
				
				return $param;
				
			}
		}
		
		
		private function trimValues() {
			
			$values[] = $this->trimParams();
			
			if ($values != null) {
				
				$count = count($values);
				
				$p[] = explode("=", $values[0]);
				
				
				return $p;
				
			} else {
				
				return $values;
				
			}
			
		}
		
		
		public function splitURL() {
			
			$this->trimURL();
			$this->trimParams();
			return $this->trimValues();
			#return $p;
			
		}
		
	}

?>