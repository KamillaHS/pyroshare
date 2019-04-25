<?php require_once("includes/header.php"); ?>
<?php require_once('../../database/dbcon.php'); ?>
<?php require_once("includes/session.php"); ?>
<?php
if (!logged_in()) {
    header("Location: login.php");
}
?>
<link href="../../css/adminAdd.style.css" rel="stylesheet">


<?php

// START FORM PROCESSING
if (isset($_POST['submitRegister'])
    && !empty($_POST['username'])
    && !empty($_POST['pass'])) { // Form has been submitted.

    $username = $_POST['username'];
    $password = $_POST['pass'];

    $dbCon = dbCon($user, $pass);
    $sql = "INSERT INTO `admin` (`AdminID`, `Username`, `Password`) VALUES (NULL, '$username', '$password')";
    $query = $dbCon->prepare($sql);
    $query->execute();

    $message = "The admin was added successfully";
}

?>

<div id="admin-content">
    <h3 id="admin-content-title">Add New Admin</h3>

    <hr>

    <p>Write the desired username and password for the new admin in the form below.</p>

    <div id="admin-add">
        <form action="" id="add-admin-form" method="POST" name="register">
            <input id="username" name="username" placeholder="Username" type="text" value="" required />
            <input id="pass" name="pass" placeholder="Password" type="password" value="" required />
            <button href="" id="admin-add-button" class="waves-effect waves-light btn" name="submitRegister">Add</button>

            <?php if (!empty($message)) {echo "<p>" . $message . "</p>";} ?>
        </form>
    </div>
</div>


<?php require_once("includes/footer.php"); ?>