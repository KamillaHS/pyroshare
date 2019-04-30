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

//if(isset($_POST['like-comment'])) {
//    $action = $_GET["action"];
//
//    if($action == "like") {
//        $CommentID = $_GET["CommentID"];
//
//        $commentFunc = new CommentDAO();
//        $commentFunc->likeComment($CommentID);
//
//        echo "<script>location.href = '../view/frontend/profile.php'</script>";
//    }
//}
//
//if(isset($_POST['dislike-comment'])) {
//    $action = $_GET["action"];
//
//    if($action == "dislike") {
//        $CommentID = $_GET["CommentID"];
//
//        $commentFunc = new CommentDAO();
//        $commentFunc->likeComment($CommentID);
//
//        echo "<script>location.href = '../view/frontend/profile.php'</script>";
//    }
//}

?>