<?php include_once("../includes/header.php") ?>
<?php require_once('../includes/SelectUserInfo.php') ?>
<?php require_once('../includes/SelectUserPosts.php') ?>
<?php require_once('../includes/SelectUserComments.php') ?>
<?php require_once('../../model/PostDAO.php') ?>
<?php
if (!logged_in()) {
    echo "<script>location.href = 'index.php'</script>";
}
?>
<link rel="stylesheet" href="../../css/profile.style.css">
<link rel="stylesheet" href="../../css/explore.style.css">


<?php
$dbCon = dbCon($user, $pass);

$userID = $_GET['userID'];

$query = $dbCon->prepare("SELECT `user`.`UserID`, `user`.`Username`, `user`.`Email`, `user`.`Country`, `user`.`Birthday`, `user`.`ProfilePic`, `user`.`ProfileCover`, `user`.`IsBanned`
                                    FROM `user`
                                    WHERE `user`.`UserID` = ?");
$query->bindParam(1, $userID);
$query->execute();
$getUserAcc = $query->fetchAll();


foreach ($getUserAcc as $data) {
    // Show profile cover
    if($data['ProfileCover']) {
        echo "<div id='profile-cover' style='background-color: " . $data['ProfileCover'] . "'></div>";
    } else {
        echo "<div id='profile-cover' style='background-color: #808080'></div>";
    }

    // Setting Profile Pic upload path
    $picUploadPath = "../../upload/ProfilePics/";

    // Show profile image
    if($data['ProfilePic']) {
        echo "<div id='profile-pic' style='background-image: url(" . $picUploadPath . $data['ProfilePic'] . ")'></div>";
    } else {
        echo "<div id='profile-pic' style='background: #d3d3d3'><p style='text-align: center; margin-top: 42%; font-size: 22px; font-weight: bold;'>No image available</p></div>";
    }

    // Edit button
    $user_id = $_SESSION['user_id'];
    if($userID == $user_id) {
        echo "<a id='profile-edit-button' class='btn waves-effect waves-light' href='profilesettings.php'>Edit Profile</a>";
    }

    // User info
    echo "<div id='profile-user-info'>";
    echo "<h2 id='profile-username' style='margin-left: 0px;'>" . $data['Username'] . "</h2>";
    echo "<p><b>From: </b>" . $data['Country'] . "</p>";
    echo "<p><b>Number of uploads: </b>" . count($getUserPosts) . "</p>";
    echo "</div>";

    echo "<h3 id='profile-posts-title'>Uploads</h3>";
    echo "<div id='profile-posts'>";


    $query = $dbCon->prepare("SELECT post.PostID, post.Img, post.Title, post.Description, post.UploadedAt, `user`.`UserID`, `user`.Username, likes.Likes, likes.Dislikes, TIMESTAMPDIFF(hour, `UploadedAt`, CURRENT_TIMESTAMP) AS TimeDiff
                                    FROM post, `user`, likes
                                    WHERE post.UserID = `user`.`UserID` && post.PostID = likes.PostID && `user`.`UserID` = ?
                                    ORDER BY `post`.`PostID` DESC");
    $query->bindParam(1, $userID);
    $query->execute();
    $getUserAccPosts = $query->fetchAll();

    if(count($getUserAccPosts) > 0) {
        foreach ($getUserAccPosts as $data2) {
            // Setting upload path
            $uploadPath = "../../upload/Pics/";
            echo "<a href=''>";

            // Make image as background for div
            echo "<div id='featpic' style='background-image: url(" . $uploadPath .  $data2['Img'] . ")'>";
//            echo 'upload/' . $data2['Img'];
//            echo ")'>";

            // Show title and user in div
            echo "<div id='pic-info-bar'>";
            echo "<p id='info'>";
            echo "<b>" . $data2['Title'] . "</b>";
            echo "</p>";

            $uploadToTime = DateTime::createFromFormat( "Y-m-d H:i:s", $data2['UploadedAt']);
            $uploadTime = $uploadToTime->format('d-m-Y');

            echo "<p id='post-upload'>Uploaded ";
            if($data2['TimeDiff'] < 1) {
                echo "Less than 1 hour ago";
            } elseif($data2['TimeDiff'] <= 24 && $data2['TimeDiff'] >= 1) {
                echo $data2['TimeDiff'] . " hours ago";
            } elseif($data2['TimeDiff'] <= 48 && $data2['TimeDiff'] > 24){
                echo "2 day ago";
            } elseif($data2['TimeDiff'] <= 72 && $data2['TimeDiff'] > 48) {
                echo "3 days ago";
            } elseif($data2['TimeDiff'] <= 96 && $data2['TimeDiff'] > 72) {
                echo "4 days ago";
            } elseif($data2['TimeDiff'] <= 120 && $data2['TimeDiff'] > 96) {
                echo "5 days ago";
            } elseif($data2['TimeDiff'] <= 144 && $data2['TimeDiff'] > 120) {
                echo "6 days ago";
            } elseif($data2['TimeDiff'] <= 168 && $data2['TimeDiff'] > 144) {
                echo "1 week ago";
            } elseif($data2['TimeDiff'] > 168) {
                echo $uploadTime;
            } else {
                echo "No date to display";
            }
            echo " by ";
            echo "<b>" . $data2['Username'] . "</b>";
            echo "</p>";

            echo "<div id='info-social'>";
            echo "<div id='like-num-box'><i class=\"material-icons\">keyboard_arrow_up</i><p>" . $data2['Likes'] . "</p></div>";
            echo "<div id='dislike-num-box'><i class=\"material-icons\">keyboard_arrow_down</i><p>" . $data2['Dislikes'] . "</p></div>";
            echo "<div id='comment-num-box'><i class=\"material-icons\">mode_comment</i><p>15</p></div>";
            echo "</div>";

            // End info bar div
            echo "</div>";
            $id = $data2['PostID'];
//            echo "<a class='btn waves-effect waves-light' id='update' type='button' onclick='div_edit_show(". $data2['PostID'] . ")'>Update</a>";
            echo "<button class='btn waves-effect waves-light' id='update' type='button'><a onclick='div_edit_show(". $data2['PostID'] . ")'>Update</a></button>";
            echo "<form action='../../controller/PostController.php?action=delete&PostID=" . $id . "' method='post'>";
            echo "<button type='submit' class='btn waves-effect waves-light' id='delete' name='deletePostForm'  value='Delete'>Delete</button>";
            echo "</form>";

//            if(isset($_POST['deletePostForm'])) {
//                $deletePost = new PostDAO();
//                $deletePost->deletePost($data2['PostID']);
//
//            }

            // End background div tag
            echo "</div>";

            // End link tag
            echo "</a>";

            include('editPost.php');
        }
    } else {
        echo "This user has not uploaded any photos";
    }

    echo "</div>";
}
?>



<h3 id='profile-comments-title'>Latests Comments</h3>
<div id='profile-comments'>

    <?php
    $query = $dbCon->prepare("SELECT comment.CommentID, comment.Description, comment.Likes, comment.CreatedAt, comment.isPic, post.PostID, post.Title, post.Img, `user`.Username, `user`.ProfilePic, TIMESTAMPDIFF(hour, `CreatedAt`, CURRENT_TIMESTAMP) AS TimeDiff
                                    FROM comment, post, `user`
                                    WHERE comment.PostID = post.PostID && comment.UserID = `user`.UserID && comment.UserID = ?
                                    ORDER BY comment.CommentID DESC");
    $query->bindParam(1, $userID);
    $query->execute();
    $getUserAccComments = $query->fetchAll();


    if(count($getUserAccComments) > 0) {
        foreach($getUserAccComments as $data) {
            // Setting Profile Pic upload path
            $picUploadPath = "../../upload/ProfilePics/";
            // Setting Comment Pic upload path
            $commentUploadPath = "../../upload/CommentPics/";

            echo "<div id='comment-single'>";

            // Show user
            echo "<div id='user-box'>";
            if(!empty($data['ProfilePic'])) {
                echo "<div id='comment-user-img' style='background-image: url(" . $picUploadPath . $data['ProfilePic'] . ")'></div>";
            } else {
                echo "<div id='comment-user-img' style='background: grey;'></div>";
            }
            echo "<p>" . $data['Username'] ."</p>";
            echo "</div>";
            echo "<p id='comment-after-user'>said:</p>";



            // Show comment

            if ($data['isPic'] == true){
                // echo "<div id='commentPictureShow' style='background-image: url(" . $commentUploadPath .  $data['Description'] . "); height: 120px; width: 92%; background-size: contain; background-repeat: no-repeat; background-position: center; margin: 0 auto;'></div>";

                // Comment top
                echo "<div id='comment-text-top'></div>";

                echo "<div id='comment-text-box'>";

                echo "<div id='comment-text'>";
                echo "<img id='commentPictureShow' src='" . $commentUploadPath .  $data['Description'] . "' alt=''>";
                echo "</div>";
                echo "</div>";
                
            }else  {
                // Comment top
                echo "<div id='comment-text-top'></div>";

                echo "<div id='comment-text-box'>";

                echo "<p id='comment-text'>" . $data['Description'] . "</p>";
                echo "</div>";


            }



            // Show when the comment was made
            echo "<div id='comment-made'>";

            $createdToTime = DateTime::createFromFormat( "Y-m-d H:i:s", $data['CreatedAt']);
            $createdTime = $createdToTime->format('d-m-Y');

            echo "Comment made ";

            if($data['TimeDiff'] < 1) {
                echo "Less than 1 hour ago";
            } elseif($data['TimeDiff'] <= 24 && $data['TimeDiff'] >= 1) {
                echo $data['TimeDiff'] . " hours ago</p>";
            } elseif($data['TimeDiff'] <= 48 && $data['TimeDiff'] > 24){
                echo "2 day ago";
            } elseif($data['TimeDiff'] <= 72 && $data['TimeDiff'] > 48) {
                echo "3 days ago";
            } elseif($data['TimeDiff'] <= 96 && $data['TimeDiff'] > 72) {
                echo "4 days ago";
            } elseif($data['TimeDiff'] <= 120 && $data['TimeDiff'] > 96) {
                echo "5 days ago";
            } elseif($data['TimeDiff'] <= 144 && $data['TimeDiff'] > 120) {
                echo "6 days ago";
            } elseif($data['TimeDiff'] <= 168 && $data['TimeDiff'] > 144) {
                echo "1 week ago";
            } elseif($data['TimeDiff'] > 168) {
                echo $createdTime;
            } else {
                echo "No date to display";
            }

            echo "</div>";

            // Show view picture
            echo "<div id='comment-view-source'>";
            echo '<a href="../frontend/postImg.php?postID=' . $data['PostID'] . '">View Picture</a>';
            echo "</div>";

            echo "</div>";
        }
    } else {
        echo "This user has not made any comments";
    }
    ?>
</div>

<?php include_once("../includes/footer.php") ?>
