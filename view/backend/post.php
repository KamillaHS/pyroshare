<?php require_once('includes/header.php'); ?>
<?php
if (!logged_in()) {
    echo "<script>location.href = 'login.php'</script>";
}
?>
<?php
$postID = $_GET['postID'];

$dbCon = dbCon($user, $pass);
$query = $dbCon->prepare("SELECT post.PostID, post.Img, post.Title, post.Description
                                    FROM post
                                    WHERE post.PostID = '$postID'");
$query->execute();
$getPost = $query->fetch();

$uploadPath = "../../upload/Pics/";
?>
    <link rel="stylesheet" href="../../css/adminUserPost.style.css">

    <div id="admin-content">
        <h3 id="admin-content-title">Access All Posts</h3>

        <hr>

        <a href="accessAllPosts.php" id="admin-back-button" class="waves-effect waves-light btn"><i class="material-icons">keyboard_arrow_left</i></a>


        <div id="admin-content-content">

            <div id="pic" style="background-image: url( <?php echo $uploadPath . $getPost['Img'] ?>)"></div>

            <form id="admin-post-form" method="POST" action="../../controller/PostController.php?action=adminEditPost&postID=<?php echo $postID ?>">
                <input id="imgInput" name="img" type="text" value="<?php echo $getPost['Img'] ?>" disabled>
                <input id="titleInput" name="imgTitle" type="text" value="<?php echo $getPost['Title'] ?>">
                <textarea id="descriptionInput" name="imgDescription"><?php echo $getPost ['Description'] ?></textarea>
                <button id="submitAdminEdit" class="waves-effect waves-light btn" name="adminSubmitEditPost">Update</button>
            </form>

        </div>

    </div>

<?php require_once('includes/footer.php'); ?>