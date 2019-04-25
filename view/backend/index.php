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

    <?php
    $dbCon = dbCon($user, $pass);
    ?>

    <div id="activity">
        <div id="numUsers">
            <?php
            $sql = "SELECT `user`.UserID
                     FROM `user`";
            $query = $dbCon->prepare($sql);
            $query->execute();
            $getNumUser= $query->fetch();
            ?>
        </div>
        <div id="numPosts">
            <?php
            $sql = "SELECT post.PostID
                     FROM post";
            $query = $dbCon->prepare($sql);
            $query->execute();
            $getPostComments= $query->fetch();
            ?>
        </div>
        <div id="numComments">
            <?php
//            $sql = "SELECT comment.CommentID, comment.Description, comment.Likes, comment.CreatedAt, post.PostID, `user`.Username, TIMESTAMPDIFF(hour, `CreatedAt`, CURRENT_TIMESTAMP) AS TimeDiff
//                     FROM comment, post, `user`
//                     WHERE comment.PostID = post.PostID && post.UserID = `user`.UserID && `comment`.`PostID` = " . $data['PostID'] . "
//                     ORDER BY comment.CommentID";
//            $query = $dbCon->prepare($sql);
//            $query->execute();
//            $getPostComments= $query->fetch();
            ?>
        </div>
    </div>
</div>

<?php require_once ('includes/footer.php'); ?>