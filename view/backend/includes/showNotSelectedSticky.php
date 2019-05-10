<?php

$dbCon = dbCon($user, $pass);
$query = $dbCon->prepare("SELECT post.PostID, post.Img, post.UploadedAt, post.isSticky, likes.Likes, likes.Dislikes, TIMESTAMPDIFF(hour, `UploadedAt`, CURRENT_TIMESTAMP) AS TimeDiff
                                    FROM post, likes
                                    WHERE post.PostID = likes.PostID && `post`.`isSticky` = 0
                                    ORDER BY TimeDiff ASC");
$query->execute();
$getStickyPics = $query->fetchAll();
//var_dump($query);

foreach ($getStickyPics as $pic) {
    echo "<div id='" . $pic['PostID'] ."' class='sticky-pic'>";

    // Make image as background for div
    echo "<div id='pic' style='background-image: url(" . $pic['Img'] . ")'></div>";

    // Information below the picture
    echo "<div id='pic-info-below'>";

    echo "<div>";
    $uploadToTime = DateTime::createFromFormat( "Y-m-d H:i:s", $pic['UploadedAt']);
    $uploadTime = $uploadToTime->format('d-m-Y H:i');

    echo "<p id='post-upload'><b>Uploaded at:</b> " . $uploadTime . "</p>";
    echo "<p id='post-likes'><b>Likes:</b> " . $pic['Likes'] . "</p>";
    echo "<p id='post-dislikes'><b>Dislikes:</b> " . $pic['Dislikes'] . "</p>";
    echo "</div>";

    // Checkbox form start
    echo "<form id='sticky-pic-form' method='POST' action='../../controller/PostController.php?action=Sticky&postID=". $pic['PostID'] ."'>";
    echo "<div id='checkbox'>";

    echo "<label>";
    echo "<input name='isSticky' type='checkbox' onchange='this.form.submit()'";

    if($pic['isSticky'] == true) {
        echo "checked='checked'";
    } else {
        echo "";
    }

    echo "'/>";
    echo "<span> </span>";
    echo "</label>";

    // Checkbox form end
    echo "</div>";
    echo "</form>";

    // Information div end tag
    echo "</div>";

    // Surrounding div end tag
    echo "</div>";
}

?>