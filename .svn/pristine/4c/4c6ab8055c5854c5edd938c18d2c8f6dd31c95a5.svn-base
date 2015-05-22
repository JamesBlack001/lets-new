<?php
	header("content-type:application/json");

	require_once "./SqlConnect.php";

	// and in sql verification to check the email availability
	//perform the necessary verification checks

	$email="";
	if(isset($_POST['email'])){
		$email = $_POST['email'];
	}
	$resultSet = SqlConnect::getInstance()->validateConnection()->prepareStatement("SELECT email FROM client WHERE email=?")->bindParamsCheckUser("s",$email)->stmtExecute()->get_Result()->getRes();
	$resultArray = $resultSet->fetch_assoc();
	$resultEmail=$resultArray['email'];
	//}

	//get result set of entries in db that are equal to the entered value

	if($email===$resultEmail)
	{
		$verified = true;//email exists in db, pick another
		$response = array('verified'=>$verified,'email'=>$_POST['email']);
		
	}
	else{
		$verified = false;//email doesnt exist in db, free to pick
		$response = array('verified'=>$verified,'email'=>'empty');
	}
	echo json_encode($response);
?>
