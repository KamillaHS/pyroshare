<?php

$dbCon = dbCon($user, $pass);
$query = $dbCon->prepare("SELECT `user`.UserID, `user`.Username, `user`.Email, `user`.ProfilePic, `user`.isBanned
                                    FROM `user`
                                    WHERE `user`.`isBanned` = 1
                                    ORDER BY `user`.Username ASC");
$query->execute();
$getBannedUsers = $query->fetchAll();
//var_dump($getBannedUsers);

foreach ($getBannedUsers as $user) {

    // Start surrounding div
    echo "<div id='" . $user['UserID'] . "' class='user-box'>";

    // Show profile Image
    if(!empty($user['ProfilePic'])) {
        // Setting upload path
        $uploadPath = "../../upload/ProfilePics/";
        echo "<div id='user-img' style='background-image: url(" . $uploadPath . $user['ProfilePic'] . ")'></div>";
    } else {
        echo "<div id='user-img' style='background: grey'></div>";
    }

    // User Info box
    echo "<div id='user-info'>";

    echo "<p><b>Username:</b> " . $user['Username'] . "</p>";
    echo "<p><b>Email:</b> " . $user['Email'] . "</p>";

    // User Info box end
    echo "</div>";

    // Checkbox form start
    echo "<form id='banned-form' method='POST' action='../../controller/UserController.php?action=Ban&userID=". $user['UserID'] ."'>";
    echo "<div id='checkbox'>";

    echo "<label>";
    echo "<input name='isBanned' type='checkbox' onchange='this.form.submit()'";

    if($user['isBanned'] == true) {
        echo "checked='checked'";
    } else {
        echo "";
    }

    echo "'/>";
    echo "<span> </span>";
    echo "</label>";

    // Checkbox form end
    echo "</div>";
    echo "</form>";

    // End surrounding div
    echo "</div>";
}