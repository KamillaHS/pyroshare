<?php
require( __DIR__ . "/../view/includes/signUp.php" );
if (isset($_GET['action'])) {


    $action = $_GET["action"];

    if ($action == "create") {
        $email = $_POST["email"];
        $username = $_POST["username"];
        $country = $_POST["country"];
        $birthday = $_POST["birthday"];
        $password = $_POST['password'];
        createUser($email, $username, $country, $birthday, $password);
    }
}
