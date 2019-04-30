<?php

class CommentDAO {
    function createComment($postID, $userID) {
        require_once '../database/dbcon.php';
        $text = htmlspecialchars($_POST['text']);

        $user = 'surcrit_dk';
        $pass = 'succeeded';
        $dbCon = dbCon($user, $pass);

        $sql = "INSERT INTO `comment` (`CommentID`, `Description`, `Likes`, `CreatedAt`, `PostID`, `UserID`) 
                VALUES (NULL, ?, 0, CURRENT_TIMESTAMP, '$postID', '$userID')";
        $query = $dbCon->prepare($sql);

        $query->bindParam(1,$text);
        $query->execute();
    }

    function showComment($postID) {

    }

//    function editComment() {
//
//    }

    function deleteComment() {

    }

    function likeComment($commentID) {
        $user = 'surcrit_dk';
        $pass = 'succeeded';
        $dbCon = dbCon($user, $pass);
        $sql = "UPDATE comment SET Likes = Likes + 1 WHERE CommentID = '$commentID'";
        $query = $dbCon->prepare($sql);
        $query->execute();
    }

    function dislikeComment($commentID) {
        $user = 'surcrit_dk';
        $pass = 'succeeded';
        $dbCon = dbCon($user, $pass);
        $sql = "UPDATE comment SET Likes = Likes - 1 WHERE CommentID = '$commentID'";
        $query = $dbCon->prepare($sql);
        $query->execute();
    }
}