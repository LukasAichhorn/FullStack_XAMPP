<?php






$litemHome = "
<li class='nav-item'>
    <a class='nav-link active' aria-current='page' href='//".DIR_BASE."index.php'>Home</a>
</li>
        ";
$litemlogin ="
<li class='nav-item'>
    <a class='nav-link' aria-current='page' href='//".DIR_PAGES."login.php'>login</a>
</li>
        ";
$litemMyProfile = "
<li class='nav-item'>
    <a class='nav-link' aria-current='page' href='//".DIR_PAGES."MyProfile.php'>My Profile</a>
</li>
        ";
$litemLogOut = "
<li class='nav-item'>
    <a class='nav-link' aria-current='page' href='//".DIR_PAGES."logout.php'>Logout</a>
</li>
        ";
$litemImpressum = "
<li class='nav-item'>
    <a class='nav-link' aria-current='page' href='//".DIR_PAGES."impressum.php'>Impressum</a>
</li>
        ";
$litemHelp = "
<li class='nav-item'>
    <a class='nav-link' aria-current='page' href='//".DIR_PAGES."help.php'>Help</a>
    </li>
                ";
$litemManageUsers = "
        <li class='nav-item'>
            <a class='nav-link' aria-current='page' href='//".DIR_PAGES."ManageUsers.php'>Manage Users</a>
        </li>
                ";
$litemNewPost = "
        <li class='nav-item'>
            <a class='nav-link' aria-current='page' href='//".DIR_PAGES."createPost.php'>create new Post</a>
        </li>
                ";


?>

<nav class="navbar navbar-expand-lg navbar-light bg-light shadow-sm">
    <div class="container-fluid w-100">
    <a class="navbar-brand" href="#">
    <img src="ressources/color-filter-sharp.svg" width="30" height="30" alt="">
  </a>
        <a class="navbar-brand" href="#">GoellHorn</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse d-flex justify-content-end" id="navbarNav">
            <ul class="navbar-nav">
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
    </div>
</nav>

