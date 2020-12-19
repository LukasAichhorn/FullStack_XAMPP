<?php
require '../classes/UserManager.class.php';
$Usermanager = new UserManager();
$Usermanager->startSession();
$Usermanager->handleLogout();
?>