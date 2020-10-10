<?php
	include $_SERVER['DOCUMENT_ROOT'] . '/database/auth.php';

	// Get values from login form
	$title = $_POST['title'];
	$content = $_POST['content'];
	$ID = trim($_GET['ID']);

	// call the class
	$auth = new Auth();
	$edit = $auth->edit($title, $content, $ID);


	// redirect to the login.php
	if($edit == 1)
	{
		header('Location: ' . '/index.php');
	}else{
		echo 'error';
	}
	
	
	
?>