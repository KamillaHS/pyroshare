<?php
$dbCon = dbCon($user, $pass);
$query = $dbCon->prepare("SELECT * FROM `webstyle`");
$query->execute();
$getWebStyle = $query->fetchAll();
//var_dump($query);