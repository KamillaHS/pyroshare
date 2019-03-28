<?php
require( __DIR__ . "/../../database/dbcon.php" );

function readUser()
{
    try {
        global $cxn;

        $handle = $cxn->prepare( 'SELECT * FROM `user` ORDER BY UserID DESC' );
        $handle->execute();
        $result = $handle->fetchAll( \PDO::FETCH_ASSOC );


        foreach ( $result as $row ) {
            print( showUser($row) );
        }
    }
    catch(\PDOException $ex){
        print($ex->getMessage());

    }
}
readUser();

?>

<?php

function showUser($row) {
//    var_dump($row);


    return $showUser = "
    <div id='showUser'>
    <p id='showEmail'>" . $row['Email'] . "</p>
    <p id='showUsername'>" . $row['Username'] . "</p>
    <p id='showCountry'>" . $row['Country'] . "</p>
    <p id='showBirthday'>" . $row['Birthday'] . "</p>
    <br>

</div>";

} ?>



<html lang="en">

<body>


<div id="allUsers">
    <?php global $row; showUser($row); ?>
</div>


</body>
</html>

