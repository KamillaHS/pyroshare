<?php include_once("../includes/header.php") ?>
<?php require_once("../includes/SelectFeatPic.php") ?>
<?php require_once("../includes/SelectHotPic.php") ?>

    <div id="welcome-message">
        <h2>Hello Name</h2>
        <p>Do you want to upload a new picture?</p>
        <a class="waves-effect waves-light btn" href="/">Upload</a>
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
    </div>

<?php include_once("../includes/footer.php") ?>