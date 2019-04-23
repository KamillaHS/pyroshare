<?php require_once ('includes/header.php'); ?>
<?php
if (!logged_in()) {
    header("Location: login.php");
}
?>
<div id="admin-content">
    <h3 id="admin-content-title">Welcome Admin</h3>

    <hr>

    <div id="admin-content-content">
        <p>
            This is your "backend" to customize your website Pyroshare!
            <br>
            You are now located at the Dashboard, but you will find a menu to your right with all of the editable stuff.
        </p>
        <br>
        <p>Below, you can view the activity on PyroShare.</p>
    </div>

    <div id="activity">
        <div id="numUsers">
            Number of users
        </div>
        <div id="numPosts">
            Number of posts
        </div>
        <div id="numComments">
            Number of comments
        </div>
    </div>
</div>

<?php require_once ('includes/footer.php'); ?>