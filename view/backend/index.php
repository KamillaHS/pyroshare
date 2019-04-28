<?php require_once ('includes/header.php'); ?>
<?php
if (!logged_in()) {
    echo "<script>location.href = 'login.php'</script>";
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

    <?php
    $dbCon = dbCon($user, $pass);
    ?>

    <div id="activity">
        <div id="numUsers">
            <h3>Number of users:</h3>
            <p>
                <?php
                $sql = "SELECT `user`.UserID
                     FROM `user`";
                $query = $dbCon->prepare($sql);
                $query->execute();
                $getNumUser= $query->fetchAll();

                echo count($getNumUser);
                ?>
            </p>
        </div>
        <div id="numPosts">
            <h3>Number of images:</h3>
            <p>
                <?php
                $sql = "SELECT post.PostID
                     FROM post";
                $query = $dbCon->prepare($sql);
                $query->execute();
                $getNumPost= $query->fetchAll();

                echo count($getNumPost);
                ?>
            </p>
        </div>
        <div id="numComments">
            <h3>Number of comments:</h3>
            <p>
                <?php
                $sql = "SELECT comment.CommentID
                     FROM comment";
                $query = $dbCon->prepare($sql);
                $query->execute();
                $getNumCom= $query->fetchAll();

                echo count($getNumCom);
                ?>
            </p>
        </div>
    </div>
</div>

<?php require_once ('includes/footer.php'); ?>