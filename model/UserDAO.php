<?php

class UserDAO {
    function createUser() {
        $email = htmlspecialchars($_POST['email']);
        $username = htmlspecialchars($_POST['username']);
        $country = htmlspecialchars($_POST['country']);
        $dateofbirth = htmlspecialchars($_POST['dob']);
        $password = htmlspecialchars(sha1($_POST['pass']));

//    $dbCon = dbCon($user, $pass);
//    $sql = "INSERT INTO `user` (`UserID`, `Username`, `Password`, `Email`, `Country`, `Birthday`, `ProfilePic`, `ProfileCover`, `IsBanned`)
//                        VALUES (NULL, '$username', '$password', '$email', '$country', '$dateofbirth', NULL, NULL, b'0')";
//    $query = $dbCon->prepare($sql);
//    $query->execute();

        // DELETE THIS IF NOTHING WORKS

        $user = 'surcrit_dk';
        $pass = 'succeeded';

        $dbCon = dbCon($user, $pass);

        $sql = "SELECT `user`.Username, `user`.Email FROM `user` WHERE `user`.Username = ? OR `user`.Email = ?";
        $query = $dbCon->prepare($sql);
        $query->bindParam(1, $username);
        $query->bindParam(2, $email);
        $query->execute();
        $getUsers = $query->fetchAll();

        if(count($getUsers) > 0) {
            echo "<script>alert('The Username or Email is already in use')</script>";
        } else {
            $sql = "INSERT INTO `user` (`UserID`, `Username`, `Password`, `Email`, `Country`, `Birthday`, `ProfilePic`, `ProfileCover`, `IsBanned`)
                        VALUES (NULL, ?, ?, ?, ?, ?, NULL, NULL, b'0')";

            $query = $dbCon->prepare($sql);

            $query->bindParam(1, $username);
            $query->bindParam(2,$password);
            $query->bindParam(3, $email);
            $query->bindParam(4, $country);
            $query->bindParam(5, $dateofbirth);

            $query->execute();


            // ENDS HERE


            $last_id = $dbCon->lastInsertId();
            $query2 = $dbCon->prepare("SELECT `UserID`, `Username`, `Email`, `Password`
                                        FROM `user`
                                        WHERE `UserID` = '{$last_id}'");
            $query2->execute();
            $getUser = $query2->fetch();

            if($query){
                $_SESSION['user_id'] = $getUser['UserID'];
                $_SESSION['username'] = $getUser['Username'];
                echo "<script>location.href = 'index2.php'</script>";
            } else {
                echo "Something went wrong";
            }
        }
    }

    function showUser() {

    }

    function editUserInfo($id) {
        $email = $_POST['email'];
        $country = $_POST['country'];
        $dob = $_POST['dob'];

        $user = 'surcrit_dk';
        $pass = 'succeeded';
        $dbCon = dbCon($user, $pass);
        $sql = "UPDATE `user` SET `Email` = '$email', `Country` = '$country', `Birthday` = '$dob' WHERE UserID = '$id'";
        $query = $dbCon->prepare($sql);
        $query->execute();

        echo "<script>location.href = 'profile.php'</script>";
    }

    function editUserPic($id)
    {


        if (isset($_POST['submitUserPic'])) {
            if (($_FILES['profile-pic']['type'] == "image/jpeg" ||
                    $_FILES['profile-pic']['type'] == "image/pjpeg" ||
                    $_FILES['profile-pic']['type'] == "image/png" ||
                    $_FILES['profile-pic']['type'] == "image/gif" ||
                    $_FILES['profile-pic']['type'] == "image/jpg") && (
                    $_FILES['profile-pic']['size'] < 5000000
                )) {
                if ($_FILES['profile-pic']['error'] > 0) {
                    echo "Error: " . $_FILES['profile-pic']['error'];
                } else {
                    echo "Name: " . $_FILES['profile-pic']['name'] . "<br>";
                    echo "Type: " . $_FILES['profile-pic']['type'] . "<br>";
                    echo "Size: " . ($_FILES['profile-pic']['size'] / 1024) . "<br>";
                    echo "Tmp_name: " . $_FILES['profile-pic']['tmp_name'] . "<br>";
                    if (file_exists("../../upload/ProfilePics/" . preg_replace('/\s/', '', $_FILES['profile-pic']['name']))) {
                        echo "can't upload: " . preg_replace('/\s/', '', $_FILES['profile-pic']['name']) . " Exists";
                    } else {
                        move_uploaded_file($_FILES['profile-pic']['tmp_name'],
                            "../../upload/ProfilePics/" . preg_replace('/\s/', '', $_FILES['profile-pic']['name']));
                        echo "stored in: ../../upload/ProfilePics/" . $_FILES['profile-pic']['name'];


                        $user = 'surcrit_dk';
                        $pass = 'succeeded';
                        $dbCon = dbCon($user, $pass);
                        $sql = "UPDATE `user` SET `ProfilePic` = '" . preg_replace('/\s/', '', $_FILES['profile-pic']['name']) . "' WHERE UserID = '$id'";
                        $query = $dbCon->prepare($sql);
                        $query->execute();

                        echo "<script>location.href = 'profile.php'</script>";

                    }
                }
            }

        }
    }

    function editUserCov($id) {
        $cover = $_POST['profile-cov'];

        $user = 'surcrit_dk';
        $pass = 'succeeded';
        $dbCon = dbCon($user, $pass);
        $sql = "UPDATE `user` SET `ProfileCover` = '$cover' WHERE UserID = '$id'";
        $query = $dbCon->prepare($sql);
        $query->execute();

        echo "<script>location.href = 'profile.php'</script>";
    }

    function editUserPass($id) {
        $password = $_POST['pass'];

        $user = 'surcrit_dk';
        $pass = 'succeeded';
        $dbCon = dbCon($user, $pass);
        $sql = "UPDATE `user` SET `Password` = '$password' WHERE UserID = '$id'";
        $query = $dbCon->prepare($sql);
        $query->execute();

        echo "<script>location.href = 'profile.php'</script>";
    }

    function verifyUser() {

    }

    function banUser($userID) {
        require_once '../database/dbcon.php';
        $user = 'surcrit_dk';
        $pass = 'succeeded';
        $dbCon = dbCon($user, $pass);

        $sql = "UPDATE `user` SET isBanned = 1 WHERE UserID = '$userID'";
        $query = $dbCon->prepare($sql);
        $query->execute();
    }

    function unbanUser($userID) {
        require_once '../database/dbcon.php';
        $user = 'surcrit_dk';
        $pass = 'succeeded';
        $dbCon = dbCon($user, $pass);

        $sql = "UPDATE `user` SET isBanned = 0 WHERE UserID = '$userID'";
        $query = $dbCon->prepare($sql);
        $query->execute();
    }

    function makeUserMod($userID) {
        require_once '../database/dbcon.php';
        $user = 'surcrit_dk';
        $pass = 'succeeded';
        $dbCon = dbCon($user, $pass);

        $sql = "UPDATE `user` SET Role = 'mod' WHERE UserID = '$userID'";
        $query = $dbCon->prepare($sql);
        $query->execute();
    }

    function makeUserUser($userID) {
        require_once '../database/dbcon.php';
        $user = 'surcrit_dk';
        $pass = 'succeeded';
        $dbCon = dbCon($user, $pass);

        $sql = "UPDATE `user` SET Role = 'user' WHERE UserID = '$userID'";
        $query = $dbCon->prepare($sql);
        $query->execute();
    }

    function deleteUser($userID) {
        require_once '../database/dbcon.php';
        $user = 'surcrit_dk';
        $pass = 'succeeded';
        $dbCon = dbCon($user, $pass);

        $dbCon->beginTransaction();

        // Delete user comments
        $handle = $dbCon->prepare("DELETE FROM comment WHERE UserID = '$userID'");
        $handle->execute();

        // Delete likes on user posts
        $handle = $dbCon->prepare("DELETE `likes`.LikeID, `likes`.Likes, `likes`.Dislikes, `likes`.PostID
                                             FROM likes, `user`, `post` 
                                             WHERE post.UserID = `user`.`UserID` && post.PostID = likes.PostID && `user`.`UserID` = '$userID'");
        $handle->execute();

        // Delete comments on user posts
        $handle = $dbCon->prepare("DELETE comment.CommentID, comment.Description, comment.Likes, comment.CreatedAt, comment.PostID, comment.UserID
                                             FROM comment, `user`, `post`
                                             WHERE `comment`.`PostID` = `post`.`PostID` && `comment`.`UserID` = `user`.`UserID` && `user`.`UserID` = '$userID'");
        $handle->execute();

        // Delete user posts
        $handle = $dbCon->prepare("DELETE FROM `post` WHERE UserID = '$userID'");
        $handle->execute();

        // Delete user
        $handle = $dbCon->prepare("DELETE FROM `user` WHERE UserID = '$userID'");
        $handle->execute();

        $dbCon->commit();


//        echo "<script>location.href = 'profile.php'</script>";

    }
}
