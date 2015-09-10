<?php

	if (isset($_POST['submitPoll'])) {
		
		require ("../../includes/config/config.php");
		
		$value = $_POST['submitPoll'];
		$userId = $_SESSION['user_id'];
		$pollId = $_POST['pollId'];
		$answerId = $_POST['answerId'];
		
		$sql = "INSERT INTO `pollusers`
					(`poll_id`, `pollAns_id`, `user_id`)
					VALUES
					('$pollId', '$answerId', '$userId')";
		$query = $conn->query($sql);
		
		echo $value;
		
	} else {
		
	}

?>