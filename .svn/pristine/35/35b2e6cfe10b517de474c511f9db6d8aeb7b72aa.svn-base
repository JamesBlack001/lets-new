<?php

	class SqlConnect{
		
		//variables
		
		private $connection;
		private $stmt;
		private $res;

		public function __construct(){
			//echo "Constructed";
			$mysqli=new mysqli("127.0.0.1","root","rgh87clownfrog","LETS");
			if ($mysqli->connect_errno) {
				echo "Failed to connect to MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
			}

			$this->connection = $mysqli;
		}

		public static $instance;

		/*
		**The method checks if an instance has been made, already, if
		**it has then it will only return that instance, otherwise
		**it will create one, then return it.
		*/
		public static function getInstance(){
			if(!isset(self::$instance)){
				self::$instance = new SqlConnect();
				//echo "new instance created";
			}
			return self::$instance;
		}

		function getConnection(){
			return $connection;
		}
	
		//open the connection
		

		//select required database
		
		
		//mysql_query($sql,$connection);
		
		//echo "1 record added";
		
		//takes one argument, the connection
		//runs an error message if the connection fails.
		function validateConnection(){
			if ($this->connection->connect_errno) {
				echo "Failed to connect to MySQL: (" . $this->connection->connect_errno . ") " . $connection->connect_error;
			}

			//echo "validated";
			return $this;
		}
		function beginTransaction(){
			if(!($this->connection->autocommit(false))){
				echo "Failed to begin transaction.";
			}

			return $this;
		}
		function endTransaction(){
			if(!($this->connection->autocommit(true))){
				echo "Failed to end transaction.";
			}

			return $this;
		}
		function commitTransaction(){
			if(!($this->connection->commit())){
				echo "failed to commit queries";

				$this->connection->rollback();
			}

			return $this;
		}
		function rollback(){
			$this->connection->rollback();

			return $this;
		}
		
		//takes two arguments, the string value for the prepare, and the open connection.
		//runs an error message if the prepare method fails.
		function prepareStatement($statement){
			//the process for managing the salt is taken from the book 'PHP6 and MySQL 5 - Larry Ullman'
			if (!($stmt = $this->connection->prepare($statement))) {
				echo "Prepare failed: (" . $this->connection->errno . ") " . $this->connection->error;
			}
			$this->stmt=$stmt;
			//echo "statement prepared";
			return $this;
		}
		
		//calls execute on the statement, and runs an error message if fails
		function stmtExecute(){
			if (!$this->stmt->execute()) {
				echo "Execute failed: (" . $this->stmt->errno . ") " . $this->stmt->error;
			}
			else{
				//echo "Success";
			}
			return $this;
		}
		
		//takes a stmt, and returns the result associated with the statement,
		//runs error message on failure.
		function get_Result(){
				if (!($res = $this->stmt->get_result() ) ) {
					echo "Getting result set failed: (" . $this->stmt->errno . ") " . $this->stmt->error;
				}
			$this->res=$res;
			return $this;
		}

		function getRes(){
			return $this->res;
		}
		function numRows($set){
			return $set->num_rows;
		}
		
		
		//takes a string as a value, and applies the encryption algorithm and returns the result
		
		//the second variable defines the encryption algorithm to use, set to default by PHP standards t allow for updates
		//to the php standard that upgrades for stronger algorithms
		//code lifted from the documentation
		//this algorithm is taken from the php documentation, it is the most efficient as it uses the most upto date encryption
		//algorithm as well as a salt.
		function createNewPassword($password,$salt){
			
			$options = [
					'cost' => 9,
					'salt' => $salt,
			];
			return password_hash($password, PASSWORD_DEFAULT, $options);
		}
		
		//binds the parameters to the newUser insertion, uses three variables,
		//the type identifier,
		//the $name,
		//the $new_password
		//This will eventually be updated to include an extensive detail about the client
		//upon their registering


		function bindParamsCreateNewThread($typeIdentifier,$sender,$recipientID){
			if(!$this->stmt->bind_param($typeIdentifier,$sender,$recipientID)) {
				echo "Binding parameters failed: (" . $stmt->errno . ") " . $stmt->error;
			}
			return $this;	
		}

		function bindParamsGetClientThreads($typeIdentifier,$sender,$recipientID){
			if(!$this->stmt->bind_param($typeIdentifier,$sender,$recipientID)) {
				echo "Binding parameters failed: (" . $stmt->errno . ") " . $stmt->error;
			}
			return $this;	
		}
		function bindParamsGetThreadID($typeIdentifier,$sender,$recipientID){
			if(!$this->stmt->bind_param($typeIdentifier,$sender,$sender,$recipientID,$recipientID)) {
				echo "Binding parameters failed: (" . $stmt->errno . ") " . $stmt->error;
			}
			return $this;	
		}
		function bindParamsUpdateSkill($typeIdentifier,$level,$skillID){
			if(!$this->stmt->bind_param($typeIdentifier,$level,$skillID)) {
				echo "Binding parameters failed: (" . $stmt->errno . ") " . $stmt->error;
			}
			return $this;	
		}
		function bindParamsInsertSkill($typeIdentifier,$clientID,$skillName,$skillType,$skillLevel){
			if(!$this->stmt->bind_param($typeIdentifier,$clientID,$skillName,$skillType,$skillLevel)) {
				echo "Binding parameters failed: (" . $stmt->errno . ") " . $stmt->error;
			}
			return $this;
		}
		function bindParamsSkillList($typeIdentifier,$type){
			if(!$this->stmt->bind_param($typeIdentifier,$type)) {
				echo "Binding parameters failed: (" . $stmt->errno . ") " . $stmt->error;
			}
			return $this;
		}
		function bindParamsUpdateActive($typeIdentifier,$active,$clientID){
			if(!$this->stmt->bind_param($typeIdentifier,$active,$clientID)) {
				echo "Binding parameters failed: (" . $stmt->errno . ") " . $stmt->error;
			}
			return $this;
		}
		function bindParamsGetClientHash($typeIdentifier,$email, $hash, $active){
			if(!$this->stmt->bind_param($typeIdentifier,$email, $hash, $active)) {
				echo "Binding parameters failed: (" . $stmt->errno . ") " . $stmt->error;
			}
			return $this;
		}
		function bindParamsNewInactiveUser($typeIdentifier,$email, $hash, $password){
			if(!$this->stmt->bind_param($typeIdentifier,$email, $hash, $password)) {
				echo "Binding parameters failed: (" . $stmt->errno . ") " . $stmt->error;
			}
			return $this;
		}
		function bindParamsInsertNewMessage($typeIdentifier,$sender, $recipient, $subject, $content, $state,$threadid){
			if(!$this->stmt->bind_param($typeIdentifier,$sender, $recipient, $subject, $content, $state,$threadid)) {
				echo "Binding parameters failed: (" . $stmt->errno . ") " . $stmt->error;
			}
			return $this;
		}
		function bindParamsNewMessages($typeIdentifier,$user, $state){
			if(!$this->stmt->bind_param($typeIdentifier,$user,$state)) {
				echo "Binding parameters failed: (" . $stmt->errno . ") " . $stmt->error;
			}
			return $this;
		}
		function bindParamsFavourRequests($typeIdentifier,$pid){
			if(!$this->stmt->bind_param($typeIdentifier,$pid)) {
				echo "Binding parameters failed: (" . $stmt->errno . ") " . $stmt->error;
			}
			return $this;
		}
		function bindParamsTransactionRequest($typeIdentifier,$pid,$favour_uid,$reciever_uid){
			if(!$this->stmt->bind_param($typeIdentifier,$pid,$favour_uid,$reciever_uid)) {
				echo "Binding parameters failed: (" . $stmt->errno . ") " . $stmt->error;
			}
			return $this;
		}
		function bindParamsNewHistoryInsert($typeIdentifier,$pid,$favour_uid,$reciever_uid,$cost){
			if(!$this->stmt->bind_param($typeIdentifier,$pid,$favour_uid,$reciever_uid,$cost)) {
				echo "Binding parameters failed: (" . $stmt->errno . ") " . $stmt->error;
			}
			return $this;
		}
		function bindParamsStatefulFavours($typeIdentifier,$uid,$state){
			if(!$this->stmt->bind_param($typeIdentifier,$uid,$state)) {
				echo "Binding parameters failed: (" . $stmt->errno . ") " . $stmt->error;
			}
			return $this;
		}
		function bindParamsPostTitle($typeIdentifier,$pid){
			if(!$this->stmt->bind_param($typeIdentifier,$pid)) {
				echo "Binding parameters failed: (" . $stmt->errno . ") " . $stmt->error;
			}
			return $this;
		}
		function bindParamsTransactionHistory($typeIdentifier,$uid){
			if(!$this->stmt->bind_param($typeIdentifier,$uid,$uid)) {
				echo "Binding parameters failed: (" . $stmt->errno . ") " . $stmt->error;
			}
			return $this;
		}
		function bindParamsEmail($typeIdentifier,$email){
			if(!$this->stmt->bind_param($typeIdentifier,$email)) {
				echo "Binding parameters failed: (" . $stmt->errno . ") " . $stmt->error;
			}
			return $this;
		}
		function bindParamsSearchQuery($typeIdentifier,$entry){
			if(!$this->stmt->bind_param($typeIdentifier,$entry,$entry)) {
				echo "Binding parameters failed: (" . $stmt->errno . ") " . $stmt->error;
			}
			return $this;
		}
		function bindParamsCheckUser($typeIdentifier,$email){
			if(!$this->stmt->bind_param($typeIdentifier,$email)) {
				echo "Binding parameters failed: (" . $stmt->errno . ") " . $stmt->error;
			}
			return $this;
		}
		function bindParamsUpdateUsername($typeIdentifier,$username,$email){
			if(!$this->stmt->bind_param($typeIdentifier,$username,$email)) {
				echo "Binding parameters failed: (" . $stmt->errno . ") " . $stmt->error;
			}
			return $this;
		}
		function bindParamsNewUser($typeIdentifier, $name,$new_password,$img_id){
			
			if (!$this->stmt->bind_param($typeIdentifier, $name,$new_password,$img_id)) {
				echo "Binding parameters failed: (" . $this->stmt->errno . ") " . $this->stmt->error;
			}
			return $this;
		}
		function bindParamsSubmitPost($typeIdentifier,$client_id,$title,$description,$expiry,$cost,$state){
			if (!$this->stmt->bind_param($typeIdentifier,$client_id,$title,$description,$expiry,$cost,$state))	 {
				echo "Binding parameters failed: (" . $stmt->errno . ") " . $stmt->error;
			}
			return $this;
		}
		function bindParamsGetPassword($typeIdentifier,$email){
			if(!$this->stmt->bind_param($typeIdentifier,$email)) {
				echo "Binding parameters failed: (" . $stmt->errno . ") " . $stmt->error;
			}
			return $this;
		}
}
	
?>