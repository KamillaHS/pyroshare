<?php require_once('../../database/dbcon.php'); ?>
<?php require_once("includes/session.php"); ?>
<?php
if (logged_in()) {
    header("Location: index.php");
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
        header("Location: index.php");
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
