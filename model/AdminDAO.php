<?php

class AdminDAO {
    function createAdmin() {

    }

    function showAdmin() {

    }

    function editAdminUsername($id) {
        $username = $_POST['username'];

        $user = 'root';
        $pass = '123456';
        $dbCon = dbCon($user, $pass);
        $sql = "UPDATE `admin` SET `Username` = '$username' WHERE AdminID = '$id'";
        $query = $dbCon->prepare($sql);
        $query->execute();

        header("Location: index.php");
    }

    function editAdminPass($id) {
        $password = $_POST['pass'];

        $user = 'root';
        $pass = '123456';
        $dbCon = dbCon($user, $pass);
        $sql = "UPDATE `admin` SET `Password` = '$password' WHERE AdminID = '$id'";
        $query = $dbCon->prepare($sql);
        $query->execute();

        header("Location: index.php");
    }

    function deleteAdmin() {

    }

    function verifyAdmin() {

    }
}
