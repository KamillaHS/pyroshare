<?php
require_once ("../../database/dbcon.php");
require_once("../includes/SelectLateComment.php");

foreach ($getCommentData as $data) {
    echo "<div id='comment-single'>";

    // Show user
    echo "<div id='user-box'>";
    echo "<div id='comment-user-img'></div>";
    echo "<p>" . $data['Username'] ."</p>";
    echo "</div>";
    echo "<p id='comment-after-user'>said:</p>";

    // Comment top
    echo "<div id='comment-text-top'></div>";

    // Show comment
    echo "<div id='comment-text-box'>";
    echo "<p id='comment-text'>" . $data['Description'] . "</p>";
    echo "</div>";

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
    echo '<a href="">View Picture</a>';
    echo "</div>";

    echo "</div>";
}
?>