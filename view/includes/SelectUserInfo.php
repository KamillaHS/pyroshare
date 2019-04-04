<?php
$dbCon = dbCon($user, $pass);

$user_id = $_SESSION['user_id'];

$query = $dbCon->prepare("SELECT `user`.`UserID`, `user`.`Username`, `user`.`Country`, `user`.`Birthday`, `user`.`ProfilePic`, `user`.`ProfileCover`, `user`.`IsBanned`
                                    FROM `user`
                                    WHERE `user`.`UserID` = '$user_id'");
$query->execute();
$getUserInfo = $query->fetchAll();
//var_dump($query);