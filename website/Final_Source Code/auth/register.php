<?php
	//ini_set("display_errors", "On");
	include $_SERVER['DOCUMENT_ROOT'] . '/database/auth.php';

	// Get values from login form
	$ID = $_POST['ID'];
	$password = hash('sha256', $_POST['password']);//Hash pwd
	$lastname = $_POST['lastname'];
	$firstname = $_POST['firstname'];
	$email = $_POST['email'];

	// call the class
	$auth = new Auth();
	$register = $auth->register($ID, $password,$lastname,$firstname,$email);

?>