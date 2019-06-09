<?php

class AdminDAO {
    function createAdmin() {
        $username = htmlspecialchars($_POST['username']);
        $password = htmlspecialchars($_POST['pass']);
        $password_hashed = sha1($password);

        $user = 'surcrit_dk';
        $pass = 'succeeded';

        $dbCon = dbCon($user, $pass);

        $sql = "SELECT Username FROM `admin` WHERE Username = ?";
        $query = $dbCon->prepare($sql);
        $query->bindParam(1, $username);
        $query->execute();
        $getAdminUsername = $query->fetchAll();

        if(count($getAdminUsername) > 0){
            echo "<script>alert('An Admin with this username already exist')</script>";
        } else {
            $sql = "INSERT INTO `admin` (`AdminID`, `Username`, `Password`) VALUES (NULL, ?, ?)";

            $query = $dbCon->prepare($sql);
            $query->bindParam(1, $username);
            $query->bindParam(2, $password_hashed);
            $query->execute();

            echo "<script>alert('The admin was added successfully')</script>";
        }

    }

//    function showAdmin() {
//
//    }

    function editAdminUsername($id) {
        $username = htmlspecialchars($_POST['username']);

        $user = 'surcrit_dk';
        $pass = 'succeeded';
        $dbCon = dbCon($user, $pass);
        $sql = "UPDATE `admin` SET `Username` = ? WHERE AdminID = '$id'";
        $query = $dbCon->prepare($sql);
        $query->bindParam(1, $username);
        $query->execute();

        echo "<script>location.href = 'index.php'</script>";
    }

    function editAdminPass($id) {
        $password = htmlspecialchars(sha1($_POST['pass']));

        $user = 'surcrit_dk';
        $pass = 'succeeded';
        $dbCon = dbCon($user, $pass);
        $sql = "UPDATE `admin` SET `Password` = ? WHERE AdminID = '$id'";
        $query = $dbCon->prepare($sql);
        $query->bindParam(1, $password);
        $query->execute();

        echo "<script>location.href = 'index.php'</script>";
    }

    function changeBackendTheme($themeID) {
        include('../database/dbcon.php');
        $user = 'surcrit_dk';
        $pass = 'succeeded';
        $dbCon = dbCon($user, $pass);


        $dbCon->beginTransaction();

        $handle = $dbCon->prepare("UPDATE `backendstyle` SET `isUsed` = 1 WHERE StyleID = '$themeID'");
        $handle->execute();

        $handle = $dbCon->prepare("UPDATE `backendstyle` SET `isUsed` = 0 WHERE StyleID != '$themeID'");
        $handle->execute();

        $dbCon->commit();
    }


//    function deleteAdmin() {
//
//    }
//
//    function verifyAdmin() {
//
//    }
}
