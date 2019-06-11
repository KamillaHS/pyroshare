<?php require_once('../includes/header.php') ?>
<?php require_once('../includes/SelectAllPosts.php') ?>
<head>
    <link rel="stylesheet" href="../../css/explore.style.css">
</head>

<?php

$dbCon = dbCon($user, $pass);

$query = $dbCon->prepare("SELECT * FROM `category`");
$query->execute();
$getCategories = $query->fetchAll();



if (isset($_POST['submit']) &&
    $_POST['option'] == 'newest'){
    $sortOpt = 'newest';
} elseif (isset($_POST['submit']) &&
    $_POST['option'] == 'mostLikes'){
    $sortOpt = 'mostLikes';
} elseif (isset($_POST['submit']) &&
    $_POST['option'] == 'leastLikes'){
    $sortOpt = 'leastLikes';
}else{
    $sortOpt = 'newest';
}


?>

<div id="explore-menu">
    <li><a class="waves-effect waves-light btn" id="login-button" href="?cat=showall&sort=<?php $sortOpt ?>">Show All</a></li>
    <li><a class="waves-effect waves-light btn" id="login-button" href="?cat=nature&sort=newest"><?php echo $getCategories['0']['CategoryName'] ?></a></li>
    <li><a class="waves-effect waves-light btn" id="login-button" href="?cat=buildings&sort=newest"><?php echo $getCategories['1']['CategoryName'] ?></a></li>
    <li><a class="waves-effect waves-light btn" id="login-button" href="?cat=explosions&sort=newest"><?php echo $getCategories['2']['CategoryName'] ?></a></li>
    <li><a class="waves-effect waves-light btn" id="login-button" href="?cat=illustrations&sort=newest"><?php echo $getCategories['3']['CategoryName'] ?></a></li>
    <li><a class="waves-effect waves-light btn" id="login-button" href="?cat=memes&sort=newest"><?php echo $getCategories['4']['CategoryName'] ?></a></li>

    <form id="explore-filter" method="post" name="sortingOption">
        <p>Sort by: </p>
        <select class="browser-default" name="option" >
            <option value="choose" >Choose a Filter</option>
            <option value="newest">Newest</option>
            <option value="mostLikes">Most likes</option>
            <option value="leastLikes">Most Dislikes</option>
        </select>
        <li><button class="waves-effect waves-light btn" id="filter-button" type="submit" name="submit" value="submit">Sort</button></li>
</div>

<div id="show-posts">
    <?php require_once('../../controller/CategoryController.php') ?>

    <?php


//    if (isset($_POST['submit']) &&
//        $_POST['option'] == 'newest'){
//    include('../includes/showAllPicsNewest.php');
//    } elseif (isset($_POST['submit']) &&
//    $_POST['option'] == 'mostLikes'){
//        include('../includes/showAllPicsMostLikes.php');
//    } elseif (isset($_POST['submit']) &&
//    $_POST['option'] == 'leastLikes'){
//        include('../includes/showAllPicsLeastLikes.php');
//    }else{
//        include('../includes/showAllPicsNewest.php');
//    }
     ?>


</div>


<?php require_once('../includes/footer.php') ?>
