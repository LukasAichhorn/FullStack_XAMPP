<?php
class UserManager{
private $User;




function startSession(){
    session_start();
}

function checkStatus(){
    if(isset($_SESSION["User"])){
        $User = $_SESSION["User"]; 

        $this->User = $User;

        if($User->IsAdmin == 1){
            return 2;
        }
        else{
            return 1;
        }
    }
    return 0;
   
}
 function getUser(){
   return $this->User;
    
}

function handleLogin($DB){
    if(isset($_POST["Username"])&& isset($_POST["Passwort"])){

        $UserName = $_POST["Username"];
        $PW  =  $_POST["Passwort"];

        if($DB->checkifUserExists($UserName)){
            $UserID = $DB->validateUser($UserName,$PW);
            if($UserID!= 0){

                $CurrentUser = $DB->getUser($UserID);
                $_SESSION["User"]=$CurrentUser;
                header("Refresh:0; url=../index.php");
            }
            else{
                echo("Username or password is wrong <br>");
            }

        }
        else{
            echo("User does not exist, try to create a new account ! <br>");

        };

    }
} 
function handleRegister($DB){

if(isset($_POST["Username"]) && isset($_POST["Passwort"]) && isset($_POST["Anrede"]) && isset($_POST["Vorname"]) && isset($_POST["Nachname"])){


    $Validator = new Validator();
    $Username=$Validator->validate_string($_POST["Username"]);
    $Hpw=$Validator->validate_Password($_POST["Passwort"]);
    $Anrede=$Validator->validate_string($_POST["Anrede"]);
    $Vorname=$Validator->validate_string($_POST["Vorname"]);
    $Nachname=$Validator->validate_string($_POST["Nachname"]);

    $NewUser = new User(0,$Username,$Hpw,$Anrede,$Vorname,$Nachname,0,1,'ressources/pics/DefaultUser.png');

    if(!$DB->checkifUserExists($Username)){
        $DB->insertUser($NewUser);
        header("Refresh:0; url=login.php");
        
    }else{
        echo("User already exist!");
        
    };

}

}
function handleLogout(){
    session_unset();
    header("Refresh:0; url=../index.php");
}

}



?>