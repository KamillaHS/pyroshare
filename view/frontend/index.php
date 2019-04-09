<?php include_once("../includes/header.php") ?>
<?php require_once("../includes/SelectHeader.php") ?>
<?php
if (logged_in()) {
    header("Location: index2.php");
}
?>

<?php

$i = 0;

foreach ($getPost as $img) {
//    $i++;
    $img = $img['Img'];

//    if() {
//
//    } else {
//
//    }
}

?>

<!--    <div id="front-hero">-->
<!--        <div id="inner hero">-->
<!--            <h1 id="hero-title">Hello World</h1>-->
<!--            <h2 id="hero-sub-title">The biggest official photosharing community for pyromaniacs</h2>-->
<!--            <a class="waves-effect waves-light btn">button</a>-->
<!--        </div>-->
<!--    </div>-->
    <div class="container">
        <div class="content">
            <h1 id="hero-title">PyroShare</h1>
            <h2 id="hero-sub-title">The biggest official photosharing community for pyromaniacs</h2>
            <a class="waves-effect waves-light btn" href="index2.php">button</a>
        </div>

        <div class="slide show" style="background: indianred no-repeat center center fixed"></div>
        <div class="slide" style="background: palevioletred no-repeat center center fixed;"></div>
        <div class="slide" style="background: orangered no-repeat center center fixed;"></div>
    </div>

    <?php include('../includes/aboutSection.php') ?>


<?php include_once("../includes/footer.php") ?>