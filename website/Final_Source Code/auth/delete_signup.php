<?php
	//ini_set("display_errors", "On");
	include $_SERVER['DOCUMENT_ROOT'] . '/database/auth.php';

	// Get values from event
	$event_ID = $_GET['n'];
	$user_ID = $_GET['r'];

	//echo "'$eventname'";
	// call the class
	$auth = new Auth();
	$register = $auth->delete_signup($event_ID, $user_ID);
?>