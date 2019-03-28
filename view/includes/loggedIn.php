<?php
session_start();
require( __DIR__ . "/../../database/dbcon.php" );

// Always start this first




if ( isset( $_SESSION['user_id'] ) ) {
    // Grab user data from the database using the user_id
    // Let them access the "logged in only" pages
    echo "WHAT NANI YOU ARE LOGGED IN!!!";
} else {
    // Redirect them to the login page
    // header("Location: logIn.php");
    echo "You are not logged in";
}





