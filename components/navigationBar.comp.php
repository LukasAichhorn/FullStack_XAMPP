<?php






$litemHome = "
<li class='nav-item'>
    <a class='nav-link active' style='text-align: center;' aria-current='page' href='//".DIR_BASE."index.php'>Home</a>
</li>
        ";
$litemlogin ="
<li class='nav-item'>
    <a class='nav-link' style='text-align: center;' aria-current='page' href='//".DIR_PAGES."login.php'>Login</a>
</li>
        ";
$litemMyProfile = "
<li class='nav-item'>
    <a class='nav-link' style='text-align: center;' aria-current='page' href='//".DIR_PAGES."myProfile.php'>Mein Profil</a>
</li>
        ";
$litemLogOut = "
<li class='nav-item'>
    <a class='nav-link' style='text-align: center;' aria-current='page' href='//".DIR_PAGES."logout.php'>Logout</a>
</li>
        ";
$litemImpressum = "
<li class='nav-item'>
    <a class='nav-link' style='text-align: center;' aria-current='page' href='//".DIR_PAGES."impressum.php'>Impressum</a>
</li>
        ";
$litemHelp = "
<li class='nav-item'>
    <a class='nav-link' style='text-align: center;' aria-current='page' href='//".DIR_PAGES."help.php'>Hilfe</a>
    </li>
                ";
$litemManageUsers = "
        <li class='nav-item'>
            <a class='nav-link' style='text-align: center;' aria-current='page' href='//".DIR_PAGES."ManageUsers.php'>User verwalten</a>
        </li>
                ";
$litemNewPost = "
        <li class='nav-item'>
            <a class='nav-link' style='text-align: center;' aria-current='page' href='//".DIR_PAGES."createPost.php'>Beitrag erstellen</a>
        </li>
                ";


?>

<nav class="navbar navbar-expand-lg navbar-light bg-light shadow-sm sticky-top">
    
    <a class="navbar-brand" href="#">
    <img src="//<?php echo(DIR_RES."color-filter-sharp.svg"); ?>" width="30" height="30" alt="">
  </a>
        <a class="navbar-brand" href="#">GoellHorn</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse  navbar-collapse" id="navbarNav">
            <ul class="navbar-nav"style="margin-left: auto;
">
                <?php
                // checkStatus == 0 = Anon
                if ($UserManager->checkStatus() == 0) {
                    echo $litemHome;
                    echo $litemlogin;
                    echo $litemHelp;
                    echo $litemImpressum;
                    
                }
                // checkStatus == 1 = User
                elseif ($UserManager->checkStatus() == 1) {
                    echo $litemHome;
                    echo $litemMyProfile;
                    echo $litemNewPost;
                    echo $litemLogOut;
                    echo $litemHelp;
                    echo $litemImpressum;
                }
                // checkStatus == 1 = Admin
                elseif ($UserManager->checkStatus() == 2) {
                    echo $litemHome;
                    echo $litemManageUsers;
                    echo $litemMyProfile;
                    echo $litemNewPost;
                    echo $litemLogOut;
                    echo $litemHelp;
                    echo $litemImpressum;
                }

                ?>

            </ul>
        </div>
    
</nav>

