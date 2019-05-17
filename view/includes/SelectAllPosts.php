<?php
$dbCon = dbCon($user, $pass);
$query = $dbCon->prepare("SELECT post.PostID, post.Img, post.Title, post.Description, post.UploadedAt, post.isFlagged,`user`.`UserID`, `user`.Username, likes.Likes, likes.Dislikes, TIMESTAMPDIFF(hour, `UploadedAt`, CURRENT_TIMESTAMP) AS TimeDiff
                                    FROM likes, post LEFT JOIN `user`
                                    ON post.UserID = `user`.`UserID`
                                    WHERE post.PostID = likes.PostID
                                    ORDER BY post.UploadedAt DESC");

$query->execute();
$getAllPostsNewest = $query->fetchAll();
//var_dump($query);

$query = $dbCon->prepare("SELECT post.PostID, post.Img, post.Title, post.Description, post.UploadedAt, post.isFlagged,`user`.`UserID`, `user`.Username, likes.Likes, likes.Dislikes, TIMESTAMPDIFF(hour, `UploadedAt`, CURRENT_TIMESTAMP) AS TimeDiff
                                    FROM likes, post LEFT JOIN `user`
                                    ON post.UserID = `user`.`UserID`
                                    WHERE post.PostID = likes.PostID
                                    ORDER BY likes.Likes DESC");

$query->execute();
$getAllPostsMostLikes = $query->fetchAll();

$query = $dbCon->prepare("SELECT post.PostID, post.Img, post.Title, post.Description, post.UploadedAt, post.isFlagged,`user`.`UserID`, `user`.Username, likes.Likes, likes.Dislikes, TIMESTAMPDIFF(hour, `UploadedAt`, CURRENT_TIMESTAMP) AS TimeDiff
                                    FROM likes, post LEFT JOIN `user`
                                    ON post.UserID = `user`.`UserID`
                                    WHERE post.PostID = likes.PostID
                                    ORDER BY likes.Dislikes DESC ");

$query->execute();
$getAllPostsLeastLikes = $query->fetchAll();