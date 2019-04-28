<?php

class AdminDAO {
    function createAdmin() {
        $username = htmlspecialchars($_POST['username']);
        $password = htmlspecialchars($_POST['pass']);
        $password_hashed = sha1($password);

        $user = 'surcrit_dk';
        $pass = 'succeeded';

        $dbCon = dbCon($user, $pass);
        $sql = "INSERT INTO `admin` (`AdminID`, `Username`, `Password`) VALUES (NULL, ?, ?)";

        $query = $dbCon->prepare($sql);
        $query->bindParam(1, $username);
        $query->bindParam(2, $password_hashed);
        $query->execute();

    }

    function showAdmin() {

    }

    function editAdminUsername($id) {
        $username = $_POST['username'];

        $user = 'surcrit_dk';
        $pass = 'succeeded';
        $dbCon = dbCon($user, $pass);
        $sql = "UPDATE `admin` SET `Username` = '$username' WHERE AdminID = '$id'";
        $query = $dbCon->prepare($sql);
        $query->execute();

        echo "<script>location.href = 'index.php'</script>";
    }

    function editAdminPass($id) {
        $password = $_POST['pass'];

        $user = 'surcrit_dk';
        $pass = 'succeeded';
        $dbCon = dbCon($user, $pass);
        $sql = "UPDATE `admin` SET `Password` = '$password' WHERE AdminID = '$id'";
        $query = $dbCon->prepare($sql);
        $query->execute();

        echo "<script>location.href = 'index.php'</script>";
    }

    function deleteAdmin() {

    }

    function verifyAdmin() {

    }
}
