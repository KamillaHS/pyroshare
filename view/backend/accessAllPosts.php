<?php require_once ('includes/header.php'); ?>
<?php
if (!logged_in()) {
    echo "<script>location.href = 'login.php'</script>";
}
?>
    <div id="admin-content">
        <h3 id="admin-content-title">Access All Posts</h3>

        <hr>

        <div id="admin-content-content">
            Settings here
            <br>
            Here you can access all posts and their information.
            <br>
            But most importantly, you can delete inappropriate images.
        </div>

    </div>

<?php require_once ('includes/footer.php'); ?>