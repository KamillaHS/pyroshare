<?php require_once('../../database/dbcon.php'); ?>
<?php require_once("../includes/session.php"); ?>

<link href="../../css/login.style.css" rel="stylesheet">
<script src="../../js/uploadPost.js"></script>

<?php

// START FORM PROCESSING
if (isset($_POST['submitLogin'])
    && !empty($_POST['email'])
    && !empty($_POST['pass'])) { // Form has been submitted.
    $email = htmlspecialchars($_POST['email']);
    $password = $_POST['pass'];
    $password_hashed = sha1($password);

    $dbCon = dbCon($user, $pass);
    $query = $dbCon->prepare("SELECT `UserID`, `Username`, `Email`, `Password`
                                        FROM `user`
                                        WHERE `Email` = ?");

    $query->bindParam(1, $email);


    $query->execute();
    $getUser = $query->fetch();

    if($password_hashed == $getUser['Password']){
        $_SESSION['user_id'] = $getUser['UserID'];
        $_SESSION['username'] = $getUser['Username'];
        echo "Hello " . $_SESSION['username'];
        header("Location: index2.php");
    } else {
        echo "Something went wrong";
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

<div id="opacity-background">
    <!-- Popup Div Starts Here -->
    <div id="uploadPost">
        <!-- Login Form -->
        <form action="" id="login-form" method="POST" name="login">
            <i id="close" class="material-icons" onclick="div_hide()">clear</i>
            <h2 id="popupTitle">Login</h2>
            <input id="email" name="email" placeholder="Email" type="email" value="" />
            <input id="pass" name="pass" placeholder="Password" type="password" value="" />
            <button type="submit" value="Login" id="login-form-button" class="waves-effect waves-light btn" name="submitLogin">Login</button>
<!--            <button href="" id="register-form-button" class="waves-effect waves-light btn" name="SubmitRegister">Sign Up</button>-->
        </form>
    </div>
    <!-- Popup Div Ends Here -->
</div>

