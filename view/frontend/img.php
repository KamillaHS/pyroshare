<?php require_once('../../database/dbcon.php'); ?>
<?php require_once("../includes/session.php"); ?>

<link href="../../css/showImg.style.css" rel="stylesheet">
<script src="../../js/uploadPost.js"></script>

<?php

?>

<div id="opacity-background-img">
    <!-- Popup Div Starts Here -->
    <div id="img-pop-up-box">
        <i id="close" class="material-icons" onclick="div_img_hide()">clear</i>
        <!-- Login Form -->
        <div id="img-pop-up" style="background-image: url('<?php  echo $getAllPosts[0][1]  ?>')">
<!--            <img src="--><?php // echo $getAllPosts[0][1]  ?><!--" alt="">-->
        </div>
        <div>
            <h2 id="img-title">Img</h2>
            <div>
                <div id="like-num-box"></div>
                <div id="dislike-num-box"></div>
                <div id="comment-num-box"></div>
            </div>
        </div>

        <button href="" id="show-comments" class="waves-effect waves-light btn" onclick="">Show / Hide Comments</button>

        <div id="display-comments">

        </div>
    </div>
    <!-- Popup Div Ends Here -->
</div>
