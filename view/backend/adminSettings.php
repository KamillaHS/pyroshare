<?php require_once ('includes/header.php'); ?>
<?php
if (!logged_in()) {
    header("Location: login.php");
}
?>
    <div id="admin-content">
        <h3 id="admin-content-title">Settings</h3>

        <hr>

        <div id="admin-content-content">
            Settings here
        </div>

    </div>

<?php require_once ('includes/footer.php'); ?>