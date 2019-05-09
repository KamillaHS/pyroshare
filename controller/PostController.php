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



//echo "<script>location.href = '../view/frontend/profile.php'</script>";

?>


