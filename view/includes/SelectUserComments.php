<?php
$dbCon = dbCon($user, $pass);

$user_id = $_SESSION['user_id'];

$query = $dbCon->prepare("SELECT comment.CommentID, comment.Description, comment.Likes, comment.CreatedAt, post.PostID, post.Title, post.Img, `user`.Username, TIMESTAMPDIFF(hour, `CreatedAt`, CURRENT_TIMESTAMP) AS TimeDiff
                                    FROM comment, post, `user`
                                    WHERE comment.PostID = post.PostID && comment.UserID = `user`.UserID && comment.UserID = '$user_id'
                                    ORDER BY comment.CommentID ASC");
$query->execute();
$getUserComments = $query->fetchAll();
//var_dump($query);