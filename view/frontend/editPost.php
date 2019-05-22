<link href="../../css/showImg.style.css" rel="stylesheet">
<script src="../../js/uploadPost.js"></script>
<?php
require_once("../includes/session.php");
if (!logged_in()) {
    echo "<script>location.href = 'index.php'</script>";
}?>
<?php require_once('../../controller/PostController.php'); ?>

<?php

//if(isset($_POST['editPost'])) {
//    $editPost = new PostDAO();
//    $editPost->editPost($data2['PostID']);
//}
// Setting upload path
$uploadPath = "../../upload/Pics/";

$postID = $data2['PostID'];

$dbCon = dbCon($user, $pass);
$sql = "SELECT * FROM category";
$query = $dbCon->prepare($sql);
$query->execute();
$getCategories = $query->fetchAll();

$sql = "SELECT category.CategoryName, category.CategoryID, post.Title, post.PostID
                FROM ((category
                INNER JOIN postcat on category.CategoryID = postcat.CategoryID) 
                RIGHT JOIN post on post.PostID = postcat.PostID)
                WHERE post.PostID = '$postID';";
$query = $dbCon->prepare($sql);
$query->execute();
$getPostCategories = $query->fetch();
?>

<div id="<?php echo $data2["PostID"] ?>" class="opacity-background-edit">
    <!-- Popup Div Starts Here -->
    <div id="img-pop-up-box">
        <i id="close" class="material-icons" onclick="div_img_hide(<?php echo $data2['PostID'] ?>)">clear</i>
        <!-- Login Form -->
        <div id="img-pop-up" style="background-image: url('<?php  echo $uploadPath . $data2["Img"]  ?>')"></div>
<!--        <div id="img-popup-content">-->
<!--            <h2 id="img-title"> --><?php //echo $data2['Title'] ?><!-- by --><?php //echo $data2['Username'] ?><!-- </h2>-->
<!--        </div>-->

        <div id="edit-post">
            <!-- Contact Us Form -->
            <form action="../../controller/PostController.php?action=edit&PostID=<?php echo $data2['PostID'] ?>" id="edit-form" method="POST" name="form">
                <!--            <img id="close" src="images/3.png" onclick ="div_hide()">-->
                <h2 id="popupTitle">Edit image</h2>
                <!--            <hr>-->
                <input id="imgUpload" name="img" placeholder="Image url" type="text" value="<?php echo $data2['Img']; ?>" disabled>
                <input id="imgTitle" name="imgTitle" placeholder="Title" type="text" value="<?php if(!empty($data2['Title'])) { echo $data2['Title']; } else { echo "Unnamed"; } ?>">
                <br>
<!--                <label for="imgCategory">Hold "Ctrl" to select multiple categories</label>-->
                <select name="imgCategory" id="imgCategory" class="browser-default">
                    <?php
                    foreach($getCategories as $category) {
                        echo "<option value='" . $category['CategoryID'] . "'";
                        if($category['CategoryName'] ==
                            $getPostCategories['CategoryName']) {
                            echo "selected";
                        }
                        echo ">" . $category['CategoryName'] . "</option>";
                    }
                    ?>
                </select>
                <textarea id="imgDescription" name="imgDescription" placeholder="Description"><?php if(!empty($data2['Description'])) { echo $data2['Description']; } else { echo "..."; } ?></textarea>
                <button type="submit" value="Upload" id="uploadPost-button" class="waves-effect waves-light btn" name="editPost">Save changes</button>
            </form>
        </div>
    </div>
    <!-- Popup Div Ends Here -->
</div>
