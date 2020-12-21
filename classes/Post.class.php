<?php

class Post {
public $PostID;
public $Bildadresse;
public $Bildname;
public $Titel;
public $Inhalt;
public $Sichtbarkeit;
public $UserID;
public $SelectedTags = array();


function __construct($_PostID,$_Bildadresse,$_Bildname,$_Titel,$_Inhalt,$_Sichtbarkeit,$_FKUserID,$_SelectedTags){
$this->PostID = $_PostID;
$this->Bildadresse=$_Bildadresse;
$this->Bildname=$_Bildname;
$this->Titel=$_Titel;
$this->Inhalt=$_Inhalt;
$this->Sichtbarkeit=$_Sichtbarkeit;
$this->UserID = $_FKUserID;
$this->SelectedTags = $_SelectedTags;

}

}

?>





