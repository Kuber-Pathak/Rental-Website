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
    <link rel="stylesheet" href="wishlist.css" />
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
                            <li><a href="profile.php"> Profile</a></li>
                            <li><a href="#"> Help Center</a></li>
                            <li><a href="logout.php" class="user"> Log Out</a></li>
                        </ul>
                    </div>
                    <!-- <a href="#" class="left-btn btn">Sign up</a> -->
                </div>
            </nav>
        </div>
    </header>
    <div class="bodyw">
        <div class="row">
            <div class="wishlistw"> Wishlists </div>

            <div class="image">
                <div class="whited">
                    <div class="image1 place">
                        <div class="icon">

                            <button class="button">
                                <i class="fa-solid fa-x"></i>
                            </button>
                            <div class="heart">
                                <button>
                                    <i class="fa-solid fa-heart fa-2xl"></i>
                                    <button>
                            </div>
                        </div>

                    </div>


                    <div class="texts">
                        <span style="font-weight:bold">Alisha Shrestha</span> <br>
                        <span style="font-weight:bold">Location:</span><span
                            style="color: rgb(58, 57, 57)">Kalanki</span><br>
                        <span style="font-weight:bold">Type:</span><span
                            style="color: rgb(58, 57, 57)">Apartment</span><br>
                        <span style="font-weight:bold">Price:</span><span style="color: rgb(58, 57, 57)">Rs2000</span>
                    </div>
                </div>

                <div class="whited">
                    <div class="image2 place">
                        <div class="icon">

                            <button class="button">
                                <i class="fa-solid fa-x"></i>
                            </button>
                            <div class="heart">
                                <button>
                                    <i class="fa-solid fa-heart fa-2xl"></i>
                                    <button>
                            </div>
                        </div>

                    </div>

                    <div class="texts">
                        <span style="font-weight:bold">Alisha Shrestha</span> <br>
                        <span style="font-weight:bold">Location:</span><span
                            style="color: rgb(58, 57, 57)">Kalanki</span><br>
                        <span style="font-weight:bold">Type:</span><span
                            style="color: rgb(58, 57, 57)">Apartment</span><br>
                        <span style="font-weight:bold">Price:</span><span style="color: rgb(58, 57, 57)">Rs2000</span>
                    </div>
                </div>


            </div>



        </div>
    </div>
    <form>

        <script type="module" src="wishlist.js"></script>
</body>

</html>