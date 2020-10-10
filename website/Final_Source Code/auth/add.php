<?php
	//ini_set("display_errors", "On");
	include $_SERVER['DOCUMENT_ROOT'] . '/database/auth.php';

	// Get values from event
	$eventname = $_POST['eventname'];
	$eventdate = $_POST['eventdate'];
	$teamlimit = $_POST['teamlimit'];
	$memberlimit = $_POST['memberlimit'];

	//echo "'$eventname'";
	// call the class
	$auth = new Auth();
	$register = $auth->newevent($eventname, $eventdate,$teamlimit,$memberlimit);

?>