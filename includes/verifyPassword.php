<?php
	header("content-type:application/json");
	
	require_once 
"./SqlConnect.php";

	//used for the logging in component. seperate from the phpFunction method for passwordVerify, refactor
	//to represent this


	
	// and in sql verification to check the username and password
	//perform the necessary verification checks
	//form response array, and echo

	//get the email and the password,

	//get the email
	
	//$email="james@email.com";
	if(isset($_POST['email'])){
		$email = $_POST['email'];
	}
	else{
		//$email='james_black001@hotmail.co.uk';
		$email='james@email.com';
	}

	//echo $email;

	//get the password
	//$passwordAttempt="hello";
	if(isset($_POST['password'])){
		$passwordAttempt = $_POST['password'];
	}
	else{
		$passwordAttempt='hello';
	}
	//echo $passwordAttempt;

	//echo $email.":".$passwordAttempt;
	//get salt
	
	$resultSet = SqlConnect::getInstance()->validateConnection()->prepareStatement("SELECT saltValue FROM salt")->stmtExecute()->get_Result()->getRes();
	$resultArray = $resultSet->fetch_assoc();
	$salt=$resultArray['saltValue'];
	//echo "got some salt: ".$salt;
	
	//make a 'new encrypted password' using first attempt
	$attemptEncrypted = SqlConnect::createNewPassword($passwordAttempt,$salt);

	//$testEncryption = SqlConnect::createNewPassword("hello",$salt);

	//echo "attempt Encryption (made on password - 'hello'): ".$testEncryption;
	
	//get the stored entry, and compare the 2.
	//$email = "james@email.com";
	//echo json_encode($email);

	$passwordResultSet = SqlConnect::getInstance()->validateConnection()->prepareStatement("SELECT password FROM client WHERE email=?")->bindParamsCheckUser("s",$email)->stmtExecute()->get_Result()->getRes();
	$passwordArray = $passwordResultSet->fetch_assoc();
	
	$storedPassword = $passwordArray['password'];
	/*
	echo $attemptEncrypted."\n";
	echo $storedPassword."\n";
	*/

	//get the client id and the username if it is there and put into the session variables
	
	$dataResultSet = SqlConnect::getInstance()->validateConnection()->prepareStatement("SELECT client_id,username,active FROM client WHERE email=?")->bindParamsCheckUser("s",$email)->stmtExecute()->get_Result()->getRes();
	$dataArray = $dataResultSet->fetch_assoc();
	
	$username = $dataArray['username'];
	$clientID = $dataArray['client_id'];
	$active = $dataArray['active'];
	
	if($active == 0){
		//return false, active = 0
		//echo "active is 0";
		$verified = false;
		$response = array('verified'=>$verified,'email'=>$email ,'active'=>0);
	}
	//if the same return true, else false
	else{
		//echo "active is".$active;
		
		if($storedPassword===$attemptEncrypted){
			
		//if($testEncryption===$attemptEncrypted){
	
		//if($email === 'james@email.com' && $passwordAttempt==='hello'){	
			//start the session variables
			session_start();//needed to define the session variables
			$_SESSION['email']=$email;
			$_SESSION['username']=$username;
			$_SESSION['client_id']=$clientID;
			$_SESSION['loggedIn']=true;
			$_SESSION['active']=$active;
			
	
			$verified = true;
			$response = array('verified'=>$verified,'email'=>$email);//,'dbPassword'=>$storedPassword, 'testedPassword'=>$attemptEncrypted);
		}
		else{
			$verified = false;
			$response = array('verified'=>$verified,'email'=>$email);//,'dbPassword'=>$storedPassword, 'testedPassword'=>$attemptEncrypted);
		}
	}
	/*
	if(isset($_POST['email'])&&isset($_POST['password']))
	{
		session_start();//needed to define the session variables
		$_SESSION['email']=$_POST['email'];
		$_SESSION['loggedIn']=true;
		$verified = true;
		$response = array('verified'=>$verified,'email'=>$_SESSION['email']);
	}
	else{
		$verified = false;
		$response = array('verified'=>$verified);
	}*/

	
	//$response = true;
	//echo $response;
	echo json_encode($response);
	//echo $response;
?>
