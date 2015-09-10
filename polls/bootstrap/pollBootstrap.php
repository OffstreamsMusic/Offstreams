<?php
	
	// Is user logged in and on their page?
	#if ($poll->isUserPage()) {
		
		echo $polls->startPoll();
		
		if (isActivated()) {
			
			echo $polls->startForm();
			echo $polls->pollAnswers($poll->poll['answer']);
			echo $polls->endForm();
			
		} else {
			
			echo $polls->notActivePoll();
			
		}
		
		echo $polls->endPoll();
		
	// They are not on their page or logged in
	#} else {
		
		
		
	#} 

?>