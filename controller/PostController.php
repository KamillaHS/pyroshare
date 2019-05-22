<?php
require_once(__DIR__ . '/../model/PostDAO.php');
?>

<?php

if (isset($_POST['uploadPost'])
    && !empty($_FILES['imgfile'])){

    $action = $_GET['action'];

    if($action == "create") {

        $uploadPost = new PostDAO();
        $uploadPost->createPost();



        echo "<script>location.href = '../view/frontend/profile.php'</script>";
    }
}

// User edit post
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

// Admin edit post
if($_SERVER['REQUEST_METHOD'] == 'POST') {
    $action = $_GET["action"];

    if ($action == "adminEditPost")
    {
        $PostID = $_GET["postID"];

        $editPost = new PostDAO();
        $editPost->adminEditPost($PostID);

        echo "<script>location.href = '../view/backend/accessAllPosts.php'</script>";
    }
}

if(isset($_GET['like-post']) && $_GET['like-post'] == 1 ) {
    $action = $_GET["action"];

    if($action == "like") {
        $PostID = $_GET["PostID"];

        $postLike = new PostDAO();
        $postLike->likePost($PostID);

        echo "<script>location.href = '../view/frontend/index2.php'</script>";
    }
}
elseif(isset($_GET['dislike-post']) &&$_GET['dislike-post'] == 1) {
    $action = $_GET["action"];

    if($action == "dislike") {
        $PostID = $_GET["PostID"];

        $postDislike = new PostDAO();
        $postDislike->dislikePost($PostID);

        echo "<script>location.href = '../view/frontend/index2.php'</script>";
    }
}

// Delete post (user)
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

// Delete post (admin)
if($_SERVER['REQUEST_METHOD'] == 'POST') {
    $action = $_GET["action"];

    if ($action == "AdminPostDelete")
    {
        $PostID = $_GET["postID"];

        $deletePost = new PostDAO();
        $deletePost->deletePost($PostID);

        echo "<script>location.href = '../view/backend/accessAllPosts.php'</script>";
    }
}


if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $action = $_GET["action"];

    if ($action == "Hot")
    {
        if(isset($_POST['isHot'])) {
            $postID = $_GET['postID'];

            $selectHot = new PostDAO();
            $selectHot->makeHot($postID);

            echo "<script>location.href = '../view/backend/editHot.php'</script>";
        } else {
            $postID = $_GET['postID'];

            $selectHot = new PostDAO();
            $selectHot->makeNotHot($postID);

            echo "<script>location.href = '../view/backend/editHot.php'</script>";
        }
    }
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $action = $_GET["action"];

    if ($action == "Sticky")
    {
        if(isset($_POST['isSticky'])) {
            $postID = $_GET['postID'];

            $selectHot = new PostDAO();
            $selectHot->makeSticky($postID);

            echo "<script>location.href = '../view/backend/editSticky.php'</script>";
        } else {
            $postID = $_GET['postID'];

            $selectHot = new PostDAO();
            $selectHot->makeNotSticky($postID);

            echo "<script>location.href = '../view/backend/editSticky.php'</script>";
        }
    }
}

if(isset($_POST['flag-post'])) {
    $action = $_GET["action"];

    if ($action == "flag")
    {
        $PostID = $_GET["PostID"];

        $flagPost = new PostDAO();
        $flagPost->flagPost($PostID);

        echo "<script>location.href = '../view/frontend/explore.php'</script>";
    }
}

if($_SERVER['REQUEST_METHOD'] == 'POST') {
    $action = $_GET["action"];

    if ($action == "AdminPostUnflag")
    {
        $PostID = $_GET["postID"];

        $unflagPost = new PostDAO();
        $unflagPost->unflagPost($PostID);

        echo "<script>location.href = '../view/backend/accessAllPosts.php'</script>";
    }
}

// Admin redirect to the post page
if($_SERVER['REQUEST_METHOD'] == 'POST') {
    $action = $_GET["action"];

    if ($action == "AdminPostEdit")
    {
        $postID = $_GET["postID"];

        echo "<script>location.href = '../view/backend/post.php?postID=" . $postID . "'</script>";
    }
}

//echo "<script>location.href = '../view/frontend/profile.php'</script>";

?>


