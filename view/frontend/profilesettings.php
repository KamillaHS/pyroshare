<?php include_once("../includes/header.php") ?>
<?php require_once('../includes/SelectUserInfo.php') ?>
<?php require_once('../../model/UserDAO.php'); ?>

<?php
if (!logged_in()) {
    header("Location: index.php");
}
?>

<head>
    <link rel="stylesheet" href="../../css/profile.style.css">
</head>

<?php
foreach ($getUserInfo as $data) {
    // Show profile cover
    if($data['ProfileCover']) {
        echo "<div id='profile-cover' style='background-color: " . $data['ProfileCover'] . "'></div>";
    } else {
        echo "<div id='profile-cover' style='background-color: #808080'></div>";
    }

    // Show profile image
    if($data['ProfilePic']) {
        echo "<div id='profile-pic' style='background-image: url(" . $data['ProfilePic'] . ")'></div>";
    } else {
        echo "<div id='profile-pic' style='background: #d3d3d3'><p style='text-align: center; margin-top: 42%; font-size: 22px; font-weight: bold;'>No image available</p></div>";
    }

//    echo "<h2 id='profilesettings-headline'>Settings for the user: <br> ". $data['Username'] ."</h2>";

?>
<a href="profile.php" id='profile-back-button' class='btn waves-effect waves-light'><i id="close" class="material-icons">keyboard_arrow_left</i></a>

<?php
    if(isset($_POST['submitUserInfo'])) {
          $makeUser = new UserDAO();
          $makeUser->editUserInfo($_SESSION['user_id']);
    }

    if(isset($_POST['submitUserCov'])) {
        $makeUser = new UserDAO();
        $makeUser->editUserCov($_SESSION['user_id']);
    }

    if(isset($_POST['submitUserPic'])) {
        $makeUser = new UserDAO();
        $makeUser->editUserPic($_SESSION['user_id']);
    }

    if(isset($_POST['submitUserPass'])) {
        $makeUser = new UserDAO();
        $makeUser->editUserPass($_SESSION['user_id']);
    }

?>

    <div id="user-settings-menu">
        <h2 id="popupTitle">Settings</h2>
        <button id="btn1" class="waves-effect waves-light btn">Change profile picture</button>
        <button id="btn2" class="waves-effect waves-light btn">Change profile cover</button>
        <button id="btn3" class="waves-effect waves-light btn">Edit user info</button>
        <button id="btn4" class="waves-effect waves-light btn">Edit password</button>
    </div>

    <div id="user-picture-form">
        <form action="" id="user-settings" method="POST">
            <input id="profile-picture" name="profile-pic" placeholder="Username" type="text" value="<?php if(!empty($data['ProfilePic'])) { echo $data['ProfilePic']; } else { echo "No image uploaded. Insert Url."; } ?>"/>
            <button id="register-form-button" class="waves-effect waves-light btn" name="submitUserPic">Update</button>
        </form>
    </div>

    <div id="user-cover-form">
        <form action="" id="user-settings" method="POST">
            <p>
                <label>
                    <input name="radio" value="picture" type="radio" checked />
                    <span>Picture</span>
                </label>
            </p>
            <p>
                <label>
                    <input name="radio" value="color" type="radio" />
                    <span>Color</span>
                </label>
            </p>

            <button id="register-form-button" class="waves-effect waves-light btn" name="submitRadio">Select and continue</button>
        </form>
    </div>

    <div id="user-cover-form2">
        <?php
        if (isset($_POST['submitRadio'])) {
            if (isset($_POST['radio']) && $_POST['radio'] == 'picture') {
                ?>
                <form action="" id="user-settings" method="POST">
                    <input id="profile-cov" name="profile-cov" type="text" placeholder="Insert img url"/>
                    <button id="register-form-button" class="waves-effect waves-light btn" name="submitUserCov">Update</button>
                </form>
                <?php
            } elseif (isset($_POST['radio']) && $_POST['radio'] == 'color') {
                ?>
                <form action="" id="user-settings" method="POST">
                    <input id="profile-cov" name="profile-cov" type="text" value="<?php if(!empty($data['ProfileCover'])) { echo $data['ProfileCover']; } else { echo "#808080"; } ?>"/>
                    <button id="register-form-button" class="waves-effect waves-light btn" name="submitUserCov">Update</button>
                </form>
                <?php
            }
        }
        ?>
    </div>


    <div id="user-info-form">
        <form action="" id="user-settings" method="POST">
            <input id="username" name="username" placeholder="Username" type="text" value="<?php echo $data['Username'] ?>" disabled/>
            <input id="email" name="email" placeholder="Email" type="email" value="<?php echo $data['Email'] ?>" />
            <input id="country" name="country" placeholder="Country" type="text" value="<?php echo $data['Country'] ?>" />
            <input id="dob" name="dob" placeholder="Date of birth" type="date" value="<?php echo $data['Birthday'] ?>" />
            <!--    <br><br>-->
            <!--    <label for="pass">Choose new Password</label>-->
            <!--    <input id="pass" name="pass" placeholder="Password" type="password" value=""/>-->
            <button id="register-form-button" class="waves-effect waves-light btn" name="submitUserInfo">Update</button>
        </form>
    </div>

    <div id="user-pass-form">
        <form action="" id="user-settings" method="POST">
                <label for="pass">Choose new Password</label>
                <input id="pass" name="pass" placeholder="Password" type="password" value=""/>
            <button id="register-form-button" class="waves-effect waves-light btn" name="submitUserPass">Update</button>
        </form>
    </div>

<?php

}
?>

<script>
    document.getElementById("btn1").addEventListener("click", function(){
        document.getElementById("user-picture-form").style.display = "block";
    });

    document.getElementById("btn2").addEventListener("click", function(){
        document.getElementById("user-cover-form").style.display = "block";
    });

    document.getElementById("btn3").addEventListener("click", function(){
        document.getElementById("user-info-form").style.display = "block";
    });

    document.getElementById("btn4").addEventListener("click", function(){
        document.getElementById("user-pass-form").style.display = "block";
    });
</script>



<?php include_once("../includes/footer.php") ?>
