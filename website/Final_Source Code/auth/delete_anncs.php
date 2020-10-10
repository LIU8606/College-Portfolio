<?php
	//ini_set("display_errors","On");
	include 'database/auth.php';

	// call the class
	$auth = new Auth();
	$check=$_POST['checkbox'];
	$delete = $auth->delete_muti($check);

	header('Location: ' . '/index.php');
	

?>
    
