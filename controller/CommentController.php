<?php
require_once ('../view/includes/session.php');
require_once('/../model/CommentDAO.php');
?>

<?php

//$action = $_GET["action"];

//if ($action == "create")
//{
//    $fullName = $_POST["fullName"];
//    $contents = $_POST["message"];
//    createReview( $fullName, $contents );
//}

if(isset($_POST['post-comment'])) {
    $action = $_GET["action"];

    if($action == "create") {
        $PostID = $_GET["PostID"];

        $commentFunc = new CommentDAO();
        $commentFunc->createComment($PostID, $_SESSION['user_id']);

        echo "<script>location.href = '../view/frontend/profile.php'</script>";
    }
}

//else if ($action == "delete")
//{
//    $reviewID = $_GET["reviewID"];
//    deleteReview($reviewID);
//}

//echo "<script>location.href = '../view/frontend/profile.php'</script>";

?>