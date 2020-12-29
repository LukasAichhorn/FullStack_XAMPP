<?php
require '../classes/UserManager.class.php';
require '../classes/NotificationHandler.class.php';

$Usermanager = new UserManager();
$Usermanager->startSession();
$Usermanager->handleLogout();
?>