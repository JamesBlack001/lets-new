<?php

require_once $_SERVER['DOCUMENT_ROOT']."/mvc/mvc/includes/SqlConnect.php";
//require_once $_SERVER['DOCUMENT_ROOT']."/NewMVC/mvc/includes/content.php";
include_once $_SERVER['DOCUMENT_ROOT'].'/mvc/mvc/includes/viewComponents.php';

class Message{

	public $userID;
	public $message_id;
	public $recipientid;
	public $threadID;

	public function returnView($data){

		if($data['action']=='viewMessages'){

			//get the message data, store as an array, and pass into viewMessages method
			session_start();
			$this->userID = $_SESSION['client_id'];


			if($data['inboxType']=='all'){

				//get the threads for the user

				$messageSet = SqlConnect::getInstance()->validateConnection()->prepareStatement("SELECT * FROM messages WHERE threadid= ? ORDER BY date_time DESC")->bindParamsCheckUser('s',$this->threadID)->stmtExecute()->get_Result()->getRes();
				$heading='Conversation Messages: ';
			}
			else if($data['inboxType']=='new'){
				//session_start();
				$this->userID = $_SESSION['client_id'];
				$messageSet = SqlConnect::getInstance()->validateConnection()->prepareStatement("SELECT message_id,client_id,subject,date_time,content,state FROM messages WHERE client_id= ? AND state = ? AND threadid = ? ORDER BY date_time DESC")->bindParamsNewMessages('sss',$this->userID,'unread',$this->threadID)->stmtExecute()->get_Result()->getRes();
				$heading = 'New Messages: ';
			}


			$messageString=
				"
					<p style='color:blue'>Messages in blue are from you.</p>
					<p style='color:red'>Messages in red are from the recipient.</p>
					<ul>";
			if(SqlConnect::numRows($messageSet) <= 0){
				$messageString = '<p>No messages to show</p>';
			}
			$senderLink="";
			//creates the list of data for the thread
			while($messageArray=$messageSet->fetch_assoc()){

				//var_dump($messageArray);
				$messageID=$messageArray['message_id'];
				
				//get uname details from client table

				//get the details from the result row:
				$subject=$messageArray['subject'];
				$senderID = $messageArray['client_id'];
				$reciever_id = $messageArray['reciever_id'];

				$state= $messageArray['state'];

				if($state == 'unread'){
					//update the db
					SqlConnect::getInstance()->validateConnection()->prepareStatement("UPDATE messages SET state = 'read' WHERE threadid= ? AND state = 'unread'")->bindParamsCheckUser('s',$this->threadID)->stmtExecute();

					$_SESSION['unreadMessages']= " (New)" ;
				}



				if(!$messageArray['content']){
					$message="";
				}
				else{$message = $messageArray['content'];}



				//$date_time = $messageArray['date_time'];

				$uname;
				$unameSet = SqlConnect::getInstance()->validateConnection()->prepareStatement("SELECT email,username FROM client WHERE client_id= ? ")->bindParamsCheckUser('i',$senderID)->stmtExecute()->get_Result()->getRes();
				$unameArray = $unameSet->fetch_assoc();

				if($unameArray['username']){
					$uname=$unameArray['username'];
				}
				else{
					$uname = $unameArray['email'];
				}

				if(isset($messageArray['state'])){
					$stateString = $messageArray['state'];
				}
				else{
					$stateString = "";
				}

				//$messageLink="<a href='http://46.101.34.183/mvc/mvc/public/home/viewMessageDetails/".$messageID."'>".$subject."</a>";
				$senderLink="<a href='http://46.101.34.183/mvc/mvc/public/home/viewUserDetails/".$senderID."'>".$uname."</a>";

				
				//echo $senderID;
				//echo $this->userID;
				if($senderID==$this->userID){
					$messageString = $messageString."<li><p style='color:blue'>Subject: ".$subject."</p><p style='color:blue'>Message: ".$message."</p></li>";
				}
				else{
					$messageString = $messageString."<li><p style='color:red'>Subject: ".$subject."</p><p style='color:red'>Message: ".$message."</p></li>";
				}

			}
			$messageString=$messageString."</ul>";
			if(!$senderLink){
				
			}
			else{$heading=$heading.$senderLink;}
			
			echo openingComponent();
			echo navBar();
			echo messageNavBar();
			echo viewMessages($messageString,$heading);


			//insert view components for viewing all messages

			echo closingComponent();
		}
		else if($data['action']=='viewConversations'){


			
			$threadSet = SqlConnect::getInstance()->validateConnection()->prepareStatement("SELECT threadid FROM messagethread WHERE sender1= ? or sender2 = ?")->bindParamsGetClientThreads('ii',$this->userID,$this->userID)->stmtExecute()->get_Result()->getRes();
			$heading = 'Conversations: ';
			
			$threadString="<ul>";
			if(SqlConnect::numRows($threadSet) <= 0){
				$threadString = '<p>No Conversations to show</p>';
			}

			//creates the list of data for the thread, iterates through the return result set
			while($threadArray=$threadSet->fetch_assoc()){
				//var_dump($threadArray);


				//get the thread id
				$threadid = $threadArray['threadid'];

				//get the top level message for that thread
				$messageSet = SqlConnect::getInstance()->validateConnection()->prepareStatement("SELECT * FROM messages WHERE client_id= ? AND threadid = ? ORDER BY date_time DESC LIMIT 1")->bindParamsGetClientThreads('ii',$this->userID,$threadid)->stmtExecute()->get_Result()->getRes();

				$messageArray = $messageSet->fetch_assoc();

				$unreadSet = SqlConnect::getInstance()->validateConnection()->prepareStatement("SELECT * FROM messages WHERE client_id= ? AND threadid = ? AND state ='unread' ORDER BY date_time")->bindParamsGetClientThreads('ii',$this->userID,$threadid)->stmtExecute()->get_Result()->getRes();

				$count = SqlConnect::numRows($unreadSet);

				//check if the Array is empty
				if(!$messageArray){
					//echo "no entry exists";
					//do NAFFIN
				}
				//else
				else{
					//echo "an entry exists";
					//add the value to the thread string


					//get reciever credentials:

					//get the reciever_id,
					$reciever_id = $messageArray['reciever_id'];


					//echo $reciever_id."\r\n";

					//get the reciever email/username, 
					$recieverSet = SqlConnect::getInstance()->validateConnection()->prepareStatement("SELECT email,username FROM client WHERE client_id= ?")->bindParamsCheckuser('i',$reciever_id)->stmtExecute()->get_Result()->getRes();

					$recieverArray = $recieverSet->fetch_assoc();

					$uname="";
					if($recieverArray['username']){
						$uname = $recieverArray['username'];
					}
					else{
						$uname = $recieverArray['email'];
					}

					$messageID = $messageArray['message_id'];
					$subject = $messageArray['subject'];
					$senderID = $messageArray['client_id'];


					//create link to view messages from this user 
					//{must alter view inbox to reflect this}

					//$messageLink="<a href='http://46.101.34.183/mvc/mvc/public/home/viewMessages/".$threadid."'>View conversation</a>";

					if($count>0){
						$messageLink="<a href='http://46.101.34.183/mvc/mvc/public/home/viewMessages/".$threadid."'>View conversation (New) </a>";
					}
					else{
						$messageLink="<a href='http://46.101.34.183/mvc/mvc/public/home/viewMessages/".$threadid."'>View conversation</a>";
					}
					$senderLink="<a href='http://46.101.34.183/mvc/mvc/public/home/viewUserDetails/".$senderID."'>".$uname."</a>";
					
					$threadString = $threadString."<li><p>From: ".$senderLink."</p><p>".$messageLink."</p></li>";
					
				}

			}
			$threadString=$threadString."</ul>";

			echo openingComponent();
			echo navBar();
			echo messageNavBar();

			//echo $threadString;

			echo viewMessages($threadString,$heading);
			
			//echo var_dump($messageSet->fetch_all());
			echo dynamicUserInfo();
			echo closingComponent();

		}
		else if($data['action']=='createNewMessage'){

			echo openingComponent();
			echo navBar();
			echo messageNavBar();
			echo createMessageForm($this->recipientid);
			echo closingComponent();

		}
		else if($data['action']=='viewMessageDetails'){
			//begin transaction for retrieving and updating the 'read' status of the message


			$messageDetailSet = SqlConnect::getInstance()->validateConnection()->prepareStatement("SELECT * FROM messages WHERE message_id= ? ")->bindParamsCheckUser('s',$this->message_id)->stmtExecute()->get_Result()->getRes();

			$messageDetails = $messageDetailSet->fetch_assoc();

			$senderID = $messageDetails['client_id'];
			$subject = $messageDetails['subject'];
			$content = $messageDetails['content'];
			$dateSent = $messageDetails['date_time'];
			$state = $messageDetails['state'];

			//change state of the message
			if($state == 'unread'){// change to read
				try{
				SqlConnect::getInstance()->beginTransaction();
				SqlConnect::getInstance()->validateConnection()->prepareStatement("UPDATE messages SET state='read' WHERE message_id= ?")->bindParamsCheckUser('s',$this->message_id)->stmtExecute();
				SqlConnect::getInstance()->commitTransaction();
				}
				catch(Exception $e){
				SqlConnect::getInstance()->validateConnection()->rollback();
				}
				SqlConnect::getInstance()->endTransaction();
			}
			//end transaction


			echo openingComponent();
			echo navBar();
			echo messageNavBar();
			echo viewMessageDetails(['senderID'=>$senderID,'subject'=>$subject,'content'=>$content, 'dateSent'=>$dateSent]);
			echo closingComponent();

		}
		else{
			echo 
				'
					<p>Something went wrong</p>
					<p>Probably didn"t add the view Component method calls to the Main.php file for this particular view</p>
					<p>Or didn"t add the specific conditional statement call to the method returnView</p>
				';
		}
	}		
}

?>
