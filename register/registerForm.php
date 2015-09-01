<div id="registerFormDisplay">
	<form action="<?php echo BASE_URI; ?>register/" method="post">
		<div id="registerFormWrapper">
			<h3 class="center mobileLogRegHead">Register</h3>
			<input type="text" name="username" placeholder="Username" id="registerUsernameInput" class="inputBox" required/>
			<input type="email" name="email" placeholder="Email" id="registerEmailInput" class="inputBox" required/>
			<input type="password" name="password" placeholder="Password" id="registerPasswordInput" class="inputBox" required/>
			<input type="password" name="confirmPass" placeholder="Confirm Password" id="registerConfirmInput" class="inputBox" required/>
			<input type="submit" name="registerSubmit" value="Register" id="registerSubmitButton" />
			<span class="backButton"></span>
		</div>
	</form>
</div>