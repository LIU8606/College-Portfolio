<?php
	$code = $_GET['code'];
	$usercode=$_POST['Code'];
	if($code == $usercode){
		echo "Verified";
	}
	else{
		echo "go to hell";
	}

?>