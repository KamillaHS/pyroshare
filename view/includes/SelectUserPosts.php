<?php
$dbCon = dbCon($user, $pass);

$user_id = $_SESSION['user_id'];

$query = $dbCon->prepare("SELECT post.PostID, post.Img, post.Title, post.Description, post.UploadedAt, `user`.`UserID`, `user`.Username, likes.Likes, likes.Dislikes, TIMESTAMPDIFF(hour, `UploadedAt`, CURRENT_TIMESTAMP) AS TimeDiff
                                    FROM post, `user`, likes
                                    WHERE post.UserID = `user`.`UserID` && post.PostID = likes.PostID && `user`.`UserID` = '$user_id'
                                    ORDER BY `post`.`PostID` DESC");
$query->execute();
$getUserPosts = $query->fetchAll();
//var_dump($query);