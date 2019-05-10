<?php include_once("../includes/header.php") ?>
<?php require_once("../includes/SelectHeader.php") ?>
<?php
if (logged_in()) {
    echo "<script>location.href = 'index2.php'</script>";
}
?>

    <div class="container">
        <div class="content">
            <img id="front-logo" src="<?php foreach ($getWebStyle as $data) { echo $data['Logo']; } ?>" alt="">
            <h1 id="hero-title">PyroShare</h1>
            <h2 id="hero-sub-title">The biggest official photosharing community for pyromaniacs</h2>
<!--            <a class="waves-effect waves-light btn" href="index2.php">button</a>-->
        </div>

<!--        <div class="slide show" style="background: indianred no-repeat center center fixed"></div>-->
<!--        <div class="slide" style="background: palevioletred no-repeat center center fixed;"></div>-->
<!--        <div class="slide" style="background: orangered no-repeat center center fixed;"></div>-->
        <?php
        // Setting upload path
        $uploadPath = "../../upload/Pics/";

        foreach ($getPost as $img) {
            echo "<div class='slide show' id='header-imgs' style='background: url(".$uploadPath. $img['Img'] .") no-repeat center center fixed; background-size:100%;'></div>";
        }

        ?>
        <div id="fade-over"></div>
    </div>

    <?php include('../includes/aboutSection.php') ?>


<?php include_once("../includes/footer.php") ?>