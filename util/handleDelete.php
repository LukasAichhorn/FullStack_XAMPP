<?php 
require "../classes/DBManager.class.php";
$DB= new DBManager();
$DB->ConnectDB();

$PostID = $_GET["PostId"];
if($DB->deletePost($PostID)){
    echo("deleted");
}
else{
    echo("error");
}
