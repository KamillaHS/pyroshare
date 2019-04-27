<?php


class PostDAO
{

    public function createPost()
    {

        $imgURL = htmlspecialchars($_POST['img']);
        $imgTitle = htmlspecialchars($_POST['imgTitle']);
        $imgDescription = htmlspecialchars($_POST['imgDescription']);
        $user_id = htmlspecialchars($_SESSION['user_id']);

        $user = 'root';
        $pass = '123456';
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

        header("Location: index2.php");


    }

    function showPost()
    {

    }

    function editPost($id)
    {
        $imgURL = $_POST['img'];
        $imgTitle = $_POST['imgTitle'];
        $imgDescription = $_POST['imgDescription'];

        $user = 'root';
        $pass = '123456';
        $dbCon = dbCon($user, $pass);
        $sql = "UPDATE `post` SET `Img` = '$imgURL', `Title` = '$imgTitle', `Description` = '$imgDescription' WHERE PostID = '$id'";
        $query = $dbCon->prepare($sql);
        $query->execute();

        header("Location: profile.php");
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