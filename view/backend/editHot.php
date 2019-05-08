<?php require_once ('includes/header.php'); ?>
<?php require_once ('../../controller/PostController.php') ?>
<?php
if (!logged_in()) {
    echo "<script>location.href = 'login.php'</script>";
}
?>
    <link rel="stylesheet" href="../../css/adminSelectHot.css">

    <div id="admin-content">
        <h3 id="admin-content-title">Hot New Pictures</h3>

        <hr>

        <div id="admin-content-content">
            <h4>Hot Pictures</h4>
            <p>Here you can see the pictures you have already selected as "Hot"</p>
            <div id="selected-hot">
                <?php require_once "includes/showSelectedHot.php" ?>
            </div>
            <h4>All Pictures</h4>
            <p>This is a list of all pictures uploaded to the site. Check the checkbox to select them as "Hot"</p>
            <div id="select-hot">
                <?php require_once "includes/showAllPostSelectHot.php" ?>
            </div>
        </div>

    </div>

<?php require_once ('includes/footer.php'); ?>