<?php
class UserManager{
private $status;
private $userID;


function __contruct($_initStatus){
    
    $this->status = $_initStatus;


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
 function setUserID($ID){
     $_SESSION["userID"]=$ID;
     $this->userID = $ID;
 }

function handleLogin($DB){


}


}
?>