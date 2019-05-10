<?php require_once ('includes/header.php'); ?>
<?php require_once ('../../controller/PostController.php') ?>
<?php
if (!logged_in()) {
    echo "<script>location.href = 'login.php'</script>";
}
?>
    <link rel="stylesheet" href="../../css/adminSelectHot.style.css">

    <div id="admin-content">
        <h3 id="admin-content-title">Hot New Pictures</h3>

        <hr>

        <div id="admin-content-content">
            <h4>Selected</h4>
            <p>Here you can see the pictures you have already selected as "Hot". Uncheck the checkbox to unselect them as "Hot". The pictures that has been selected as "Hot" will be shown under the "Hot New Pictures" section, and as the frontpage slidehshow pictures.</p>
            <p>It is recommended that you always strive to have 8 pictures selected, for design purposes.</p>
            <div id="selected-hot">
                <?php require_once "includes/showSelectedHot.php" ?>
            </div>
            <h4>Not Selected</h4>
            <p>Here you can see the pictures you haven't selected as "Hot". Check the checkbox to select them as "Hot"</p>
            <div id="select-hot">
                <?php require_once "includes/showAllPostSelectHot.php" ?>
            </div>
        </div>

    </div>

<?php require_once ('includes/footer.php'); ?>