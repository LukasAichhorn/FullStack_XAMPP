<?php
class UserManager{
private $status;
private $userID;


function __contruct($_initStatus){
    
    $this->status = $_initStatus;


}



function checkStatus(){
    if(isset($_SESSION["Status"])){
        return 1;
    }
    return 0;
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