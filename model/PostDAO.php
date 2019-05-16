<?php

class PostDAO
{

    public function createPost()
    {
        require_once ('../view/includes/session.php');
        require_once ('../database/dbcon.php');
        // require_once ('../view/frontend/uploadPost.php');
        //$imgURL = htmlspecialchars($_POST['imgfile']);
        $imgTitle = htmlspecialchars($_POST['imgTitle']);
        $imgDescription = htmlspecialchars($_POST['imgDescription']);
        $user_id = htmlspecialchars($_SESSION['user_id']);
        //$stripped = preg_replace('/\s/', '', $sentence);

        if (isset($_POST['uploadPost'])){
            if(($_FILES['imgfile']['type']=="image/jpeg" ||
                    $_FILES['imgfile']['type']=="image/pjpeg" ||
                    $_FILES['imgfile']['type']=="image/png" ||
                    $_FILES['imgfile']['type']=="image/gif" ||
                    $_FILES['imgfile']['type']=="image/jpg")&& (
                    $_FILES['imgfile']['size']< 50000000
                )){
                if ($_FILES['imgfile']['error']>0){
                    echo "Error: ". $_FILES['imgfile']['error'];
                }else{
                    echo "Name: ".$_FILES['imgfile']['name']."<br>";
                    echo "Type: ".$_FILES['imgfile']['type']."<br>";
                    echo "Size: ".($_FILES['imgfile']['size']/1024)."<br>";
                    echo "Tmp_name: ".$_FILES['imgfile']['tmp_name']."<br>";
                    if (file_exists("../upload/Pics/". preg_replace('/\s/', '', $_FILES['imgfile']['name']))){
                        echo "can't upload: ". preg_replace('/\s/', '', $_FILES['imgfile']['name']). " Exists";
                    }else{
                        move_uploaded_file($_FILES['imgfile']['tmp_name'],
                            "../upload/Pics/".preg_replace('/\s/', '',$_FILES['imgfile']['name']));
                        echo "stored in: ../upload/Pics/".$_FILES['imgfile']['name'];
//                        $conn = mysqli_connect("localhost","surcrit_dk","succeeded","pyrosharedb");
//                        $sql = "INSERT INTO imgs (ID, filename) VALUES
//                        (NULL, '". $_FILES['imgfile']['name']."')";
//                        echo $sql;
//                        mysqli_query($conn,$sql);

                        $user = 'surcrit_dk';
                        $pass = 'succeeded';
                        $dbCon = dbCon($user, $pass);


                        $sql = "INSERT INTO `post` (`PostID`, `Img`, `Title`, `Description`, `UploadedAt`, `isHot`, `isSticky`, `UserID`)
                        VALUES (NULL, '". preg_replace('/\s/', '', $_FILES['imgfile']['name'])."', ?, ?, CURRENT_TIMESTAMP, b'0', b'0', ?)";
                        $query = $dbCon->prepare($sql);

                        //$query->bindParam(1,$imgURL);
                        $query->bindParam(1, $imgTitle);
                        $query->bindParam(2, $imgDescription);
                        $query->bindParam(3,$user_id);
                        $query->execute();

                        $last_post_id = $dbCon->lastInsertId();
                        $query2 = $dbCon->prepare("INSERT INTO `likes` (`LikeID`, `Likes`, `Dislikes`, `PostID`) VALUES (NULL, '0', '0', '{$last_post_id}')");
                        $query2->execute();

                        $category = $_POST['imgCategory'];
                        $query3 = $dbCon->prepare("INSERT INTO `postcat` (`PostID`, `CategoryID`) VALUES ({$last_post_id}, {$category})");
                        $query3->execute();
                    }
                }
            }
        }

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

    function AdminEditPost($id)
    {
        require_once '../database/dbcon.php';
        $imgTitle = $_POST['imgTitle'];
        $imgDescription = $_POST['imgDescription'];

        $user = 'surcrit_dk';
        $pass = 'succeeded';
        $dbCon = dbCon($user, $pass);
        $sql = "UPDATE `post` SET `Title` = '$imgTitle', `Description` = '$imgDescription', `isFlagged` = 0 WHERE PostID = '$id'";
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
        $filepath = "../upload/Pics/";
        $dbCon = dbCon($user, $pass);
//        $sql = "DELETE FROM likes WHERE PostID='$id'; DELETE FROM post WHERE PostID='$id'; DELETE FROM comment WHERE PostID='$id';  " ;
//        $query = $dbCon->prepare($sql);
//        $query->execute();

        // Getting current filename
        $postFilename = $dbCon->prepare("SELECT Img FROM post WHERE PostID='$id'");
        $postFilename->execute();
        $result = $postFilename->fetchAll(\PDO::FETCH_ASSOC);



        // Deleting existing file in upload folder
        foreach ($result as $imgName) {
            $postFile = $filepath . $imgName['Img'];
            unlink($postFile);
        }

        $dbCon->beginTransaction();

        $handle = $dbCon->prepare("DELETE FROM likes WHERE PostID='$id'");
        $handle->execute();

        $handle = $dbCon->prepare("DELETE FROM comment WHERE PostID='$id'");
        $handle->execute();

        $handle = $dbCon->prepare("DELETE FROM post WHERE PostID='$id'");
        $handle->execute();


        $dbCon->commit();


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

    function makeHot($postID) {
        require_once '../database/dbcon.php';
        $user = 'surcrit_dk';
        $pass = 'succeeded';
        $dbCon = dbCon($user, $pass);

        $sqlSELECT = "SELECT PostID FROM post WHERE isHot = 1";
        $querySELECT = $dbCon->prepare($sqlSELECT);
        $querySELECT->execute();
        $getHots = $querySELECT->fetchAll();

        if(count($getHots) < 8) {
            $sql = "UPDATE post SET isHot = 1 WHERE PostID = '$postID'";
            $query = $dbCon->prepare($sql);
            $query->execute();

        } else {
            echo "<script>alert('You cannot have more than 8 Hot pictures')</script>";
        }
    }

    function makeNotHot($postID) {
        require_once '../database/dbcon.php';
        $user = 'surcrit_dk';
        $pass = 'succeeded';
        $dbCon = dbCon($user, $pass);
        $sql = "UPDATE post SET isHot = 0 WHERE PostID = '$postID'";
        $query = $dbCon->prepare($sql);
        $query->execute();
    }

    function makeSticky($postID) {
        require_once '../database/dbcon.php';
        $user = 'surcrit_dk';
        $pass = 'succeeded';
        $dbCon = dbCon($user, $pass);

        $sqlSELECT = "SELECT PostID FROM post WHERE isSticky = 1";
        $querySELECT = $dbCon->prepare($sqlSELECT);
        $querySELECT->execute();
        $getStickys = $querySELECT->fetchAll();

        if(count($getStickys) < 8) {
            $sql = "UPDATE post SET isSticky = 1 WHERE PostID = '$postID'";
            $query = $dbCon->prepare($sql);
            $query->execute();

        } else {
            echo "<script>alert('You cannot have more than 8 Sticky pictures')</script>";
        }
    }

    function makeNotSticky($postID) {
        require_once '../database/dbcon.php';
        $user = 'surcrit_dk';
        $pass = 'succeeded';
        $dbCon = dbCon($user, $pass);
        $sql = "UPDATE post SET isSticky = 0 WHERE PostID = '$postID'";
        $query = $dbCon->prepare($sql);
        $query->execute();
    }

    function flagPost($postID) {
        require_once '../database/dbcon.php';
        $user = 'surcrit_dk';
        $pass = 'succeeded';
        $dbCon = dbCon($user, $pass);
        $sql = "UPDATE post SET isFlagged = 1 WHERE PostID = '$postID'";
        $query = $dbCon->prepare($sql);
        $query->execute();
    }

    function unflagPost($postID) {
        require_once '../database/dbcon.php';
        $user = 'surcrit_dk';
        $pass = 'succeeded';
        $dbCon = dbCon($user, $pass);
        $sql = "UPDATE post SET isFlagged = 0 WHERE PostID = '$postID'";
        $query = $dbCon->prepare($sql);
        $query->execute();
    }

}
