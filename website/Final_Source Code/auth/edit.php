<?php
	//ini_set("display_errors", "On");
	include $_SERVER['DOCUMENT_ROOT'] . '/database/auth.php';

	// Get values from event
	$ID = $_POST['ID'];
	$eventname = $_POST['eventname'];
	$eventdate = $_POST['eventdate'];
	$teamlimit = $_POST['teamlimit'];
	$memberlimit = $_POST['memberlimit'];

	//echo "'$eventname'";
	// call the class
	$auth = new Auth();
	$register = $auth->editevent($ID, $eventname, $eventdate,$teamlimit,$memberlimit);
?>