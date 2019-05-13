<?php // require_once('../../database/dbcon.php'); ?>
<?php require_once("../includes/session.php"); ?>
<?php require_once('../../model/UserDAO.php') ?>

<link href="../../css/register.style.css" rel="stylesheet">
<script src="../../js/uploadPost.js"></script>

<?php


// START FORM PROCESSING
if (isset($_POST['submitRegister'])
    && !empty($_POST['email'])
    && !empty($_POST['pass'])) { // Form has been submitted.



//    $email = htmlspecialchars($_POST['email']);
//    $username = htmlspecialchars($_POST['username']);
//    $country = htmlspecialchars($_POST['country']);
//    $dateofbirth = htmlspecialchars($_POST['dob']);
//    $password = htmlspecialchars(sha1($_POST['pass']));

//    $dbCon = dbCon($user, $pass);
//    $sql = "INSERT INTO `user` (`UserID`, `Username`, `Password`, `Email`, `Country`, `Birthday`, `ProfilePic`, `ProfileCover`, `IsBanned`)
//                        VALUES (NULL, '$username', '$password', '$email', '$country', '$dateofbirth', NULL, NULL, b'0')";
//    $query = $dbCon->prepare($sql);
//    $query->execute();

    // DELETE THIS IF NOTHING WORKS

//    $dbCon = dbCon($user, $pass);
//    $sql = "INSERT INTO `user` (`UserID`, `Username`, `Password`, `Email`, `Country`, `Birthday`, `ProfilePic`, `ProfileCover`, `IsBanned`)
//                        VALUES (NULL, ?, ?, ?, ?, ?, NULL, NULL, b'0')";
//
//    $query = $dbCon->prepare($sql);
//
//    $query->bindParam(1, $username);
//    $query->bindParam(2,$password);
//    $query->bindParam(3, $email);
//    $query->bindParam(4, $country);
//    $query->bindParam(5, $dateofbirth);
//
//    $query->execute();
//
//
//
//
//    // ENDS HERE
//
//
//    $last_id = $dbCon->lastInsertId();
//    $query2 = $dbCon->prepare("SELECT `UserID`, `Username`, `Email`, `Password`
//                                        FROM `user`
//                                        WHERE `UserID` = '{$last_id}'");
//    $query2->execute();
//    $getUser = $query2->fetch();
//
//    if($query){
//        $_SESSION['user_id'] = $getUser['UserID'];
//        $_SESSION['username'] = $getUser['Username'];
//        header("Location: index2.php");
//    } else {
//        echo "Something went wrong";
////            $message = "Username/password combination incorrect.<br />
////					Please make sure your caps lock key is off and try again.";
//    }

    $createUser = new UserDAO();
    $createUser->createUser();
}
else { // Form has not been submitted.
    if (isset($_GET['logout']) && $_GET['logout'] == 1) {
        $message = "You are now logged out.";
    }
}

?>

<div id="opacity-background2">
    <!-- Popup Div Starts Here -->
    <div id="uploadPost">
        <!-- Login Form -->
        <form action="" id="register-form" method="POST" name="register">
            <i id="close" class="material-icons" onclick="div2_hide()">clear</i>
            <h2 id="popupTitle">Sign Up</h2>
            <input id="email" name="email" placeholder="Email" type="email" value="" required />
            <input id="username" name="username" placeholder="Username" type="text" value="" required />
            <input id="country" name="country" placeholder="Country" type="text" value="" />
            <input id="dob" name="dob" placeholder="Date of birth" type="date" value="" />
            <input id="pass" name="pass" placeholder="Password" type="password" value="" required />
            <button href="" id="register-form-button" class="waves-effect waves-light btn" name="submitRegister">Sign Up</button>
        </form>
    </div>
    <!-- Popup Div Ends Here -->
</div>

