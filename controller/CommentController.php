<?php
require_once ('../view/includes/session.php');
require_once('/../model/CommentDAO.php');
?>

<?php

if(isset($_POST['post-comment'])) {
    $action = $_GET["action"];

    if($action == "create") {
        $PostID = $_GET["PostID"];

        $commentFunc = new CommentDAO();
        $commentFunc->createComment($PostID, $_SESSION['user_id']);

        echo "<script>location.href = '../view/frontend/profile.php'</script>";
    }
}

if(isset($_GET['like-comment']) && $_GET['like-comment'] == 1 ) {
    $action = $_GET["action"];

    if($action == "like") {
        $CommentID = $_GET["CommentID"];

        $commentFunc = new CommentDAO();
        $commentFunc->likeComment($CommentID);

        echo "<script>location.href = '../view/frontend/index2.php'</script>";
    }
} elseif(isset($_GET['dislike-comment']) &&$_GET['dislike-comment'] == 1) {
    $action = $_GET["action"];

    if($action == "dislike") {
        $CommentID = $_GET["CommentID"];

        $commentFunc = new CommentDAO();
        $commentFunc->dislikeComment($CommentID);

        echo "<script>location.href = '../view/frontend/index.php'</script>";
    }
}

?>