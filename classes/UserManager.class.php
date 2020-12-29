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
    $nM = new NotificationHandler();
    $nM->initAlerts();

    if(isset($_POST["Username"])&& isset($_POST["Passwort"])){

        $UserName = $_POST["Username"];
        $PW  =  $_POST["Passwort"];

        if($DB->checkifUserExists($UserName)){
            $UserID = $DB->validateUser($UserName,$PW);
            if($UserID!= 0){

                $CurrentUser = $DB->getUser($UserID);
                $_SESSION["User"]=$CurrentUser;

                $nM->pushNotification("sucessfully logged in!","success");
                header("Refresh:0; url=../index.php");
            }
            else{
            
            $nM->pushNotification("Username or password is wrong","danger");
                
            }

        }
        else{
            
            $nM->pushNotification("User does not exist, try to create a new account !","danger");

        };

    }
} 
function handleRegister($DB){

if(isset($_POST["Username"]) && isset($_POST["Passwort"]) && isset($_POST["Anrede"]) && isset($_POST["Vorname"]) && isset($_POST["Nachname"]) && isset($_POST["Email"])){

echo($_POST["Email"]);
    $Validator = new Validator();
    $Username=$Validator->validate_string($_POST["Username"]);
    $Hpw=$Validator->validate_Password($_POST["Passwort"]);
    $Anrede=$Validator->validate_string($_POST["Anrede"]);
    $Vorname=$Validator->validate_string($_POST["Vorname"]);
    $Nachname=$Validator->validate_string($_POST["Nachname"]);
    $Email = $Validator->validate_Email($_POST["Email"]);
    echo($Email);    

    if(!$DB->checkifUserExists($Username)){

        $UserRoot = DIR_ROOT. "/WEB_SS2020/WP/UsersRoot/" . $Username;
        $error=mkdir($UserRoot);
        echo $error;
        $UserRoot = DIR_BASE . "UsersRoot/" . $Username;
        $DefaultUserImg= DIR_BASE .'ressources/pics/DefaultUser.png';
        $NewUser = new User(0,$Username,$Hpw,$Anrede,$Vorname,$Nachname,0,1,$DefaultUserImg,$UserRoot,$Email);
        $DB->insertUser($NewUser);       
        

        //header("Refresh:0; url=login.php");
        
    }else{
        $nM = new NotificationHandler();
            $nM->initAlerts();
            $nM->pushNotification("User already exists","danger");
        
        
    };

}

}
function handleLogout(){
    session_unset();
    $nM = new NotificationHandler();
            $nM->initAlerts();
            $nM->pushNotification("User was logged out","primary");
    header("Refresh:0; url=../index.php");
}

function handleUpdateProfile($DB,$CurrentUser){
           
    if( isset($_POST["Username"])&&
        isset($_POST["Anrede"])&&
        isset($_POST["Vorname"])&&
        isset($_POST["Nachname"])){
            
             //upload user pic to  
             if(isset($_POST["fileUpload"])){
                $POSTManager = new PostManager();
                $POSTManager->handleImgUpload($CurrentUser);
             }      
            //create new user object
            $DB->updateUser();

            $nM = new NotificationHandler();
            $nM->initAlerts();
            $nM->pushNotification("User has been updated sucessfully","success");

            // if img is empty set img path to default manually
            //$UpdatedUser = new User();
            // use db function to insert user

            }



    }

}





?>