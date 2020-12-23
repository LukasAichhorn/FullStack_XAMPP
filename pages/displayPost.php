<?php
// all includes and requires
include "../Dir-Config.php";
require "../classes/DBManager.class.php";
require "../classes/Post.class.php";
require "../classes/User.class.php";
require "../classes/UserManager.class.php";
require "../classes/validator.class.php";
require "../classes/PostManager.class.php";
require "../classes/Comment.class.php";
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
$comments = $DB->commentCount($PostID);
$SinglePost = $SinglePost[0];
$Path = $_SERVER['REQUEST_URI'];
$PostManager->handleNewComment($DB, $PostID, $CurrentUser->UserID, $Path);
$Comments = $DB->getComments($PostID);
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

  <div class="container-fluid">
    <div class="row displayPost-BG"></div>
    <div class="row">
      <div class="col">

      </div>

      <div class="col-6 p-4 minusTop">


        <img class="card-img-top " src="//<?php echo ($SinglePost->Bildadresse); ?>" alt="Card image cap">
        <h5 class="mt-3 mb-3"><?php echo ($SinglePost->Titel) ?></h5>
        <p><?php echo ($SinglePost->Inhalt) ?></p>



        <div class="row mt-2">

          <div class="d-flex flex-wrap">

            <?php
            foreach ($SinglePost->SelectedTags as $tag) {

              echo ("<div class='border  m-1 small-tag'>" . $tag["TagName"] . "</div>");
            }

            ?>
          </div>
          <div class="divider border mt-1 mb-1"></div>
          <div class="col">
            <p class="card-text"><small class="text-muted">created by <?php echo ($SinglePost->Username) ?> at: <?php echo ($SinglePost->CreatedAt) ?> </small></p>
          </div>

          <div class="col">
            <p class="card-text"><small class="text-muted"><?php echo ($comments); ?> comment(s)</small></p>
          </div>

          <div class="col ">
            <div class="d-flex flex-row justify-content-end">
              <div class="Comp-like">
                <form><button type="button" class="btn btn-sm btn-sm-my btn-outline-success"><?php echo ($SinglePost->Likes) ?></button></form>
              </div>
              <div class="Comp-like">
                <form><button type="button" class="btn btn-sm btn-sm-my btn-outline-danger"> <?php echo ($SinglePost->Dislikes) ?></button></form>
              </div>
            </div>
          </div>



        </div>
        <div class="row mb-1">
          <b>Comments:</b>
        </div>

        <?php

        //Display all comments
        foreach ($Comments as $Comment) {
          include "../components/comment.comp.php";
        }
        ?>




        <?php include "../components/CreateComment.comp.php" ?>
      </div>




      <div class="col">

      </div>
    </div>
  </div>