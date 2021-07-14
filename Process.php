<?php

/**
 * login controller
 */

class Process extends Helper{

	private $validation;

	public function __construct(){
		parent::__construct();	
		$this->validation = new Validation();
	}




	private function view($file,$data = null){
		if(!is_null($data))extract($data);
		include "views.php";
		$html_data = compact("login","registration","email","resetPassword","verification"
		);
		include "header.php";
		echo $html_data[$file];
		include "footer.php";
	}





	public function login(){
        Session::init();
		Session::destroy();
		if(isset($_POST['login'])){
			$this->validation->field("email")->isEmpty()->isEmail();
			$this->validation->field("password")->isEmpty()->length(6,30);
			if($this->validation->submit()){
				$data['errors'] = $this->loginHelper($this->validation->values);
			}else{
				$data['errors'] = $this->validation->errors;
			}
			$data['values'] = $this->validation->values;
			$this->view("login",$data);
		}else{
			$this->view("login");
		}
	}

	


	public function registration($param=null){
		
		if(isset($_POST['register'])){
			$this->validation->field("name")->isEmpty()->length(3,40);
			$this->validation->field("email")->isEmpty()->isEmail();
			$this->validation->field("password")->isEmpty()->length(6,30);

			if($this->validation->submit()){
				$data["alert"] = $this->registerHelper($this->validation->values);				
			}else{
				$data['errors'] = $this->validation->errors;
			}
			$data['values'] = $this->validation->values;
			$this->view("registration",$data);
	
		}else{
			$this->view("registration");
		}

	}




 
	


	public function verification(){

		if(!Session::get("code")){
			if(isset($_SERVER['HTTP_REFERER'])){
				header("location:".$_SERVER['HTTP_REFERER']);
			}else{
				header("location:".BASE_URL);
			}
		}

		if(isset($_POST['verify'])){
			if(!empty($_POST['code'])){
				$data["errors"] = $this->verificationHelper($_POST['code']);
			}else{$data['errors'] = array("code"=>"Verification Code is Required");}
            $data["values"] = array("code"=>$_POST['code']);
			$this->view("verification",$data);
		}
		elseif (isset($_POST['resend'])) {
			$this->emailHelper(Session::get("email"));
			$data["message"] = "Again check your email you've got another verification code";
			$this->view("verification",$data);
		}else{
			$this->view("verification");
		}
	}








	public function email(){
		
		if(isset($_POST['sendMail'])){
			$this->validation->field("email")->isEmpty()->isEmail();
			if($this->validation->submit()){
				$data['errors'] = $this->emailHelper($this->validation->values["email"]);
			}
			$data['values'] = $this->validation->values;
			$this->view("email",$data);
		}else{
			$this->view("email");
		}
	}





	public function resetpassword(){

		if(!Session::get("resetCode")){
			if(isset($_SERVER['HTTP_REFERER'])){
				header("location:".$_SERVER['HTTP_REFERER']);
			}else{
				header("location:".BASE_URL."email");
			}
		}

		if(isset($_POST['savePassword'])){
			$this->validation->field("password")->isEmpty()->length(6,30);
			$this->validation->field("confirm_password")->isEmpty()->length(6,30);
			if($this->validation->values["password"] !== $this->validation->values["confirm_password"] && $this->validation->submit()==true){
				$this->validation->errors["confirm_password"] = "Doesn't match your password";
			}
            $data["errors"] = $this->validation->errors;

			if($this->validation->submit()){
				$data["alert"] = $this->saveNewpassword($this->validation->values["password"]);				
			}
            $data['values'] = $this->validation->values;
            $this->view("resetPassword",$data);
		}else{
			$this->view("resetPassword");
		}


	}











}
