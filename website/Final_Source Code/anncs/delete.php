<?php
	//ini_set("display_errors","On");
	include '../database/auth.php';

	// call the class
	$auth = new Auth();
	$ID = trim($_GET['ID']);
	$delete = $auth->delete($ID);

	header('Location: ' . '../index.php');
	

?>