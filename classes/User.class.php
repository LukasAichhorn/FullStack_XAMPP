<?php 
class User {
private $UserID;
private $UserPW;
private $UserName;
Private $Anrede;
private $Vorname;
private $Nachname;

private $IsAdmin;
private $status;
private $IMG;

function __construct($_UserID,$_UserName,$_UPW,$_Anrede,$_Vorname,$_Nachname,$_IsAdmin,$_status){
$this->UserID = $_UserID;
$this->UserName=$_UserName;
$this->UserPW=$_UPW;
$this->Anrede=$_Anrede;
$this->Vorname=$_Vorname;
$this->Nachname=$_Nachname;

$this->IsAdmin = $_IsAdmin;
$this->status = $_status;

}

}

?>