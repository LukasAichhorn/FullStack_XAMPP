<?php
// all includes and requires
include "../Dir-Config.php";
require "../classes/DBManager.class.php";
require "../classes/Post.class.php";
require "../classes/User.class.php";
require "../classes/UserManager.class.php";
require "../classes/validator.class.php";
require "../classes/PostManager.class.php";
require "../classes/NotificationHandler.class.php";
require "../classes/imagePocessor.class.php";

?>



<?php
//instantiate UserManager
$DB = new DBManager();
$DB->connectDB();

$UserManager = new UserManager();
$UserManager->startSession();
$nM=new NotificationHandler();
$nM->initAlerts();

$UserManager->handleLogin($DB);
$UserManager->checkStatus();
$CurrentUser = $UserManager->getUser();
$CurrentUserPosts = $DB->getPostsUser($CurrentUser->UserID);
$PostManager= new PostManager();
$UserManager->handleUpdateProfile($DB,$CurrentUser);

?>


<!doctype html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
  <link rel="preconnect" href="https://fonts.gstatic.com">
  <link href="https://fonts.googleapis.com/css2?family=Bree+Serif&family=Open+Sans&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="../style.css">
  <title>GoellHorn</title>
</head>

<body>

  <!-- +++++++++++++++++++++++++++++++  Navigation +++++++++++++++++++++++++++++++++++ -->
  <?php include "../components/navigationBar.comp.php" ?>

  <div class="alertContainer">
    <?php $nM->display(); ?>
</div>

  <div class="container-fluid">
    <div class="row User-BG"></div>
    <div class="row">
      <div class="col">

      </div>

      <div class="col-6 p-4 minusTop">     
            <h5>My Profile:</h5>
      
      
      <?php
      if(!isset($_GET["edit"])){
       include "../components/singleUser.comp.php";
      }
      else if(isset($_GET["pwedit"])){

      }
      else{
      include "../components/EditSingleUser.comp.php";}
       ?>    
             
      <h5>My Posts:</h5>
      <?php //var_dump($CurrentUserPosts);?>
      <?php $PostManager->display($DB,$CurrentUserPosts,$CurrentUser);?>
      
        </div>
        
        
      
      
      <div class="col">
     

      </div>
    </div>
  </div>