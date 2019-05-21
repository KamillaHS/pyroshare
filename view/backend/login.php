<?php require_once('../../database/dbcon.php'); ?>
<?php require_once("includes/session.php"); ?>
<?php
if (logged_in()) {
    // header("Location: index.php");
    echo "<script>location.href = 'index.php'</script>";
}
?>

<head>
    <!--Import Google Icon Font-->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <!-- Compiled and minified CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
    <script src="https://code.jquery.com/jquery-2.1.3.min.js"></script>
    <!--Let browser know website is optimized for mobile-->
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>

    <!-- Custom CSS -->
    <link rel="stylesheet" href="../../css/adminLogin.style.css">

    <title>PyroShare Admin Login</title>

    <!--Changing browser icon to our logo-->
    <link rel="apple-touch-icon" sizes="57x57" href="/logo/favicon/apple-icon-57x57.png">
    <link rel="apple-touch-icon" sizes="60x60" href="/logo/favicon/apple-icon-60x60.png">
    <link rel="apple-touch-icon" sizes="72x72" href="/logo/favicon/apple-icon-72x72.png">
    <link rel="apple-touch-icon" sizes="76x76" href="/logo/favicon/apple-icon-76x76.png">
    <link rel="apple-touch-icon" sizes="114x114" href="/logo/favicon/apple-icon-114x114.png">
    <link rel="apple-touch-icon" sizes="120x120" href="/logo/favicon/apple-icon-120x120.png">
    <link rel="apple-touch-icon" sizes="144x144" href="/logo/favicon/apple-icon-144x144.png">
    <link rel="apple-touch-icon" sizes="152x152" href="/logo/favicon/apple-icon-152x152.png">
    <link rel="apple-touch-icon" sizes="180x180" href="/logo/favicon/apple-icon-180x180.png">
    <link rel="icon" type="image/png" sizes="192x192"  href="/logo/favicon/android-icon-192x192.png">
    <link rel="icon" type="image/png" sizes="32x32" href="/logo/favicon/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="96x96" href="/logo/favicon/favicon-96x96.png">
    <link rel="icon" type="image/png" sizes="16x16" href="/logo/favicon/favicon-16x16.png">
    <link rel="manifest" href="/logo/favicon/manifest.json">
    <meta name="msapplication-TileColor" content="#ffffff">
    <meta name="msapplication-TileImage" content="/logo/favicon/ms-icon-144x144.png">
    <meta name="theme-color" content="#ffffff">
</head>

<!--<link href="../../css/login.style.css" rel="stylesheet">-->
<!--<script src="../../js/uploadPost.js"></script>-->

<?php

// START FORM PROCESSING
if (isset($_POST['submitLogin'])
    && !empty($_POST['username'])
    && !empty($_POST['pass'])) { // Form has been submitted.
    $username = htmlspecialchars($_POST['username']);
    $password = $_POST['pass'];
    $password_hashed = sha1($password);

    $dbCon = dbCon($user, $pass);
    $query = $dbCon->prepare("SELECT * FROM `admin` WHERE `Username` = ?");

    $query->bindParam(1, $username);
    $query->execute();
    $getAdmin = $query->fetch();

    if($password_hashed == $getAdmin['Password']){
        $_SESSION['admin_id'] = $getAdmin['AdminID'];
        $_SESSION['username'] = $getAdmin['Username'];
        echo "Hello " . $_SESSION['username'];
        // header("Location: index.php");
        echo "<script>location.href = 'index.php'</script>";
    } else {
        echo '<script type="text/javascript">alert("Something went wrong! Please try again");</script>';
        // username/password combo was not found in the database
//            $message = "Username/password combination incorrect.<br />
//					Please make sure your caps lock key is off and try again.";
    }
}
else { // Form has not been submitted.
    if (isset($_GET['logout']) && $_GET['logout'] == 1) {
        $message = "You are now logged out.";
    }
}
if (!empty($message)) {echo "<p>" . $message . "</p>";}

?>

<div id="admin-login">
    <form action="" id="login-form" method="POST" name="login">
        <h2 id="admin-login-title">Login</h2>
        <input id="admin-username" name="username" placeholder="Username" type="text" value="" />
        <input id="admin-pass" name="pass" placeholder="Password" type="password" value="" />
        <button type="submit" value="Login" id="admin-login-button" class="waves-effect waves-light btn" name="submitLogin">Login</button>
    </form>
</div>
