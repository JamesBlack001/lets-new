<?php
	header("content-type:application/json");
	session_start();
	session_destroy();
	$verified = false;
	if((isset($_SESSION))){
		//session_start();
		if(isset($_SESSION['loggedIn'])){
			$_SESSION = array();
			$verified = true;//echo json_encode(true);	//echo " ".;
		}
		else {
			$verified = false;
		}
	}
	else{
		$verified=true;
	}
	
	echo json_encode($verified);
?>