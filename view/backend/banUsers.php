<?php require_once ('includes/header.php'); ?>
<?php
if (!logged_in()) {
    echo "<script>location.href = 'login.php'</script>";
}
?>
    <link rel="stylesheet" href="../../css/adminBanUsers.style.css">

    <div id="admin-content">
        <h3 id="admin-content-title">Ban Users</h3>

        <hr>

        <div id="admin-content-content">
            <h4>Banned</h4>
            <p>This is a list of users who are banned from PyroShare. They will not be able to access the site when they try to log in. If you want to let them access the site again, uncheck the checkbox.</p>

            <div id="banned-users">
                <?php require "includes/bannedUsers.php"; ?>
            </div>
            <h4>Not Banned</h4>
            <p>This is a list of all users who have access to PyroShare. If you want to ban a user, check the checkbox.</p>
            <div id="not-banned-users">
                <?php require "includes/notBannedUsers.php"; ?>
            </div>
        </div>

    </div>

<?php require_once ('includes/footer.php'); ?>