<?php
// all includes and requires
include "../Dir-Config.php";
require "../classes/DBManager.class.php";
require "../classes/Post.class.php";
require "../classes/User.class.php";
require "../classes/UserManager.class.php";
require "../classes/validator.class.php";
require "../classes/NotificationHandler.class.php";
?>



<?php
//instantiate UserManager
$DB = new DBManager();
$DB->connectDB();

$UserManager = new UserManager();
$UserManager->startSession();
$UserManager->handleLogin($DB);
$nM=new NotificationHandler();
$nM->initAlerts();
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
    <div class="row login-BG size-adjust"></div>
    <div class="row">
      <div class="col">

      </div>

      <div class="col-12 col-sm-6 col-md-6 col-lg-6 col-xl-6 p-4 minusTop">     
            <h1>Login:</h1>
      
      
      <?php include "../components/loginForm.comp.php" ?>    
            
         
        </div>
        

      

      <div class="col">

      </div>
    </div>
  </div>













  <?php require "../components/JS_Imports.comp.php" ?>

</body>

</html>