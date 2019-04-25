<?php require_once('../../database/dbcon.php') ?>
    <link href="../../css/uploadPost.css" rel="stylesheet">
    <script src="../../js/uploadPost.js"></script>

<?php

if (isset($_POST['uploadPost'])
    && !empty($_POST['img'])){

    $imgURL = $_POST['img'];
    $imgTitle = $_POST['imgTitle'];
    $imgDescription = $_POST['imgDescription'];
    $user_id = $_SESSION['user_id'];

    $dbCon = dbCon($user, $pass);
    $sql = "INSERT INTO `post` (`PostID`, `Img`, `Title`, `Description`, `UploadedAt`, `isHot`, `isSticky`, `UserID`)
                        VALUES (NULL, '$imgURL', '$imgTitle', '$imgDescription', CURRENT_TIMESTAMP, b'0', b'0', '$user_id')";
    $query = $dbCon->prepare($sql);
    $query->execute();

    $last_post_id = $dbCon->lastInsertId();
    $query2 = $dbCon->prepare("INSERT INTO `likes` (`LikeID`, `Likes`, `Dislikes`, `PostID`) VALUES (NULL, '0', '0', '{$last_post_id}')");
    $query2->execute();

    header("Location: index2.php");

}
?>

<div id="opacity-background">
    <!-- Popup Div Starts Here -->
    <div id="uploadPost">
        <!-- Contact Us Form -->
        <form action="" id="uploadForm" method="POST" name="form">
<!--            <img id="close" src="images/3.png" onclick ="div_hide()">-->
            <i id="close" class="material-icons" onclick="div_hide()">clear</i>
            <h2 id="popupTitle">Upload new image</h2>
<!--            <hr>-->
            <input id="imgUpload" name="img" placeholder="Image url" type="text">
            <input id="imgTitle" name="imgTitle" placeholder="Title" type="text">
            <textarea id="imgDescription" name="imgDescription" placeholder="Description"></textarea>
            <button type="submit" value="Upload" id="uploadPost-button" class="waves-effect waves-light btn" name="uploadPost">Upload</button>
        </form>
    </div>
    <!-- Popup Div Ends Here -->
</div>
<!-- Display Popup Button -->
<!--<h1>Click Button To Popup Form Using Javascript</h1>-->
<!--<button id="popup" onclick="div_show()">Popup</button>-->