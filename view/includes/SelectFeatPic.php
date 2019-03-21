<?php
$dbCon = dbCon($user, $pass);
$query = $dbCon->prepare("
                                    SELECT post.PostID, post.Img, post.Title, post.Description, post.UploadedAt, `user`.Username
                                    FROM post, `user`
                                    WHERE post.UserID = `user`.`UserID` && `post`.`isSticky` = 1
                                    ORDER BY post.PostID ASC");
$query->execute();
$getPostData = $query->fetchAll();
//var_dump($query);