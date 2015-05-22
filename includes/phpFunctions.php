<?php

	//echo "hi";

//http://dev.mysql.com/doc/refman/5.1/en/alter-table.html

	header("content-type:application/json");

	//gmail username letsAtRhul@gmail.com
	//gmail password RHULlets00


	
	require_once $_SERVER['DOCUMENT_ROOT']."/mvc/mvc/includes/SqlConnect.php";
	require_once $_SERVER['DOCUMENT_ROOT']."/mvc/mvc/includes/libs/PHPMailerAutoload.php";

	//echo "root: ".$_SERVER['DOCUMENT_ROOT'];

	// and in sql verification to check the username availability
	//perform the necessary verification checks
	//$_POST['action']='search';
	//$_POST['users']='something';
	//$_POST['posts']='something_else';
	//$_POST['entry']='something_new_entirely';

	//static $dataArray;

	//echo "root: ".$_SERVER['DOCUMENT_ROOT'];

	if(isset($_POST['action'])&&$_POST['action']==='changeEmail')
	{
		session_start();
	
		$clientID=$_SESSION['client_id'];

		$email=$_POST['email'];	

		SqlConnect::getInstance()->validateConnection()->prepareStatement("UPDATE client SET email = (?) WHERE client_id = (?)")->bindParamsUpdateUsername('ss',$email,$clientID)->stmtExecute();

		$verified = true;
		
		//here goes the code to change the database content to the new email address

		$response = array('verified'=>$verified);
		
		$_SESSION['email']=$email;
		
	}
	else if(isset($_POST['action'])&&$_POST['action']==='skillSubmit'){

		if(isset($_POST['skillType'])){
			$type = $_POST['skillType'];
			$verified = true;
		}
		else{
			$type = "general";
			$verified = false;
		}
		if(isset($_POST['skillName'])){
			$name = $_POST['skillName'];
			$verified = true;
		}
		else{
			$name = "aSkillName";
			$verified = false;
		}
		if(isset($_POST['skillLevel'])){
			$level = $_POST['skillLevel'];
			$verified = true;
		}
		else{
			$level = "proficient";
			$verified = false;
		}

		session_start();
		if(isset($_SESSION['client_id'])){
			$clientID=$_SESSION['client_id'];
		}
		else{
			$clientID=9;
		}
		//check that the skill doesnot already exist
		$resultSet = SqlConnect::getInstance()->validateConnection()->prepareStatement("SELECT skill,skill_type FROM skills WHERE skill = ?")->bindParamsSkillList('s',$name)->stmtExecute()->get_Result()->getRes();
		$skillList = $resultSet->fetch_assoc();
		$count = count($skillList);

		if($count>=1 && $_POST['newSkill']=='true'){
			$verified=false;
			$message="This skill already exists, please select from above options, it is found under type ".$skillList['skill_type'];
			$response = array('verified'=>$verified, 'message'=>$message);
		}
		else{
			//make submit
			SqlConnect::getInstance()->validateConnection()->prepareStatement("INSERT INTO skills (client_id,skill,skill_type,skill_level) values (?,?,?,?)")->bindParamsInsertSkill('isss',$clientID,$name,$type,$level)->stmtExecute();
			$verified=true;
			$message="Done";
			$response = array('verified'=>$verified, 'message'=>$message);
	
		}

	
			
	
	}
	else if(isset($_POST['action'])&&$_POST['action']==='getSkillList'){
		
		//get the post['skilltype']
		if(isset($_POST['skillType'])){
			$type = $_POST['skillType'];
			$verified = true;
		}
		else{
			$type = "language";
			$verified = false;
		}
		//get the skill list
		$resultSet = SqlConnect::getInstance()->validateConnection()->prepareStatement("SELECT DISTINCT(skill) FROM skills WHERE skill_type = ?")->bindParamsSkillList('s',$type)->stmtExecute()->get_Result()->getRes();
		$skillList = $resultSet->fetch_all();
		//prepare the data
		$skillString="";
		
		$count = count($skillList);
		for ($i=0; $i < $count ; $i++) { 
			$skillString=$skillString.'<option value="'.$skillList[$i][0].'">'.$skillList[$i][0].'</option>';
		}
		//echo $skillString;

		//here goes the code to change the database content to the new email address
		//$response = array('verified'=>$verified);
		$response = array('verified'=>$verified,'skillString'=>$skillString);
	}
	else if(isset($_POST['action'])&&$_POST['action']==='checkActiveValue'){
		//$_SESSION['loggedIn']=true;
		session_start();
		if(isset($_SESSION['loggedIn'])){

			//get the active value
			//$clientID=$_SESSION['client_id'];
			
			$active=$_SESSION['active'];
			if($active == 1){
				$response = array('active'=>true);
			}
			else{
				$response = array('active'=>false);
			}
		}
		else{
			$response = array('active'=>false);
		}

	}
	else if(isset($_POST['action'])&&$_POST['action']==='sendUserVerification'){

		if(isset($_POST['email'])){
			$email = $_POST['email'];
		}
		else{
			$email='james_black001@hotmail.co.uk';
		}

		//make the password
		$password = rand(1000,5000);

		//make the hash
		$hash = md5(rand(0,1000));
		
		$to      = $email; // Send email to our user
		$subject = 'Signup | Verification'; // Give the email a subject
		$message = 
		"
			 
			\r\nThanks for signing up!\r\n
			\r\nYour account has been created,\r\nyou can login with the following credentials\r\nafter you have activated your account\r\n by pressing the url below.
			 
			------------------------\r\n
			Login:    ".$to."\r\n
			Password: ".$password."\r\n
			Hash:     ".$hash."\r\n
			------------------------\r\n
			 
			Please click this link to activate your account:\r\n
			http://46.101.34.183/mvc/mvc/includes/accountCreation.php?email=".$email."&hash=".$hash."\r\n			
		";
		//echo $message;
		//$message = wordwrap($message, 70, "\r\n");


		//hash password
		$saltResultSet = SqlConnect::getInstance()->validateConnection()->prepareStatement("SELECT saltValue FROM salt")->stmtExecute()->get_Result()->getRes();
		$saltResultArray = $saltResultSet->fetch_assoc();
		$salt=$saltResultArray['saltValue'];
		
		//make a 'new encrypted password' using first attempt
		$passwordEncrypted = SqlConnect::createNewPassword($password,$salt);

		//insert new user into db as 'inactive'
		SqlConnect::getInstance()->validateConnection()->prepareStatement("INSERT INTO client (email,hash,password) values (?,?,?)")->bindParamsNewInactiveUser('sss',$email,$hash,$passwordEncrypted)->stmtExecute();
		
		//create SMTP connection
		$mail = new PHPMailer;
		$mail->isSMTP();
		$mail->SMTPAuth = true;
		$mail->Mailer = 'smtp';
		$mail->Host = 'tls://smtp.gmail.com:587';
		$mail->Username = "letsatrhul@gmail.com";
		$mail->Password = "RHULlets00";
		$mail->SMTPSecure = 'tls';
		$mail->Port = 587;

		//debuginfo
		//$mail->SMTPDebug = 3;
		//$mail->Debugoutput = 'html';
		
		//create message
		$mail->From = "letsatrhul@gmail.com";
		$mail->FromName = "Lets - Admin";
		$mail->addReplyTo('replyto@example.com', 'Reply To');
		//$mail->addAddress('letsatrhul@gmail.com', 'John Doe');
		$mail->addAddress($to);
		$mail->Subject = $subject;
		$mail->Body     = $message;//allows html markup
		$mail->AltBody = 'This is a plain-text message body';
		$mail->setFrom('letsatrhul@gmail.com', 'Lets Admin');
		
		//send the message, check for errors
		//if (!$mail->send()) {
		//echo "Mailer Error: " . $mail->ErrorInfo;
		//} else {
		//echo "Message sent!";
		//}
		$mail->send();

		//echo 'hi';
		
		$verified = true;

		$response = array('verified'=>$verified);

	}

	else if(isset($_POST['action'])&&$_POST['action']==='updateSkillLevel'){
		session_start();

		//$clientID=$_SESSION['client_id'];

		//get the POST new skill level, skill id, 

		if(isset($_POST['skillLevel'])){
			$level = $_POST['skillLevel'];
		}
		else{
			$level = 'beginner';
		}
		if(isset($_POST['skillIndex'])){
			$index = $_POST['skillIndex'];
		}
		else{
			$index = 0;
		}
		if(isset($_SESSION['skill_ids'])){
			$skillID = $_SESSION['skill_ids'][$index];
		}
		else{
			$skillID = 30;
		}



		//make query to db to update the skill level value of the skill_id 


		SqlConnect::getInstance()->validateConnection()->prepareStatement("UPDATE skills set skill_level = ? WHERE skill_id = ?")->bindParamsUpdateSkill('si',$level,$skillID)->stmtExecute();

		$verified = true;

		$response = array('verified'=>$verified);
	}
	else if(isset($_POST['action'])&&$_POST['action']==='checkNewMessages'){
		session_start();

		$clientID=$_SESSION['client_id'];

		$newMessageDataSet = SqlConnect::getInstance()->validateConnection()->prepareStatement("SELECT message_id FROM messages WHERE reciever_id=? AND state =?")->bindParamsNewMessages("ss", $clientID,'unread')->stmtExecute()->get_Result()->getRes();
		$size = SqlConnect::numRows($newMessageDataSet);
		if($size > 0){
			//edit session vars
			$_SESSION['unreadMessages']= " (New)" ;
			$unread = true;
		}
		else{
			$_SESSION['unreadMessages']="";
			$unread= false;
		}

		$verified = true;

		$response = array('verified'=>$verified, 'unread'=>$unread,'size'=>$size);

	}
	else if(isset($_POST['action'])&&$_POST['action']==='sendMessage'){
		
		session_start();

		$sender = $_SESSION['client_id'];

		if(isset($_POST['subject'])){
			$subject = $_POST['subject'];
		}
		else{
			$subject = "a test subject yo";
		}
		if(isset($_POST['content'])){
			$content = $_POST['content'];
		}
		else{
			$content = "a test content for yo content yo yo";
		}
		if(isset($_POST['recipient'])){
			$recipient = $_POST['recipient'];
		}
		else{
			$recipient = 'something@james.com';
		}

		//get the id for this recipient
		//echo $recipient;
		$recipientDataSet = SqlConnect::getInstance()->validateConnection()->prepareStatement("SELECT client_id FROM client WHERE email=?")->bindParamsCheckUser("s", $recipient)->stmtExecute()->get_Result()->getRes();
		$recipientAssoc = $recipientDataSet->fetch_assoc();
		$recipientID = $recipientAssoc['client_id'];
		//echo json_encode($recipientID);

		//get thread id
		$threadSet = SqlConnect::getInstance()->validateConnection()->prepareStatement("SELECT threadid FROM messagethread WHERE (sender1=? or sender2 = ?) AND (sender1=? or sender2 =?)")->bindParamsGetThreadID('iiii',$sender,$recipientID)->stmtExecute()->get_Result()->getRes();
		$threadArray = $threadSet->fetch_assoc();

		if($threadArray){
			//returns a value
			//this is good...
			//echo "Grrrrrreat";
		}
		else{
			//returns nothing, is empty
			//must make a new entry in message thread
			//echo "Must make new entry";

			SqlConnect::getInstance()->validateConnection()->prepareStatement("INSERT INTO messagethread (sender1, sender2) VALUES (?,?)")->bindParamsCreateNewThread('ii',$sender,$recipientID)->stmtExecute();

			$threadSet = SqlConnect::getInstance()->validateConnection()->prepareStatement("SELECT threadid FROM messagethread WHERE (sender1=? or sender2 = ?) AND (sender1=? or sender2 =?)")->bindParamsGetThreadID('iiii',$sender,$recipientID)->stmtExecute()->get_Result()->getRes();
	
			$threadArray = $threadSet->fetch_assoc();


		}

		$threadID = $threadArray['threadid'];

		SqlConnect::getInstance()->validateConnection()->prepareStatement("INSERT INTO messages (client_id, reciever_id, subject, content, state, date_time,threadid) VALUES (?,?,?,?,?,CURRENT_TIMESTAMP(),?)")->bindParamsInsertNewMessage('iisssi',$sender,$recipientID,$subject,$content,'unread',$threadID)->stmtExecute();

		$verified = true;

		$response = array('verified'=>$verified);

	}
	else if(isset($_POST['action'])&&$_POST['action']==='makeTransaction'){

		session_start();

		if(isset($_SESSION['transactionArray']['pid']))
		{$pid=$_SESSION['transactionArray']['pid'];}
		else{
			$pid=33;
		}
		if(isset($_SESSION['transactionArray']['favour_client_id'])){
			$favour_client_id = $_SESSION['transactionArray']['favour_client_id'];		
		}
		else{
			$favour_client_id = 888;
		}
		if(isset($_SESSION['client_id'])){
		$clientID = $_SESSION['client_id'];
		}
		else{
			$clientID = 777;
		}
		if(isset($_SESSION['transactionArray']['cost'])){
		$cost = $_SESSION['transactionArray']['cost'];
		}
		else{
			$cost = 5;
		}
		if(isset($_SESSION['transactionArray']['newBalance'])){
		$newBalance = $_SESSION['transactionArray']['newBalance'];
		}
		else{
			$newBalance=2;
		}

		//get the set of rows from the db, from the transaction_request where the $pid = the post, order DESC
		$pid=33;
		$resultSet=SqlConnect::getInstance()->validateConnection()->prepareStatement("SELECT * FROM transaction_request WHERE pid=? ORDER BY date_time ASC")->bindParamsFavourRequests('i',$pid)->stmtExecute()->get_Result()->getRes();
		$resultArray= $resultSet->fetch_assoc();

		//add in a confirmation check that the favour still has an 'active' state, 
		$favourSet=SqlConnect::getInstance()->validateConnection()->prepareStatement("SELECT state FROM post WHERE post_id=?")->bindParamsFavourRequests('i',$pid)->stmtExecute()->get_Result()->getRes();
		$favourArray= $favourSet->fetch_assoc();

		var_dump($resultArray);
		var_dump($favourArray);

		//lock
		
		if($resultArray['client_uid']==$clientID && $favourArray['state']=='active'){
			//here goes the update to db
			try{
			SqlConnect::getInstance()->validateConnection()->beginTransaction();
			
			SqlConnect::getInstance()->validateConnection()->prepareStatement("UPDATE client SET credit_amount = (?) WHERE client_id = (?)")->bindParamsUpdateUsername('ss',$newBalance,$clientID)->stmtExecute();

			SqlConnect::getInstance()->validateConnection()->prepareStatement("UPDATE post SET state = (?) WHERE post_id = (?)")->bindParamsUpdateUsername('ss','unredeemed',$pid)->stmtExecute();

			SqlConnect::getInstance()->validateConnection()->prepareStatement("UPDATE post SET reciever_id = (?) WHERE post_id = (?)")->bindParamsUpdateUsername('ss',$clientID,$pid)->stmtExecute();

			SqlConnect::getInstance()->validateConnection()->prepareStatement("INSERT INTO history (pid,favour_uid,reciever_uid,cost,transaction_date) VALUES (?,?,?,?, CURDATE())")->bindParamsNewHistoryInsert('iiii',$pid,$favour_client_id,$clientID,$cost)->stmtExecute();

			SqlConnect::getInstance()->validateConnection()->commitTransaction();
			}
			catch(Exception $e){
				SqlConnect::getInstance()->validateConnection()->rollback();
			}

			$verified = true;

			SqlConnect::getInstance()->validateConnection()->endTransaction();

			SqlConnect::getInstance()->validateConnection()->prepareStatement("DELETE FROM transaction_request WHERE pid = ?")->bindParamsFavourRequests('i',$pid)->stmtExecute();
		}
		else{
			$verified = false;
		}
		
		$response = array('verified'=>$verified);

	}
	else if(isset($_POST['action'])&&$_POST['action']==='search')
	{
		//echo "true";

		session_start();

		$clientID = $_SESSION['client_id'];
		
		
		if(isset($_POST['users'])){
			$users = $_POST['users'];
		}
		else{
			$users = 'true';
		}
		if(isset($_POST['posts'])){
			$posts = $_POST['posts'];
		}
		else{
			$posts = 'false';
		}
		if(isset($_POST['entry'])){
			$entry = $_POST['entry'];
		}
		else{
			$entry = 'j';
		}
		if(isset($_POST['skills'])){
			$skills = $_POST['skills'];
		}
		else{
			$skills = 'false';
		}

		$queryString = "%".$entry."%";
		//echo $queryString;

		

		//$collectedArray = array();
		//determine the search to process

		// SELECT * FROM articles WHERE MATCH (title,body) AGAINST ('database')

		if($users ==='true' && $posts==='false'){
			$resultSet = SqlConnect::getInstance()->validateConnection()->prepareStatement("SELECT email,username,client_id FROM client WHERE MATCH(email,username) AGAINST(?) LIMIT 25")->bindParamsCheckUser('s',$entry)->stmtExecute()->get_Result()->getRes();
			$resultArray = $resultSet->fetch_all();
			//$newArray = array('one'=> 1, 'two'=>2);
			//var_dump($resultArray);


			//$dataArray = $resultArray;

			//$response = array('verified'=>$verified,'entry'=>$entry,'posts'=>$posts,'users'=>$users,'resultArray'=>$resultArray);
			//search for users alone
			$verified = true;
		}
		else if($users ==='false' && $posts==='true'){
			$resultSet = SqlConnect::getInstance()->validateConnection()->prepareStatement("SELECT client_id,post_id,title,post_description FROM post WHERE MATCH(title,post_description) AGAINST(?) AND state='active' LIMIT 25")->bindParamsCheckUser('s',$queryString)->stmtExecute()->get_Result()->getRes();
			$resultArray = $resultSet->fetch_all();
			$verified = true;
		}
		else if($users ==='false' && $posts ==='false' && $skills ==='true'){
			$resultSet = SqlConnect::getInstance()->validateConnection()->prepareStatement("SELECT client_id,skill_id,skill,skill_type,skill_level FROM skills WHERE MATCH(skill) AGAINST(?) AND client_id != ? LIMIT 25")->bindParamsSearchQuery('ss',$entry,$clientID)->stmtExecute()->get_Result()->getRes();
			$resultArray = $resultSet->fetch_all();
			$verified = true;
		}
		else{
			$verified=false;
		}
		
		//here goes the code to collect information from db about the user's query
		//sort into array for easy processing at browser side

		$response = array('verified'=>$verified,'entry'=>$entry,'posts'=>$posts,'users'=>$users,'skills'=>$skills, 'resultArray'=>$resultArray);
		
	}
	else if(isset($_POST['action'])&&$_POST['action']==='verifyPassword')
	{
		//$password = $_POST['password'];

		session_start();
		$clientID = $_SESSION['client_id'];

		//add db check that verifies the password entered, against that which is stored
		if(isset($_POST['password'])){
			$passwordAttempt = $_POST['password'];
		}
		else{
			$passwordAttempt='hallo';
		}
		

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

		$passwordResultSet = SqlConnect::getInstance()->validateConnection()->prepareStatement("SELECT password FROM client WHERE client_id=?")->bindParamsCheckUser("s",$clientID)->stmtExecute()->get_Result()->getRes();
		$passwordArray = $passwordResultSet->fetch_assoc();
		
		$storedPassword = $passwordArray['password'];
		/*
		echo $attemptEncrypted."\n";
		echo $storedPassword."\n";

		*/
		//if the same return true, else false

		if($storedPassword===$attemptEncrypted){
			//if($password==="hello"){
			//if(/*The entered - encrypted password is the same as the stored password*/){
			$verified=true;
		}
		else{
			$verified=false;
		}
		//here goes the code to verify that the password entered is the one that is storde in the db

		$response = array('verified'=>$verified);
		
		//session_start();
		//$_SESSION['email']=$_POST['email'];		
		
	}
	else if(isset($_POST['action'])&&$_POST['action']==='editPassword')
	{
		//echo "true";

		session_start();
		$clientID = $_SESSION['client_id'];
		$password = $_POST['password'];
		
		//$clientID = 137;
		//$password = 'hello';

		//create the new password

		$resultSet = SqlConnect::getInstance()->validateConnection()->prepareStatement("SELECT saltValue FROM salt")->stmtExecute()->get_Result()->getRes();
		$resultArray = $resultSet->fetch_assoc();
		$salt=$resultArray['saltValue'];
		//echo "got some salt: ".$salt;
		$activeResultSet = SqlConnect::getInstance()->validateConnection()->prepareStatement("SELECT active FROM client where client_id = ?")->bindParamsCheckUser('i',$clientID)->stmtExecute()->get_Result()->getRes();
		$activeResultArray = $activeResultSet->fetch_assoc();
		$active = $activeResultArray['active'];

		//make a 'new encrypted password' using first attempt
		$newEncrypted = SqlConnect::createNewPassword($password , $salt);

		//here goes the db connection for updating the new password
		SqlConnect::getInstance()->validateConnection()->prepareStatement("UPDATE client SET password = (?) WHERE client_id = (?)")->bindParamsUpdateUsername('ss',$newEncrypted,$clientID)->stmtExecute();
		if($active==1){
			SqlConnect::getInstance()->validateConnection()->prepareStatement("UPDATE client SET active = (?) WHERE client_id = (?)")->bindParamsUpdateUsername('ss',2,$clientID)->stmtExecute();
			$_SESSION['active']=2;
		}
		else{}

		$verified = true;
		
		$response = array('verified'=>$verified);
		
		//session_start();
		
	}
	else if(isset($_POST['action'])&&$_POST['action']==='changeUsername')
	{
		

		$username = $_POST['username'];
		//$username = 'Dickhead';
		session_start();
		$clientID = $_SESSION['client_id'];
		$email=$_SESSION['email'];
		//here goes the code to change the database content to the new email address

		SqlConnect::getInstance()->validateConnection()->prepareStatement("UPDATE client SET username = (?) WHERE client_id = (?)")->bindParamsUpdateUsername('ss',$username,$clientID)->stmtExecute();

		$verified = true;

		$response = array('verified'=>$verified);

		//submit this data to the db
		
		//session_start();
		$_SESSION['username']=$username;		
		
	}

	else if(isset($_POST['action'])&&$_POST['action']==='favourSubmit')
	{
		//get the postData
		if(isset($_POST['title'])){
			$title = $_POST['title'];
		}
		else{
			$title='someTitle';
		}
		if(isset($_POST['description'])){
			$description = $_POST['description'];
		}
		else{
			$description='someDescription';
		}
		if(isset($_POST['expiry'])){
			$expiry = $_POST['expiry'];
		}
		else{
			$expiry='2007-09-09';
		}
		if(isset($_POST['cost'])){
			$cost = $_POST['cost'];
		}
		else{
			$cost=12;
		}

		session_start();
		$clientID = $_SESSION['client_id'];


		//here goes the code to add the favour information to the db,

		SqlConnect::getInstance()->validateConnection()-> prepareStatement("INSERT INTO post (client_id,title,post_description,expiry_date,credit_cost,state) values (?,?,?,?,?,?)")->bindParamsSubmitPost('ssssis',$clientID,$title,$description,$expiry,$cost,'active')->stmtExecute();

		$verified = true;
		
		//here goes the code to change the database content to add a new favour

		$response = array('verified'=>$verified);

		//submit this data to the db
		
		//session_start();
		//$_SESSION['username']=$_POST['username'];		
		
	}
	else{
		//echo "true";
		$verified = false;
		$response = array('verified'=>$verified);
	}
	echo json_encode($response);

	function sessionSet(){
		$returnValue=false;
		if(isset($_SESSION)){
			if(isset($_SESSION['loggedIn'])){
				if(is_bool($_SESSION['loggedIn'])==true){
					if($_SESSION['loggedIn']==true){
						$returnValue=true;
					}
				}
			}
		}
		return $returnValue;
	}
?>
