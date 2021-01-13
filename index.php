<?php
// all includes and requires
include "Dir-Config.php";
require "classes/DBManager.class.php";
require "classes/Post.class.php";
require "classes/User.class.php";
require "classes/UserManager.class.php";
require "classes/validator.class.php";
require "classes/PostManager.class.php";
require "classes/NotificationHandler.class.php";
?>



<?php

//instntiate DB Object
$DB = new DBManager();
$DB->ConnectDB();



//instantiate UserManager
$UserManager = new UserManager();
$UserManager->startSession();

$Notifications = new NotificationHandler();
$Notifications->initAlerts();

$status = $UserManager->checkStatus();
//get Current user object from Session
$CurrentUser = $UserManager->getUser();
//Create PostManager and fetch all posts
$PostManager = new PostManager();
$filteredPosts = $PostManager->handleSearch($DB, $status);

/*if ($filteredPosts == 0) {
  $filteredPosts = $PostManager->FetchPosts($DB,$status);
}*/
// handle additional filters:



$Tags = $DB->allTags();








?>


<!doctype html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script>

console.log("hello");
$(document).on('click', '[data-toggle="lightbox"]', function(event) {
                event.preventDefault();
                $(this).ekkoLightbox();
            });
</script>
 <!-- lightbox  CSS -->
 



 <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ekko-lightbox/5.3.0/ekko-lightbox.css" integrity="sha512-Velp0ebMKjcd9RiCoaHhLXkR1sFoCCWXNp6w4zj1hfMifYB5441C+sKeBl/T/Ka6NjBiRfBBQRaQq65ekYz3UQ==" crossorigin="anonymous" />
  <!-- Bootstrap CSS -->
 
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
  <link rel="preconnect" href="https://fonts.gstatic.com">
  <link href="https://fonts.googleapis.com/css2?family=Bree+Serif&family=Open+Sans&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="style.css">
  <title>GoellHorn</title>
</head>

<body>

  <!-- +++++++++++++++++++++++++++++++  Navigation +++++++++++++++++++++++++++++++++++ -->
  <?php include "components/navigationBar.comp.php" ?>
  <!-- +++++++++++++++++++++++++++++++  Main 3 colum layout +++++++++++++++++++++++++++++++++++ -->
  <div class="container-fluid">


    <div class="alertContainer">
      <?php
      $Notifications->display();

      ?>
    </div>

  </div>


  <div class="row login-BG" style="background-image: url(./ressources/pics/bermuda-fatal-error-1.png)">
    <div class="col-xl-2 col-lg-2  col-md-1">

    </div>

    <div class="col">
      <div class="mt-5 mb-5 headline-info">
        <h1 class="headline">Welcome to GoellHorn!</h1>
        <?php if (isset($CurrentUser)) {
          echo ("<p>Your are logged in as $CurrentUser->UserName</p>");
        } else {
          echo ("<p>Your are not logged in and only see 'public' posts!</p>");
        }
        ?>
      </div>

      <?php include "components/search.comp.php" ?>

      <div class="mt-5">

      </div>




    </div>

    <div class="col-xl-2 col-lg-2 col-md-1">

    </div>
  </div>
  <div class="row">
    <div class="col">

    </div>

    <div class="col-xl-6 col-lg-10 p-4 minusTop">
      <div class="d-flex sort-container mb-3">
        <?php
        $l = $d = $ta = FALSE;//likes, dislikes, time descending
        $td = true;// time ascending
        if (isset($_GET["filter"])) {
          $td = false;
          

          switch ($_GET["filter"]) {
            case 'likes':
              $l = True;
              break;
            case 'dislikes':
              $d = True;
              break;
            case 't_ASC':
              $ta = True;
              break;
            case 't_DESC':
              $td = True;
              break;
            default:
              # code...
              break;
          }
        }

        ?>

        <form class="btn-sort"  action="//<?php echo (DIR_SERVERROOT .  $_SERVER['REQUEST_URI']); ?>">
          <input type="hidden" name="filter" value="likes" />

          <button type="submit" <?php  echo( ($l==True) ? "disabled ":"" );?> class="btn btn-sm btn-sm-my btn-outline-primary">

            <?php echo ("most likes") ?></button>
        </form>
        <form class="btn-sort" action="//<?php echo (DIR_SERVERROOT .  $_SERVER['REQUEST_URI']); ?>">
          <input type="hidden" name="filter" value="dislikes" />

          <button type="submit" <?php echo( ($d==True) ? "disabled ":""); ?> class="btn btn-sm btn-sm-my btn-outline-primary">

            <?php echo ("most dislikes") ?></button>
        </form>

        <form class="btn-sort" action="//<?php echo (DIR_SERVERROOT .  $_SERVER['REQUEST_URI']); ?>">
          <input type="hidden" name="filter" value="t_DESC" />

          <button type="submit" <?php echo( ($td==True) ? "disabled":"") ; ?> class="btn btn-sm btn-sm-my btn-outline-primary">

            <?php echo ("newest") ?></button>
        </form>
        <form class="btn-sort" action="//<?php echo (DIR_SERVERROOT .  $_SERVER['REQUEST_URI']); ?>">
          <input type="hidden" name="filter" value="t_ASC" />

          <button type="submit" <?php echo( ($ta==True) ? "disabled ":"" ); ?> class="btn btn-sm btn-sm-my btn-outline-primary">

            <?php echo ("oldest") ?></button>
        </form>


      </div>


      <?php if(!empty($filteredPosts)){
      $PostManager->display($DB, $filteredPosts, $CurrentUser); }?>





    </div>




    <div class="col">
    </div>
















    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous"></script>
    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js" integrity="sha384-q2kxQ16AaE6UbzuKqyBE9/u/KzioAlnx2maXQHiDX9d4/zp8Ok3f+M7DPm+Ib6IU" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.min.js" integrity="sha384-pQQkAEnwaBkjpqZ8RU1fF1AKtTcHJwFl3pblpTlHXybJjHpMYo79HY3hIi4NKxyj" crossorigin="anonymous"></script>
    -->
    <!-- lightbox JS -->
   
    <script src="https://cdnjs.cloudflare.com/ajax/libs/ekko-lightbox/5.3.0/ekko-lightbox.min.js" integrity="sha512-Y2IiVZeaBwXG1wSV7f13plqlmFOx8MdjuHyYFVoYzhyRr3nH/NMDjTBSswijzADdNzMyWNetbLMfOpIPl6Cv9g==" crossorigin="anonymous"></script>
    
</body>

</html>