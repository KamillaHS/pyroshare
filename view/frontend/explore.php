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

?>

<div id="explore-menu">
    <li><a class="waves-effect waves-light btn" id="login-button" href="">Show All</a></li>
    <li><a class="waves-effect waves-light btn" id="login-button" href=""><?php echo $getCategories['0']['CategoryName'] ?></a></li>
    <li><a class="waves-effect waves-light btn" id="login-button" href=""><?php echo $getCategories['1']['CategoryName'] ?></a></li>
    <li><a class="waves-effect waves-light btn" id="login-button" href=""><?php echo $getCategories['2']['CategoryName'] ?></a></li>
    <li><a class="waves-effect waves-light btn" id="login-button" href=""><?php echo $getCategories['3']['CategoryName'] ?></a></li>
    <li><a class="waves-effect waves-light btn" id="login-button" href=""><?php echo $getCategories['4']['CategoryName'] ?></a></li>

    <form id="explore-filter">
        <p>Sort by: </p>
        <select class="browser-default">
            <option value="newest" selected>Newest</option>
            <option value="mostLikes">Most likes</option>
            <option value="leastLikes">Least likes</option>
        </select>
    </form>
</div>

<a href=''></a>

<div id="show-posts">
    <?php include('../includes/showAllPics.php') ?>
</div>






<?php require_once('../includes/footer.php') ?>
