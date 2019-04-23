<?php
$dbCon = dbCon($user, $pass);
$query = $dbCon->prepare("SELECT comment.CommentID, comment.Description, comment.Likes, comment.CreatedAt, post.PostID, `user`.Username, TIMESTAMPDIFF(hour, `CreatedAt`, CURRENT_TIMESTAMP) AS TimeDiff
                                    FROM comment, post, `user`
                                    WHERE comment.PostID = post.PostID && post.UserID = `user`.UserID
                                    ORDER BY comment.CommentID DESC");
$query->execute();
$getAllComments = $query->fetchAll();
//var_dump($query);