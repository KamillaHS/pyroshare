<?php
session_start();
require( __DIR__ . "/../../database/dbcon.php" );





    try {
        global $cxn;

        if (isset($_POST['logIn'])) {

            if (isset($_POST['logInUsername']) && isset($_POST['logInPassword'])) {
                // Getting submitted user data from database
                $handle = $cxn->prepare("SELECT * FROM `user` WHERE username = ? AND password = ?");
                $handle->bindParam(1, $_POST['logInUsername']);
                $handle->bindParam(2, $_POST['logInPassword']);
                $handle->execute();
                $user = $handle->fetchObject();

                $cxn = null;

                // Verify user password and set $_SESSION
                /* if (password_verify($_POST['logInPassword'], $user->Password)) {
                    $_SESSION['user_id'] = $user->UserID;

                } */

                $_SESSION['user_id'] = $user->UserID;
                if (isset($_SESSION['user_id'])) {
                    header("Location: loggedIn.php");
                    die();
                } else {
                    header("Location: loggedIn.php");
                }

            }

        }


    } catch (\PDOException $ex) {
        print($ex->getMessage());
    }





?>


<html lang="en">
<body>
<div id="logInForm">
    <form method="post" action="">
        <input type="text" name="logInUsername" placeholder="Username" required>
        <br><br>
        </input>
        <input type="password" name="logInPassword" placeholder="Password" required>
        <br><br>
        </input>
        <input type="submit" name="logIn" value="Log In">
    </form>
</div>
</body>
</html>