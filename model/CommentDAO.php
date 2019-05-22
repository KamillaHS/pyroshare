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

    function createPictureComment($postID, $userID){



//        if (isset($_POST['uploadPictureComment'])) {
            if (($_FILES['commentPicture']['type'] == "image/jpeg" ||
                    $_FILES['commentPicture']['type'] == "image/pjpeg" ||
                    $_FILES['commentPicture']['type'] == "image/png" ||
                    $_FILES['commentPicture']['type'] == "image/gif" ||
                    $_FILES['commentPicture']['type'] == "image/jpg") && (
                    $_FILES['commentPicture']['size'] < 5000000
                )) {
                if ($_FILES['commentPicture']['error'] > 0) {
                    echo "Error: " . $_FILES['commentPicture']['error'];
                } else {
                    echo "Name: " . $_FILES['commentPicture']['name'] . "<br>";
                    echo "Type: " . $_FILES['commentPicture']['type'] . "<br>";
                    echo "Size: " . ($_FILES['commentPicture']['size'] / 1024) . "<br>";
                    echo "Tmp_name: " . $_FILES['commentPicture']['tmp_name'] . "<br>";
//                    if (file_exists("../upload/CommentPics/" . preg_replace('/\s/', '', $_FILES['commentPicture']['name']))) {
//                        echo "can't upload: " . preg_replace('/\s/', '', $_FILES['commentPicture']['name']) . " Exists";
//                    } else {
                        $increment = '';
                        $commentPicture = preg_replace('/\s/', '', $_FILES['commentPicture']['name']);


                    while(file_exists("../upload/CommentPics/" . $increment . $commentPicture )){
                        $increment++;
                    }
                        move_uploaded_file($_FILES['commentPicture']['tmp_name'],
                            "../upload/CommentPics/" .  $increment .  preg_replace('/\s/', '', $_FILES['commentPicture']['name']) );
                        echo "stored in: ../upload/CommentPics/" . $_FILES['commentPicture']['name'];






                        require_once '../database/dbcon.php';
                        $user = 'surcrit_dk';
                        $pass = 'succeeded';
                        $truePicturePath =  $increment . $commentPicture ;

                        $dbCon = dbCon($user, $pass);
                        $sql = "INSERT INTO `comment` (`CommentID`, `Likes`, `CreatedAt`, `PostID`, `UserID`, `Description`, `isPic`) 
                VALUES (NULL, 0, CURRENT_TIMESTAMP, '$postID', '$userID', ?, 1)";
                        $query = $dbCon->prepare($sql);
                        $query->bindParam(1, $truePicturePath);
                        $query->execute();



                        echo "<script>location.href = '../view/frontend/profile.php'</script>";

                    //}
                }
           // }

        }










    }

//    function showComment($postID) {
//
//    }

//    function editComment() {
//
//    }

//    function deleteComment() {
//
//    }

    function likeComment($commentID) {
        require_once '../database/dbcon.php';
        $user = 'surcrit_dk';
        $pass = 'succeeded';
        $dbCon = dbCon($user, $pass);
        $sql = "UPDATE comment SET Likes = Likes + 1 WHERE CommentID = '$commentID'";
        $query = $dbCon->prepare($sql);
        $query->execute();
    }

    function dislikeComment($commentID) {
        require_once '../database/dbcon.php';
        $user = 'surcrit_dk';
        $pass = 'succeeded';
        $dbCon = dbCon($user, $pass);
        $sql = "UPDATE comment SET Likes = Likes - 1 WHERE CommentID = '$commentID'";
        $query = $dbCon->prepare($sql);
        $query->execute();
    }
}