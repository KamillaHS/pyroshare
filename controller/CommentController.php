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

?>