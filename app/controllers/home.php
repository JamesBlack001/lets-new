<?php

class Home extends Controller{

	public function index($user = ''){//default method we call
		$main = $this->model('Main');//references the parent method model($model_name), defines the user model
		$main->user=$user;

		//using the new object $user, we can apply the methods of the model User class, here we assign a name to user

		$viewString = $main->returnView(['action'=>'initialHome']);

		$this->view('home/index',['name'=> $main->user, 'pageContent'=> $viewString]); 

		//uses the parent method of view($viewLocation, $data[])
		//so it passes in 'home/index' and an array of data, which has one entry, name
		//=user->name
	}

	public function viewConversations($user = ''){
		$messages = $this->model('Message');

		$messages->userID = $user;

		$viewString = $messages->returnView(['action'=>'viewConversations']);

		$this->view('home/index',['pageContent'=> $viewString]); 
	}
	public function createNewMessage($recipientid = ''){
		$messageDetails = $this->model('Message');

		$messageDetails->recipientid = $recipientid;
		
		$viewString = $messageDetails->returnView(['action'=>'createNewMessage']);

		$this->view('home/index',['pageContent'=> $viewString]); 
	}
	public function viewMessageDetails($m_id = ''){
		$messageDetails = $this->model('Message');

		$messageDetails->message_id = $m_id;

		$viewString = $messageDetails->returnView(['action'=>'viewMessageDetails']);

		$this->view('home/index',['pageContent'=> $viewString]); 
	}
	public function viewMessages($threadID = ''){

		$messages = $this->model('Message');

		$messages->threadID = $threadID;

		$viewString = $messages->returnView(['action'=>'viewMessages','inboxType'=> 'all']);

		$this->view('home/index',['pageContent'=> $viewString]); 

	}
	public function viewNewMessages($threadID = ''){

		$messages = $this->model('Message');

		$messages->threadID = $threadID;

		$viewString = $messages->returnView(['action'=>'viewMessages','inboxType'=> 'new']);

		$this->view('home/index',['pageContent'=> $viewString]); 

	}
	public function transactionSummary($pid = ''){
		$post = $this -> model('Post');
		$post->pid = $pid;

		//make insert into the transaction_request table, treat as a queue

		$post->getPostDetails();

		$post->getUserCreditDetails();

		$post->insertTransactionRequest();

		$viewString = $post->returnView(['action'=>'transactionSummary']);

		$this->view('home/index',['pid'=> $post->pid, 'pageContent'=> $viewString]);
	}
	public function retiredFavours($user=''){
		$search = $this->model('Search');
		$search->uid=$user;

		$viewString = $search->returnView(['action'=>'searchRetired']);
		$this->view('home/index',['pageContent'=> $viewString]);
	}
	public function unredeemedFavours($user=''){
		$search = $this->model('Search');
		$search->uid=$user;

		$viewString = $search->returnView(['action'=>'searchUnredeemed']);
		$this->view('home/index',['pageContent'=> $viewString]);
	}
	public function activeFavours($user= ''){
		$search = $this->model('Search');
		$search->uid=$user;

		$viewString = $search->returnView(['action'=>'searchActive']);
		$this->view('home/index',['pageContent'=> $viewString]);
	}
	public function transactionHistory($user = ''){
		$search = $this->model('Search');
		$search->uid=$user;

		$viewString = $search->returnView(['action'=>'searchHistory']);
		$this->view('home/index',['pageContent'=> $viewString]);
	}
	public function viewPostDetails($pid = ''){
		$post = $this -> model('Post');
		$post->pid = $pid;

		$post->getPostDetails();

		$viewString = $post->returnView(['action'=>'postDetails']);

		$this->view('home/index',['pid'=> $post->pid, 'pageContent'=> $viewString]);
	}

	public function viewOpenFavours($uid = ''){
		$search = $this->model('Search');

		$viewString = $search->returnView(['action'=>'searchOpenFavours']);
		
		$this->view('home/index',['pageContent'=> $viewString]);
	}
	public function viewUserDetails($uid = ''){
		$user = $this -> model('User');
		$user->uid=$uid;

		$user->getUserDetails();

		$viewString = $user->returnView(['action'=>'userDetails']);

		$this->view('home/index',['uid'=> $user->uid, 'pageContent'=> $viewString]);
	}
	public function search(){
		$search = $this->model('Search');

		$viewString = $search->returnView(['action'=>'search']);
		$this->view('home/index',['pageContent'=> $viewString]);
	}
	public function makeFavour(){
		$favour = $this->model('Favour');

		$viewString = $favour ->returnView(['action'=>'makeFavour']);
		$this->view('home/index',['pageContent'=> $viewString]);
	}
	public function editProfile(){
		$main = $this->model('Main');

		$viewString = $main->returnView(['action'=>'editProfileForm']);
		$this->view('home/index',['formType'=>$main->formType, 'pageContent'=> $viewString]);//use the default view

	}
	public function createUserForm($formType = ''){
		$main = $this->model('Main');
		$main->formType=$formType;

		$viewString = $main->returnView(['action'=>'createUserForm']);
		$this->view('home/index',['formType'=>$main->formType, 'pageContent'=> $viewString]);//use the default view
		
	}
	public function loadForm($address = ''){
		$main = $this->model('Main');
		$main->address=$address;

		$viewString = $main->returnView(['action'=>'returnForm']);//,'address'=>$address]);
		$this->view('home/index',['formType'=>$main->formType, 'pageContent'=> $viewString]);//use the default view
		
		//run session test here
		//$main->returnView(['action'=>'returnForm']);//load code which is to be inserted into the default view
	}
}

?>