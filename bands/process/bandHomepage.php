<?php

	if (isset($_POST["submitMp3"])) {
		
		include("../../includes/config/config.php");
		
		$name = $_FILES['song']['name'];
		$tmp_name = $_FILES['song']['tmp_name'];
		echo $tmp_name . "<br/>";
		
		print_r($_FILES);
		echo $_FILES['song']['error'] . "<br>";
		
		$encrypt = $enc->encrypt($name);
		echo $encrypt;
		echo "<br>";
		$decrypt = $enc->decrypt($encrypt);
		echo $decrypt;
		
		if (isset ($name)) {
			if (!empty($name)) {

			$location = BASEPATH . 'music/';
			echo $location;

			move_uploaded_file($tmp_name, $location.$encrypt);
			
			if (move_uploaded_file($tmp_name, $location.$encrypt)){
			echo 'Uploaded';    
			}

			} else {
			  echo 'please choose a file';
			 }
		}
	}
		
	

?>