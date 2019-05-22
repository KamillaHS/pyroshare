<?php

$dbCon = dbCon($user, $pass);
$query = $dbCon->prepare("SELECT `user`.UserID, `user`.Username, `user`.Password, `user`.Email, `user`.Country, 
                                    `user`.Birthday, `user`.ProfilePic, `user`.ProfileCover, `user`.isBanned
                                    FROM `user`
                                    WHERE `user`.`isBanned` = 0 && `user`.Role = 'mod' 
                                    ORDER BY `user`.Username ASC");
$query->execute();
$getUsersMods = $query->fetchAll();
//var_dump($getBannedUsers);

foreach ($getUsersMods as $user) {

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

    // Options box
    echo "<div id='user-options'>";

    echo "<form id='user-options-form' method='POST' action='../../controller/UserController.php?action=AdminUserUser&userID=";
    echo $user['UserID'];
    echo "'>";
    echo "<input type='button' class='btn' id='user-option-btn' value='Make User' name='makeUser' onclick='this.form.submit()'>";
    echo "</form>";



    echo "<form id='user-options-form' method='POST' action='../../controller/UserController.php?action=AdminUserEdit&userID=" . $user['UserID'] . "'>";
    echo "<input type='button' class='btn' id='user-option-btn' value='Edit Info' name='editUser' onclick='this.form.submit()'>";
    echo "</form>";

    echo "<form id='user-options-form' method='POST' action='../../controller/UserController.php?action=AdminUserDelete&userID=" . $user['UserID'] . "'>";
    echo "<input type='button' class='btn admin-user-delete' id='user-option-btn' value='Delete' name='deleteUser' onclick='this.form.submit()'>";
    echo "</form>";

    // Options box end
    echo "</div>";

    // End surrounding div
    echo "</div>";
}