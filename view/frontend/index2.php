<?php include_once("../includes/header.php") ?>
<?php
if (!logged_in()) {
    header("Location: index.php");
}
?>


    <div id="welcome-message">
        <h2>Hello <?php echo $_SESSION['username'] ?></h2>
        <p>Do you want to upload a new picture?</p>
        <button class="waves-effect waves-light btn" id="popup" onclick="div_show()">Upload</button>
        <?php include_once("uploadPost.php"); ?>
    </div>

    <div id="featured-img">
        <h3>Featured Pictures of the Day</h3>
        <div id="featpic-box">
            <?php include('../includes/showFeatPic.php') ?>
        </div>
    </div>

    <div id="hot-img">
        <h3>Hot New Pictures</h3>
        <div id="featpic-box">
            <?php include('../includes/showHotPic.php') ?>
        </div>
    </div>

    <div id="latest-comments">
        <h3>Latest Comments</h3>
        <div id="comment-box">
            <?php include('../includes/showLateComment.php') ?>
        </div>
    </div>

<?php include_once("../includes/footer.php") ?>