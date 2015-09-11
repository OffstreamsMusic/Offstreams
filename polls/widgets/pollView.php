<?php

	class PollView {
		
		public $poll;
		
		public function __construct($pollData) {
			
			$this->poll = $pollData;
			
		}
		
		
		
		// CREATE THE POLL TITLE
		public function pollTitle() {
			return "<h4 class='center' style='margin: 0 auto;'>" . $this->poll['name']['poll_title'] . "</h4>";
		}
		
		
		
		// LOOP THROUGH EACH ANSWER AND ECHO IT TO SCREEN
		public function pollAnswers($answers = array()) {
			
			foreach ($answers as $id => $name) {
				
				$ans = "
				<p>
					<input type='radio' name='pollValues' value='" . $name . "' id=" . $id . " class='pollRadioButton'/>
					" . $name . "
				</p>
				";
				
				echo $ans;
			}
		}
		
		
		
		// DISPLAY MESSAGE WHEN USER IS NOT ACTIVATED
		public function notActivePoll() {
			
			// USER IS LOGGED IN
			if (isset($_SESSION['active'])) {
				
				// USER IS NOT ACTIVE THOUGH
				if ($_SESSION['active'] == "unactive") {
					
					$error = "
						<br/>
						<span class='center'>
							<strong>Please activate your account to participate in polls</strong>
						</span>
					";
					
					return $error;
					
				}
			}
		}
		
		
		
		public function setFloat($side) {
			
			switch($side) {
				
				case "left":
					$float = "float: left; margin: 0 auto;";
					break;
				case "right":
					$float = "float: right; margin: 0 auto;";
					break;
				default:
					$float = null;
					break;
				
			}
			
			return $float;
		}
		
		
		// CREATE THE START OF THE POLL
		public function startPoll() {
			
			global $side;
			
			$poll = "
				<div class='pollWidget' style='" . $this->setFloat($side) . "'>
					<h2 class='center'>Poll:</h2>
			";
			
			return $poll;
			
		}
		
		
		// HTML TO END POLL
		public function endPoll() {
			
			$this->end = "</div>";
			return $this->end;
			
		}
		
		
		
		// CREATE THE FORM
		public function startForm() {
			
			$form = "
				<h4 class='center' style='margin: 0 auto;'>" . $this->poll['name']['poll_title'] . "</h4>
					<form action='" . BASE_URI . "polls/process/pollWidget.php' method='post' id='pollSubmitForm'>
						<input type='hidden' name='pollId' value='" . $this->poll['name']['poll_id'] . "' />
			";
			return $form;
			
		}
		
		
		
		// HTML TO END THE FORM
		public function endForm() {
			
			$form = "
				<div class='submitButton'>
					<input type='submit' name='submitPoll' id='submitPollButton' class='' />
				</div>
			</form>
			";
			return $form;
			
		}
		
		
	}
	
	
	
	// IS USER ACTIVATED?
	function isActivated() {
		
		// USER IS LOGGED IN
		if (isset($_SESSION['active'])) {
			
			// USER IS ACTVE
			if ($_SESSION['active'] == "active") {
				
				return true;
			
			// USER IS NOT ACTIVE
			} else {
				
				return false;
				
			}
			
		// USER IS NOT LOGGED IN
		} else {
			
			return false;
			
		}
	}


?>