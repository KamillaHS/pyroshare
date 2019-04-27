<?php include_once("../includes/header.php") ?>
<?php require_once('../includes/SelectUserInfo.php') ?>
<?php require_once('../includes/SelectUserPosts.php') ?>
<?php require_once('../includes/SelectUserComments.php') ?>
<?php
if (!logged_in()) {
    header("Location: index.php");
}
?>
<link rel="stylesheet" href="../../css/profile.style.css">
<link rel="stylesheet" href="../../css/explore.style.css">


<?php
foreach ($getUserInfo as $data) {
    // Show profile cover
    if($data['ProfileCover']) {
        echo "<div id='profile-cover' style='background-color: " . $data['ProfileCover'] . "'></div>";
    } else {
        echo "<div id='profile-cover' style='background-color: #808080'></div>";
    }

    // Show profile image
    if($data['ProfilePic']) {
        echo "<div id='profile-pic' style='background-image: url(" . $data['ProfilePic'] . ")'></div>";
    } else {
        echo "<div id='profile-pic' style='background: #d3d3d3'><p style='text-align: center; margin-top: 42%; font-size: 22px; font-weight: bold;'>No image available</p></div>";
    }

    // Edit button
    echo "<a id='profile-edit-button' class='btn waves-effect waves-light' href='profilesettings.php'>Edit Profile</a>";

    // User info
    echo "<div id='profile-user-info'>";
    echo "<h2 id='profile-username'>" . $data['Username'] . "</h2>";
    echo "<p><b>From: </b>" . $data['Country'] . "</p>";
    echo "<p><b>Number of uploads: </b>" . count($getUserPosts) . "</p>";
    echo "</div>";

    echo "<h3 id='profile-posts-title'>Uploads</h3>";
    echo "<div id='profile-posts'>";

    if(count($getUserPosts) > 0) {
        foreach ($getUserPosts as $data2) {
            echo "<a href=''>";

            // Make image as background for div
            echo "<div id='featpic' style='background-image: url(";
            echo $data2['Img'];
            echo ")'>";

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

            echo "<a class='btn waves-effect waves-light' id='update' type='button' onclick='div_edit_show(". $data2['PostID'] . ")'>Update</a>";
            echo "<a class='btn waves-effect waves-light' id='delete' type='button' >Delete</a>";

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
if(count($getUserComments) > 0) {
    foreach($getUserComments as $data) {
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
} else {
    echo "This user has not made any comments";
}
?>
</div>

<?php include_once("../includes/footer.php") ?>
