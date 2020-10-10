<?php
	//ini_set("display_errors", "On");
	include $_SERVER['DOCUMENT_ROOT'] . '/database/auth.php';

	$check=$_POST['checkbox'];
 	foreach($check as $value){
 		echo $value;
  		//mysql_query("delete from 資料表名稱 where 欄位名稱 = $value");
 	}

	// Get values from event
	$ID = $_GET['n'];

	//echo "'$eventname'";
	// call the class
	$auth = new Auth();
	$register = $auth->deleteevent($ID);
?>