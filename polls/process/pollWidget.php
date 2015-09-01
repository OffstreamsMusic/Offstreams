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
		
		$sql = "SELECT * FROM polls
					RIGHT JOIN
					pollanswers
					ON polls.poll_id = pollanswers.poll_id";
					
		$query = $conn->query($sql);
		while ($row = $query->fetch_assoc()){
			$pollId = $row['poll_id'];
			$answerId[] = $row['pollAns_id'];
			$name[] = $row['pollAns_name'];
		}
		
		
		
		
	}

?>