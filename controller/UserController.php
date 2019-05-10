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

