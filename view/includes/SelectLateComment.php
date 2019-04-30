<?php
$dbCon = dbCon($user, $pass);
$query = $dbCon->prepare("SELECT comment.CommentID, comment.Description, comment.Likes, comment.CreatedAt, post.PostID, post.Title, post.Img, `user`.Username, TIMESTAMPDIFF(hour, `CreatedAt`, CURRENT_TIMESTAMP) AS TimeDiff
                                    FROM comment, post, `user`
                                    WHERE comment.PostID = post.PostID && comment.UserID = `user`.UserID
                                    ORDER BY comment.CommentID DESC");
$query->execute();
$getCommentData = $query->fetchAll();
//var_dump($query);