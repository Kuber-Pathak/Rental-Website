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
    if (isset($_POST['wishlist_delete'])) {
        $wishlistid = $_POST['wishlistId'];
        $sql = "SELECT * FROM wishlist_info WHERE wishlistId = '$wishlistid' ";
        $result = mysqli_query($conn, $sql);
        if (mysqli_num_rows($result) > 0) {
            $sql = "DELETE FROM wishlist_info WHERE wishlistId = '$wishlistid'";
            $result = mysqli_query($conn, $sql);
            if ($result) {
                $sucess = "Removed from wishlist.";
            }
        }
    }

    $sql = "SELECT * FROM wishlist_info 
            INNER JOIN Property 
            ON Property.PropertyID = wishlist_info.PropertyID
            WHERE wishlist_info.user_id = '$userid'";
    $result = mysqli_query($conn, $sql);


    ?>
    <!DOCTYPE html>
    <html>

    <head>
        <title>Rental website</title>
        <link rel="stylesheet" href="wishlist.css?v=<?php echo $version; ?>" />
        <script src="https://kit.fontawesome.com/5a78363638.js" crossorigin="anonymous"></script>
    </head>


    <body>
        <header>
            <div id="navbar">
                <nav class="center">
                    <div class="logo">
                        <a href="home.php"><img src="Images/logo3.png" alt="Logo" width="112" /></a>
                    </div>
                    <ul class="middle-side">
                        <li class="active">
                            <a href="wishlist.php">WishList <i class="fa-regular fa-heart"></i></a>
                        </li>
                        <li><a href="">Contact Us</a></li>
                        <li>
                            <a href="list.php">List a place <i class="fa-solid fa-plus"></i></a>
                        </li>
                    </ul>
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
                                <li><a href="profile.php"><i class="fa-solid fa-user"></i> Profile</a></li>
                                <li><a href="wishlist.php"><i class="fa-solid fa-heart"></i> WishList</a></li>
                                <li><a href="contact.php"><i class="fa-solid fa-message"></i> Contact Us</a></li>
                                <li><a href=""><i class="fa-solid fa-circle-info"></i> Help Center</a></li>
                                <li><a href="logout.php" class="user"><i class="fa-solid fa-arrow-right-from-bracket"></i>
                                        Log Out</a>
                                </li>
                            </ul>
                        </div>
                        <!-- <a href="" class="left-btn btn">Sign up</a> -->
                    </div>
                </nav>
            </div>
        </header>
        <div class="bodyw center">
            <?php
            if (isset($sucess)) {
                echo '
    <div class="sucess">
    <p class="sucess_msg" id="format">
    <i class="fa-solid fa-check"></i> 
    ' . $sucess . '
    </p>
    </div>

    ';
                unset($sucess);
            } ?>
            <div class="row">
                <div class="wishlistw"> Wishlists </div>
                <div class="image">
                    <?php
                    if (mysqli_num_rows($result) > 0) {
                        while ($row = mysqli_fetch_assoc($result)) {
                            ?>
                            <div class="whited">
                                <div class="place">
                                    <div class="room_image">
                                        <a href="info.php?id=<?php echo $row['PropertyID']; ?>"><img class="image1"
                                                src="data:image/jpeg;base64,<?php echo $row["mainphoto"]; ?>" alt="" /></a>
                                    </div>
                                    <div class="heart">
                                        <form action="" method="POST">
                                            <input type="hidden" name="wishlistId" value="<?php echo $row['wishlistId']; ?>">
                                            <button type="submit" name="wishlist_delete" id="wishlist-btn">
                                                <i class="fa-solid fa-heart fa-xl" style="color: #ff0000;"></i>
                                            </button>
                                        </form>
                                    </div>
                                    <div class="view_button">
                                        <a href="info.php?id=<?php echo $row['PropertyID']; ?>">View</a>
                                    </div>
                                </div>
                                <div class="texts">
                                    <div class="info-col-title">
                                        <p class="title">
                                            <?= $row['title']; ?>
                                        </p>
                                    </div>
                                    <div class="info-col">

                                        <p id="location"><i class="fa-solid fa-location-dot fa-beat"></i>
                                            <?= $row['location']; ?>
                                        </p>
                                    </div>
                                    <div class="info-col">
                                        <p id="category"><i class="fa-solid fa-house fa-beat"></i>
                                            <?= $row['category']; ?>
                                        </p>
                                    </div>
                                    <div class="info-col">
                                        <p id="price"><i class="fa-solid fa-sack-dollar fa-beat"></i> Rs
                                            <?= $row['price']; ?>
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <?php
                        }
                    }

}
?>
            </div>
        </div>
    </div>

    <script type="module" src="wishlist.js?v=<?php echo $version; ?>">
    </script>
</body>

</html>