<?php

/**
 * Query class
 */
class Query {

	private $file_dir;
	private $dataArr = array();

	public function __construct(){
		$this->file_dir = "databases/users.txt";
		if(!file_exists("databases")) mkdir("databases");
		if(!file_exists("databases/users.txt")) touch($this->file_dir);
		if(!is_null($this->getContent())){
			$this->dataArr = $this->getContent();
		}
		
	}

	protected function getContent(){
		$json =  file_get_contents($this->file_dir);
		return json_decode($json,true);
	}


	protected function insertUser($content){
		$this->dataArr[$this->generateId()] = $content;		
		$content = json_encode($this->dataArr);
		file_put_contents($this->file_dir, $content);
	}


	protected function update($email,$password){
		foreach ($this->dataArr as $key => $value) {
			if($value["email"]==$email){
				$this->dataArr[$key]["password"] = $password;
				$content = json_encode($this->dataArr);
				file_put_contents($this->file_dir, $content);
				break;
			}
		}
	}


	protected function hasEmail($email){
		$i = false;
		foreach ($this->dataArr as $key => $value) {
			if($value["email"]==$email){
				$i = true;
				break;
			}
		}
		return $i;
	}




	protected function getPassword($email){
		foreach ($this->dataArr as $key => $value) {
			if($value["email"]==$email){
				return $value["password"];
				break;
			}
		}
	}



	protected function getUserName($email){
		foreach ($this->dataArr as $key => $value) {
			if($value["email"]==$email){
				return $value["name"];
				break;
			}
		}
	}





	private function generateId(){
		$id=0;
		foreach (array_keys($this->dataArr) as $value) {
			if($value>$id){
				$id=$value;
			}
		}
		return $id+1;
	}

}