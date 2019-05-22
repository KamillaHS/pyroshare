<div id="about-page">
    <div>
        <h1>About PyroShare</h1>
        <p>
            <?php
//            $user_id = $_SESSION['user_id'];
            $sql = "SELECT Description, Contact FROM websiteinfo";
            $query = $dbCon->prepare($sql);
            $query->execute();
            $getAbout= $query->fetch();
            echo "$getAbout[0]";
            ?>
            <i><?php echo $getAbout['Contact'] ?></i>
        </p>
    </div>
</div>