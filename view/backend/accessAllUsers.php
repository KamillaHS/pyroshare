<?php require_once ('includes/header.php'); ?>
<?php
if (!logged_in()) {
    echo "<script>location.href = 'login.php'</script>";
}
?>
    <link rel="stylesheet" href="../../css/adminEditUsers.style.css">

    <div id="admin-content">
        <h3 id="admin-content-title">Access All Users</h3>

        <hr>

        <div id="admin-content-content">
            <h4>Users with Role: Mod</h4>
            <p>...</p>

            <div id="users-mods">
                <?php require "includes/editUserMod.php"; ?>
            </div>
            <h4>Users with Role: User</h4>
            <p>...</p>
            <div id="users-users">
                <?php require "includes/editUserNotMod.php"; ?>
            </div>
        </div>

    </div>

<?php require_once ('includes/footer.php'); ?>