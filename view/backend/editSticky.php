<?php require_once ('includes/header.php'); ?>
<?php
if (!logged_in()) {
    echo "<script>location.href = 'login.php'</script>";
}
?>
    <div id="admin-content">
        <h3 id="admin-content-title">Sticky Images</h3>

        <hr>

        <div id="admin-content-content">
            Settings here
        </div>

    </div>

<?php require_once ('includes/footer.php'); ?>