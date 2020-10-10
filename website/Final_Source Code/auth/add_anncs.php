<?php
	include $_SERVER['DOCUMENT_ROOT'] . '/database/auth.php';

	// Get values from login form
	$title = $_POST['title'];
	$content = $_POST['content'];

	// call the class
	$auth = new Auth();
	$broad = $auth->broad($title, $content);


	// redirect to the login.php
	if($broad == 1)
	{
		header('Location: ' . '/index.php');
	}else{
		echo 'error';
	}
	
	
	
?>