<?php
include 'classes/DBManager.class.php';
include 'classes/User.class.php';

$testDBManager = new DBManager;

$testDBManager->ConnectDB();

$testPW = "asdfjkl1";

$testPW = $testDBManager->HashPW($testPW);
echo $testPW;



$TestID = $testDBManager->validateUser("boi", "asdfjkl1");
echo "!" . $TestID . "!";
$testUser = $testDBManager->getUser($TestID); 
//$testDBManager->insertUser($testUser);    
$testUsername = "Heinz";
$testDBManager->checkifUserExists($testUsername);
?>