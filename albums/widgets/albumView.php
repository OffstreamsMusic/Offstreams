<?php

	class AlbumView {
		
		private $model;
		public $album;
		public $counter;
		
		
		public function __construct($model) {
			
			$this->model = $model;
			
		}
		
		
		
		public function setCounter() {
			
			$this->counter = 0;
			
			return $this->counter;
			
		}
		
		
		
		// HTML FOR ALBUM IMAGE
		public function albumImage($image = null) {
			
			$location = BASE_URI . "images/albums/" . $image;
			$pic = "<div class='albumInfoLeftCol'><img src='" . $location . "' class='albumImage'/></div>";

			return $pic;
			
		}
		
		
		
		// GET RELEASE DATE
		public function releaseDate($type = "all", $i) {
			
			$time = strtotime($this->model->album[$i]["released"]);
			
			switch($type) {
				
				case "year":
					$date = date("Y", $time);
					break;
					
				case "month":
					$date = date("M", $time);
					break;
					
				case "day":
					$date = date("j", $time);
					break;
				
				 case "month day":
				 case "day month":
					$date = date("M j", $time);
					break;
					
				case "month year":
				case "year month":
					$date = date("M Y", $time);
					break;
					
				default:
					$date = date("M j, Y", $time);
			}
			
			return $date;
			
		}
		
		
		
		// FORMAT THE ALBUM TYPE TO LOOK BETTER
		public function albumTypeFormat($type, $i) {
			
			switch ($type) {
				
				case "ep":
					$album = "E.P.";
					break;
					
				case "album":
				default:
					$album = "Album";
					break;
				
			}
			
			return $album;
			
		}
		
		
		
		// INFO BAR FOREACH ALBUM
		public function albumInfoBar($i) {
			
			$bar = "<div class='albumInfoBar'>
						<span>
							<h2>(" . $this->releaseDate("year", $i) . ") " . $this->model->album[$i]["name"] . "</h2>
						</span>
						<span>
							<h2> - " . $this->albumTypeFormat($this->model->album[$i]["type"], $i) . "</h2>
						</span>
					  </div>";
			
			return $bar;
			
		}
		
		
		
		// ALBUM INFO
		public function generalAlbumInfo($i) {
			
			$info = "
						<div class='albumInfoRightCol'>
							<p><strong>Label:</strong> " . $this->model->album[$i]["label"] . "</p>
							<p><strong>Released: </strong> " . $this->releaseDate("all", $i) . "</p>
							<p><strong>Description: </strong><br>" . $this->model->album[$i]["desc"] . "</p>
						</div>
						";
						
			return $info;
			
		}
		
		
		// DISPLAYS ALL THE ALBUMS TO THE SCREEN
		public function displayAlbums($i = 0) {
			
			echo $this->albumInfoBar($i);
			echo $this->albumImage($this->model->album[$i]["image"]);
			echo $this->generalAlbumInfo($i);
			
			
		}
		
		
	}

?>