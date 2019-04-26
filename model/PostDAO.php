<?php
require_once('../database/DBconnection.php');

class PostDAO extends DBconnection
{

    public function createPost()
    {

        $imgURL = htmlspecialchars($_POST['img']);
        $imgTitle = htmlspecialchars($_POST['imgTitle']);
        $imgDescription = htmlspecialchars($_POST['imgDescription']);
        $user_id = htmlspecialchars($_SESSION['user_id']);

        $db = new DBconnection();
        $db->dbCon();


        $sql = "INSERT INTO `post` (`PostID`, `Img`, `Title`, `Description`, `UploadedAt`, `isHot`, `isSticky`, `UserID`)
                        VALUES (NULL, ?, ?, ?, CURRENT_TIMESTAMP, b'0', b'0', ?)";
        $query = $db->prepare($sql);

        $query->bindParam(1,$imgURL);
        $query->bindParam(2, $imgTitle);
        $query->bindParam(3, $imgDescription);
        $query->bindParam(4,$user_id);
        $query->execute();

        $last_post_id = $db->lastInsertId();
        $query2 = $db->prepare("INSERT INTO `likes` (`LikeID`, `Likes`, `Dislikes`, `PostID`) VALUES (NULL, '0', '0', '{$last_post_id}')");
        $query2->execute();

        header("Location: index2.php");






    }

    function showPost()
    {

    }

    function editPost()
    {

    }

    function deletePost()
    {

    }

    function showAllPosts()
    {

    }

}

function likePost() {

}

function dislikePost() {


}