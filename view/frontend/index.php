<?php include_once("../includes/header.php") ?>

   <h1>Hello World</h1>
    <a class="waves-effect waves-light btn">button</a>

<?php
$dbCon = dbCon($user, $pass);
$query = $dbCon->prepare("SELECT `Img` FROM `post` WHERE `isHot` = 1");
$query->execute();
//$getPost = $query->fetchAll();
var_dump($query);


while ($row = $query->fetch(PDO::FETCH_ASSOC))
{
    $img = $row['Img'];
    echo $img;
}


?>



<?php include_once("../includes/footer.php") ?>