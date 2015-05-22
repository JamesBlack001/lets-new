<?php
	
	header("content-type:application/json");

	//session_start();
	if((isset($_SESSION))){
		//session_start();
		if(isset($_SESSION['loggedIn'])){
			$_SESSION = array();
			echo json_encode(true);	//echo " ".;
		}
	}
	else
		echo json_encode(false);
?>