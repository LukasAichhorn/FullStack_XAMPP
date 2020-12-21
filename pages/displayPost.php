<?php
// all includes and requires
require "../classes/DBManager.class.php";
require "../classes/Post.class.php";
require "../classes/User.class.php";
require "../classes/UserManager.class.php";
require "../classes/validator.class.php";
require "../classes/PostManager.class.php";
?>
<?php
 
//instntiate DB Object
$DB = new DBManager();
$DB->ConnectDB();
//instantiate UserManager
$UserManager = new UserManager();
$UserManager->startSession();
$status = $UserManager->checkStatus();
//get Current user abject from Session
$CurrentUser = $UserManager->getUser();
//Create PostManager and fetch all posts
$PostManager = new PostManager();
$PostID = $_GET["PostID"];
$SinglePost = $DB->getSinglePost($PostID);


?>


!doctype html>
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

  <div class="container-fluid">
    <div class="row displayPost-BG"></div>
    <div class="row">
      <div class="col">

      </div>

      <div class="col-6 p-4 minusTop">     
            <h5><?php $SinglePost["Titel"]?></h5>

            <img class="card-img-top" src=".../100px180/?text=Image cap" alt="Card image cap">
            <p></p>
      
      
         
            
         
        </div>
        

      

      <div class="col">

      </div>
    </div>
  </div>