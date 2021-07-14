<?php



/**
 * Form validation class
 */
class Validation {


    public $currentValue;
    public $values = array();
    public $errors = array();



    public function field($key){
        $this->values[$key] = $_POST[$key];
        $this->currentValue = $key;
        return $this;
    }






    public function isEmpty(){
        if(empty($this->values[$this->currentValue])){
            $this->errors[$this->currentValue] = $this->currentValue." is required !!";
        }
        return $this;
    }







    public function length($min,$max){
        if(!empty($this->values[$this->currentValue])){
            $length = strlen($this->values[$this->currentValue]);
            if($length < $min || $length > $max){
                $this->errors[$this->currentValue] = "minimum length $min and maximum length $max required";
            }
        }
        return $this;
    }

    




    public function isEmail(){
        if(!empty($this->values[$this->currentValue])){
             $valid = filter_var($this->values[$this->currentValue], FILTER_VALIDATE_EMAIL);
            if(!$valid){
                $this->errors[$this->currentValue] = "Invalid Email Address !!";
            }
        }
        
         return $this;
    }



    public function isPassword(){
        
    }



    public function submit(){
        if(empty($this->errors)){
            return true;
        }else{
            return false;
        }
    }




    public function emailValidate_By_API_KEY(){
        // my API KEY: cf1c91faa660429187be994b5ecc2c82

        // Calling Abstract API endpoint using CURL library (http://us3.php.net/curl)
        $ch = curl_init('https://emailvalidation.abstractapi.com/v1/?api_key=cf1c91faa660429187be994b5ecc2c82&email=4534534532@gmail.com');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        $data = curl_exec($ch);
        curl_close($ch);
        echo "<pre>";
        print_r(json_decode($data,true));
    }




    
}