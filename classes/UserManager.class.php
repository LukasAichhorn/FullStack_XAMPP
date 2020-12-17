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

   


}



}
?>