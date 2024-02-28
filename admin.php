<?php
session_start();
include 'connect.php';
include 'config.php';
include 'product_query.php';
if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {
    // header(location:login.php);
    echo "<script> window.location.href='signup.php';</script>";
    exit;
} else {
    $userid = $_SESSION['userid'];
    $firstname = $_SESSION['name'];
    $secondname = $_SESSION['lname'];
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>Admin Panel</title>
    <link rel="stylesheet" href="admin.css?v=<? echo $version ?>" />
    <script src="https://kit.fontawesome.com/5a78363638.js" crossorigin="anonymous"></script>
</head>

<body>
    <header>
        <div id="navbar">
            <nav>
                <div class="logo">
                    <a href="admin.php"><img src="./Images/logo3.png" alt="Logo" width="112" /></a>
                </div>
                <div class="left-side">
                    <div class="user-content">
                        <div class="user-profile">
                            <span class="username">
                                <?php echo $firstname[0]; ?>
                            </span>
                        </div>
                    </div>

                    <!-- <a href="#" class="left-btn btn">Sign up</a> -->
                </div>
            </nav>
        </div>
    </header>
    <div class="container">
        <div class="main-container">
            <?php
            if (isset($_SESSION['sucess'])) {
                echo '
    <div class="sucess">
    <p class="sucess_msg" id="format">
    <i class="fa-solid fa-check"></i> 
    ' . $_SESSION['sucess'] . '
    </p>
    </div>

    ';
                unset($_SESSION['sucess']);
            }
            ?>
            <div class="row">
                <div class="left-column">
                    <div class="left-data">
                        <div class="dashboard">
                            <ul class="dashboard-menu">
                                <li class="active"><a href=""><span><i class="fa-solid fa-layer-group"></i>
                                            <p>Dashboard</p>
                                        </span><i class="fa-solid fa-arrow-right dashboard-icon"></i></a>
                                </li>
                                <li><a href="admin_properties.php"><span><i class="fa-solid fa-house-chimney"></i>
                                            <p>Properties</p>
                                        </span> <i class="fa-solid fa-arrow-right dashboard-icon"></i></a>
                                </li>
                                <li><a href="admin_user.php"><span><i class="fa-solid fa-user"></i>
                                            <p>Users</p>
                                        </span> <i class="fa-solid fa-arrow-right dashboard-icon"></i></a>
                                </li>
                                <li><a href="admin_msg.php"><span><i class="fa-solid fa-message"></i>
                                            <p>Messages</p>
                                        </span>
                                        <i class="fa-solid fa-arrow-right dashboard-icon"></i></a>
                                </li>
                                <li><a href="logout.php"><span><i class="fa-solid fa-arrow-right-from-bracket"></i>
                                            <p>Log Out</p>
                                        </span><i class="fa-solid fa-arrow-right dashboard-icon"></i></a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class=" right-column">
                    <div class="total-count">
                        <div class="count-card" id="count-1">
                            <div class="count-info">
                                <div class="count-icon">
                                    <i class="fa-regular fa-building"></i>
                                </div>
                                <div class="count-data">
                                    <p>Total Properties</p>
                                    <span>
                                        <?php
                                        $property_num = getAllProperties();
                                        echo count($property_num);
                                        ?>
                                    </span>
                                </div>

                            </div>
                        </div>
                        <div class="count-card" id="count-2">
                            <div class="count-info">
                                <div class="count-icon">
                                    <i class="fa-solid fa-users"></i>
                                </div>
                                <div class="count-data">
                                    <p>Total Users</p>
                                    <span>
                                        <?php
                                        $user_num = getAllUsers();
                                        echo count($user_num);
                                        ?>
                                    </span>
                                </div>

                            </div>
                        </div>
                        <div class="count-card" id="count-3">
                            <div class="count-info">
                                <div class="count-icon">
                                    <i class="fa-regular fa-handshake"></i>
                                </div>
                                <div class="count-data">
                                    <p>Total Bookings</p>
                                    <span>

                                    </span>
                                </div>

                            </div>
                        </div>
                        <div class="count-card" id="count-4">
                            <div class="count-info">
                                <div class="count-icon">
                                    <i class="fa-solid fa-sack-dollar"></i>
                                </div>
                                <div class="count-data">
                                    <p>Total Earning</p>
                                    <span>

                                    </span>
                                </div>

                            </div>
                        </div>
                    </div>
                    <div class="chart">
                        <img src="Images/chart.jpeg" alt="">
                    </div>
                </div>
            </div>
</body>
<script type="module" src="admin.js?v=<? echo $version ?>"></script>

</html>