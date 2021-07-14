<?php
spl_autoload_register(function($class_name){
	if(file_exists($class_name.".php")){
		include $class_name.".php";
	}else{
		echo "<h1>".$class_name." not found </h1>";
	}
});

/**
 * URL maintanance
 */

class MainController
{	
	private $URL;
	private $controller = "Process";
	private $method;
	private $paramiter;
	private $object;



	public function __construct(){	
		$this->processUrl();
		$this->getMethod();
	}


/*
*URL Parser and Processor
*/

	private function processUrl(){
		if(isset($_GET['url']) && !empty($_GET['url'])){
			$url = $_GET['url'];
			$url = trim($url,'/');
			$this->URL = explode('/', $url);
		}else{
			unset($this->URL);
		}
	}





	private function getMethod(){
		if(isset($this->URL) && count($this->URL)>0){
			$this->object = new $this->controller();
			if(method_exists($this->object, $this->URL[0])){		
				$this->method = $this->URL[0];
				if(isset($this->URL[1])){
					$this->paramiter = $this->URL[1];
					$this->object->{$this->method}($this->paramiter);
				}else{
					$this->object->{$this->method}();
					unset($this->paramiter);
				}
			}else{
				echo "Method Not found";
			}
		}else{
			$this->object = new $this->controller();
			$this->object->login();
		}		
	}	

}



new MainController();
