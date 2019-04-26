<?php

class UserDAO {
    function createUser() {

    }

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
