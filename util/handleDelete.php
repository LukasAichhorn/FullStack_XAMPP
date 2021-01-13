<?php 
require "../classes/DBManager.class.php";
require "../classes/NotificationHandler.class.php";
$DB= new DBManager();
$DB->ConnectDB();
$nM = new NotificationHandler();
$nM->initAlerts();

$PostID = $_GET["PostId"];
if($DB->deletePost($PostID)){
    echo("deleted");
    $nM->pushNotification("Post successfully deleted!","success");
    header("Refresh:0; url= ". $_SERVER['HTTP_REFERER']);
}
else{
    echo("error");
    $nM->pushNotification("something went wrong when deleting this post!","warning");
    header("Refresh:0; url=" . $_SERVER['HTTP_REFERER']);
}
