<?php
session_start();
include 'connect.php';
include 'config.php';
if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {
    // header(location:login.php);
    echo "<script> window.location.href='signup.php';</script>";
    exit;
} else {
    $userid = $_SESSION['userid'];
    $username = $_SESSION['name'];

}
?>

<!DOCTYPE html>
<html>

<head>
    <title>Rental website</title>
    <link rel="stylesheet" href="profile.css?v=<? echo $version ?>" />
    <script src="https://kit.fontawesome.com/5a78363638.js" crossorigin="anonymous"></script>
</head>

<body>
    <header>
        <div id="navbar">
            <nav>
                <div class="logo">
                    <a href="home.php"><img src="./Images/logo.png" alt="Logo" width="112" /></a>
                </div>
                <div class="left-side">
                    <div class="user-content">
                        <div class="user-profile">
                            <i class="fa-solid fa-bars"></i>
                            <span class="username">
                                <?php echo $username[0]; ?>
                            </span>
                        </div>
                    </div>
                    <div class="dropdown">
                        <ul>
                            <li><a href="#"> Notification</a></li>
                            <li><a href="#"> Profile</a></li>
                            <li><a href="#"> Help Center</a></li>
                            <li><a href="logout.php" class="user"> Log Out</a></li>
                        </ul>
                    </div>
                    <!-- <a href="#" class="left-btn btn">Sign up</a> -->
                </div>
            </nav>
        </div>
    </header>
    <div class="container">
        <div class="main-container center">
            <div class="row">
                <div class="left-column">
                    <div class="left-data">
                        <div class="user-data">
                            <div class="user-info">
                                <div class="profile"><span class="user-photo">K</span></div>
                                <div class="name"><span class="user-name">Kuber Pathak</span></div>
                            </div>
                        </div>
                        <div class="dashboard">
                            <ul class="dashboard-menu">
                                <li><a href="">Your Properties <i class="fa-solid fa-arrow-right"></a></i>
                                </li>
                                <li><a href="">Booked Properties <i class="fa-solid fa-arrow-right"></i></a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class=" right-column">

                </div>

            </div>
        </div>
    </div>

    <script type="module" src="profile.js?v=<? echo $version ?>"></script>
</body>

</html>