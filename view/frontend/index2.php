<?php include_once("../includes/header.php") ?>
<?php
if (!logged_in()) {
    echo "<script>location.href = 'index.php'</script>";
}
?>


    <div id="welcome-message">
        <h2>Hello <?php echo $_SESSION['username'] ?></h2>
        <p>Do you want to upload a new picture?</p>
        <button class="waves-effect waves-light btn" id="upload-button" onclick="div_show()">Upload</button>
        <?php include_once("uploadPost.php"); ?>
    </div>

    <div id="featured-img">
        <h5>Featured Pictures of the Day</h5>
        <div id="featpic-box">
            <?php include('../includes/showFeatPic.php') ?>
        </div>
    </div>

    <div id="hot-img">
        <h5>Hot New Pictures</h5>
        <div id="featpic-box">
            <?php include('../includes/showHotPic.php') ?>
        </div>
    </div>

    <div id="latest-comments">
        <h5>Latest Comments</h5>
        <div id="comment-box">
            <?php include('../includes/showLateComment.php') ?>
        </div>
    </div>

<?php include_once("../includes/footer.php") ?>