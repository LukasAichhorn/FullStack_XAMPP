<?php 
class User {
public $UserID;
public $UserPW;
public $UserName;
public $Anrede;
public $Vorname;
public $Nachname;

public $IsAdmin;
public $status;
public $IMG;
public $RootFolder;

function __construct($_UserID,$_UserName,$_UPW,$_Anrede,$_Vorname,$_Nachname,$_IsAdmin,$_status,$_img,$_RootFolder){
$this->UserID = $_UserID;
$this->UserName=$_UserName;
$this->UserPW=$_UPW;
$this->Anrede=$_Anrede;
$this->Vorname=$_Vorname;
$this->Nachname=$_Nachname;

$this->IsAdmin = $_IsAdmin;
$this->status = $_status;
$this->IMG = $_img;
$this->RootFolder = $_RootFolder;

}

}

?>