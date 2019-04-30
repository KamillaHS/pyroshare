<?php
require_once('/../model/PostDAO.php');
?>

<?php

if (isset($_POST['uploadPost'])
    && !empty($_POST['img'])){

    $action = $_GET['action'];

    if($action == "create") {

        $uploadPost = new PostDAO();
        $uploadPost->createPost();

        echo "<script>location.href = '../view/frontend/profile.php'</script>";
    }
}


if(isset($_POST['editPost'])) {
    $action = $_GET["action"];

    if ($action == "edit")
    {
        $PostID = $_GET["PostID"];

        $editPost = new PostDAO();
        $editPost->editPost($PostID);

        echo "<script>location.href = '../view/frontend/profile.php'</script>";
    }
}

if(isset($_POST['deletePostForm'])) {
    $action = $_GET["action"];

    if ($action == "delete")
    {
        $PostID = $_GET["PostID"];

        $deletePost = new PostDAO();
        $deletePost->deletePost($PostID);

        echo "<script>location.href = '../view/frontend/profile.php'</script>";
    }
}


//echo "<script>location.href = '../view/frontend/profile.php'</script>";

?>


