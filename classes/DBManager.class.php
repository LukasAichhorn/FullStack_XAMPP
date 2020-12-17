<?php
class DBManager{
    private $DB_LOCATION = "localhost";
    private $DB_USER="root";
    private $DB_PW= "hl03VAPfORGedk0J";
    private $DB_NAME = "goellhornDB"; 
    private $DB;

input 

function ConnectDB(){

    $this->DB = new mysqli($this->DB_LOCATION,$this->DB_USER,$this->DB_PW,$this->DB_NAME);
    $DB = $this->DB;
    if ($DB->connect_errno) {
        echo "Failed to connect to MySQL: " . $DB->connect_error;
    }
    echo $DB->host_info . " Connection success!\n";

}

function insertUser(){
    $DB = $this->DB;



}



function checkifUserExists($Query*Users){

}



//function QueryForUser(){}

function HashPW($PW){
$PW = hash("sha256",$PW);
return $PW;
}
}

?>