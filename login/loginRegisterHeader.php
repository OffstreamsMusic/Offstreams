<?php

	// NOT LOGGED IN
	if (!isset($_SESSION['username'])){ ?>
		
		<div id="loginRegisterWrapper">
			<div id="loginButton">
				<span>Login</span>
			</div>
			<div id="registerButton">
				<span>Register</span>
			</div>
		</div>
		
	<?php } elseif (isset($_SESSION['username'])) { ?>
		
		<div id="loginRegisterWrapper">
			<!-- LINK TO USER'S PAGE -->
			<span>
				<a class="aWhite" href="<?php echo BASE_URI; ?>user/<?php echo strtolower($_SESSION['username']); ?>">
					<?php echo $_SESSION['username']; ?>
				</a>
			</span>
			<!-- LOGOUT -->
			<span>
				<a href="<?php echo BASE_URI; ?>logout/" class="aWhite">
					Logout
				</a>
			</span>
		</div>
		
	<?php }

?>