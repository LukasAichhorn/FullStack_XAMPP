<?php
include 'classes/DBManager.class.php';
include 'classes/User.class.php';

$testDBManager = new DBManager;

$testDBManager->ConnectDB();

$testPW = "asdfjkl1";

$testPW = $testDBManager->HashPW($testPW);
//echo $testPW;



$TestID = $testDBManager->validateUser("carlos", "1234");
echo "!" . $TestID . "!";
$testUser = $testDBManager->getUser($TestID); 
//$testDBManager->insertUser($testUser);    
$testUsername = "carlos";
$testDBManager->checkifUserExists($testUsername);
$testDBManager->getPosts(1);

//$testDBManager->dislikePost(1);

$tags = $testDBManager->allTags();
var_dump($tags);

//$testDBManager->commentCount(4);

?>