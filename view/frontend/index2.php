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

        <?php
        $username = $_SESSION['username'];

        $dbCon = dbCon($user, $pass);
        $sql = $dbCon->prepare("SELECT Role FROM `user` WHERE Username = '$username'");
        $sql->execute();
        $getUserRole = $sql->fetch();

        if($getUserRole['Role'] == 'mod') {
            echo "<div id='mod-info-box'>";
            echo "<h4>You are a Moderator</h4>";
            echo "<p>Because you are a moderator, you have access to a function that allows you to mark uploaded pictures.
                  <br>This function will appear as a flag icon (<i class=\"material-icons\">flag</i>) on pictures that you yourself have not uploaded.
                  <br>The function will only appear on the <a href='explore.php'>Explore</a> page under the category <b>Show All</b>. 
                  <br>If you click on this icon for a specific picture, it means that you mark the picture as inappropriate or just not following the <a href='rulesAndRegulations.php'>Rules and Regulations</a> for PyroShare.
                  <br>When you mark a picture, it will be the admin's job to decide if the post should get deleted or not. 
                  </p>";
            echo "<p>Because you are a Moderator, you have a certain responsibility to know and uphold the <a href='rulesAndRegulations.php'>Rules and Regulations</a> of PyroShare.
                  <br>Though, like any other user, if you do not follow the <a href='rulesAndRegulations.php'>Rules and Regulations</a>, it can have consequences. 
                  <br>As a moderator, you are asked to always be fair, when you mark pictures, though it is better to mark one too many, since your mark will not have influence on the post, until the admin reviews your mark.
                  </p>";
            echo "</div>";
        }
        ?>

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