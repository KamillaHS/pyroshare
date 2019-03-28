<?php
$user = "root";
$pass = "123456";

$cxn = dbCon($user, $pass);
function dbCon($user, $pass){
try {
    $dbCon = new PDO('mysql:host=localhost;dbname=pyrosharedb;charset=utf8', $user, $pass);
    //$dbCon = null;
    return $dbCon;
} catch (PDOException $err) {
    echo "Error!: " . $err->getMessage() . "<br/>";
    die();
}}

