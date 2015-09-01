<?php require ("config/config.php"); ?>
<!DOCTYPE html>
<html>
	<head>
		<?php require ("javascript/javascript.html"); ?>
		<title><?php include (BASEPATH . "/includes/widgets/title.php"); ?></title>
		<meta name="viewport" content="width=device-width, initial-scale=1">
	</head>
	<body>
		<header>
			<table class="headerTable">
				<tr>
					<th id="headerLeft">
						<!-- LEFT -->
					</th>
					<th id="headerCenter">
						<!-- CENTER -->
						<form action="<?php echo BASE_URI . "search/"; ?>" method='get' class='searchbarForm'>
							<input type='text' name='search' id='searchbar' placeholder='Search...' autocomplete="off"/>
						</form>
					</th>
					<th id="headerRight">
						<?php include (BASEPATH . "/login/loginRegisterHeader.php"); ?>
						<?php include (BASEPATH . "/login/loginForm.php"); ?>
						<?php include (BASEPATH . "/register/registerForm.php"); ?>
					</th>
				</tr>
			</table>
		</header>
		<nav>
			<?php include (BASEPATH . "/includes/widgets/navigation.php"); ?>
		</nav>
		<div class="wrapper">
			<?php include (BASEPATH . "/errors/logRegErrors.php"); ?>
			<?php include (BASEPATH . "/success/successDialog.php"); ?>