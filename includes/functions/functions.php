<?php

	class cleanInput {
		
		function sanitize($input) {
			global $conn;
			$search = array(
				'@<script[^>]*?>.*?</script>@si',   // Strip out javascript
				'@<[\/\!]*?[^<>]*?>@si',            // Strip out HTML tags
				'@<style[^>]*?>.*?</style>@siU',    // Strip style tags properly
				'@<![\s\S]*?--[ \t\n\r]*>@'         // Strip multi-line comments
			);

			$preg = preg_replace($search, '', $input);
			$output = mysqli_real_escape_string($conn, $preg);
			
			return $output;
		}
		
		function randString($length) {
			$characters = "1234567890abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ";
			$characterLen = strlen($characters);
			$randomString = "";
			for ($i = 0; $i < $length; $i++){
				$randomString .= $characters[rand(0, $characterLen - 1)];
			}
			return $randomString;
		}
		
		function arrayView($input) {
			echo "<pre>";
			print_r($input);
			echo "</pre>";
		}
		
		function numToMonth($input) {
			$month = array("01" => "Jan", "02" => "Feb", "03" => "Mar", "04" => "Apr", "05" => "May",
									"06" => "Jun", "07" => "Jul", "08" => "Aug", "09" => "Sept", "10" => "Oct", "11" => "Nov", "12" => "Dec");
			foreach ($month as $mon => $abbr){
				if ($input != $mon) {
					continue;
				} else {
					return $abbr;
				}
			}
		}
		
		function monthToNum($input) {
			$month = array("01" => "Jan", "02" => "Feb", "03" => "Mar", "04" => "Apr", "05" => "May",
									"06" => "Jun", "07" => "Jul", "08" => "Aug", "09" => "Sept", "10" => "Oct", "11" => "Nov", "12" => "Dec");
			foreach ($month as $mon => $abbr){
				if ($input != $abbr) {
					continue;
				} else {
					return $mon;
				}
			}
		}
		
		
	}
	
	
	// MAKE PHP FUNCTIONS SHORTER
	class shortenPhpFunctions {
		
		function lower($input) {
			return strtolower($input);
		}
		
		function ucase($input) {
			return strtoupper($input);
		}
		
		function ucfirstall($input) {
			$tmp[] = explode(" ", $input);
			for ($i = 0; $i < count($tmp); $i++) {
				$tmp .= ucfirst($tmp[$i]);
			}
			$output = implode(" ", $tmp);
		}
		
		function strpLast($results) {
			$result = implode(", ", $results);
			return $result;
		}
		
	}
	
	
	
	// Class to go back and forth between Zepp Code
	class zeppTranslate {
		
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
		
		
		/////////////////////////////////////////////////////////////////////////////////////////////////
		//
		// 			zeppArray()
		//
		//
		// DECLARES SPECIFIC ZEPP CODE FOR
		// EACH SYMBOL BEING USED FOR IT'S
		// WORD COUNTERPART
		//
		// Usage:
		// 		- This function is a private function that is used
		//			to determine symbols. All functions use the code
		//			adequately. Feel free to add your own.
		//			The syntax for each Zepp code:
		//
		//				array("@param1", "@param2", "@param3"),
		//				
		//			@param1:
		//				* Indicates the desired code. Begins with "%" and
		//					ends with "#". Between both characters is a made
		//					up three digit number that is used to decipher 
		//					meanings of Zepp code.
		//
		//			@param2:
		//				* Indicates the symbol to be used (i.e. "&")
		//
		//			@param3:
		//				* Indicates the @param2 English word. Like in @param2,
		//					the corresponding string would be "and".
		//
		//			@return:
		//				* Returns the entire array to be looped for appropriate values.
		
		private function zeppArray() {
			global $zeppArray;
			
			
			// All zepp code goes in this array based on the syntax above
			$zeppArray = array(
										array("%001#", "&", "and"),
										array("%002#", "@", "at"),
										array("%003#", "#", "hash"),
										array("%004#", "*", "asterisks"),
										array("%005#", "$", "dollar"),
										array("%006#", "%", "percent"),
										array("%007#", "^", "power"),
										array("%008#", "/", "slash"),
										array("%009#", "-", "dash"),
										array("%010#", "_", "underscore"),
										array("%011#", "+", "plus"),
										array("%012#", "=", "equals")
										);
			
			// Return entire array
			return $zeppArray;
		}
		
		
		/////////////////////////////////////////////////////////////////////////////////////////////////////////////
		//
		//			zeppCode()
		//
		//
		// CONVERT KEYBOARD SPECIAL CHARS INTO "ZEPP" CODE
		//
		// Usage:
		// 		- This function is designed to convert special chars or "symbols"
		//			into "zepp" code, a code stored in a database to be used to
		//			convert a character into either it's special char or it's English
		//			string. It's purpose is for a transition between proper usage and
		//			URL usage (i.e. "&", "%", "#" all have special meaning in URL's but
		//			are used by pop culture phrases and words).
		//
		//			@syntax:
		//				* The legal syntax usage for @param1 and @param2 are as following:
		//					
		//						- "symbol"
		//						- "zepp"
		//						- "string"
		//
		//				* Each possible parameter is self-explanatory and their usage is explained below.
		//				* If parameters are not legal syntax for function, an error is returned instead of desired string
		//				* Parameters can be used in any mixture that is desired (even if it @param1 and @param2 are the same).
		//
		//			@param1:
		//				* Indicates the starting point for the conversion (i.e. converting
		//					from symbol to zepp code).
		//
		//			@param2:
		//				* Indicates the ending point for the conversion (i.e. converting
		//					from zepp code to string).
		//
		//			@param3:
		//				* Indicates input string. It is inserted as a string with whitespace included
		//					(like a normal string of text).
		//
		//			@return:
		//				* Returns a string with whitespace exactly as entered, with the exception
		//					of the special chars being converted into zepp code/string or vice versa.
		//					(i.e. returns "Scruffy %001# the Janitors" instead of "Scruffy & the Janitors"), etc.
		//
		//					!!Main purpose is for database storage!!
		//					Use this to store in database for the purpose of making URL's legal, while maintaining
		//					the original text design through this simple and easy conversion.
		
		
		public function zeppCode($type1, $type2, $string) {
			
			$types = array($type1, $type2);
			$type = array();
			for($i = 0; $i < count($types); $i++) {
				
				switch($types[$i]) {
					
					case "symbol":
						$type[] = 1;
						break;
					
					case "zepp":
						$type[] = 0;
						break;
						
					case "string":
						$type[] = 2;
						break;
						
					default:
						return "Incorrect parameters used!";
						break;
					
				}
				
			}
			
			$stringArray = explode(" ", $string);
			$zeppArray = $this->zeppArray();
			$arrayVal = count($zeppArray);
			
			// Loop through each string
			$strings = array();
			foreach ($stringArray as $string) {
			
				// Check if this is a word on list
				for ($i = 0; $i < $arrayVal; $i++) {
					
					// If symbol is in list
					if ($string == $zeppArray[$i][$type[0]]) {
						
						// Return it's Zepp value
						$string = $zeppArray[$i][$type[1]];
					
					// Skip if it is not in the list
					} else {
						
						$string = $string;
						continue;
						
					}
					
				}
				$strings[] = $string;
			}
			
			$s = implode(" ", $strings);
			return $s;
			
		}
		
		
	}
	
	
	
	class imageCentering {
	
	// Return image size
	private function getImgSize($imgLocation) {
		list($width, $height) = getimagesize($imgLocation);
		$size["w"] = $width;
		$size["h"] = $height;
		return $size;
	}
	
	
	private function determineSpecs($maxWidth, $maxHeight, $height, $width) {
		
		// If Picture is landscape
		if ($width > $height) {
			
			// If picture is bigger than maximum size
			if ($width > $maxWidth) {
				$ratio = $maxHeight / $height;
				$height = $maxHeight;
				$width = $ratio * $width;
				$widthMargin = (($maxWidth / 2) - ($width / 2));
				$heightMargin = 0;
				
				/*
				$ratio = $ / $height;
				$height = $maxHeight;
				$width = $maxWidth / $ratio;
				$widthMargin = (($maxWidth / 2) - ($width / 2));
				$heightMargin = 0;
				// need h/w margins
				// need h/w */
				
			// If picture is smaller than maximum size
			} elseif ($width < $maxWidth) {
				// If frame width is bigger than height
				if ($maxWidth > $maxHeight) {
					$ratio = $maxWidth / $width;
					$width = $maxWidth;
					$height = $ratio * $height;
					$heightMargin = (($maxHeight / 2) - ($height / 2));
					$widthMargin = 0;
				// If frame height is bigger than width
				} else {
					$ratio = $maxHeight / $height;
					$height = $ratio * $height;
					$width = $ratio * $maxWidth;
					$widthMargin = (($maxWidth / 2) - ($width / 2));
					$heightMargin = 0;
				}
			}
		
		// If Picture is portrait
		} elseif ($width < $height) {
			
			// If picture is bigger than maximum size
			if ($height > $maxHeight) {
				$ratio = $maxWidth / $width;
				$width = $maxWidth;
				$height = $ratio * $height;
				$heightMargin = (($maxHeight / 2) - ($height / 2));
				$widthMargin = 0;
			
			// If picture is smaller than maximum size
			} elseif ($height < $maxHeight) {
				$ratio = $maxWidth / $width;
				$width = $ratio * $width;
				$height = $ratio * $maxHeight;
				$heightMargin = (($maxHeight / 2) - ($height / 2));
				$widthMargin = 0;
			}
			
		// Picture is square
		} elseif ($width == $height) {
			
			// If maxWidth is more than maxHeight
			if ($maxHeight < $maxWidth) {
				$width = $maxWidth;
				$height = $width;
				$heightMargin = (($maxHeight / 2) - ($height / 2));
				$widthMargin = 0;
			
			// If maxWidth is less than maxHeight
			} elseif ($maxHeight > $maxWidth) {
				$height = $maxHeight;
				$width = $height;
				$widthMargin = (($maxWidth / 2) - ($width / 2));
				$heightMargin = 0;
			
			// Both resolution and max border size are square
			} else {
				$height = $maxHeight;
				$width = $maxWidth;
				$heightMargin = 0;
				$widthMargin = 0;
			}
			
		} else {
			return "WTF";
		}
		
		$picStyling = "width: " . $width . "px; " . "height: " . $height . "px; margin-top: " . $heightMargin . "px; margin-left: " . $widthMargin . "px;";
	
		return $picStyling;
		
	}
	
	public function imgSpecs($imgLocation, $maxWidth, $maxHeight) {
		#global $size;
		
		$size = $this->getImgSize($imgLocation);
		$width = $size["w"];
		$height = $size['h'];
		
		#echo $width . " " . $height;
		
		$specs = $this->determineSpecs($maxWidth, $maxHeight, $height, $width);
		
		return $specs;
		
	}
	
	/*
		$maxWidth = 230;
		$maxHeight = 230;
		list($width, $height) = getimagesize($imgLocation);
	
	// If Picture is landscape
	if ($width > $height) {
		
		// If picture is bigger than maximum size
		if ($width > $maxWidth) {
			$ratio = $maxHeight / $height;
			$height = $maxHeight;
			$width = $ratio * $width;
			$widthMargin = (($width / 2) - ($maxWidth / 2));
			$heightMargin = 0;
			
		// If picture is smaller than maximum size
		} elseif ($width < $maxWidth) {
			$ratio = $maxHeight / $height;
			$height = $ratio * $height;
			$width = $ratio * $maxWidth;
			$widthMargin = (($width / 2) - ($maxWidth / 2));
			$heightMargin = 0;
		}
	
	// If Picture is portrait
	} elseif ($width < $height) {
		
		// If picture is bigger than maximum size
		if ($height > $maxHeight) {
			$ratio = $maxWidth / $width;
			$width = $maxWidth;
			$height = $ratio * $height;
			$heightMargin = (($height / 2) - ($maxHeight / 2));
			$widthMargin = 0;
		
		// If picture is smaller than maximum size
		} elseif ($height < $maxHeight) {
			$ratio = $maxWidth / $width;
			$width = $ratio * $width;
			$height = $ratio * $maxHeight;
			$heightMargin = (($height / 2) - ($maxHeight / 2));
			$widthMargin = 0;
		}
		
	} else {
		$width = $maxWidth;
		$height = $maxHeight;
		$heightMargin = 0;
		$widthMargin = 0;
	}
	
	$profilePicStyling = "width: " . $width . "px; " . "height: " . $height . "px; margin-top: -" . $heightMargin . "px; margin-left: -" . $widthMargin . "px;";
	*/
		
	}
	
	
	
	class camelCaseSplit {
		
		public function camelCase($type, $string) {
			
			switch($type) {
				
				case "create":
					$nine = 1;
					break;
				
				case "break":
					$nine = 2;
					break;
					
				default:
					$nine = "Illegal syntax for Parameter 1";
					break;
				
			}
			
			$camel = "";
			
			if ($nine == 1) {
				$stringArray = explode(" ", $string);
				for ($i = 0; $i < count($stringArray); $i++) {
					if ($stringArray[$i] > 0) {
						$stringArray[$i] = ucfirst($stringArray[$i]);
					}
					$camel .= $stringArray[$i];
				}
				
				return $camel;
			} elseif ($nine == 2) {
				$camel = preg_split('/(?=[A-Z])/', $string);
				for ($i = 0; $i < count($camel); $i++) {
					$camel[$i] = strtolower($camel[$i]);
				}
				$cam = implode(" ", $camel);
				return $cam;
			} else {
				return $nine;
			}
			
		}
		
	}
	
	
	
	
	
	
	
?>