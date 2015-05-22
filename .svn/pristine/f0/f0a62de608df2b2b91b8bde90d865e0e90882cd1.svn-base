<?php

	/*
	Implementation Note: framework for mvc adapted tutorial at 
	http://www.phpacademy.org, Alex Garret
	*/

/*
	Used along side the controllers to hep in the construction of new pages, without needing to create a new
	file for each page
*/
	class App{
		
		//will build a construct function that will allow us to do things with the controller

		protected $controller = 'home';//default controller when we runour bootstrapped application

		protected $method = 'index';//default method when we runour bootstrapped application

		protected $params = [];//paramters that we will want to be able to pass through
		
		public function __construct(){
			$url=$this->parseUrl();

			if(file_exists('../app/controllers/'. $url[0] .'.php')){//tests to see if there is such a file that has been written into the url
				$this->controller =$url[0];//reassigns the value for controller to the of $url[0]
				unset($url[0]);//unsets the value defined for $url[0]
			}

			//require_once "../includes/loadContent.php" ;

			require_once '../app/controllers/'.$this->controller.'.php';

			$this->controller= new $this->controller;

			if(isset($url[1])){//checks to see if there is a value for $url[1]
				if(method_exists($this->controller, $url[1])){ //checks to see if the value for $url1 is a defined method for the object $this->controller
					$this->method = $url[1];//assigns the value of $method to that of $url[1]
					unset($url[1]);
				}
			}

			$this->params = $url ? array_values($url) : [];//does two things, first checks if it isn't then makes it empty if so,
			//otherwise rebases that array to 0 with values that are defined in the values for params

			call_user_func_array([$this->controller,$this->method], $this->params);
			//callback using ([classname,method], params)
		}

		public function parseUrl(){//allows us to analyse the paramaters that are part of the url
			if(isset($_GET['url'])){
				//sanitize url, determine if a controller/method is being accessed
				//or if variables are being returned.


				//we need rtrim to trim this to protect against errors formed from additional trailing forward slashes
				//we need to sanitize by using filter_var, and option -Filter_sanitize_url ... removes illegal characters from the string
				//we aso explode to seperate each string by a particular variablem in this case "/"
				return $url =explode('/',filter_var(rtrim($_GET['url'], '/'), FILTER_SANITIZE_URL));
			} 
		}
	}
?>