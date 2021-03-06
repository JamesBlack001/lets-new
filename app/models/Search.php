<?php

include_once $_SERVER['DOCUMENT_ROOT'].'/mvc/mvc/includes/viewComponents.php';
require_once $_SERVER['DOCUMENT_ROOT']."/mvc/mvc/includes/SqlConnect.php";
	
class Search{

	public $transactionHistoryArray;
	public $uid;

	public function returnView($data){

		if($data['action']=='search'){
			echo openingComponent();
			echo navBar();
			echo search();
			echo searchResults();
			echo closingComponent();
		}
		elseif ($data['action']=='searchRetired'){
			$resultString;
			//get the data for prep
			$resultSet = SqlConnect::getInstance()->validateConnection()->prepareStatement("SELECT * FROM post WHERE client_id = ? AND state = ? ORDER BY expiry_date DESC")->bindParamsStatefulFavours('is',$this->uid,'retired')->stmtExecute()->get_Result()->getRes();
			
			//prep the data
			$resultString="<ul>";

			while($resultArray=$resultSet->fetch_assoc()){

				$post_id=$resultArray['post_id'];
				$post_title=$resultArray['title'];
				$favour_uid=$resultArray['client_id'];
				$reciever_uid=$resultArray['reciever_id'];
				$expiry = $resultArray['expiry_date'];
				$cost = $resultArray['credit_cost'];
				$description = $resultArray['post_description'];
				$postLink="<a href='http://46.101.34.183/mvc/mvc/public/home/viewPostDetails/".$post_id."'>".$post_title."</a>";
				$userLinkOriginator="<a href='http://46.101.34.183/mvc/mvc/public/home/viewUserDetails/".$favour_uid."'>".$favour_uid."</a>";
				if($reciever_uid==0){
					$userLinkReciever="Favour unactioned";
				}
				else{
					$userLinkReciever="<a href='http://46.101.34.183/mvc/mvc/public/home/viewUserDetails/".$reciever_uid."'>".$reciever_uid."</a>";
				}

				$resultString = $resultString."<li><p>".$postLink." Expiry Date: ".$expiry." Cost: ".$cost."</p><p>User: ".$userLinkOriginator." Reciever: ".$userLinkReciever."</p><p>Description: ".$description."</p></li>";

			}
			$resultString=$resultString."</ul>";
			
			echo openingComponent();
			echo navBar();

			echo viewDetailsNavBar(['uid'=>$this->uid]);
			echo viewFavourDetails($resultString,'retiredFavours','Retired Favours: ');
			echo closingComponent();
		}

		elseif ($data['action']=='searchOpenFavours'){
			session_start();
			$this->uid=$_SESSION['client_id'];

			$resultString;
			//get the data for prep
			$resultSet = SqlConnect::getInstance()->validateConnection()->prepareStatement("SELECT * FROM post WHERE client_id = ? AND state = ? ORDER BY expiry_date ASC")->bindParamsStatefulFavours('is',$this->uid,'unredeemed')->stmtExecute()->get_Result()->getRes();
			

			
			//prep the data
			$resultString="<ul>";

			while($resultArray=$resultSet->fetch_assoc()){

				$post_id=$resultArray['post_id'];
				$post_title=$resultArray['title'];
				$favour_uid=$resultArray['client_id'];
				$reciever_uid=$resultArray['reciever_id'];
				$expiry = $resultArray['expiry_date'];
				$cost = $resultArray['credit_cost'];
				$description = $resultArray['post_description'];


				//get the name or email for the o.p. of the favour 
				$favourNameResultSet = SqlConnect::getInstance()->validateConnection()->prepareStatement("SELECT email,username FROM client WHERE client_id = ?")->bindParamsCheckUser('s',$favour_uid)->stmtExecute()->get_Result()->getRes();
				$favourArray = $favourNameResultSet->fetch_assoc();
				
				$favour_name=$favourArray['username'];
				if(!$favour_name){
					$favour_name=$favourArray['email'];
				}
				
				//get the name or email for the reciever of the favour
				$recieverNameResultSet = SqlConnect::getInstance()->validateConnection()->prepareStatement("SELECT email,username FROM client WHERE client_id = ?")->bindParamsCheckUser('s',$reciever_uid)->stmtExecute()->get_Result()->getRes();
				$recieverArray = $recieverNameResultSet->fetch_assoc();
				
				$reciever_name=$recieverArray['username'];
				if(!$reciever_name){
					$reciever_name=$recieverArray['email'];
				}

				$postLink="<a href='http://46.101.34.183/mvc/mvc/public/home/viewPostDetails/".$post_id."'>".$post_title."</a>";
				$userLinkOriginator="<a href='http://46.101.34.183/mvc/mvc/public/home/viewUserDetails/".$favour_uid."'>".$favour_name."</a>";
				if($reciever_uid==0){
					$userLinkReciever="Favour unactioned";
				}
				else{
					$userLinkReciever="<a href='http://46.101.34.183/mvc/mvc/public/home/viewUserDetails/".$reciever_uid."'>".$reciever_name."</a>";
				}
				$closeFavourLink = "<a href='http://46.101.34.183/mvc/mvc/includes/closeFavour.php?fid=".$post_id."'>Close Favour</a>";

				$resultString = $resultString."<li><p>".$postLink." Expiry Date: ".$expiry." Cost: ".$cost."</p><p>User: ".$userLinkOriginator." Reciever: ".$userLinkReciever."</p><p>Description: ".$description."</p><p>".$closeFavourLink."</p></li>";

			}
			$resultString=$resultString."</ul>";
			
			echo openingComponent();
			echo navBar();

			echo viewDetailsNavBar(['uid'=>$this->uid]);
			echo viewFavourDetails($resultString,'openFavours','Open Favours: ');
			echo closingComponent();
		}
		elseif ($data['action']=='searchUnredeemed') {
			$resultString;
			//get the data for prep
			$resultSet = SqlConnect::getInstance()->validateConnection()->prepareStatement("SELECT * FROM post WHERE reciever_id = ? AND state = ? ORDER BY expiry_date ASC")->bindParamsStatefulFavours('is',$this->uid,'unredeemed')->stmtExecute()->get_Result()->getRes();
			
			//prep the data
			$resultString="<ul>";

			while($resultArray=$resultSet->fetch_assoc()){

				$post_id=$resultArray['post_id'];
				$post_title=$resultArray['title'];
				$favour_uid=$resultArray['client_id'];
				$expiry = $resultArray['expiry_date'];
				$cost = $resultArray['credit_cost'];
				$description = $resultArray['post_description'];

				$favourResultSet = SqlConnect::getInstance()->validateConnection()->prepareStatement("SELECT email,username FROM client WHERE client_id = ?")->bindParamsCheckUser('s',$favour_uid)->stmtExecute()->get_Result()->getRes();
				$favourArray = $favourResultSet->fetch_assoc();
				
				$favour_name=$favourArray['username'];
				if(!$favour_name){
					$favour_name=$favourArray['email'];
				}


				$postLink="<a href='http://46.101.34.183/mvc/mvc/public/home/viewPostDetails/".$post_id."'>".$post_title."</a>";
				$userLinkOriginator="<a href='http://46.101.34.183/mvc/mvc/public/home/viewUserDetails/".$favour_uid."'>".$favour_name."</a>";
				$resultString= $resultString."<li><p>".$postLink." Expiry Date: ".$expiry."</p><p>User: ".$userLinkOriginator." Cost: ".$cost."</p><p>Description: ".$description."</p></li>";

			}
			$resultString=$resultString."</ul>";
			
			echo openingComponent();
			echo navBar();
			echo viewDetailsNavBar(['uid'=>$this->uid]);
			echo viewFavourDetails($resultString,'unredeemedFavours','Unredeemed Favours: ');
			echo closingComponent();
		}
		else if($data['action']=='searchActive'){

			$resultString;
			//get the data for prep
			$resultSet = SqlConnect::getInstance()->validateConnection()->prepareStatement("SELECT * FROM post WHERE client_id = ? AND state = ? ORDER BY expiry_date ASC")->bindParamsStatefulFavours('is',$this->uid,'active')->stmtExecute()->get_Result()->getRes();
			
			//prep the data
			$resultString="<ul>";

			while($resultArray=$resultSet->fetch_assoc()){

				$post_id=$resultArray['post_id'];
				$post_title=$resultArray['title'];
				$favour_uid=$resultArray['client_id'];
				$expiry = $resultArray['expiry_date'];
				$cost = $resultArray['credit_cost'];
				$description = $resultArray['post_description'];

				$favourResultSet = SqlConnect::getInstance()->validateConnection()->prepareStatement("SELECT email,username FROM client WHERE client_id = ?")->bindParamsCheckUser('s',$favour_uid)->stmtExecute()->get_Result()->getRes();
				$favourArray = $favourResultSet->fetch_assoc();
				
				$favour_name=$favourArray['username'];
				if(!$favour_name){
					$favour_name=$favourArray['email'];
				}
				
				
				$retireFavourLink = "<a href='http://46.101.34.183/mvc/mvc/includes/retireFavour.php?fid=".$post_id."'>Retire Favour</a>";

				$postLink="<a href='http://46.101.34.183/mvc/mvc/public/home/viewPostDetails/".$post_id."'>".$post_title."</a>";
				$userLinkOriginator="<a href='http://46.101.34.183/mvc/mvc/public/home/viewUserDetails/".$favour_uid."'>".$favour_name."</a>";
				$resultString= $resultString."<li><p>".$postLink." Expiry Date: ".$expiry."</p><p>User: ".$userLinkOriginator." Cost: ".$cost."</p><p>Description: ".$description."</p><p>".$retireFavourLink."</p></li>";

			}
			$resultString=$resultString."</ul>";
			
			echo openingComponent();
			echo navBar();

			echo viewDetailsNavBar(['uid'=>$this->uid]);
			echo viewFavourDetails($resultString,'activeFavours','Active Favours: ');
			echo closingComponent();


		}
		else if($data['action']=='searchHistory'){

			//get the data and pass it into it as an array

			$resultString;
			$resultSet = SqlConnect::getInstance()->validateConnection()->prepareStatement("SELECT * FROM history WHERE favour_uid = ? OR reciever_uid = ? ORDER BY transaction_date ASC")->bindParamsTransactionHistory('ss',$this->uid)->stmtExecute()->get_Result()->getRes();
			
			//prepare the data as a string;

			$resultString = "<ul>";
			while($resultArray=$resultSet->fetch_row()){

				$pid=$resultArray[0];

				$postSet = SqlConnect::getInstance()->validateConnection()->prepareStatement("SELECT title FROM post WHERE post_id = ?")->bindParamsPostTitle('i',$pid)->stmtExecute()->get_Result()->getRes();
				$titleArray = $postSet->fetch_assoc();
				$title = $titleArray['title'];
				$postLink = "<a href='http://46.101.34.183/mvc/mvc/public/home/viewPostDetails/".$pid."'>".$title."</a>";
				$userLinkOriginator;
				$userLinkReciever;



				$favourOriginator = $resultArray[1];
				$favourReciever = $resultArray[2];


				//get the name or email for the o.p. of the favour 
				$favourOriginaterResultSet = SqlConnect::getInstance()->validateConnection()->prepareStatement("SELECT email,username FROM client WHERE client_id = ?")->bindParamsCheckUser('s',$favourOriginator)->stmtExecute()->get_Result()->getRes();
				$favourArray = $favourOriginaterResultSet->fetch_assoc();
				
				$favour_name=$favourArray['username'];
				if(!$favour_name){
					$favour_name=$favourArray['email'];
				}
				
				//get the name or email for the reciever of the favour
				$recieverResultSet = SqlConnect::getInstance()->validateConnection()->prepareStatement("SELECT email,username FROM client WHERE client_id = ?")->bindParamsCheckUser('s',$favourReciever)->stmtExecute()->get_Result()->getRes();
				$recieverArray = $recieverResultSet->fetch_assoc();
				
				$reciever_name=$recieverArray['username'];
				if(!$reciever_name){
					$reciever_name=$recieverArray['email'];
				}




				$cost = $resultArray[3];


				if($favourOriginator==$this->uid){
					$userLinkOriginator="<a href='http://46.101.34.183/mvc/mvc/public/home/viewUserDetails/".$resultArray[1]."'>".$favour_name."</a>";
					$userLinkReciever="<a href='http://46.101.34.183/mvc/mvc/public/home/viewUserDetails/".$resultArray[2]."'>".$reciever_name."</a>";
					$resultString = $resultString."<li><p>".$postLink." Date: ".$resultArray[4]."</p><p>".$userLinkOriginator." <---- $".$cost." ---- ".$userLinkReciever."</p></li>";
				}
				else{
					$userLinkOriginator="<a href='http://46.101.34.183/mvc/mvc/public/home/viewUserDetails/".$resultArray[2]."'>".$reciever_name."</a>";
					$userLinkReciever="<a href='http://46.101.34.183/mvc/mvc/public/home/viewUserDetails/".$resultArray[1]."'>".$favour_name."</a>";
					$resultString = $resultString."<li><p>".$postLink." Date: ".$resultArray[4]."</p><p>".$userLinkOriginator." ---- $".$cost." ----> ".$userLinkReciever."</p></li>";
				}
			}
			$resultString=$resultString."</ul>";
			
			echo openingComponent();
			echo navBar();
			
			echo viewDetailsNavBar(['uid'=>$this->uid]);
			echo viewFavourDetails($resultString,'transactionHistory','Transaction History: ');
			echo closingComponent();
		}
		else{
			echo 
				'
					<p>Something went wrong</p>
					<p>Probably didn"t add the view Component method calls to the Main.php file for this particular view</p>
				';
		}
	}
}

?>
