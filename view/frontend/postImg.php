<?php include_once("../includes/header.php") ?>
<?php require_once('../../database/dbcon.php'); ?>
<?php require_once("../includes/session.php"); ?>
<?php require_once('../../model/CommentDAO.php'); $commentFunc = new CommentDAO(); ?>
<?php require_once('../../model/CategoryDAO.php'); $categoryFunc = new CategoryDAO(); ?>
<?php require_once('../../model/CategoryDAO.php'); $categoryFunc = new CategoryDAO(); ?>

<link href="../../css/showImg.style.css" rel="stylesheet">

<?php
$postID = $_GET['postID'];

$dbCon = dbCon($user, $pass);
$query = $dbCon->prepare("SELECT post.PostID, post.Img, post.Title, post.Description, post.UploadedAt, post.isFlagged,`user`.`UserID`, `user`.Username, likes.Likes, likes.Dislikes, TIMESTAMPDIFF(hour, `UploadedAt`, CURRENT_TIMESTAMP) AS TimeDiff
                                    FROM likes, post LEFT JOIN `user`
                                    ON post.UserID = `user`.`UserID`
                                    WHERE post.PostID = likes.PostID && post.PostID = '$postID'");
$query->execute();
$getSinglePost = $query->fetchAll();

?>
<button id="img-back" class="waves-effect waves-light btn" onclick="history.go(-1)"><i class="material-icons">keyboard_arrow_left</i></button>
<?php

// Setting upload path
$uploadPath = "../../upload/Pics/";

foreach ($getSinglePost as $data) {
?>
    <div id="showImgPage">
        <div id="img-pop-up" style="background-image: url('<?php  echo $uploadPath . $data["Img"]  ?>')"></div>
        <div id="img-popup-content">
            <h2 id="img-title">
                <?php echo $data['Title'] ?>
                by
                <?php
                if(!empty($data['Username'])) {
                    echo "<object><a href='../frontend/useraccount.php?userID=" . $data['UserID'] . "'>" . $data['Username'] . "</a></object>";
                } else {
                    echo "<i>Deleted User</i>";
                }
                ?>
            </h2>
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
            <div id="post-react">
                <a id="post-like" class="waves-effect waves-light btn" href="../../controller/PostController.php?like-post=1&action=like&PostID=<?php echo $data['PostID'] ?>">Like</a>
                <a id="post-dislike" class="waves-effect waves-light btn" href="../../controller/PostController.php?dislike-post=1&action=dislike&PostID=<?php echo $data['PostID'] ?>">Dislike</a>
            </div>
        </div>


        <div id="img-popup-info">
            <div id="img-uploaded-time">
                <?php
                $uploadToTime = DateTime::createFromFormat( "Y-m-d H:i:s", $data['UploadedAt']);
                $uploadTime2 = $uploadToTime->format('d-m-Y H:i');
                ?>
                <p><?php echo "<p><b>Uploaded at:</b> " . $uploadTime2 . "</p>" ?></p>
            </div>
            <div id="img-category">
                <p><b>Category:</b>
                <?php
                $categoryFunc->showCategory($data['PostID']);
                ?>
                </p>
            </div>
        </div>

        <div id="img-description">
            <p><?php echo $data['Description'] ?></p>
        </div>



        <h5>Comments</h5>

        <div id="display-comments">
            <?php
            $dbCon = dbCon($user, $pass);
            $sql = "SELECT comment.CommentID, comment.Description, comment.Likes, comment.CreatedAt, comment.isPic, post.PostID, `user`.UserID, `user`.Username, `user`.ProfilePic, TIMESTAMPDIFF(hour, `CreatedAt`, CURRENT_TIMESTAMP) AS TimeDiff
                         FROM comment, post, `user`
                         WHERE comment.PostID = post.PostID && comment.UserID = `user`.UserID && `comment`.`PostID` = " . $data['PostID'] . "
                         ORDER BY comment.CommentID";
            $query = $dbCon->prepare($sql);
            $query->execute();
            $getPostComments= $query->fetchAll();

            if(count($getPostComments) > 0) {
                foreach($getPostComments as $comment) {
                    // Setting Comment Pic upload path
                    $picUploadPath = "../../upload/CommentPics/";
                    ?>
                    <div id="post-comment">
                        <div id="post-comment-info">
                            <p id="post-comment-user">
                                by
                                <?php
                                if(!empty($comment['Username'])) {
                                    echo "<object><a href='../frontend/useraccount.php?userID=" . $comment['UserID'] . "'>" . $comment['Username'] . "</a></object>";
                                } else {
                                    echo "<i>Deleted User</i>";
                                }
                                ?>
                            </p>
                            <p id="post-comment-created">Comment made <?php echo $comment['CreatedAt'] ?> </p>
                        </div>
                        <hr>
                        <div id="post-comment-content">


                            <?php
                            if ($comment['isPic'] == true){ ?>
                                <div id='commentPictureShow' style='background-image: url(" <?php echo $picUploadPath .  $comment['Description'] ?> "); height: 800px; width: 92%; background-size: contain; background-repeat: no-repeat; background-position: center; margin: 0 auto;'></div>


                            <?php }else  {
                                ?>

                                <p> <?php echo $comment['Description']; ?> </p>
                            <?php }?>


                        </div>

                        <?php

                        //                        if(isset($_POST['like-comment'])) {
                        //                            $commentFunc->likeComment($comment['CommentID']);
                        //                        }
                        //
                        //                        if(isset($_POST['dislike-comment'])) {
                        //                            $commentFunc->dislikeComment($comment['CommentID']);
                        //                        }

                        ?>
                        <div id="post-comment-social">
                            <div id="post-comment-social-react">
                                <a id="comment-react-like" class="waves-effect waves-light btn" name="like-comment" href="../../controller/CommentController.php?like-comment=1&action=like&CommentID=<?php echo $comment['CommentID'] ?>">Like</a>
                                <a id="comment-react-like" class="waves-effect waves-light btn" name="dislike-comment" href="../../controller/CommentController.php?dislike-comment=1&action=dislike&CommentID=<?php echo $comment['CommentID'] ?>">Dislike</a>
                                <!--                                <form method="get" action="../../controller/CommentController.php?action=like&CommentID=--><?php //echo $comment['CommentID'] ?><!--">-->
                                <!--                                    <button id="comment-react-like" name="like-comment" class="waves-effect waves-light btn">Like</button>-->
                                <!--                                </form>-->
                                <!--                                <form method="get" action="../../controller/CommentController.php?action=dislike&CommentID=--><?php //echo $comment['CommentID'] ?><!--">-->
                                <!--                                    <button id="comment-react-dislike" name="dislike-comment" class="waves-effect waves-light btn">Dislike</button>-->
                                <!--                                </form>-->

                                <!--                                <button id="comment-react-reply" class="waves-effect waves-light btn">Reply</button>-->
                            </div>
                            <div id="post-comment-social-social">
                                <div id='like-num-box'><i class="material-icons">keyboard_arrow_up</i><p> <?php echo $comment['Likes'] ?> </p></div>
                                <!--                                <div id='comment-num-box'><i class="material-icons">mode_comment</i><p> --><?php //echo 0 ?><!-- </p></div>-->
                            </div>
                        </div>
                    </div>
                    <?php
                }
            } else {
                echo "No one has made any comments to this picture yet. Do you wanna be the first?";
            }


            if(logged_in()) {
                $user_id = $_SESSION['user_id'];
                $sql2 = "SELECT `user`.ProfilePic FROM `user` WHERE `user`.UserID = '$user_id'";
                $query = $dbCon->prepare($sql2);
                $query->execute();
                $getUserPic= $query->fetch();

                ?>
                <div id="comment-write">
                    <form id="comment-form" action="../../controller/CommentController.php?action=create&PostID=<?php echo $data['PostID'] ?>" method="POST">
                        <?php
                        // Setting Profile Pic upload path
                        $picUploadPath = "../../upload/ProfilePics/";


                        if(!empty($getUserPic['ProfilePic'])) {
                            echo "<div id='comment-user-img' style='background-image: url(" . $picUploadPath . $getUserPic['ProfilePic'] . ")'></div>";
                        } else {
                            echo "<div id='comment-user-img' style='background: grey;'></div>";
                        }
                        ?>
                        <input id="make-comment" type="text" name="text">
                        <button id="gif-icon"><i class="material-icons">gif</i></button>
                        <button id="send-comment" class="waves-effect waves-light btn" name="post-comment">Send</button>
                    </form>
                    <form id="comment-img-form" action="../../controller/CommentController.php?action=createPicture&PostID=<?php echo $data['PostID'] ?>" method="post" enctype="multipart/form-data">
                        <div class="upload-btn-wrapper">
                            <button id="imgCommentUpload"><i class="material-icons" >insert_photo</i></button>
                            <input id="file" name="commentPicture" type="file" onchange="this.form.submit()">
                        </div>
                        <!--                        <button type="submit" class="waves-effect waves-light btn" name="uploadPictureComment">Comment Picture</button>-->
                    </form>
                </div>
                <?php
            }
            ?>
        </div>
    </div>
<?php
}
?>






<?php include_once("../includes/footer.php") ?>
