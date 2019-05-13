<?php

$dbCon = dbCon($user, $pass);
$query = $dbCon->prepare("SELECT post.PostID, post.Img, post.UploadedAt, post.isHot, likes.Likes, likes.Dislikes, TIMESTAMPDIFF(hour, `UploadedAt`, CURRENT_TIMESTAMP) AS TimeDiff
                                    FROM post, likes
                                    WHERE post.PostID = likes.PostID && `post`.`isHot` = 0
                                    ORDER BY TimeDiff ASC");
$query->execute();
$getHotPics = $query->fetchAll();
//var_dump($query);

foreach ($getHotPics as $pic) {
    // Setting upload path
    $uploadPath = "../../upload/Pics/";

    echo "<div id='" . $pic['PostID'] ."' class='hot-pic'>";

    // Make image as background for div
    echo "<div id='pic' style='background-image: url(" . $uploadPath . $pic['Img'] . ")'></div>";

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
    echo "<form id='hot-pic-form' method='POST' action='../../controller/PostController.php?action=Hot&postID=". $pic['PostID'] ."'>";
    echo "<div id='checkbox'>";

    echo "<label>";
    echo "<input name='isHot' type='checkbox' onchange='this.form.submit()'";

    if($pic['isHot'] == true) {
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

