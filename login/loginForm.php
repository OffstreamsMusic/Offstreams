<div id="loginFormDisplay">
	<form action="<?php echo BASE_URI; ?>login/" method="post">
		<div id="loginFormWrapper">
			<h3 class="center mobileLogRegHead">Login</h3>
			<input type="text" name="username" placeholder="Username" id="loginUsernameInput" class="inputBox" required/>
			<input type="password" name="password" placeholder="Password" id="loginPasswordInput" class="inputBox" required/>
			<input type="submit" name="loginSubmit" value="Login" id="loginSubmitButton" />
			<span class="backButton"></span>
		</div>
	</form>
</div>