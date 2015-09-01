<?php

	if (isset($_GET['e'])){
		
		switch ($_GET['e']) {
				
			case 1:
				echo "<div class='RegError dialogBox' id='dialogBox'><span>Passwords do not match</span><span id='closeDialog'>X</span></div>";
				break;
				
			case 2:
				echo "<div class='RegError dialogBox' id='dialogBox'><span>Username is already in use</span><span id='closeDialog'>X</span></div>";
				break;
				
			case 3:
				echo "<div class='RegError dialogBox' id='dialogBox'><span>Email has already been used</span><span id='closeDialog'>X</span></div>";
				break;
				
			case 4:
				echo "<div class='RegError dialogBox' id='dialogBox'><span>Username and email are both in use</span><span id='closeDialog'>X</span></div>";
				break;
				
			case 5:
				echo "<div class='logError dialogBox' id='dialogBox'><span>Username does not exist.</span><span id='closeDialog'>X</span></div>";
				break;
			
			case 6:
				echo "<div class='logError dialogBox' id='dialogBox'><span>Password is incorrect.</span><span id='closeDialog'>X</span></div>";
				break;
			
			default:
				break;
		}
		
	}

?>