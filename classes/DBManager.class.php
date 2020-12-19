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

//checking if pw of username matches the passwort stored in the database
function validateUser($username, $passwort){
    $DB = $this->DB;
    $pw = $this->HashPW($passwort);
    

}

function insertUser($validData){//input is an object called User
    //validated data in array as input
    $DB = $this->DB;
    if(!( $stmt = $DB->prepare("INSERT INTO goellhorndb.user(Username,Passwort,Anrede,Vorname,Nachname) VALUES (?,?,?,?,?)"))){
        echo "Prepare failed: (" . $DB->errno . ") " . $DB->error; 
    }
    
    if (!$stmt->bind_param("sssss", $validData['Username'],$validData['Passwort'],$validData['Anrede'],$validData['Vorname'],$validData['Nachname'])) {
    echo "Binding Username failed: (" . $stmt->errno . ") " . $stmt->error;
    }
    

    if (!$stmt->execute()) {
    echo "Execute failed: (" . $stmt->errno . ") " . $stmt->error;
    }

   



}

function selectUserPW(){}



//checking if Username exists in our database returning corresponding bool, input:username as string
function checkifUserExists($input){
$DB = $this->DB;
$arr = array();

$qury = "SELECT Username FROM goellhorndb.user WHERE Username = '" . $input . "';";

$result = $DB->query($qury);
$arr = $result->fetch_row();

if(!empty($arr)){
    echo "Succses!";
    var_dump($arr);
    return True;
}
else{
    echo "Fail!";
    return False;
}
 
}




//function QueryForUser(){}

function HashPW($PW){
$PW = hash("sha256",$PW);
return $PW;
}

}
