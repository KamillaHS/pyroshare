<?php require_once ('includes/header.php'); ?>
<?php
if (!logged_in()) {
    echo "<script>location.href = 'login.php'</script>";
}
?>
    <link rel="stylesheet" href="../../css/adminSelectSticky.style.css">

    <div id="admin-content">
        <h3 id="admin-content-title">Sticky Images</h3>

        <hr>

        <div id="admin-content-content">
            <h4>Selected</h4>
            <p>Here you can see the pictures you have already selected as "Sticky". Uncheck the checkbox to unselect them as "Hot". The pictures that has been selected as "Sticky" will be shown under the "Featured Pictures" section"</p>
            <p>It is recommended that you always strive to have 8 pictures selected, for design purposes.</p>
            <div id="selected-sticky">
                <?php require_once "includes/showSelectedSticky.php" ?>
            </div>
            <h4>Not Selected</h4>
            <p>Here you can see the pictures you haven't selected as "Hot". Check the checkbox to select them as "Hot"</p>
            <div id="select-sticky">
                <?php require_once "includes/showNotSelectedSticky.php" ?>
            </div>
        </div>

    </div>

<?php require_once ('includes/footer.php'); ?>