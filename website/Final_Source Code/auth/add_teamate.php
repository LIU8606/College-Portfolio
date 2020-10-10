<?php
	//ini_set("display_errors", "On");
	include $_SERVER['DOCUMENT_ROOT'] . '/database/auth.php';

	// Get values from event
	$user_ID = $_POST['student_id'];
	$team_ID = $_POST['team_ID'];
	$n = $_POST['n'];

	//echo "'$eventname'";
	// call the class
	$auth = new Auth();
	$register = $auth->add_teamate($user_ID, $team_ID, $n);
?>