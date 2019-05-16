<?php require_once ('includes/header.php'); ?>
<?php
if (!logged_in()) {
    echo "<script>location.href = 'login.php'</script>";
}
?>
<?php
$dbCon = dbCon($user, $pass);
$sql = "SELECT * FROM `webstyle`";
$query = $dbCon->prepare($sql);
$query->execute();
$getWebStyle = $query->fetch();
?>
    <link rel="stylesheet" href="../../css/adminWebStyle.style.css">

    <div id="admin-content">
        <h3 id="admin-content-title">Website Style</h3>

        <hr>

        <div id="admin-content-content">
            <p>Here you can change the name of the page, and the logo of the page
            <br>It is recommended that you do not change these without counsel from the designer of the page, even though you have the option to.</p>
            <div id="admin-form">
                <form action="" id="user-settings" method="POST">
                    <input id="webTitleInput" name="webTitle" type="text" value="<?php echo $getWebStyle['WebTitle'] ?>" />
                    <div class="upload-btn-wrapper">
                        <img id="webstyle-logo" src="<?php echo $getWebStyle['Logo'] ?>">
                        <div id="imgUpload">Choose Logo</div>
                        <input id="file" name="webLogo" type="file" />
                        <div id="upload-file-name"><?php echo $getWebStyle['Logo'] ?></div>
                    </div>
                    <br>
                    <button id="submitWebStyle" class="waves-effect waves-light btn" name="updateWebStyle">Update</button>
                </form>
            </div>
        </div>

    </div>

    <script>
        document.querySelector("#file").onchange = function(){
            document.querySelector("#upload-file-name").textContent = this.files[0].name;
        }
    </script>

<?php require_once ('includes/footer.php'); ?>