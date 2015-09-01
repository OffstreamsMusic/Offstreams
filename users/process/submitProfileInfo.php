<?php
	
	require("../../includes/config/config.php");
	
	if (isset($_POST['submitProfileEdit'])) {

		$userBday = $_POST['userBdayMonth'] . $_POST['userBdayDay'] . $_POST['userBdayYear'];
		$elements = array($_POST['userName'], $_POST['userCity'], $_POST['userState'], 
									$_POST['userCountry'], $userBday, $_POST['userGender'], $_POST['userBio']);
		$value = array();
		for ($i = 0; $i < count($elements); $i++) {
			$value[] = $elements[$i];
		}


		$sql = "UPDATE `users`
					SET
						`user_name` = '$value[0]', `user_city` = '$value[1]', `user_state` = '$value[2]', 
						`user_country` = '$value[3]', `user_birthday` = '$value[4]', `user_gender` = '$value[5]', `user_bio` = '$value[6]'";
		
		$query = $conn->query($sql) or die;

		header("Location: " . BASE_URI . "user/" . $s->lower($_SESSION['username']));
		exit;
	}
	
?>