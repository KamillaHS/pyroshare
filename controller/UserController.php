<?php
require_once "../model/UserDAO.php";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $action = $_GET["action"];

    if ($action == "Ban")
    {
        if(isset($_POST['isBanned'])) {
            $userID = $_GET['userID'];

            $banUser = new UserDAO();
            $banUser->banUser($userID);

            echo "<script>location.href = '../view/backend/banUsers.php'</script>";
        } else {
            $userID = $_GET['userID'];

            $banUser = new UserDAO();
            $banUser->unbanUser($userID);;

            echo "<script>location.href = '../view/backend/banUsers.php'</script>";
        }
    }
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $action = $_GET["action"];

    if ($action == "AdminUserMod") {
        $userID = $_GET['userID'];

        $makeUserMod = new UserDAO();
        $makeUserMod->makeUserMod($userID);

        echo "<script>location.href = '../view/backend/accessAllUsers.php'</script>";

    } elseif ($action == "AdminUserUser") {
        $userID = $_GET['userID'];

        $makeUserMod = new UserDAO();
        $makeUserMod->makeUserUser($userID);

        echo "<script>location.href = '../view/backend/accessAllUsers.php'</script>";
    }


    elseif ($action == "AdminUserDelete") {
        $userID = $_GET['userID'];

        $deleteUser = new UserDAO();
        $deleteUser->deleteUser($userID);

        echo "<script>location.href = '../view/backend/accessAllUsers.php'</script>";
    }
}

