<?php

//********************************* PHP-DOC *********************************
//
//This page includes all of the content that is required by the view,
//it is encapsuated in methods, and loaded by the model when it is needed
//by the controller

	function openingComponent(){
		if(isset($_SESSION)){
			
		}
		else{
			session_start();
		}
		echo
			'
				<!DOCTYPE html>
				<html lang="en">
				<head>
				<meta charset="UTF-8">
				<title>LETS</title>
				<link rel="stylesheet type="text/css" 
href="/mvc/mvc/includes/libs/bootstrap-3.3.4/css/bootstrap-theme.min.css">
				<link rel="stylesheet type="text/css" 
href="/mvc/mvc/includes/libs/bootstrap-3.3.4/css/bootstrap.min.css">
				<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
				<script src="/mvc/mvc/includes/libs/bootstrap-3.3.4/js/bootstrap.min.js"></script>
				<script>
					$(function(){
						$.post("http://46.101.34.183/mvc/mvc/includes/phpFunctions.php", { "action" : "checkNewMessages" }, function(data){
						});
					});
				</script>
				<style type="text/css">
				    .site-nav-navbar{
				    	margin: 20px;
				    }
				    .site-content-main{
				    	margin: 20px;
				    }
				    .form-group{
				    	margin-bottom: 20px;
				    }

				    .col-xs-2{
				    	margin-bottom: 20px;
				    }
					.col-xs-10{
						margin-bottom: 20px;
					}


				</style>
				<script src="/mvc/mvc/includes/script.js"></script>
				
				

				</head> 
				<body>
			';
	}
	function closingComponent(){
		echo
			'	
				</div>
				<div id="stretchContainer"><div id="content"></div></div>
				
				';//<footer><p>Any queries: <a href="mailto:hostmaster@rhul-lets.uk?Subject=My%20Query" target="_top">Contact The Administrator</a></p></footer>
			echo '	</body>
				</html>
			';
	}
	function navBar(){
		//session_start();
		echo
			'
				<div class="site-nav-navbar">
					<nav role="navigation" class="navbar navbar-default">
						<div class="navbar-header">
							<button type="button" data-target="#navbarCollapse" data-toggle="collapse" class="navbar-toggle">
								<span class=sr-only"></span>
								<span class="icon-bar"></span>
								<span class="icon-bar"></span>
								<span class="icon-bar"></span>
							</button>

							<a href="#" class="navbar-brand">LETS || RHUL</a>


						</div>
						<div id="navbarCollapse" class="collapse navbar-collapse">
							<ul class="nav navbar-nav">';

								if(testSession('loggedIn')){
									echo 
										'
											<li><a href="http://46.101.34.183/mvc/mvc/public/home/search">Search</a></li>
											<li><a href="http://46.101.34.183/mvc/mvc/public/home/makeFavour">Make Favour</a></li>
											<li><a href="http://46.101.34.183/mvc/mvc/public/home/editProfile" id="editProfile">Edit Profile</a></li>
											<li><a href="http://46.101.34.183/mvc/mvc/public/home/viewUserDetails/'.$_SESSION['client_id'].'" id="viewDetails">View Details</a></li>
											<li><a href="http://46.101.34.183/mvc/mvc/public/home" id="home">Home</a></li>

											<li><a href="http://46.101.34.183/mvc/mvc/public/home/viewConversations/'.$_SESSION['client_id'].'" id="viewMessagesNav">Messages';
												if(testSession('unreadMessages')){
													echo $_SESSION['unreadMessages'];
												}
												else{}
											echo '</a></li>
										';
								
								}							
								else{
									echo 
										'
											<li><a href="http://46.101.34.183/mvc/mvc/public/home/createUserForm" id="createUser">Create User</a></li>
											<li><a href="http://46.101.34.183/mvc/mvc/public/home/loadForm" id="loadForm">Login Form</a></li>
											<li><a href="http://46.101.34.183/mvc/mvc/public/home" id="home">Home</a></li>
										';
								}
								echo
									'
										</ul>
									';
					echo
						'	
							<ul class="nav navbar-nav navbar-right">
								<li><a href="mailto:hostmaster@rhul-lets.uk?Subject=My%20Query" target="_top">Contact</a></li>
<li><a href="https://docs.google.com/forms/d/1odWAZPG8jdmaXZZlRCRJuXilHxjts-S6Xq9N132EFn0/viewform?usp=send_form">Feedback</a></li>
								<li><a href="https://rhul-lets/mvc/mvc/public/home/logout" id="logout">Logout</a></li>
							</ul>
						</div>
					</nav>
				</div>
				<div class="site-content-main">

						';

		//echo $_SESSION['client_id'];
	}
								//$('#divSearchResults').append("<p><a href='http://46.101.34.183/mvc/mvc/public/home/viewUserDetails/"+data['resultArray'][i][0]+"'>User: "+uname+"</a></p>");
	function viewMessageDetails($messageArray){
		echo
			'
				<script src="/mvc/mvc/includes/script.js"></script>
				<div id="viewMessageDetails">
					<h1>Message Details:</h1>';
					if(isset($messageArray['senderID'])){
						echo 
							'
								<p>Sender: <a href="http://46.101.34.183/mvc/mvc/public/home/viewUserDetails/'.$messageArray['senderID'].'">'.$messageArray['senderID'].'</a></p>
								<p><a href="http://46.101.34.183/mvc/mvc/public/home/createNewMessage/'.$messageArray['senderID'].'">Reply</a></p>
							';
					}
					if(isset($messageArray['subject'])){
						echo 
							'
								<p>Subject: '.$messageArray['subject'].'</p>
							';
					}
					if(isset($messageArray['content'])){
						echo 
							'
								<p>Message: '.$messageArray['content'].'</p>
							';
					}
					if(isset($messageArray['dateSent'])){
						echo 
							'
								<p>Date: '.$messageArray['dateSent'].'</p>
							';
					}
					else{
						echo '<p>No date defined</p>';
					}


		echo 
			'		
				</div>	
			';					
	}
	function createMessageForm($recipientid){
		echo
			'
				

				<div class="panel panel-default">
					<div id ="sendMessageDiv" class="panel-body">
						<form id="sendMessageForm">
							<label for="sendMessageRecipient">Recipient: </label>
							<input type="text" id="sendMessageRecipient" value="'.$recipientid.'">
							<label for="sendMessageSubject">Subject: </label>
							<input type="text" id="sendMessageSubject">
							<label for="sendMessageContent">Message: </label>
							<input type="text" id="sendMessageContent">
							<button type="submit" id="sendMessageSubmit" disabled>Send</button>
							<button id="doOver">Do over</button>
						</form>
					</div>
				</div>
			';
	}
	function messageNavBar(){
		echo
			'
				<nav role="navigation" class="navbar navbar-default">
					<div class="navbar-header">
						<button type="button" data-target="#message-navbarCollapse" data-toggle="collapse" class="navbar-toggle">
				            <span class="sr-only">Toggle navigation</span>
				            <span class="icon-bar"></span>
				            <span class="icon-bar"></span>
				            <span class="icon-bar"></span>
				        </button>
				        <a href="#" class="navbar-brand">LETS || Messages</a>
				    </div>
				    <div id="message-navbarCollapse" class="collapse navbar-collapse">
						<ul class="nav navbar-nav">
							<li><a href="http://46.101.34.183/mvc/mvc/public/home/createNewMessage">Send a Message</a></li>
							<li><a href="http://46.101.34.183/mvc/mvc/public/home/viewConversations/'.$_SESSION['client_id'].'">Conversations</a></li>
						</ul>
					</div>
				</nav>
			';
	}
	function viewDetailsNavBar($userInfo){
		echo 
			'
				<nav role ="navigation" class="navbar navbar-default">
					<div class="navbar-header">
						<button type="button" data-target="#details-navbarCollapse" data-toggle="collapse" class="navbar-toggle">
				            <span class="sr-only">Toggle navigation</span>
				            <span class="icon-bar"></span>
				            <span class="icon-bar"></span>
				            <span class="icon-bar"></span>
				        </button>
				        <a href="#" class="navbar-brand">LETS || Details</a>
				    </div>
					<div id="details-navbarCollapse" class="collapse navbar-collapse">
						<ul class="nav navbar-nav">
							<li><a href="http://46.101.34.183/mvc/mvc/public/home/transactionHistory/'.$userInfo['uid'].'">Transaction History</a></li>
							<li><a href="http://46.101.34.183/mvc/mvc/public/home/activeFavours/'.$userInfo['uid'].'">Active Favours</a></li>
							<li><a href="http://46.101.34.183/mvc/mvc/public/home/unredeemedFavours/'.$userInfo['uid'].'">Unredeemed Favours</a>
							<li><a href="http://46.101.34.183/mvc/mvc/public/home/retiredFavours/'.$userInfo['uid'].'">Retired Favours</a></li>
							<li><a href="http://46.101.34.183/mvc/mvc/public/home/viewOpenFavours/">Open Favours</a></li>
						</ul>
				</nav>
			';

	}
	function viewMessages($messageInfo, $heading){
		echo
			'
				<div id="viewTransactionSummary">
					<h1>'.$heading.'</h1>
			';
		echo $messageInfo;
		echo
			'
				</div>
			';
	}
	function viewTransactionSummary($postInfo){
		//y(['favour_client_id'=>$this->clientID,'cost'=>$this->cost, 'expiry'=>$this->expiry, 'postTitle'=>$this->title,'postDescription'=>$this->description,'postID'=>$this->pid, 'username'=>$this->username,'email'=>$this->email,'user_ID'->$this->userCredits]);

		echo
			'
				<div id="viewTransactionSummary">
					<h1>Transaction Summary:</h1>';
					if(isset($postInfo['postID'])){
						echo 
							'
								<p>FavourID: '.'<div id="div_pid">'.$postInfo['postID'].'</div>'.'</p>
							';
					}
					if(isset($postInfo['postTitle'],$postInfo['postDescription'])){
						echo 
							'
								<p>Title: '.$postInfo['postTitle'].' Description: '.$postInfo['postDescription'].'</p>
							';
					}
					if(isset($postInfo['username'],$postInfo['expiry'],$postInfo['cost'])){
						echo 
							'
								<p>Username: '.$postInfo['username'].' Expiry: '.$postInfo['expiry'].' Cost: '.'<div id="div_cost">'.$postInfo['cost'].'</div>'.'</p>
							';
					}
					else{
						echo 
							'
								<p>Email: '.$postInfo['email'].' Expiry: '.$postInfo['expiry'].' Cost: '.$postInfo['cost'].'</p>
							';
					}
					$newCredits = $postInfo['user_credits']-$postInfo['cost'];
					if($newCredits >=0){
						$_SESSION['transactionArray']= array('pid'=>$postInfo['postID'],'favour_client_id'=>$postInfo['favour_client_id'],'cost'=>$postInfo['cost'],'newBalance'=>$newCredits);
						echo 
							'
								<p>Your Current Credits: '.$postInfo['user_credits'].' Your New Balance: '.$newCredits.'</p>
								<button id="confirmFavourButton">Confirm</button>
							';
						//echo $_SESSION['transactionArray']['newBalance'];
					}
					else{
						echo 
							'
								<p>Your Current Credits: '.$postInfo['user_credits'].' Your New Balance: '.$newCredits.' Not enough credits available</p>
								<p>You should try and offer a favour and build up your credits before purchasing a favour.</p>
							';
					}
		
		echo 
			'		
					<button id="goBackButton">Go Back</button>
				</div>	
			';
	}
	function search(){
		echo 
			'

				<div class="panel panel-default">
					<div id="divSearch" class="panel-body">
						<form id="searchForm">
							<label for="searchFormEntry">Search: </label>
							<input type="text" id="searchFormEntry"></input>
							<label for="searchFormUsers">Users: </label>
							<input type="radio" name="group1" id="searchFormUsers" checked></input>
							<label for="searchFormPosts">Posts: </label>
							<input type="radio" name="group1" id="searchFormPosts"></input>
							<label for="searchFormSkills">Skills: </label>
							<input type="radio" name="group1" id="searchFormSkills"></input>
							<button type="submit" id="searchFormSubmit" disabled>Submit</button>
						</form>
					</div>
				</div>
			';
	}

	//function which acts as a place holder for the search results
	function searchResults(){
		echo 
			'
				<div id="divSearchResults">

				</div>				
			';
	}
	function viewFavourDetails($results,$id,$heading){
		echo 
			'
				<div id="'.$id.'">
					<h1>'.$heading.'</h1>
			';
		echo $results;	
		echo
			'			
				</div>
			';
	}
	function currentDetails(){
		echo
			'
				<div id="divCurrentDetails">';

					if(testSession('username')){echo '<p id="currentDetailsUsername">Username: '.$_SESSION['username'].'</p>';}
					else{echo '<p id="currentDetailsUsername">Username: '.$_SESSION['email'].'</p>';}
					if(testSession('email')){echo '<p id="currentDetailsEmail">Email: '.$_SESSION['email'].'</p>';} 
					else{}

		echo 
			'
				</div>				
			';
	}
	function editProfile($skillList){
		

		echo
			'


				<div class="panel panel-default">
					<div id="divEditProfileForm" class="panel-body">						
						<form id="editUsernameForm">
							<div class="form-group">
								<label class="control-label col-xs-2" for="editProfileUsername">New Username:</label>
								<div class="col-xs-10">
									<input type="text" id="editProfileUsername"></input>
								</div>
							</div>
							<div class="form-group">
								<div class="col-xs-offset-2 col-xs-10" style="width:208px">
									<button type="submit" id="usernameEditSubmit" class="btn btn-primary pull-right">Submit</button>
								</div>
							</div>
						</form>
					</div>
				</div>

				<div class="panel panel-default">
					<div id="divEditEmailForm" class="panel-body">						
						<form id="editEmailForm">
							<div class="form-group">
								<label class="control-label col-xs-2" for="editProfileEmail">Enter new email:</label>
								<div class="col-xs-10">
									<input type="text" id="editProfileEmail"></input>
								</div>
							</div>
							<div class="form-group">
								<div class="col-xs-offset-2 col-xs-10" style="width:208px">
									<button type="submit" id="emailEditSubmit" class="btn btn-primary pull-right" disabled>Submit</button>
								</div>
							</div>
						</form>
					</div>
				</div>

				<div class="panel panel-default">
					<div id="divEditPasswordForm" class="panel-body">						
						<form id="editPasswordForm">
							<div class="form-group">
								<label class="control-label col-xs-2" for="editCurrentPassword">Current Password:</label>
								<div class="col-xs-10">
									<input type="password" id="editCurrentPassword"></input>
								</div>
							</div>
							<div class="form-group">
								<label class="control-label col-xs-2" for="editPasswordInit">Type new Password:</label>
								<div class="col-xs-10">
									<input type="password" id="editPasswordInit"></input>
								</div>
							</div>
							<div class="form-group">
								<label class="control-label col-xs-2" for="editPasswordRepeat">Repeat new Password:</label>
								<div class="col-xs-10">
									<input type="password" id="editPasswordRepeat"></input>
								</div>
							</div>
							<div class="form-group">
								<div class="col-xs-offset-2 col-xs-10" style="width:208px">
									<button type="submit" id="passwordEditSubmit" class="btn btn-primary pull-right" disabled>Submit</button>
								</div>
							</div>
						</form>
					</div>
				</div>


				<div class="panel panel-default">
					<div id="divSelectSkillForm" class="panel-body">
						<p>Add a new skill: </p>

						<form id="selectSkillForm">
							<div class="form-group">
								<label class="control-label col-xs-2" for="selectSkillType">Select skill type:</label>
								<div class="col-xs-10">
									<select class="form-control" style="width:200px" id="selectSkillType">
										<option value="sports">Sports</option>
										<option value="language">Language</option>
										<option value="maths">Maths</option>
										<option value="science">Science</option>
										<option value="household">Household</option>
										<option value="food">Food</option>
										<option value="nature">Nature</option>
										<option value="fashion">Fashion</option>
										<option value="art">Art</option>
										<option value="general">General</option>
									</select>
								</div>
							</div>
							<div class="form-group">
								<label class="control-label col-xs-2" for="selectSkillName">Select skill name:</label>
								<div class="col-xs-10">
									<select id="selectSkillName">
									</select>
								</div>
							</div>
							<div class="form-group">
								<label class="control-label col-xs-2" for="selectSkillLevel">Select skill level:</label>
								<div class="col-xs-10">
									<select class="form-control" style="width:200px" id="selectSkillLevel">
										<option value="beginner">Beginner</option>
										<option value="good">Good</option>
										<option value="proficient">Proficient</option>
										<option value="advanced">Advanced</option>
										<option value="master">Master</option>
									</select>
								</div>
							</div>
							<div class="form-group">
								<div class="col-xs-offset-2 col-xs-10" style="width:208px">
									<button type="submit" id="selectSkillSubmit" class="btn btn-primary pull-right" disabled>Submit</button>
								</div>
							</div>
						</form>
					</div>
				</div>

				<div class="panel panel-default">
					<div id="divAddNewSkill" class="panel-body">
						<p>Or create a new skill: </p>

						<form id="addNewSkill">
							<div class="form-group">
								<label class="control-label col-xs-2" for="newSkillType">Select skill type:</label>
								<div class="col-xs-10">
									<select class="form-control" style="width:200px" id="newSkillType">
										<option value="sports">Sports</option>
										<option value="language">Language</option>
										<option value="maths">Maths</option>
										<option value="science">Science</option>
										<option value="household">Household</option>
										<option value="food">Food</option>
										<option value="nature">Nature</option>
										<option value="fashion">Fashion</option>
										<option value="art">Art</option>
										<option value="general">General</option>
									</select>
								</div>
							</div>
							
							<div class="form-group">
								<label class="control-label col-xs-2" for="newSkillLevel">Select skill level:</label>
								<div class="col-xs-10">
									<select class="form-control" style="width:200px" id="newSkillLevel">
										<option value="beginner">Beginner</option>
										<option value="good">Good</option>
										<option value="proficient">Proficient</option>
										<option value="advanced">Advanced</option>
										<option value="master">Master</option>
									</select>
								</div>
							</div>

							<div class="form-group">
								<label class="control-label col-xs-2" for="newSkillInput">Enter skill name:</label>
								<div class="col-xs-10">
									<input type="text" id="newSkillInput">
								</div>
							</div>

							<div class="form-group">
								<div class="col-xs-offset-2 col-xs-10" style="width:208px">
									<button type="submit" id="newSkillSubmit" class="btn btn-primary pull-right" disabled>Submit</button>
								</div>
							</div>
						</form>
					</div>
				</div>


			';
		$editStringBeginner=
		'
			
				<option value="beginner" selected>Beginner</option>
				<option value="good">Good</option>
				<option value="proficient">Proficient</option>
				<option value="advanced">Advanced</option>
				<option value="master">Master</option>
			</select>
		';
		$editStringGood=
		'
			
				<option value="beginner">Beginner</option>
				<option value="good" selected>Good</option>
				<option value="proficient">Proficient</option>
				<option value="advanced">Advanced</option>
				<option value="master">Master</option>
			</select>
		';
		$editStringProficient=
		'
			
				<option value="beginner">Beginner</option>
				<option value="good">Good</option>
				<option value="proficient" selected>Proficient</option>
				<option value="advanced">Advanced</option>
				<option value="master">Master</option>
			</select>
		';
		$editStringAdvanced=
		'
			
				<option value="beginner">Beginner</option>
				<option value="good">Good</option>
				<option value="proficient">Proficient</option>
				<option value="advanced" selected>Advanced</option>
				<option value="master">Master</option>
			</select>
		';
		$editStringMaster=
		'
			
				<option value="beginner">Beginner</option>
				<option value="good">Good</option>
				<option value="proficient">Proficient</option>
				<option value="advanced">Advanced</option>
				<option value="master" selected>Master</option>
			</select>
		';
		
		echo 
			'
				<div class="panel panel-default">
					<div id="divSkillList" class="panel-body">
						<p>Edit level for exisiting skills: </p>
			';
		$count = count($skillList);
		$skillString="<ul id='skillList' class='list-group'>";

		//echo $count;
		for ($i=0; $i < $count ; $i++) { 


			$skill=$skillList[$i][0];
			$type=$skillList[$i][1];
			$level=$skillList[$i][2];

			$skillString=$skillString.'<li class="list-group-item" id="'.$skill.'"><p>Skill Name: '.$skill.'</p><p>Type: '.$type.'</p><p>Level: ';

			if($level=='beginner'){
				$skillString=$skillString.'<select class="form-control" style="width:200px" id="'.$i.'"> '.$editStringBeginner.'</p></li>';
			}
			else if($level=='good'){
				$skillString=$skillString.'<select style="width:200px" class="form-control" id="'.$i.'"> '.$editStringGood.'</p></li>';
			}
			else if($level=='proficient'){
				$skillString=$skillString.'<select style="width:200px" class="form-control" id="'.$i.'"> '.$editStringProficient.'</p></li>';
			}
			else if($level=='advanced'){
				$skillString=$skillString.'<select style="width:200px" class="form-control" id="'.$i.'"> '.$editStringAdvanced.'</p></li>';
			}
			else if($level=='master'){
				$skillString=$skillString.'<select style="width:200px" class="form-control" id="'.$i.'"> '.$editStringMaster.'</p></li>';
			}
			
		}
		$skillString=$skillString."</ul>";
		echo $skillString;
		echo 
			'
					</div>
				</div>
			';
	}
	function makeFavour(){
		echo 
			'
				<link rel="stylesheet" href="//code.jquery.com/ui/1.11.3/themes/smoothness/jquery-ui.css">
				<script src="//code.jquery.com/jquery-1.10.2.js"></script>
				<script src="//code.jquery.com/ui/1.11.3/jquery-ui.js"></script>
				
				<div id="divPostFavour">
					<form id="makeFavourForm">
						<label for="favourFormTitle">Title: </label>
						<input type="text" id="favourFormTitle"></input>
						<label for="favourFormDescription">Description: </label>
						<input type="text" id="favourFormDescription"></input>
						<label for="favourFormCost">Cost: </label>
						<input type="number" id="favourFormCost"></input>
						<label for="favourDatepicker">Date: </label>
						<input type="text" id="favourDatepicker" readonly="true"></input>
						
						<button type="submit" id="makeFavourSubmit" disabled>Submit</button>
					</form>
				</div>				
			';
	}
	function viewUserDetails($userInfo){
		//<a href='http://46.101.34.183/mvc/mvc/public/home/viewUserDetails/"+data['resultArray'][i][0]+"'>
		
		echo
			'
				<div id="viewUserDetailsDiv">
					<h1>User Details:</h1>';
					if(isset($userInfo['username'])){
						echo 
							'
								<p>Username: <a href="http://46.101.34.183/mvc/mvc/public/home/viewUserDetails/'.$userInfo['uid'].'">'.$userInfo['username'].'</a></p>
							';
					}
					if(isset($userInfo['email'])){
						echo 
							'
								<p>Email: '.$userInfo['email'].'</p>
							';
					}
					if(isset($userInfo['credit_amount'])){
						echo 
							'
								<p>Credits: '.$userInfo['credit_amount'].'</p>
							';
					}

					if(isset($userInfo['skills'])){

						//add code to display the skillList
						//var_dump($userInfo['skills']);
						/*$editString=
							'
								<select id="editSkillLevel">
									<option value="beginner">Beginner</option>
									<option value="good">Good</option>
									<option value="proficient">Proficient</option>
									<option value="advanced">Advanced</option>
									<option value="master">Master</option>
								</select>
							';
						*/
						echo 
							'
								<p>Skills: </p>
							';
						$count = count($userInfo['skills']);
						$skillString="<ul>";
						//echo $count;
						for ($i=0; $i < $count ; $i++) { 
							$skill=$userInfo['skills'][$i][0];
							$type=$userInfo['skills'][$i][1];
							$level=$userInfo['skills'][$i][2];
							$skillString=$skillString.'<li><p>Skill Name: '.$skill.'</p><p>Type: '.$type.'</p><p>Level: '.$level.'</p></li>';
						}
						$skillString=$skillString."</ul>";
						echo $skillString;

					}

		echo 
			'
				</div>	
			';
	}
	function viewPostDetails($postInfo){
		echo
			'
				<div id="viewPostDetailsDiv">
					<h1>Post Details:</h1>';
					if(isset($postInfo['username'])){
						echo 
							'
								<p id="postDetailsUsername">Username: '.$postInfo['username'].'</p>
							';
					}
					if(isset($postInfo['email'])){
						echo 
							'
								<p>Email: '.$postInfo['email'].'</p>
							';
					}
					if(isset($postInfo['postID'])){
						echo 
							'
								<p>Post ID: '.$postInfo['postID'].'</p>
							';
					}
					if(isset($postInfo['postTitle'])){
						echo 
							'
								<p>Title: '.$postInfo['postTitle'].'</p>
							';
					}
					if(isset($postInfo['postDescription'])){
						echo 
							'
								<p>Description: '.$postInfo['postDescription'].'</p>
							';
					}
					if(isset($postInfo['cost'])){
						echo 
							'
								<p>Cost: '.$postInfo['cost'].'</p>
							';
					}
					if(isset($postInfo['expiry'])){
						echo 
							'
								<p>Expiry: '.$postInfo['expiry'].'</p>
							';
					}
					if(isset($postInfo['state'])){
						echo 
							'
								<p>State: '.$postInfo['state'].'</p>
							';
						if(!($_SESSION['client_id']=== $postInfo['client_id']) && $postInfo['state']==='active'){
							echo '<a href="http://46.101.34.183/mvc/mvc/public/home/transactionSummary/'.$postInfo['postID'].'" id="selectFavourLink">Select Favour</a>';
						}

					}

		echo 
			'
				</div>	
			';
	}
	function viewPersonalDetails(){
		echo
			'
				<div id="viewDetailsDiv">
					<h1>Personal Details:</h1>';
					if(testSession('username')){echo '<p>Username: '.$_SESSION['username'].'</p>';}
					else{echo '<p>Username: '.$_SESSION['email'].'</p>';}
					if(testSession('email')){echo '<p>Email: '.$_SESSION['email'].'</p>';} 
					else{}
		echo 
			'
				</div>	
			';


	}
	function welcomeDiv(){

		echo
			'
				<div id="mainBody">
					<div id="welcomeDiv">
						<h1>Welcome to RHUL.LETS'; if(testSession('username')){echo ' '.$_SESSION['username'];}else if(testSession('email')){echo ' '.$_SESSION['email'];} else{}echo '</h1>
					</div>
				</div>	

			';
		//echo "Session: ". $_SESSION['unreadMessages'];

	}
	function loginForm($address){
		echo
			'
				<div class="panel panel-default">
					<div id="divLoginForm" class="panel-body">
						<form id="loginForm">
							<label for="email">Enter Email:</label>
							<input type="email" id="email" value ='.$address.'></input>
							<label for="password">Password:</label>
							<input type="password" id="password"></input>
							<button type="submit" id="loginSubmit">Submit</button>
						</form>
					</div>
				</div>
			';
	}
	function createUserForm(){
		echo
			'
				<div class="panel panel-default">
					<div id="divCreateUserForm" class="panel-body">
						<form id="createUserForm">
							<label for="createUserEmail">Enter Email:</label>
							<input type="email" id="createUserEmail"></input>
							<label for="initPassword" hidden>Password:</label>
							<input type="password" id="initPassword" hidden></input>
							<label for="repeatPassword" hidden>Repeat password:</label>
							<input type="password" id="repeatPassword" hidden></input>
							<button type="submit" id="createUserSubmit" disabled>Submit</button>
						</form>
					</div>
				</div>
			';
	}

	function userMessage($message){
		echo 
			'
				<div class="panel panel-warning" id="userMessageMasterDiv" >
					<div class="panel-heading" >
						<h3 class="panel-title" >Notice</h3>
					</div>
					<div id="userMessage" class="panel-body">
						<p>'.$message.'</p>
					</div>
				</div>
			';
	}
	function dynamicUserInfo(){
		echo 
			'
				<div id="dynamicInfoMasterDiv" class="panel panel-warning" hidden>
					<div class="panel-heading">
						<h3 class="panel-title">Notice</h3>
					</div>
					<div id="dynamicUserInfo" class="panel-body">
						<p>Panel Content</p>
					</div>
				</div>
			';

			
	}
	function testSession($sessionVariable){
		//session_start();
		//$_SESSION['email']='James';
		if((isset($_SESSION))){
			//session_start();
			if(isset($_SESSION[$sessionVariable])){
				return true;//echo " ".;
			}
		}
		else
			return false;
	}

?>
