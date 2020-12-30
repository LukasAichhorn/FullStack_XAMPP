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
function updateUser($UserOBJ){
    $_SESSION["User"]=$UserOBJ;
    $this->User = $UserOBJ;
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
    $nM = new NotificationHandler();
    $nM->initAlerts();

if(isset($_POST["Username"]) && isset($_POST["Passwort"]) && isset($_POST["Anrede"]) && isset($_POST["Vorname"]) && isset($_POST["Nachname"]) && isset($_POST["Email"])){

echo($_POST["Email"]);
    $Validator = new Validator();
    $Username=$Validator->validate_string($_POST["Username"]);
    $Hpw=$Validator->validate_Password($_POST["Passwort"]);
    $Anrede=$Validator->validate_string($_POST["Anrede"]);
    $Vorname=$Validator->validate_string($_POST["Vorname"]);
    $Nachname=$Validator->validate_string($_POST["Nachname"]);
    $Email = $Validator->validate_Email($_POST["Email"]);
       

    if(!$DB->checkifUserExists($Username)){

        $UserRoot = DIR_ROOT. "/WEB_SS2020/WP/UsersRoot/" . $Username;
        $error=mkdir($UserRoot);
        $nM->pushNotification($error,"danger");
        
        $UserRoot = DIR_BASE . "UsersRoot/" . $Username;
        $DefaultUserImg= DIR_BASE .'ressources/pics/DefaultUser.png';
        $NewUser = new User(0,$Username,$Hpw,$Anrede,$Vorname,$Nachname,0,1,$DefaultUserImg,$UserRoot,$Email);
        $DB->insertUser($NewUser);
               
        

        header("Refresh:0; url=login.php");
        
    }else{
        
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
    
        $nM = new NotificationHandler();
        $nM->initAlerts();
           
    if( isset($_POST["Username"])&&
        isset($_POST["Anrede"])&&
        isset($_POST["Vorname"])&&
        isset($_POST["Nachname"])&&
        isset($_POST["Email"]))
        {
            //validate all inputs
            $Validator = new Validator();
            $Username=$Validator->validate_string($_POST["Username"]);
            //$Hpw=$Validator->validate_Password($_POST["Passwort"]);
            $Anrede=$Validator->validate_string($_POST["Anrede"]);
            $Vorname=$Validator->validate_string($_POST["Vorname"]);
            $Nachname=$Validator->validate_string($_POST["Nachname"]);
            $Email = $Validator->validate_Email($_POST["Email"]);
        //rename User folder in any case:
            $UserRoot = DIR_ROOT. "/WEB_SS2020/WP/UsersRoot/" . $CurrentUser->UserName;
            $newRootFolder = DIR_ROOT. "/WEB_SS2020/WP/UsersRoot/" . $Username;
            if(!rename($UserRoot,$newRootFolder)){
                $nM->pushNotification("renamed error for User! ","danger");
                return;
            }
            //reset User root to server homeroot
            $UserRoot = DIR_BASE . "UsersRoot/" . $Username;
            //update new root folder for temp User object;
            $CurrentUser->RootFolder = $UserRoot;        
            
            
             //upload user pic to User root if not empty 
             
                $POSTManager = new PostManager();
                $IMG=$POSTManager->handleImgUpload($CurrentUser);
                if(is_array($IMG)){
                    $_img = $IMG[0];
                    $nM->pushNotification("uploaded file to $_img ","success");
                }else{
                    $_img = $CurrentUser->IMG;
                    $nM->pushNotification("no file selected, value: $_img ","primary");
                }              
                           
               
                
                //create User object with all updates values
             $UpdatedUser = new User($CurrentUser->UserID,$Username,$CurrentUser->UserPW,$Anrede,$Vorname,$Nachname,$CurrentUser->IsAdmin,$CurrentUser->status,$_img,$UserRoot,$Email);
                //udating user in DB

            $DB->updateUser($UpdatedUser);
            // save new user in Session: 
            $this->updateUser($UpdatedUser);            
            $nM->pushNotification("User has been updated sucessfully","success");
            header("Refresh:0; url= //". DIR_PAGES ."myProfile.php");
            

            }



    }

    function handleStatusChange($DB){
        if(isset($_GET["changeStatus"]) && isset($_GET["UserID"]) ){
            $UserID = $_GET["UserID"];
            $DB->changeStatus($UserID);
            }      

        }

    

}





?>