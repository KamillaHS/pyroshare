<?php require_once("../../database/connection.php"); ?>
<?php require_once("../../database/dbcon.php"); ?>

<!DOCTYPE html>
<html>
<head>
    <!--Import Google Icon Font-->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <!-- Compiled and minified CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
    <script src="https://code.jquery.com/jquery-2.1.3.min.js"></script>
    <!--Let browser know website is optimized for mobile-->
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>

    <!-- Custom CSS in SASS -->
    <link rel="stylesheet" href="../../css/style.scss">

    <title>Document</title>
</head>
<body>

<header>
    <nav>
        <div class="nav-wrapper">
            <div id="logo-box">
                <a href="#" class="brand-logo left">Logo</a>
            </div>
            <form id="search-bar">
                <div class="input-field">
                    <input id="search" type="search" required>
                    <label class="label-icon" id="search-icon" for="search"><i class="material-icons">search</i></label>
                    <i class="material-icons" id="close-icon">close</i>
                </div>
            </form>
            <ul id="nav-items" class="right">
                <li><a href="/">Explore</a></li>
                <li><a href="/">About PS</a></li>
                <li><a class="waves-effect waves-light btn" id="login-button" href="/">Login</a></li>
                <li><a class="waves-effect waves-light btn" id="signup-button" href="/">Sign Up</a></li>

            </ul>
        </div>
    </nav>
</header>
