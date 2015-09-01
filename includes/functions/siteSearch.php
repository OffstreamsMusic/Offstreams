<?php

	class siteSearch {
		
		
		// USED FOR QUERYING MULTIPLE TABLES
		// Needs to be multidimensional array
		// SYNTAX: $array['table']['column']
		// EX:		$array['band']['band_id']
		public function sqlQuery($array, $keyword) {
			
			
			// GET EACH ARRAY UNIQUE KEY
			// FOR TABLE NAME
			$count = 0;
			foreach($array[0] as $key => $val) {
			
				$k[] = $key;
				$type[] = rtrim($key, "s");
				$count++;
				
			}
			
			
			// CREATE EACH SQL STATEMENT FOR EACH TABLE TO SCAN
			$iter = count($array[0]);
			
			for ($i = 0; $i < count($array[0]); $i++) {
				// Loop through each table
				$select = "SELECT ";
				$val = $k[$i];
				$from = " FROM " . $k[$i];
				
				// Create list of columns
				for ($j = 0; $j < count($array[0][$k[$i]]); $j++) {
					
					
					// Column value
					if ($j == 0) {
						$col[$j] = $array[0][$k[$i]][0] . " as name";
						continue;
					} elseif ($j == 1) {
						$col[$j] = $array[0][$k[$i]][1] . " as id";
						continue;
					} elseif ($j == 2) {
						$col[$j] = $array[0][$k[$i]][2] . " as image";
						continue;
					} else {
						$col[$j] = $array[0][$k[$i]][$j];
					}
					
				}
				
				$list = implode(", ", $col);
				@
				
				
				// EACH TABLES SQL
				// SELECT `list_items`, 'type' as `type` FROM table
				$tableSql[] = $select . $list . ", '" . $type[$i] . "' as `type` " . $from . "";
				$whereState[] = " WHERE " . $k[$i] . "." . $array[0][$k[$i]][0] . " LIKE '" . $keyword . "%'";
			}
			
			#$where = implode(" OR ", $whereState);
			$sqlUnion = implode(" UNION ", $tableSql);
			$sql = "SELECT * FROM (" . $sqlUnion . ") foo WHERE name LIKE '" . $keyword . "%'";
			return $sql;
			
		}
		
		
	}

?>