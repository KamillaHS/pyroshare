<?php
require_once(__DIR__ . '/../model/AdminDAO.php');


if($_SERVER['REQUEST_METHOD'] == 'POST') {
    $action = $_GET["action"];

    if ($action == "AdminChangeTheme")
    {
        if(isset($_POST["radio"])) {
            $radioID = $_POST['radio'];

            $changeTheme = new AdminDAO();
            $changeTheme->changeBackendTheme($radioID);

        }

         echo "<script>location.href = '../view/backend/adminSettings.php'</script>";
    }
}