<?php

function createComment() {

}

function showComment() {

}

function editComment() {

}

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