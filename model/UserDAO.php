<?php

class UserDAO {
    function createUser() {
        $email = htmlspecialchars($_POST['email']);
        $username = htmlspecialchars($_POST['username']);
        $country = htmlspecialchars($_POST['country']);
        $dateofbirth = htmlspecialchars($_POST['dob']);
        $password = htmlspecialchars(sha1($_POST['pass']));
        $regex = "/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$/";

//    $dbCon = dbCon($user, $pass);
//    $sql = "INSERT INTO `user` (`UserID`, `Username`, `Password`, `Email`, `Country`, `Birthday`, `ProfilePic`, `ProfileCover`, `IsBanned`)
//                        VALUES (NULL, '$username', '$password', '$email', '$country', '$dateofbirth', NULL, NULL, b'0')";
//    $query = $dbCon->prepare($sql);
//    $query->execute();

        // DELETE THIS IF NOTHING WORKS


        //if( filter_var( $email ,FILTER_VALIDATE_EMAIL ) )
        if (preg_match($regex, $email))
        {
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
        }

        else {

                $sql = "INSERT INTO `user` (`UserID`, `Username`, `Password`, `Email`, `Country`, `Birthday`, `ProfilePic`, `ProfileCover`, `IsBanned`)
                        VALUES (NULL, ?, ?, ?, ?, ?, NULL, NULL, b'0')";

                $query = $dbCon->prepare($sql);

                $query->bindParam(1, $username);
                $query->bindParam(2, $password);
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

                if ($query) {
                    $_SESSION['user_id'] = $getUser['UserID'];
                    $_SESSION['username'] = $getUser['Username'];
                    echo "<script>location.href = 'index2.php'</script>";
                } else {
                    echo "Something went wrong";
                }
            }

        }else {
            echo "<script>alert('Please use a valid email!!'); location.href = 'index.php';</script>";
        }
    }

    function editUserInfo($id) {
        $email = htmlspecialchars($_POST['email']);
        $country = htmlspecialchars($_POST['country']);
        $dob = htmlspecialchars($_POST['dob']);

        $user = 'surcrit_dk';
        $pass = 'succeeded';
        $dbCon = dbCon($user, $pass);
        $sql = "UPDATE `user` SET `Email` = ?, `Country` = ?, `Birthday` = ? WHERE UserID = '$id'";
        $query = $dbCon->prepare($sql);
        $query->bindParam(1, $email);
        $query->bindParam(2, $country);
        $query->bindParam(3, $dob);
        $query->execute();

        echo "<script>location.href = 'profile.php'</script>";
    }

    function adminEditUser($userID) {
        require_once '../database/dbcon.php';

        $country = htmlspecialchars($_POST['country']);
        $dob = htmlspecialchars($_POST['dob']);

        $user = 'surcrit_dk';
        $pass = 'succeeded';
        $dbCon = dbCon($user, $pass);
        $sql = "UPDATE `user` SET `Country` = ?, `Birthday` = ? WHERE UserID = '$userID'";
        $query = $dbCon->prepare($sql);
        $query->bindParam(1, $country);
        $query->bindParam(2, $dob);
        $query->execute();
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
                        $filepath = "../../upload/ProfilePics/";

                        // Getting current filename
                        $profilePictureFilename = $dbCon->prepare("SELECT ProfilePic FROM `user` WHERE UserID='$id'");
                        $profilePictureFilename->execute();
                        $result = $profilePictureFilename->fetchAll(\PDO::FETCH_ASSOC);



                        // Deleting existing file in upload folder
                        foreach ($result as $picName) {
                            $profilePictureFile = $filepath . $picName['ProfilePic'];

                            unlink($profilePictureFile);


                        }



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
        $cover = htmlspecialchars($_POST['profile-cov']);

        $user = 'surcrit_dk';
        $pass = 'succeeded';
        $dbCon = dbCon($user, $pass);
        $sql = "UPDATE `user` SET `ProfileCover` = ? WHERE UserID = '$id'";
        $query = $dbCon->prepare($sql);
        $query->bindParam(1, $cover);
        $query->execute();

        echo "<script>location.href = 'profile.php'</script>";
    }

    function editUserPass($id) {
        $password = htmlspecialchars(sha1($_POST['pass']));

        $user = 'surcrit_dk';
        $pass = 'succeeded';
        $dbCon = dbCon($user, $pass);
        $sql = "UPDATE `user` SET `Password` = ? WHERE UserID = '$id'";
        $query = $dbCon->prepare($sql);
        $query->bindParam(1, $password);
        $query->execute();

        echo "<script>location.href = 'profile.php'</script>";
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

//        $dbCon->beginTransaction();
//
//        // Delete user comments
//        $handle = $dbCon->prepare("DELETE FROM comment WHERE UserID = '$userID'");
//        $handle->execute();
//
//        // Delete likes on user posts
//        $handle = $dbCon->prepare("DELETE `likes`.LikeID, `likes`.Likes, `likes`.Dislikes, `likes`.PostID
//                                             FROM likes, `user`, `post`
//                                             WHERE post.UserID = `user`.`UserID` && post.PostID = likes.PostID && `user`.`UserID` = '$userID'");
//        $handle->execute();
//
//        // Delete comments on user posts
//        $handle = $dbCon->prepare("DELETE comment.CommentID, comment.Description, comment.Likes, comment.CreatedAt, comment.PostID, comment.UserID
//                                             FROM comment, `user`, `post`
//                                             WHERE `comment`.`PostID` = `post`.`PostID` && `comment`.`UserID` = `user`.`UserID` && `user`.`UserID` = '$userID'");
//        $handle->execute();
//
//        // Delete user posts
//        $handle = $dbCon->prepare("DELETE FROM `post` WHERE UserID = '$userID'");
//        $handle->execute();
//
//        // Delete user
//        $handle = $dbCon->prepare("DELETE FROM `user` WHERE UserID = '$userID'");
//        $handle->execute();
//
//        $dbCon->commit();

        $sql = "DELETE FROM `user` WHERE UserID = '$userID'";
        $query = $dbCon->prepare($sql);
        $query->execute();

//        echo "<script>location.href = 'profile.php'</script>";

    }
}
