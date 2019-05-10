<?php
require_once ("database/dbcon.php");


$dbCon = dbCon($user, $pass);
$sql = "SELECT filename FROM imgs WHERE ID = 1" ;
$query = $dbCon->prepare($sql);
$query->execute();
$getIMGFromDB = $query->fetch();
//var_dump($getIMGFromDB);

echo "<img src='upload/$getIMGFromDB[0]'>";





?>