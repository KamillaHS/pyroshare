<?php
$dbCon = dbCon($user, $pass);
$query = $dbCon->prepare("SELECT `Img` FROM `post` WHERE `isHot` = 1");
$query->execute();
$getPost = $query->fetchAll();
//var_dump($query);