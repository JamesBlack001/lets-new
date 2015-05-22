	<?php
	header("content-type:application/json");
	
	require_once 
"./SqlConnect.php";

	if(isset($_POST['email'])){
		$email = $_POST['email'];
	}
	else{
		$email='empty@email.com';
	}

	//make the password
	$password = rand(1000,5000);

	//make the hash
	$hash = md5(rand(0,1000));
	
	$resultSet = SqlConnect::getInstance()->validateConnection()->prepareStatement("SELECT saltValue FROM salt")->stmtExecute()->get_Result()->getRes();
	$resultArray = $resultSet->fetch_assoc();
	$salt=$resultArray['saltValue'];
	
	//make a 'new encrypted password' using first attempt
	$passwordEncrypted = SqlConnect::createNewPassword($password,$salt);

	//if the same return true, else false

	SqlConnect::getInstance()->validateConnection()->prepareStatement("INSERT INTO client (email,password,img_file) values (?,?,?)")->bindParamsNewUser('sss',$email,$passwordEncrypted,null)->stmtExecute();
	
	$idSet = SqlConnect::getInstance()->validateConnection()->prepareStatement("SELECT client_id FROM client WHERE email = ?")->bindParamsEmail('s',$email)->stmtExecute()->get_Result()->getRes();
	$idArray = $idSet->fetch_assoc();
	$id=$idArray['client_id'];
	//if($storedPassword===$attemptEncrypted){
	//if($testEncryption===$attemptEncrypted){
	

	//if($email === 'james@email.com' && $passwordAttempt==='hello'){	
		//start the session variables
		session_start();//needed to define the session variables
		$_SESSION['email']=$email;
		$_SESSION['loggedIn']=true;
		$_SESSION['client_id']=$id;
		

		$verified = true;
		$response = array('verified'=>$verified,'email'=>$email);//,'dbPassword'=>$storedPassword, 'testedPassword'=>$attemptEncrypted);
	//}
	
	/*
	else{
		$verified = false;
		$response = array('verified'=>$verified,'email'=>$email,'dbPassword'=>$storedPassword, 'testedPassword'=>$attemptEncrypted);
	}
	*/

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
