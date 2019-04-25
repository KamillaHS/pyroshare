<?php

class UserDAO {
    function createUser() {

    }

    function showUser() {

    }

    function editUser($id) {
        $password = $_POST['pass'];
        $email = $_POST['email'];
        $country = $_POST['country'];
        $dob = $_POST['dob'];

        $user = 'root';
        $pass = '123456';
        $dbCon = dbCon($user, $pass);
        $sql = "UPDATE `user` SET `Password` = '$password', `Email` = '$email', `Country` = '$country', `Birthday` = '$dob' WHERE UserID = '$id'";
        $query = $dbCon->prepare($sql);
        $query->execute();

        header("Location: profile.php");
    }

    function deleteUser() {

    }

    function verifyUser() {

    }
}
