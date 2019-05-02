<link href="../../css/showImg.style.css" rel="stylesheet">
<script src="../../js/uploadPost.js"></script>
<?php
require_once("../includes/session.php");
if (!logged_in()) {
    echo "<script>location.href = 'index.php'</script>";
}?>
<?php require_once('../../controller/PostController.php'); ?>

<?php

//if(isset($_POST['editPost'])) {
//    $editPost = new PostDAO();
//    $editPost->editPost($data2['PostID']);
//}

?>

<div id="<?php echo $data2["PostID"] ?>" class="opacity-background-edit">
    <!-- Popup Div Starts Here -->
    <div id="img-pop-up-box">
        <i id="close" class="material-icons" onclick="div_img_hide(<?php echo $data2['PostID'] ?>)">clear</i>
        <!-- Login Form -->
        <div id="img-pop-up" style="background-image: url('<?php  echo $data2["Img"]  ?>')"></div>
<!--        <div id="img-popup-content">-->
<!--            <h2 id="img-title"> --><?php //echo $data2['Title'] ?><!-- by --><?php //echo $data2['Username'] ?><!-- </h2>-->
<!--        </div>-->

        <div id="edit-post">
            <!-- Contact Us Form -->
            <form action="../../controller/PostController.php?action=edit&PostID=<?php echo $data2['PostID'] ?>" id="edit-form" method="POST" name="form">
                <!--            <img id="close" src="images/3.png" onclick ="div_hide()">-->
                <h2 id="popupTitle">Edit image</h2>
                <!--            <hr>-->
                <input id="imgUpload" name="img" placeholder="Image url" type="text" value="<?php echo $data2['Img']; ?>">
                <input id="imgTitle" name="imgTitle" placeholder="Title" type="text" value="<?php if(!empty($data2['Title'])) { echo $data2['Title']; } else { echo "Unnamed"; } ?>">
                <textarea id="imgDescription" name="imgDescription" placeholder="Description"><?php if(!empty($data2['Description'])) { echo $data2['Description']; } else { echo "..."; } ?></textarea>
                <button type="submit" value="Upload" id="uploadPost-button" class="waves-effect waves-light btn" name="editPost">Save changes</button>
            </form>
        </div>
    </div>
    <!-- Popup Div Ends Here -->
</div>
