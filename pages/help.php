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
$nM = new NotificationHandler();
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
        <div class="row help-BG"></div>
        <div class="row">
            <div class="col">

            </div>

            <div class="col-6 p-4 minusTop">
                <h1 class="mb-3">Benutzerhilfe</h1>
                <div class="accordion" id="accordionExample">
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="headingOne">
                            <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                Nicht eingeloggter Besucher
                            </button>
                        </h2>
                        <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                            <div class="accordion-body">
                                Sie können das <strong>GoellHorn</strong> auch benützen ohne einen Account zu besitzen. Sie können die angezeigten Beiträge auch nach verschiedenen Kriterien filtern und sortieren. 
                                Geben Sie dazu in der Suchleiste einen Suchbegriff ein oder verwenden Sie die Suche nach den unterschiedlichen Tags unter der Leiste. 
                                In dem Newsfeed werden Sie dann jedoch ausschließlich Beiträge sehen die von den Erstellern als öffentlich markiert wurden. 
                                Um <strong>GoellHorn</strong> in vollem Umfang nutzen zu können müssen Sie sich jedoch registrieren und einloggen. 
                                Gehen Sie dazu auf den Reiter Login und klicken Sie dort auf Registrieren. Melden Sie sich danach unter Login mit Ihren Anmeldedaten an.

                                 
                            </div>
                        </div>
                    </div>
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="headingTwo">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                Eingeloggter User
                            </button>
                        </h2>
                        <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#accordionExample">
                            <div class="accordion-body">
                            <strong>GoellHorn</strong> bietet seinen Usern eine Vielzahl von Features an. Auf Ihrer Startseite werden Ihnen die Beiträge aller User angezeigt. Sie können die angezeigten Posts auch nach verschiedenen Kriterien filtern und sortieren. 
                                Geben Sie dazu in der Suchleiste einen Suchbegriff ein oder verwenden Sie die Suche nach den unterschiedlichen Tags unter der Leiste. Unter dem Reiter 
                                Mein Profil können Sie Ihre Benutzerdaten und Ihr Profilbild einsehen und gegebenenfalls ändern. Unter dem Reiter Beitrag erstellen können Sie einen neuen Beitrag inklusive Bild erstellen. 
                                Sie können Beiträge in Ihrem Newsfeed liken, disliken und Ihre eigenen Beiträge löschen. Um Beiträge zu kommentieren klicken Sie auf den Beitrag, dort können Sie dann Ihre Kommentare verfassen. Unter dem Reiter Logout können Sie sich wieder ausloggen. Viel Spaß auf <strong>GoellHorn</strong>!
                             
                            </div>
                        </div>
                    </div>
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="headingThree">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                Admin
                            </button>
                        </h2>
                        <div id="collapseThree" class="accordion-collapse collapse" aria-labelledby="headingThree" data-bs-parent="#accordionExample">
                            <div class="accordion-body">
                                Als Admin von <strong>GoellHorn</strong> stehen Ihnen neben den üblichen Features noch einige weitere zur Verfügung. Unter dem Reiter User verwalten sehen Sie alle User von <strong>GoellHorn</strong>
                                Sie können den Status jedes Users von aktiv auf inaktiv ändern und umgekehrt. Schalten Sie einen User auf inaktiv, kann sich dieser nicht mehr einloggen bis sein Account wieder aktiviert wurde.
                                Zusätzlich steht es Ihnen frei die Beiträge aller User zu löschen sollten diese unangebrachte Bilder oder Texte beinhalten.
                            </div>
                        </div>
                    </div>
                </div>

            </div>




            <div class="col">

            </div>
        </div>
    </div>



    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous"></script>



</body>

</html>