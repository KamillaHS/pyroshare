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

        $user = 'root';
        $pass = '123456';

        $dbCon = dbCon($user, $pass);
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
            header("Location: index2.php");
        } else {
            echo "Something went wrong";

    }}

    function showUser() {

    }

    function editUserInfo($id) {
        $email = $_POST['email'];
        $country = $_POST['country'];
        $dob = $_POST['dob'];

        $user = 'root';
        $pass = '123456';
        $dbCon = dbCon($user, $pass);
        $sql = "UPDATE `user` SET `Email` = '$email', `Country` = '$country', `Birthday` = '$dob' WHERE UserID = '$id'";
        $query = $dbCon->prepare($sql);
        $query->execute();

        header("Location: profile.php");
    }

    function editUserPic($id) {
        $picture = $_POST['profile-pic'];

        $user = 'root';
        $pass = '123456';
        $dbCon = dbCon($user, $pass);
        $sql = "UPDATE `user` SET `ProfilePic` = '$picture' WHERE UserID = '$id'";
        $query = $dbCon->prepare($sql);
        $query->execute();

        header("Location: profile.php");
    }

    function editUserCov($id) {
        $cover = $_POST['profile-cov'];

        $user = 'root';
        $pass = '123456';
        $dbCon = dbCon($user, $pass);
        $sql = "UPDATE `user` SET `ProfileCover` = '$cover' WHERE UserID = '$id'";
        $query = $dbCon->prepare($sql);
        $query->execute();

        header("Location: profile.php");
    }

    function editUserPass($id) {
        $password = $_POST['pass'];

        $user = 'root';
        $pass = '123456';
        $dbCon = dbCon($user, $pass);
        $sql = "UPDATE `user` SET `Password` = '$password' WHERE UserID = '$id'";
        $query = $dbCon->prepare($sql);
        $query->execute();

        header("Location: profile.php");
    }

    function deleteUser() {

    }

    function verifyUser() {

    }
}
