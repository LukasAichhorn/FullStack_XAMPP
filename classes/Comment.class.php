<?php 
class Comment{
public $Inhalt;
public $PostID;
public $Author;
public $CreatedAt;

    function __construct($_Inhalt,$_Author,$_PostID,$_CreatedAt){
        $this->Inhalt = $_Inhalt;
        $this->PostID = $_PostID;
        $this->Author = $_Author;
        $this->CreatedAt = $_CreatedAt;
    }


    
}



?>