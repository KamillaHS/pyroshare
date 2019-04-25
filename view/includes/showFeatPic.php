<?php
require_once ("../../database/dbcon.php");
require_once("../includes/SelectFeatPic.php");

foreach ($getPostData as $data) {
    echo "<a onclick='div_img_show(". $data['PostID'] . ")' >";
    // Make image as background for div
    echo "<div id='featpic' style='background-image: url(";
    echo $data['Img'];
    echo ")'>";

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
    echo "<b>" . $data['Username'] . "</b>";
    echo "</p>";

    echo "<div id='info-social'>";
    echo "<div id='like-num-box'><i class=\"material-icons\">keyboard_arrow_up</i><p>" . $data['Likes'] . "</p></div>";
    echo "<div id='dislike-num-box'><i class=\"material-icons\">keyboard_arrow_down</i><p>" . $data['Dislikes'] . "</p></div>";
    echo "<div id='comment-num-box'><i class=\"material-icons\">mode_comment</i><p>15</p></div>";
    echo "</div>";

    // End info bar div
    echo "</div>";

    // End background div tag
    echo "</div>";

    // End link tag
    echo "</a>";

    include('../frontend/img.php');
}
?>