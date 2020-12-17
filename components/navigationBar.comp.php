<?php
$litemHome = "
<li class='nav-item'>
    <a class='nav-link active' aria-current='page' href='../index.php'>Home</a>
</li>
        ";
$litemlogin = "
<li class='nav-item'>
    <a class='nav-link' aria-current='page' href='pages/login.php'>login</a>
</li>
        ";
$litemMyProfile = "
<li class='nav-item'>
    <a class='nav-link' aria-current='page' href='pages/MyProfile'>My Profile</a>
</li>
        ";
$litemLogOut = "
<li class='nav-item'>
    <a class='nav-link' aria-current='page' href='pages/logout.php'>Logout</a>
</li>
        ";
$litemImpressum = "
<li class='nav-item'>
    <a class='nav-link' aria-current='page' href='pages/impressum.php'>Impressum</a>
</li>
        ";
$litemHelp = "
<li class='nav-item'>
    <a class='nav-link' aria-current='page' href='pages/help.php'>Help</a>
    </li>
                ";
$litemManageUsers = "
        <li class='nav-item'>
            <a class='nav-link' aria-current='page' href='pages/ManageUsers.php'>Manage Users</a>
        </li>
                ";


?>

<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container-fluid">
        <a class="navbar-brand" href="#">GoellHorn</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
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
                    echo $litemLogOut;
                    echo $litemHelp;
                    echo $litemImpressum;
                }
                // checkStatus == 1 = Admin
                elseif ($UserManager->checkStatus() == 2) {
                    echo $litemHome;
                    echo $litemManageUsers;
                    echo $litemMyProfile;
                    echo $litemLogOut;
                    echo $litemHelp;
                    echo $litemImpressum;
                }

                ?>

            </ul>
        </div>
    </div>
</nav>