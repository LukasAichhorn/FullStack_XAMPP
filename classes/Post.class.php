<?php

class Post {
public $PostID;
public $Bildadresse;
public $Bildname;
public $Titel;
public $Inhalt;
public $Sichtbarkeit;
public $UserID;
private $commentArray;


function __construct($_PostID,$_Bildadresse,$_Bildname,$_Titel,$_Inhalt,$_Sichtbarkeit,$_FKUserID){
$this->PostID = $_PostID;
$this->Bildadresse=$_Bildadresse;
$this->Bildname=$_Bildname;
$this->Titel=$_Titel;
$this->Inhalt=$_Inhalt;
$this->Sichtbarkeit=$_Sichtbarkeit;
$this->UserID = $_FKUserID;

}

function fetchComments($DB){
    $stmt = "SELECT Username,c.createdAt,c.inhalt FROM comment c inner join post p on c.FK_PostID = p.PostID inner join user u on c.AutorID = u.UserID where p.PostID = $this->PostID";
    $result = mysqli_query($DB, $stmt);
            if (mysqli_num_rows($result) > 0){
                while($row = mysqli_fetch_assoc($result)){
                    $this->commentArray[] = $row;
                }


}
}
function getComments(){
    return $this->commentArray;
}
}


?>





