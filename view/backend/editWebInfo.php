<?php require_once ('includes/header.php'); ?>
<?php
if (!logged_in()) {
    echo "<script>location.href = 'login.php'</script>";
}
?>
    <link rel="stylesheet" href="../../css/adminAdd.style.css">
    <link rel="stylesheet" href="../../css/adminEditWebInfo.style.css">

    <div id="admin-content">
        <h3 id="admin-content-title">Website Info</h3>

        <hr>

        <?php
        $dbCon = dbCon($user, $pass);
        $regex = "/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$/";
        $sql = "SELECT * FROM `websiteinfo`";
        $query = $dbCon->prepare($sql);
        $query->execute();
        $getWebInfo = $query->fetch();


        if(isset($_POST['updateWebInfo'])) {
            $email = $_POST['contact'];
            $description = $_POST['description'];
            $rulesAndReg = $_POST['rules-reg'];
            $contact = $_POST['contact'];
            if (preg_match($regex, $email)) {

            $sql = "UPDATE `websiteinfo` SET `Description` = '$description', `RulesAndRegulations` = '$rulesAndReg', `Contact` = '$contact' WHERE InfoID = 1";
            $query = $dbCon->prepare($sql);
            $query->execute();


            echo "<script>location.href = 'editWebInfo.php'</script>";

        }else {
                echo "<script>alert('Please use a valid email!!');</script>";}
        }

        ?>

        <div id="admin-content-content">
            <div id="admin-form">
                <form action="" id="user-settings" method="POST">
                    <label for="description">About Section</label>
                    <textarea id="admin-description" name="description"><?php echo $getWebInfo['Description'] ?></textarea>
                    <br><br>
                    <label for="rules-reg">Rules and Regulations</label>
                    <textarea id="admin-rules-reg" name="rules-reg">
                        <?php echo $getWebInfo['RulesAndRegulations'] ?>
                    </textarea>
                    <br><br>
                    <label for="contact">Contact information (email)</label>
                    <input id="admin-contact" name="contact" type="email" value="<?php echo $getWebInfo['Contact'] ?>"/>
                    <br><br>
                    <button id="admin-update" class="waves-effect waves-light btn" name="updateWebInfo">Update</button>
                </form>
            </div>
        </div>
        <script src="http://js.nicedit.com/nicEdit-latest.js" type="text/javascript"></script>
        <script type="text/javascript">bkLib.onDomLoaded(nicEditors.allTextAreas);</script>
    </div>

<?php require_once ('includes/footer.php'); ?>