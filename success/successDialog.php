<?php

	if (isset($_GET['s'])) {
		
		switch ($_GET['s']) {
			
			case 1:
				echo "<div class='successDialog dialogBox' id='dialogBox'><span>You have been registered. Check your email to activate your account.</span><span id='closeDialog'>X</span></div>";
				break;
				
			case 2:
				echo "<div class='successDialog dialogBox' id='dialogBox'><span>Your account has been activated!</span><span id='closeDialog'>X</span></div>";
				break;
				
			case 3:
				echo "<div class='successDialog dialogBox' id='dialogBox'><span>Login Successful</span><span id='closeDialog'>X</span></div>";
				break;
			
		}
		
	}

?>