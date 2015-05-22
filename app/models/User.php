<?php

//require_once $_SERVER['DOCUMENT_ROOT']."/LETS/mvc/includes/SqlConnect.php";
include_once $_SERVER['DOCUMENT_ROOT'].'/mvc/mvc/includes/viewComponents.php';
require_once $_SERVER['DOCUMENT_ROOT']."/mvc/mvc/includes/SqlConnect.php";

class User{
	public $uid;
	public $username;
	public $email;
	public $credits;
	public $skillsArray;
	//... inclue more fields that is other user-information extracted from db

	public function getUserDetails(){
	//include a function to get the relevant user details based on the UID in the model
	//call it from the controller
	//the function will get the details, and store them into variables in this model
	//the method returnView will use the variables stored in THIS model, and then pass those details into the
	//method call viewUserDetails, to echo the details for the user.

		//these set variables are just default, set jsut to test the method
		//use the id, passed as part of the URL, to get the data from the db for the user details
		$resultSet = SqlConnect::getInstance()->validateConnection()->prepareStatement("SELECT email,username,credit_amount FROM client WHERE client_id = ?")->bindParamsCheckUser('s',$this->uid)->stmtExecute()->get_Result()->getRes();
		$resultArray = $resultSet->fetch_array();
		
		$skillSet = SqlConnect::getInstance()->validateConnection()->prepareStatement("SELECT skill,skill_type,skill_level FROM skills WHERE client_id = ?")->bindParamsCheckUser('s',$this->uid)->stmtExecute()->get_Result()->getRes();
		$this->skillsArray = $skillSet->fetch_all();

		$this->email = $resultArray['email'];
		$this->username = $resultArray['username'];
		$this->credits = $resultArray['credit_amount'];
		//$this->username = "Dave";
		//$this->email = "dave@email.com";
	}

	public function returnView($data){
		
		if($data['action']=='userDetails'){
			echo openingComponent();
			echo navBar();
			echo viewDetailsNavBar(['uid'=>$this->uid]);
			echo viewUserDetails(['username'=>$this->username,'email'=>$this->email,'uid'=>$this->uid,'credit_amount'=>$this->credits,'skills'=>$this->skillsArray]);
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
