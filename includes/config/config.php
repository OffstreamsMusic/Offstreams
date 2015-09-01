<?php
	
	session_start();
	
	$host = "localhost";
	$user = "root";
	$pass = "";
	$db = "offstreams";
	
	$conn = mysqli_connect($host, $user, $pass, $db);
	
	define('BASE_DOMAIN', 'localhost');
	define('BASE_URI', 'http://localhost/offstreams/');
	define('ROOT', '/offstreams/');
	define('BASEPATH', $_SERVER['DOCUMENT_ROOT'] . ROOT);
	define('SALT', 'nfg87yerityleriasfderubvw8uwe8erq3o9r8fhDFshdkbjHJKadsffguhalsg');
	
	
	// INCLUDE CLASSES //
	# Basic Functions
	require(BASEPATH . "includes/functions/functions.php");
	# Site Search
	require(BASEPATH . "includes/functions/siteSearch.php");
	# Site Title
	require(BASEPATH . "includes/functions/siteTitle.php");
	# URL SPLIT Functions
	require(BASEPATH . "includes/functions/urlSplit.php");
	#Cookie functions
	require(BASEPATH . "includes/functions/cookies.php");
	
	$s = new shortenPhpFunctions;
	$zepp = new zeppTranslate;
	$cookie = new createCookie;
	
	
	// Check user and cookies to make sure they stay logged in
	$cookie->checkUser();
	

?>