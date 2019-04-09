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

    <title>Document</title>
</head>
<body>

    <header>
        <nav>
            <div class="nav-wrapper">
                <div id="logo-box">
                    <a href="index.php" class="brand-logo left">PyroShare</a>
                </div>
                <ul id="nav-items" class="right">
                    <button class="btn waves-effect waves-light" id="visit-site">
                        View Site
                    </button>
                    <form name="logout" method="post" action="../includes/logout.php" id="logout-form">
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
                    <li><a href="">Dashboard</a></li>
                    <li><a href="">Frontpage</a></li>
                    <li><a href="">Sticky Images</a></li>
                    <li><a href="">Hot New Pictures</a></li>
                    <li><a href="">Website Info</a></li>
                    <li><a href="">Website Style</a></li>
                    <li><a href="">Settings</a></li>
                </ul>
        </div>


