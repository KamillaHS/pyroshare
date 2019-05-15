<?php require_once ('includes/header.php'); ?>
<?php
if (!logged_in()) {
    echo "<script>location.href = 'login.php'</script>";
}
?>
    <link rel="stylesheet" href="../../css/adminAccessPosts.style.css">

    <div id="admin-content">
        <h3 id="admin-content-title">Access All Posts</h3>

        <hr>

        <div id="admin-content-content">
            <h4>Flagged Pictures</h4>
            <p>When Moderators mark a post as inappropriate or not following the <u>Rules and Regulations</u>, the posts will appear here. It is then the job of an admin to decide what to do with the post.</p>
            <ul id="admin-list">
                <li id="admin-list-item">If you believe that the post <b>does</b> follow the rules, then unflag it.</li>
                <li id="admin-list-item">If you believe that the post has been flagged because of the title or description, then you can choose to edit those. But please keep it as close to the original as possible.</li>
                <li id="admin-list-item">If you believe that the post has been flagged because of the picture, then you can choose to delete it.</li>
            </ul>
            <div id="flagged-posts">
                <?php require_once "includes/flaggedPosts.php" ?>
            </div>
        </div>

    </div>

<?php require_once ('includes/footer.php'); ?>