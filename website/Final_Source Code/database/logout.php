<?php
	session_start();
	//ini_set("display_errors", "On");
	include __DIR__ . '/database.php';
	$_SESSION['username']="";
	
	
	header('Location: ' . '/index.php');
	//header('Location: ' . '/login.php');
?>