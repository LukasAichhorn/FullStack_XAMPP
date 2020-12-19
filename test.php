<?php
include 'classes/DBManager.class.php';

$testDBManager = new DBManager;

$testDBManager->ConnectDB();

$testInput = [
    "Username" => "Heinz",
    "Passwort" => "pw",
    "Anrede" => "Herr",
    "Vorname" => "Hei",
    "Nachname" => "Nz"
];

$testDBManager->insertUser($testInput);    
$testUsername = "Heinz";
$testDBManager->checkifUserExists($testUsername);
?>