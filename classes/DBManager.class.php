<?php
class DBManager{
    private $DB_LOCATION = "localhost";
    private $DB_USER="root";
    private $DB_PW= "hl03VAPfORGedk0J";
    private $DB_NAME = "goellhornDB"; 
    private $DB;



function ConnectDB(){

    $this->DB = new mysqli($this->DB_LOCATION,$this->DB_USER,$this->DB_PW,$this->DB_NAME);
    $DB = $this->DB;
    if ($DB->connect_errno) {
        echo "Failed to connect to MySQL: " . $DB->connect_error;
    }
    echo $DB->host_info . " Connection success!\n";

}

function validateUser(){
    //array with POST values as input, validating each, password already hashed by HandleLogin
}

function insertUser($validData){
    //validated data in array as input
    $DB = $this->DB;
    if(!( $stmt = $DB->prepare("INSERT INTO goellhorndb.user(Username,Passwort,Anrede,Vorname,Nachname) VALUES (?,?,?,?,?)"))){
        echo "Prepare failed: (" . $DB->errno . ") " . $DB->error; 
    }
    
    if (!$stmt->bind_param("sssss", $validData['Username'],$validData['Passwort'],$validData['Anrede'],$validData['Vorname'],$validData['Nachname'])) {
    echo "Binding Username failed: (" . $stmt->errno . ") " . $stmt->error;
    }
    /*  
    if (!$stmt->bind_param("Passwort", $validData['Passwort'])) {
        echo "Binding Passwort failed: (" . $stmt->errno . ") " . $stmt->error;
        }
    if (!$stmt->bind_param("Anrede", $validData['Anrede'])) {
        echo "Binding Anrede failed: (" . $stmt->errno . ") " . $stmt->error;
        }
    if (!$stmt->bind_param("Vorname", $validData['Vorname'])) {
        echo "Binding Vorname failed: (" . $stmt->errno . ") " . $stmt->error;
        }
    if (!$stmt->bind_param("Nachname", $validData['Nachname'])) {
        echo "Binding Nachname failed: (" . $stmt->errno . ") " . $stmt->error;
        }
        */

    if (!$stmt->execute()) {
    echo "Execute failed: (" . $stmt->errno . ") " . $stmt->error;
    }

   



}

function selectUserPW(){}




function checkifUserExists(){

}



//function QueryForUser(){}

function HashPW($PW){
$PW = hash("sha256",$PW);
return $PW;
}

}

?>