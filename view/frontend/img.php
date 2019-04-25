<?php //require_once('../../database/dbcon.php'); ?>
<?php //require_once("../includes/session.php"); ?>

<link href="../../css/showImg.style.css" rel="stylesheet">
<script src="../../js/uploadPost.js"></script>

<?php

?>

<div id="<?php echo $data["PostID"] ?>" class="opacity-background-img">
    <!-- Popup Div Starts Here -->
    <div id="img-pop-up-box">
        <i id="close" class="material-icons" onclick="div_img_hide(<?php echo $data['PostID'] ?>)">clear</i>
        <!-- Login Form -->
        <div id="img-pop-up" style="background-image: url('<?php  echo $data["Img"]  ?>')"></div>
        <div id="img-popup-content">
            <h2 id="img-title"> <?php echo $data['Title'] ?> by <?php echo $data['Username'] ?> </h2>
            <div id="info-social">
                <div id='like-num-box'><i class="material-icons">keyboard_arrow_up</i><p> <?php echo $data['Likes'] ?> </p></div>
                <div id='dislike-num-box'><i class="material-icons">keyboard_arrow_down</i><p> <?php echo $data['Dislikes'] ?> </p></div>
                <div id='comment-num-box'><i class="material-icons">mode_comment</i>
                    <p>
                        <?php
                        $dbCon = dbCon($user, $pass);
                        $sql = "SELECT COUNT(CommentID) as numberOfComments FROM comment WHERE PostID = " . $data['PostID'] ;
                        $query = $dbCon->prepare($sql);
                        $query->execute();
                        $getCommentCount = $query->fetch();

                        echo $getCommentCount["numberOfComments"];
                        ?>
                    </p>
                </div>
            </div>
        </div>

        <button href="" id="show-comments" class="waves-effect waves-light btn" onclick="">Show / Hide Comments</button>

        <div id="display-comments">
            <?php
            $dbCon = dbCon($user, $pass);
            $sql = "SELECT comment.CommentID, comment.Description, comment.Likes, comment.CreatedAt, post.PostID, `user`.Username, TIMESTAMPDIFF(hour, `CreatedAt`, CURRENT_TIMESTAMP) AS TimeDiff
                     FROM comment, post, `user`
                     WHERE comment.PostID = post.PostID && post.UserID = `user`.UserID && `comment`.`PostID` = " . $data['PostID'] . "
                     ORDER BY comment.CommentID";
            $query = $dbCon->prepare($sql);
            $query->execute();
            $getPostComments= $query->fetchAll();


            if(count($getPostComments) > 0) {
                foreach($getPostComments as $comment) {
                    ?>
                    <div id="post-comment">
                        <div id="post-comment-info">
                            <p id="post-comment-user"> by <?php echo $comment['Username'] ?> </p>
                            <p id="post-comment-created">Comment made <?php echo $comment['CreatedAt'] ?> </p>
                        </div>
                        <hr>
                        <div id="post-comment-content">
                            <p> <?php echo $comment['Description'] ?> </p>
                        </div>
                        <div id="post-comment-social">
                            <form id="post-comment-social-react">
                                <button id="comment-react-like" class="waves-effect waves-light btn">Like</button>
                                <button id="comment-react-dislike" class="waves-effect waves-light btn">Dislike</button>
                                <button id="comment-react-reply" class="waves-effect waves-light btn">Reply</button>
                            </form>
                            <div id="post-comment-social-social">
                                <div id='like-num-box'><i class="material-icons">keyboard_arrow_up</i><p> <?php echo $comment['Likes'] ?> </p></div>
                                <div id='comment-num-box'><i class="material-icons">mode_comment</i><p> <?php echo 0 ?> </p></div>
                            </div>
                        </div>
                    </div>
                    <?php
                }
            } else {
                echo "No one has made any comments to this picture yet. Do you wanna be the first?";
            }

            ?>

            <div id="comment-write">

            </div>
        </div>
    </div>
    <!-- Popup Div Ends Here -->
</div>

