<?php require_once ('includes/header.php'); ?>
<?php require_once("includes/session.php"); ?>
<?php require_once('../../model/AdminDAO.php') ?>
<?php
if (!logged_in()) {
    header("Location: login.php");
}
?>
    <div id="admin-content">
        <h3 id="admin-content-title">Settings</h3>

        <hr>

        <?php
        $dbCon = dbCon($user, $pass);
        $sql = "SELECT * FROM `admin` WHERE  AdminID = " . $_SESSION['admin_id'] ;
        $query = $dbCon->prepare($sql);
        $query->execute();
        $getAdmin = $query->fetch();

        if(isset($_POST['updateAdminUsername']) && !empty($_POST['username'])) {
            $makeUser = new AdminDAO();
            $makeUser->editAdminUsername($_SESSION['admin_id']);
        }

        if(isset($_POST['updateAdminPass']) && !empty($_POST['pass'])) {
            $makeUser = new AdminDAO();
            $makeUser->editAdminPass($_SESSION['admin_id']);
        }

        ?>

            <div id="user-info-form">
                <form action="" id="user-settings" method="POST">
                    <label for="pass">Choose new Username</label>
                    <input id="username" name="username" placeholder="Username" type="text" value="<?php echo $getAdmin['Username'] ?>" />
                    <button id="register-form-button" class="waves-effect waves-light btn" name="updateAdminUsername">Update Username</button>
                </form>
            </div>

            <br><br>

            <div id="user-pass-form">
                <form action="" id="user-settings" method="POST">
                    <label for="pass">Choose new Password</label>
                    <input id="pass" name="pass" placeholder="Password" type="password" value=""/>
                    <button id="register-form-button" class="waves-effect waves-light btn" name="updateAdminPass">Update Password</button>
                </form>
            </div>


    </div>

<?php require_once ('includes/footer.php'); ?>