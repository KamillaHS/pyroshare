<?php

class CommentDAO {
    function createComment($postID, $userID) {
        $text = htmlspecialchars($_POST['text']);

        $user = 'root';
        $pass = '123456';
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
        $user = 'root';
        $pass = '123456';
        $dbCon = dbCon($user, $pass);
        $sql = "UPDATE comment SET Likes = Likes + 1 WHERE CommentID = '$commentID'";
        $query = $dbCon->prepare($sql);
        $query->execute();
    }

    function dislikeComment($commentID) {
        $user = 'root';
        $pass = '123456';
        $dbCon = dbCon($user, $pass);
        $sql = "UPDATE comment SET Likes = Likes - 1 WHERE CommentID = '$commentID'";
        $query = $dbCon->prepare($sql);
        $query->execute();
    }
}