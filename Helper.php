<?php

/**
 * Helper methods are go here
 */
class Helper extends Query {
	
	function __construct(){
		parent::__construct();
	}

	public function loginHelper($loginInfo){
		if($this->hasEmail($loginInfo["email"])){
			$db_password = $this->getPassword($loginInfo["email"]);
			if(password_verify($loginInfo["password"], $db_password)){
				Session::init();
				Session::set("loginAccess",true);
				header("location:".BASE_URL);
			}else{
				return array("password"=>"Incorrect password");
			}
		}else{
			return array("email"=>"Incorrect email address");
		}
	}

	public function registerHelper(array $registerInfo){
		if($this->hasEmail($registerInfo["email"])==false){
			$password_hash = password_hash($registerInfo["password"], PASSWORD_DEFAULT);
			$registerInfo["password"] = $password_hash;
			$this->insertUser($registerInfo);
			$code = $this->generateCode();
			$this->sendMail($code,$this->getUserName($registerInfo["email"]),$registerInfo["email"]);
			Session::init();
			Session::set("email",$registerInfo["email"]);
			Session::set("code",password_hash($code, PASSWORD_DEFAULT));
			header("location:".BASE_URL."verification");
		}else{
			return "Already has an Account . With this email . try another";
		}

	}


	public function verificationHelper($code){
	
		if(Session::get("code")){
			if(password_verify($code, Session::get("code"))){
				if(password_verify("resetpassword", Session::get("verify_status"))){
					Session::set("resetCode",true);
					header("location:".BASE_URL."resetpassword");
				}else{
					header("location:".BASE_URL."login");
				}
			}else{
				return array("code"=>"Icorrect Verification Code");
			}
		}else{
			return array("code"=>"Session expired Please resend Verification code");
		}
	}




	public function emailHelper($email){
		if($this->hasEmail($email)){
			$code = $this->generateCode();
			$this->sendMail($code,$this->getUserName($email),$email,);
			Session::init();
			Session::set("verify_status",password_hash("resetpassword", PASSWORD_DEFAULT));
			Session::set("email",$email);
			Session::set("code",password_hash($code, PASSWORD_DEFAULT));	
			if(!isset($_POST['resend'])){
				header("location:".BASE_URL."verification");
			}
		}else{
			return array("email"=>"Email address doesn't match");
		}
	}




	public function saveNewpassword($password){
		Session::init();
		$email = Session::get("email");
		$hashed_password = password_hash($password, PASSWORD_DEFAULT);
		$this->update($email,$hashed_password);
		header("location:".BASE_URL."login");
	}




	public function generateCode(){
		$characters = '012KLMNOPQRS789abcdHIJTefghijklmnop3456qrstuvwxyzABCDEFGUVWXYZ';
		$randomString = '';
		$len = strlen($characters);
		for($i=0; $i<6; $i++){
			$randomString .= $characters[rand(0,$len-1)];
		}
		return $randomString;
	}



	public function sendMail($code,$user_name,$email){

		

	}








}