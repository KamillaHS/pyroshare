<?php
$dbCon = dbCon($user, $pass);
$query = $dbCon->prepare("SELECT post.PostID, post.Img, post.Title, post.Description, post.UploadedAt, `user`.Username, likes.Likes, likes.Dislikes, TIMESTAMPDIFF(hour, `UploadedAt`, CURRENT_TIMESTAMP) AS TimeDiff
                                    FROM post, `user`, likes
                                    WHERE post.UserID = `user`.`UserID` && post.PostID = likes.PostID");
$query->execute();
$getAllPosts = $query->fetchAll();
//var_dump($query);