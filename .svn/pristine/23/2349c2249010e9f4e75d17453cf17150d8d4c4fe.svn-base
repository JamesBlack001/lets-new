<?php

	/*
	Implementation Note: framework for mvc adapted tutorial at 
	http://www.phpacademy.org, Alex Garret
	*/
/*
	The controller core, allows us to access methods like view, model, to load models and rendew the views.
*/

class Controller{
	
	public function model($model){
		require_once '../app/models/'. $model.'.php'; //uses the file for the model that is passed in to the controller
		return new $model();//constructs and returns a new object which is the model of the name that is passed in to the function.
	}

	public function view($view, $data=[]){
		include_once $_SERVER['DOCUMENT_ROOT'].'/mvc/mvc/app/views/'. $view.'.php';
		echo $data['pageContent'];

		
		//include_once $_SERVER['DOCUMENT_ROOT'].'/NewMVC/mvc/includes/viewArchive.php';
					
		//echo "<link rel='stylesheet' type='text/css' href='css/main.css'>";
		//we have created a view that uses the contents in ../app/views/$view.php, 
		//we can also use the data that is in $data, as this has been passed in to the view
	}
}
?>
