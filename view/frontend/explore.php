<?php require_once('../includes/header.php') ?>
<?php require_once('../includes/SelectAllPosts.php') ?>
<head>
    <link rel="stylesheet" href="../../css/explore.style.css">
</head>

<div id="explore-menu">
    <li><a class="waves-effect waves-light btn" id="login-button" href="">Show All</a></li>
    <li><a class="waves-effect waves-light btn" id="login-button" href="">Category 1</a></li>
    <li><a class="waves-effect waves-light btn" id="login-button" href="">Category 2</a></li>
    <li><a class="waves-effect waves-light btn" id="login-button" href="">Category 3</a></li>
    <li><a class="waves-effect waves-light btn" id="login-button" href="">Category 4</a></li>
    <li><a class="waves-effect waves-light btn" id="login-button" href="">Category 5</a></li>

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
