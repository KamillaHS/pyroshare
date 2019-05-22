<?php require_once ('includes/header.php'); ?>
<?php require_once("includes/session.php"); ?>
<?php require_once('../../model/AdminDAO.php') ?>
<?php
if (!logged_in()) {
    echo "<script>location.href = 'login.php'</script>";
}
?>
    <link rel="stylesheet" href="../../css/adminAdd.style.css">

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

        $sql2 = "SELECT * FROM `backendstyle`";
        $query2 = $dbCon->prepare($sql2);
        $query2->execute();
        $getTheme = $query2->fetchAll();

        ?>

            <div id="admin-form">
                <form action="" id="user-settings" method="POST">
                    <label for="pass">Choose new Username</label>
                    <input id="admin-username" name="username" placeholder="Username" type="text" value="<?php echo $getAdmin['Username'] ?>" />
                    <button id="admin-update" class="waves-effect waves-light btn" name="updateAdminUsername">Update Username</button>
                </form>
            </div>

            <br><br>

            <div id="admin-form">
                <form action="" id="user-settings" method="POST">
                    <label for="pass">Choose new Password</label>
                    <input id="admin-pass" name="pass" placeholder="Password" type="password" value=""/>
                    <button id="admin-update" class="waves-effect waves-light btn" name="updateAdminPass">Update Password</button>
                </form>
            </div>

            <div id="admin-form">
                <form id="adminChangeTheme" action="../../controller/AdminController.php?action=AdminChangeTheme">
                    <h5>Change theme for backend</h5>
                    <?php
                    foreach ($getTheme as $theme) {
                        ?>
                        <div>

                            <?php echo $theme['StyleID'] ?>

                            <label>
                                <input name="radio" value="theme<?php echo $theme['StyleID'] ?>" type="radio"
                                    <?php
                                    if($theme['isUsed'] == 1) {
                                        echo "checked";
                                    }
                                    ?>
                                />
                                <span> Colors: </span>
                            </label>
                            <div id="theme-container">
                                <div id="theme1-color1" style="background-color: <?php echo $theme['TextColor'] ?>"></div>
                                <div id="theme1-color2" style="background-color: <?php echo $theme['TopMenuColor'] ?>"></div>
                                <div id="theme1-color3" style="background-color: <?php echo $theme['SideMenuColor'] ?>"></div>
                            </div>
                        </div>
                        <br>
                        <?php
                    }
                    ?>
                    <button id="button-change-theme" class="waves-effect waves-light btn" name="submitRadio">Select and continue</button>
                </form>

            </div>

    </div>

<?php require_once ('includes/footer.php'); ?>