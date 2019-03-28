<?php include_once("../includes/header.php") ?>
<?php require_once("../includes/SelectFeatPic.php") ?>
<?php require_once("../includes/SelectHotPic.php") ?>
<?php require_once("../includes/SelectLateComment.php") ?>

    <div id="welcome-message">
        <h2>Hello Name</h2>
        <p>Do you want to upload a new picture?</p>
        <button class="waves-effect waves-light btn" id="popup" onclick="div_show()">Upload</button>
        <?php include_once("uploadPost.php"); ?>

    </div>
    <div id="featured-img">
        <h3>Featured Pictures of the Day</h3>

            <div id="featpic-box">
                <?php
                foreach ($getPostData as $data) {
                    // Make image as background for div
                    echo "<div id='featpic' style='background-image: url(";
                    echo $data['Img'];
                    echo ")'>";

                    // Show title and user in div
                    echo "<div id='pic-info-bar'>";
                    echo "<p id='info'>";
                    echo "<b>" . $data['Title'] . "</b>";
                    echo " by ";
                    echo "<b>" . $data['Username'] . "</b>";
                    echo "</p>";

                    $uploadTime = $data['UploadedAt'];
                    echo "<p id='info-social'>" . $uploadTime . "</p>";
                    echo "</div>";

                    // End background div tag
                    echo "</div>";
                }
                ?>
            </div>


    </div>
    <div id="hot-img">
        <h3>Hot New Pictures</h3>
        <div id="featpic-box">
            <?php
            foreach ($getPostData2 as $data) {
                // Make image as background for div
                echo "<div id='featpic' style='background-image: url(";
                echo $data['Img'];
                echo ")'>";

                // Show title and user in div
                echo "<div id='pic-info-bar'>";
                echo "<p id='info'>";
                echo "<b>" . $data['Title'] . "</b>";
                echo " by ";
                echo "<b>" . $data ['Username'] . "</b>";
                echo "</p>";
                echo "<p id='info-social'>" . $data ['UploadedAt'] . "</p>";
                echo "</div>";

                // End background div tag
                echo "</div>";
            }
            ?>
        </div>
    </div>
    <div id="latest-comments">
        <h3>Latest Comments</h3>
        <div id="comment-box">
            <?php
            foreach ($getCommentData as $data) {
                echo "<div id='comment-single'>";

                // Show user
                echo "<div id='user-box'>";
                echo "<div id='comment-user-img'></div>";
                echo "<p>" . $data['Username'] ."</p>";
                echo "</div>";
                echo "<p id='comment-after-user'>said:</p>";

                // Comment top
                echo "<div id='comment-text-top'></div>";

                // Show when the comment was made
                echo "<div id='comment-made'>";
                echo "Comment made " . $data['CreatedAt'];
                echo "</div>";

                // Show comment
                echo "<div id='comment-text-box'>";
                echo "<p id='comment-text'>" . $data['Description'] . "</p>";
                echo "</div>";

                // Show view picture
                echo "<div id='comment-view-source'>";
                echo '<a href="">View Picture</a>';
                echo "</div>";

                echo "</div>";
            }
            ?>
        </div>
    </div>

<?php include_once("../includes/footer.php") ?>