<?php
	//ini_set("display_errors", "On");
	include $_SERVER['DOCUMENT_ROOT'] . '../database/auth.php';

	// Get values from event
	$ID = $_GET['ID'];
	$r = $_GET['r'];
	$n = $_GET['n'];

	//echo "'$eventname'";
	// call the class
	$auth = new Auth();
	$register = $auth->delete_teamate($ID, $r, $n);
?>