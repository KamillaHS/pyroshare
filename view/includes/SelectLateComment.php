<?php
$dbCon = dbCon($user, $pass);
$query = $dbCon->prepare("SELECT comment.CommentID, comment.Description, comment.Likes, comment.CreatedAt, comment.isPic, post.PostID, post.Title, post.Img, `user`.UserID, `user`.Username, `user`.ProfilePic, TIMESTAMPDIFF(hour, `CreatedAt`, CURRENT_TIMESTAMP) AS TimeDiff
                                    FROM comment, post, `user`
                                    WHERE comment.PostID = post.PostID && comment.UserID = `user`.UserID
                                    ORDER BY TimeDiff ASC
                                    LIMIT 8");
$query->execute();
$getCommentData = $query->fetchAll();
//var_dump($query);