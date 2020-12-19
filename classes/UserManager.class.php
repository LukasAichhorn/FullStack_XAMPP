<?php
class UserManager{
private $status;
private $userID;


function __contruct($_initStatus){
    
    $this->status = $_initStatus;


}
function startSession(){
    session_start();
}

function checkStatus(){
    if(!isset($_SESSION["Status"])){
        return 0;
    }
    $this->status = $_SESSION["status"];
    return $this->status;
}
function setStatus($value){
    $_SESSION["status"]= $value;
    $this->status = $value;
 }
 function setUser($User){
     $_SESSION["User"]=$User;
     $this->user = $User;
 }
 function getUser(){
   return $this->user;
    
}

function handleLogin($DB,$NameField,$PwField){
    if(isset($_POST[$NameField])&& isset($_POST[$PwField])){

        $UserName = $_POST[$NameField];
        $PW  =  hash("sha256",$_POST[$PwField]);

        if($DB->checkifUserExists($UserName)){

            $User = $DB->validateUser($UserName,$PW);
            $DB->insertUser($User);

            if($User != NULL){                
                $this->setUser($User);
            }
          
        }

    }
function handleRegister($DB,$Username,$Passwort,$Anrede,$Vorname,$Nachname){

if(isset($_POST["Username"]) && isset($_POST["Passwort"]) && isset($_POST["Anrede"]) && isset($_POST["Vorname"]) && isset($_POST["Nachname"])){

    $Validator = new Validator();
    $Username=$Validator->validate_string($Username);
    $Hpw=$Validator->validate_Password($Passwort);
    $Anrede=$Validator->validate_string($Anrede);
    $Vorname=$Validator->validate_string($Vorname);
    $Nachname=$Validator->validate_string($Nachname);

    $NewUser = new User(0,$Username,$Hpw,$Anrede,$Vorname,$Nachname,0,1);

    if(!$DB->checkifUserExists($Username)){
        $DB->insertUser($NewUser);
        
    }else{
        
    }
    

}
    //validieren imput => 

    // user exist
    // insert
    //redirect to login.php



}

   


}



}
?>