<?php
	
	require("../includes/config/config.php");  
	
	$errors = array();
	
	// If User Submitted Register Form
	if(isset($_POST['registerSubmit'])){
		
		// create sanitizing class
		$clean = new cleanInput;
		
		$register = array();
		$register[0] = $_POST['username'];
		$register[1] = $_POST['password'];
		$register[2] = $_POST['confirmPass'];
		$register[3] = $_POST['email'];
		$register[4] = time();
		$register[5] = $clean->randString(40);
		$register[6] = (SALT . $_POST['username'] . SALT);
		
		// Check username and email
		$sql = "SELECT `username`, `user_email` FROM `users` 
					WHERE `username` = '$register[0]' or `user_email` = '$register[3]'";
		$query = $conn->query($sql);
		
		if ($query->num_rows > 0) {
			
			$row = $query->fetch_assoc();
			
			if ($register[0] == $row['username'] && $register[3] == $row['user_email']) {
				
				header("Location: " . BASE_URI . "index.php?e=4");
				exit;
				
			} elseif ($register[0] == $row['username']) {
				
				header("Location: " . BASE_URI . "index.php?e=2");
				exit;
				
			} elseif ($register[3] == $row['user_email']) {
				
				header("Location: " . BASE_URI . "index.php?e=3");
				exit;
				
			}
			
		}
		
		
		
		// If encrypted password is equal to encrypted confirm password
		if (sha1($register[1]) == sha1($register[2])){
			for ($i = 0; $i < count($register); $i++) {
				$register[$i] = $clean->sanitize($register[$i]);
			}
			
			$register[1] = sha1($register[1]);
			
			$sql = "INSERT INTO `users`
						(`username`, `user_password`, `user_email`, `user_created`, `user_hash`, `user_cookie`)
						VALUES
						('$register[0]', '$register[1]', '$register[3]', '$register[4]', '$register[5]', '$register[6]')";
						
			$query = $conn->query($sql) or die($conn->error);
			
			
			$_SESSION['username'] = $register[0];
			$_SESSION['access'] = "member";
			$_SESSION['active'] = "unactive";
			
			$sql = "SELECT `user_hash` FROM `users`
						WHERE `username` = '$register[0]'";
			
			$query = $conn->query($sql);
			$rows = $query->fetch_assoc();
			
			$to = $register[3];
			$subject = "Offstreams User Activation";
			$message = "
								<strong>Activation Email for $register[0] at Offstreams.com</strong>
								<br />
								<br />
								<p>In order to activate your account for offstreams.com, click the link below</p>
								<p><a>" . "http://localhost/offstreams/user/" . $s->lower($register[0]) . "/" . $rows['user_hash'] . "</a></p>
								<br />
								<p>Reasons to activate your account:</p>
								<ul>
									<li>Ability to participate in polls</li>
									<li>Allowed to like/dislike songs</li>
									<li>Favorite bands/albums</li>
								</ul>
							";
			$headers = "From: experienceit12@gmail.com" . "\r\n" .
							"X-Mailer: PHP/" . phpversion() . "\r\n" .
							"Content-type: text/html" . "\r\n";
							
			mail($to, $subject, $message, $headers);
			
			// USER REGISTERED SUCCESSFULLY
			header("Location: " . BASE_URI . "user/" . $s->lower($register[0]) . "/s/1");
			exit;
			
		// User's passwords don't match
		} else {
			
			header("Location: " . BASE_URI . "index.php?e=1");
			exit;
			
		}
	
	// User Did not submit registration form
	} else {
		
		header("Location: " . BASE_URI);
		exit;
		
	}
	
	
	

?>