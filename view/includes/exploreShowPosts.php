
<?php


// Setting upload path
$uploadPath = "../../upload/Pics/";
echo "<a onclick='div_img_show(". $data['PostID'] . ")' >";
// Make image as background for div
echo "<div id='featpic' style='background-image: url(" . $uploadPath .  $data['Img'] . ")'>";
//    echo $data['Img'];
//    echo ")'>";


// Mod box
if (logged_in()) {
    $dbCon = dbCon($user, $pass);
    $user_id = $_SESSION['user_id'];
    $sql = $dbCon->prepare("SELECT UserID, Role FROM `user` WHERE UserID = '$user_id'");
    $sql->execute();
    $getUserRole = $sql->fetch();

    if($getUserRole['Role'] == 'mod' && $data['isFlagged'] == 0 && $user_id !== $data['UserID']) {
        echo "<div id='flag-box'><form method='POST' action='../../controller/PostController.php?action=flag&PostID=" . $data['PostID'] . "'>";
        echo "<button type='submit' name='flag-post'><i class=\"material-icons\">flag</i></button>";
        echo "</form></div>";
    }
}

// Mod box end


// Show title and user in div
echo "<div id='pic-info-bar'>";
echo "<p id='info'>";
echo "<b>" . $data['Title'] . "</b>";
echo "</p>";

$uploadToTime = DateTime::createFromFormat( "Y-m-d H:i:s", $data['UploadedAt']);
$uploadTime = $uploadToTime->format('d-m-Y');

echo "<p id='post-upload'>Uploaded ";
if($data['TimeDiff'] < 1) {
    echo "Less than 1 hour ago";
} elseif($data['TimeDiff'] <= 24 && $data['TimeDiff'] >= 1) {
    echo $data['TimeDiff'] . " hours ago";
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
    echo $uploadTime;
} else {
    echo "No date to display";
}
echo " by ";
echo "<b>";
if(!empty($data['Username'])) {
    echo "<object><a href='../frontend/useraccount.php?userID=" . $data['UserID'] . "'>" . $data['Username'] . "</a></object>";
} else {
    echo "<i>Deleted User</i>";
}
echo"</b>";
echo "</p>";

echo "<div id='info-social'>";
echo "<div id='like-num-box'><i class=\"material-icons\">keyboard_arrow_up</i><p>" . $data['Likes'] . "</p></div>";
echo "<div id='dislike-num-box'><i class=\"material-icons\">keyboard_arrow_down</i><p>" . $data['Dislikes'] . "</p></div>";
echo "<div id='comment-num-box'><i class=\"material-icons\">mode_comment</i><p>";

$dbCon = dbCon($user, $pass);
$sql = "SELECT COUNT(CommentID) as numberOfComments FROM comment WHERE PostID = " . $data['PostID'] ;
$query = $dbCon->prepare($sql);
$query->execute();
$getCommentCount = $query->fetch();

echo $getCommentCount["numberOfComments"];

// End of comment box
echo "</p></div>";
echo "</div>";

// End info bar div
echo "</div>";

// End background div tag
echo "</div>";

// End link tag
echo "</a>";

include('../frontend/img.php');





?>
