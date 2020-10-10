<?php
	//ini_set("display_errors", "On");
	include $_SERVER['DOCUMENT_ROOT'] . '/database/auth.php';

	// Get values from login form
	$account = $_POST['account'];
	$password = $_POST['password'];

	// call the class
	$auth = new Auth();
	$login = $auth->login($account, $password);

	if($login == 1 ){
		//$_SESSION['username']=1;
	}
	// redirect to the login.php
	//header('Location: ' . '/login.php');
?>