<?php
$dbCon = dbCon($user, $pass);
$query = $dbCon->prepare("SELECT `user`.Username, post.PostID, post.Img, post.Title, post.Description, post.isFlagged
                                    FROM post 
                                    LEFT JOIN `user`
                                    ON post.UserID = `user`.`UserID`
                                    WHERE isFlagged = 1
                                    ORDER BY PostID DESC");
$query->execute();
$getFlaggedPics = $query->fetchAll();
//var_dump($query);

foreach ($getFlaggedPics as $pic) {
    // Setting upload path
    $uploadPath = "../../upload/Pics/";

    echo "<div id='" . $pic['PostID'] ."' class='flagged-pic'>";

    // Make image as background for div
    echo "<div id='pic' style='background-image: url(" . $uploadPath . $pic['Img'] . ")'></div>";

    // Information below the picture
    echo "<div id='pic-info-below'>";

    echo "<div>";
    echo "<p id='post-user'><b>Uploaded by:</b> ";
    if(!empty($pic['Username'])) {
        echo $pic['Username'];
    } else {
        echo "<i>Deleted User</i>";
    }
    echo "</p>";
    echo "<p id='post-upload'><b>Title:</b> " . $pic['Title'] . "</p>";
    echo "<p id='post-likes'><b>Description:</b> " . $pic['Description'] . "</p>";
    echo "</div>";

    // Post Options
    echo "<div id='post-options'>";

    echo "<form id='post-options-form' method='POST' action='../../controller/PostController.php?action=AdminPostUnflag&postID=" . $pic['PostID'] . "'>";
    echo "<input type='button' class='btn' id='post-option-btn' value='Unflag' name='unflag' onclick='this.form.submit()'>";
    echo "</form>";

    echo "<form id='post-options-form' method='POST' action='../../controller/PostController.php?action=AdminPostEdit&postID=" . $pic['PostID'] . "'>";
    echo "<input type='button' class='btn' id='post-option-btn' value='Edit Info' name='editPost' onclick='this.form.submit()'>";
    echo "</form>";

    echo "<form id='post-options-form' method='POST' action='../../controller/PostController.php?action=AdminPostDelete&postID=" . $pic['PostID'] . "'>";
    echo "<input type='button' class='btn admin-post-delete' id='post-option-btn' value='Delete' name='deletePost' onclick='this.form.submit()'>";
    echo "</form>";

    // Post Options end
    echo "</div>";

    // Information div end tag
    echo "</div>";

    // Surrounding div end tag
    echo "</div>";
}

?>

