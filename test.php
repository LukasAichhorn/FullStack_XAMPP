<?php
include 'classes/DBManager.class.php';
include 'classes/User.class.php';

$testDBManager = new DBManager;

$testDBManager->ConnectDB();

$testPW = "asdfjkl1";

$testPW = $testDBManager->HashPW($testPW);

$testUser = new User(0, "boi", $testPW, "Herr", "b", "oi",0,1);

$testDBManager->validateUser("boi", $testPW);

//$testDBManager->insertUser($testUser);    
$testUsername = "Heinz";
//$testDBManager->checkifUserExists($testUsername);
?>