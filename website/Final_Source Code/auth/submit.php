<?php
	//ini_set("display_errors", "On");
	include $_SERVER['DOCUMENT_ROOT'] . '/database/auth.php';

	// Get values from event
	$team_name = $_POST['team_name'];
	$team_ID = $_POST['team_ID'];
	$event_ID = $_POST['event_ID'];
	//echo "'$eventname'";
	// call the class
	$auth = new Auth();
	$register = $auth->submit($team_ID, $team_name, $event_ID);
?>