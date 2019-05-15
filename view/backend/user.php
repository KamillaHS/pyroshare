<?php require_once('includes/header.php'); ?>
<?php
if (!logged_in()) {
    echo "<script>location.href = 'login.php'</script>";
}
?>
<?php
            $userID = $_GET['userID'];

            $dbCon = dbCon($user, $pass);
            $query = $dbCon->prepare("SELECT `user`.UserID, `user`.Username, `user`.Password, `user`.Email, `user`.Country, `user`.Birthday, `user`.ProfilePic, `user`.ProfileCover, `user`.Role, `user`.isBanned
                                                FROM `user`
                                                WHERE `user`.UserID = '$userID'");
            $query->execute();
            $getUser = $query->fetch();

            $uploadPath = "../../upload/ProfilePics/";
?>
    <link rel="stylesheet" href="../../css/adminUserPost.style.css">

    <div id="admin-content">
        <h3 id="admin-content-title">User: <?php echo $getUser['Username'] ?></h3>

        <hr>

        <a href="accessAllUsers.php" id="admin-back-button" class="waves-effect waves-light btn"><i class="material-icons">keyboard_arrow_left</i></a>

        <div id="admin-content-content">
            <?php
            if(!empty($getUser['ProfilePic'])) {
                echo "<div id='user-img' style='background-image: url(" . $uploadPath . $getUser['ProfilePic'] . ")'></div>";
            } else {
                echo "<div id='user-img' style='background: grey'></div>";
            }
            ?>
            <form id="admin-user-form" method="POST" action="../../controller/UserController.php?action=adminEditUser&userID=<?php echo $userID ?>">
                <input id="mailInput" name="email" type="text" value="<?php echo $getUser['Email'] ?>" disabled>
                <input id="countryInput" name="country" type="text" value="<?php echo $getUser['Country'] ?>">
                <input id="dobInput" name="dob" type="date" value="<?php echo $getUser['Birthday'] ?>">
                <button id="submitAdminEdit" class="waves-effect waves-light btn" name="adminSubmitEditUser">Update</button>
            </form>

            <form id="user-pass-reset-form" method="POST">
                <button id="pass-reset-submit" class="waves-effect waves-light btn disabled">Send password reset email</button>
            </form>

        </div>

    </div>

<?php require_once('includes/footer.php'); ?>