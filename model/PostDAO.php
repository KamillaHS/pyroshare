<?php

class PostDAO
{

    public function createPost()
    {
        require_once ('../view/includes/session.php');
        require_once '../database/dbcon.php';
        $imgURL = htmlspecialchars($_POST['img']);
        $imgTitle = htmlspecialchars($_POST['imgTitle']);
        $imgDescription = htmlspecialchars($_POST['imgDescription']);
        $user_id = htmlspecialchars($_SESSION['user_id']);

        $user = 'surcrit_dk';
        $pass = 'succeeded';
        $dbCon = dbCon($user, $pass);


        $sql = "INSERT INTO `post` (`PostID`, `Img`, `Title`, `Description`, `UploadedAt`, `isHot`, `isSticky`, `UserID`)
                        VALUES (NULL, ?, ?, ?, CURRENT_TIMESTAMP, b'0', b'0', ?)";
        $query = $dbCon->prepare($sql);

        $query->bindParam(1,$imgURL);
        $query->bindParam(2, $imgTitle);
        $query->bindParam(3, $imgDescription);
        $query->bindParam(4,$user_id);
        $query->execute();

        $last_post_id = $dbCon->lastInsertId();
        $query2 = $dbCon->prepare("INSERT INTO `likes` (`LikeID`, `Likes`, `Dislikes`, `PostID`) VALUES (NULL, '0', '0', '{$last_post_id}')");
        $query2->execute();

        $category = $_POST['imgCategory'];
        $query3 = $dbCon->prepare("INSERT INTO `postcat` (`PostID`, `CategoryID`) VALUES ({$last_post_id}, {$category})");
        $query3->execute();

        // echo "<script>location.href = 'profile.php'</script>";


    }

    function showPost()
    {

    }

    function editPost($id)
    {
        require_once '../database/dbcon.php';
        $imgURL = $_POST['img'];
        $imgTitle = $_POST['imgTitle'];
        $imgDescription = $_POST['imgDescription'];

        $user = 'surcrit_dk';
        $pass = 'succeeded';
        $dbCon = dbCon($user, $pass);
        $sql = "UPDATE `post` SET `Img` = '$imgURL', `Title` = '$imgTitle', `Description` = '$imgDescription' WHERE PostID = '$id'";
        $query = $dbCon->prepare($sql);
        $query->execute();

        // echo "<script>location.href = 'profile.php'</script>";
    }

    function deletePost($id)
    {
//        $imgURL = $_POST['img'];
//        $imgTitle = $_POST['imgTitle'];
//        $imgDescription = $_POST['imgDescription'];
        require_once '../database/dbcon.php';

        $user = 'surcrit_dk';
        $pass = 'succeeded';
        $dbCon = dbCon($user, $pass);
        $sql = "DELETE FROM likes WHERE PostID='$id'; DELETE FROM post WHERE PostID='$id'; DELETE FROM comments WHERE PostID='$id';  " ;
        $query = $dbCon->prepare($sql);
        $query->execute();

//        echo "<script>location.href = 'profile.php'</script>";

    }

    function showAllPosts()
    {

    }

    function likePost($postID) {
        require_once '../database/dbcon.php';
        $user = 'surcrit_dk';
        $pass = 'succeeded';
        $dbCon = dbCon($user, $pass);
        $sql = "UPDATE likes SET Likes = Likes + 1 WHERE PostID = '$postID'";
        $query = $dbCon->prepare($sql);
        $query->execute();
    }

    function dislikePost($postID) {
        require_once '../database/dbcon.php';
        $user = 'surcrit_dk';
        $pass = 'succeeded';
        $dbCon = dbCon($user, $pass);
        $sql = "UPDATE likes SET Dislikes = Dislikes + 1 WHERE PostID = '$postID'";
        $query = $dbCon->prepare($sql);
        $query->execute();

    }

    function makeHot() {
        require_once '../database/dbcon.php';
        $user = 'surcrit_dk';
        $pass = 'succeeded';
        $dbCon = dbCon($user, $pass);
        $sql = "UPDATE post SET isHot = 1";
        $query = $dbCon->prepare($sql);
        $query->execute();
    }

    function makeNotHot() {
        require_once '../database/dbcon.php';
        $user = 'surcrit_dk';
        $pass = 'succeeded';
        $dbCon = dbCon($user, $pass);
        $sql = "UPDATE post SET isHot = 0";
        $query = $dbCon->prepare($sql);
        $query->execute();
    }

}
