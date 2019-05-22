<?php require_once("../../database/dbcon.php"); ?>
<?php require_once("session.php"); ?>
<?php require_once("../includes/SelectWebStyle.php"); ?>
<!DOCTYPE html>
<html>
<head>
    <!--Import Google Icon Font-->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <!-- Compiled and minified CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
    <script src="https://code.jquery.com/jquery-2.1.3.min.js"></script>
    <!--Let browser know website is optimized for mobile-->
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>

    <!-- Custom CSS -->
    <link rel="stylesheet" href="../../css/backend.style.css">

    <title>PyroShare - Admin</title>

    <!--Changing browser icon to our logo-->
    <link rel="apple-touch-icon" sizes="57x57" href="/logo/favicon/apple-icon-57x57.png">
    <link rel="apple-touch-icon" sizes="60x60" href="/logo/favicon/apple-icon-60x60.png">
    <link rel="apple-touch-icon" sizes="72x72" href="/logo/favicon/apple-icon-72x72.png">
    <link rel="apple-touch-icon" sizes="76x76" href="/logo/favicon/apple-icon-76x76.png">
    <link rel="apple-touch-icon" sizes="114x114" href="/logo/favicon/apple-icon-114x114.png">
    <link rel="apple-touch-icon" sizes="120x120" href="/logo/favicon/apple-icon-120x120.png">
    <link rel="apple-touch-icon" sizes="144x144" href="/logo/favicon/apple-icon-144x144.png">
    <link rel="apple-touch-icon" sizes="152x152" href="/logo/favicon/apple-icon-152x152.png">
    <link rel="apple-touch-icon" sizes="180x180" href="/logo/favicon/apple-icon-180x180.png">
    <link rel="icon" type="image/png" sizes="192x192"  href="/logo/favicon/android-icon-192x192.png">
    <link rel="icon" type="image/png" sizes="32x32" href="/logo/favicon/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="96x96" href="/logo/favicon/favicon-96x96.png">
    <link rel="icon" type="image/png" sizes="16x16" href="/logo/favicon/favicon-16x16.png">
    <link rel="manifest" href="/logo/favicon/manifest.json">
    <meta name="msapplication-TileColor" content="#ffffff">
    <meta name="msapplication-TileImage" content="/logo/favicon/ms-icon-144x144.png">
    <meta name="theme-color" content="#ffffff">
</head>
<body>

    <header>
        <nav>
            <div class="nav-wrapper">
                <div id="logo-box">
                    <a href="index.php" class="brand-logo left"><img id="header-logo" src="<?php foreach ($getWebStyle as $data) { echo $data['Logo']; } ?>" alt=""></a>
                </div>
                <ul id="nav-items" class="right">
                    <a href="../frontend/index.php" class="btn waves-effect waves-light" id="visit-site">
                        View Site
                    </a>
                    <form name="logout" method="post" action="includes/logout.php" id="logout-form">
                        <button class="btn waves-effect waves-light" type="submit" name="logout" id="logoutButton">
                            Log out
                        </button>
                    </form>
                </ul>
            </div>
        </nav>
    </header>

    <div id="side-and-content">
        <div id="side-menu">
                <ul>
                    <li><a href="index.php">Dashboard</a></li>
                    <li><a href="accessAllPosts.php">Access All Posts</a></li>
                    <li><a href="accessAllUsers.php">Access All Users</a></li>
                    <li><a href="banUsers.php">Ban Users</a></li>
                    <li><a href="editSticky.php">Sticky Images</a></li>
                    <li><a href="editHot.php">Hot New Pictures</a></li>
                    <li><a href="editWebInfo.php">Website Info</a></li>
                    <li><a href="editWebStyle.php">Website Style</a></li>
                    <li><a href="addAdmin.php">Add New Admin</a></li>
                    <li><a href="adminSettings.php">Settings</a></li>
                </ul>

            <a href="#" id="top-link"><i class="material-icons">keyboard_arrow_up</i></a>
        </div>


