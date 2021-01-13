<?php
include 'classes/DBManager.class.php';
include 'classes/User.class.php';
include 'classes/Post.class.php';

$testDBManager = new DBManager;

$testDBManager->ConnectDB();

$testPW = "asdfjkl1";

$testPW = $testDBManager->HashPW($testPW);
//echo $testPW;



$TestID = $testDBManager->validateUser("carlos", "1234");
echo "!" . $TestID . "!<br>";
//$testUser = $testDBManager->getUser($TestID); 
//$testDBManager->insertUser($testUser);    
$testUsername = "carlos";
$testDBManager->checkifUserExists($testUsername);
//var_dump($testDBManager->getPosts(1));

//$testDBManager->dislikePost(1);

//$tags = $testDBManager->allTags();
//var_dump($tags);

$singlepost = $testDBManager->getSinglePost(4);
//print_r($singlepost);

//print_r($testDBManager->getTags(17));

//$testDBManager->commentCount(4);

//$newUser = new user(32,"carpador",1234,"Frau","car","pador",0,1,"localhost/WEB_SS2020/WP/ressources/pics/DefaultUser.png","localhost/WEB_SS2020/WP/UsersRoot/carlos");

//$testDBManager->updateUser($newUser);

//$testDBManager->changeStatus(32);
$testString = "tset";
$testArray = array('Entspannung','Kartoffeln','Bruck an der Mur');
$tagString = '(';

var_dump($testArray);
//$userArray = $testDBManager->getUserArray();  

//var_dump($userArray);

$testDBManager->searchPosts($testString,$testArray);

?>
