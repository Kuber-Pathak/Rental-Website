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
    if (isset($_POST['submit'])) {
        $pid = $_POST['delete'];
        $sql1 = "DELETE FROM LocalAreaFacility WHERE PropertyID = '$pid'";
        $result1 = mysqli_query($conn, $sql1);
        $sql2 = "DELETE FROM Amenities WHERE PropertyID = '$pid'";
        $result2 = mysqli_query($conn, $sql2);
        $sql3 = "DELETE FROM Property WHERE PropertyID = '$pid'";
        $result3 = mysqli_query($conn, $sql3);
        if ($result3) {
            echo 'deleted sucessfully';
        } else {
            echo 'not deleted sucessfully';
        }
    }
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
            <nav class="center">
                <div class="logo">
                    <a href="home.php"><img src="Images/logo.png" alt="Logo" width="112" /></a>
                </div>
                <ul class="middle-side">
                    <li>
                        <a href="#">WhishList <i class="fa-regular fa-heart"></i></a>
                    </li>
                    <li><a href="#">Contact Us</a></li>
                    <li>
                        <a href="list.php">List a place <i class="fa-solid fa-plus"></i></a>
                    </li>
                </ul>
                <div class="left-side">
                    <div class="user-content">
                        <div class="user-profile">
                            <i class="fa-solid fa-bars"></i>
                            <span class="username">
                                <?php echo $firstname[0]; ?>
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
    <div class="container">
        <div class="main-container center">
            <div class="row">
                <div class="left-column">
                    <div class="left-data">
                        <div class="user-data">
                            <div class="user-info">
                                <div class="profile"><span class="user-photo">
                                        <?php echo $firstname[0]; ?>
                                    </span></div>
                                <div class="name"><span class="user-name">
                                        <? echo $firstname . " " . $secondname; ?>
                                    </span></div>
                            </div>
                        </div>
                        <div class="dashboard">
                            <ul class="dashboard-menu">
                                <li><a href="">Your Properties <i class="fa-solid fa-arrow-right"></i></a>
                                </li>
                                <li><a href="">Booked Properties <i class="fa-solid fa-arrow-right"></i></a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class=" right-column">
                    <div class="room-lists" id="product-wrapper">
                        <?php
                        $uproducts = getAllUserPrducts($userid);
                        if ($uproducts) {
                            foreach ($uproducts as $row) {
                                echo '
                            <div class="room-box">
                            <div class="room-content">
                              <div class="room-img">
                                <a href="info.php?id=' . $row['PropertyID'], '"><img src="data:image/jpeg;base64,' . $row["mainphoto"] . '" alt="" /></a>
                                <div class="room-fav">
                                <a href="wishlist.php?id=' . $row['PropertyID'], '"<i class="fa-regular fa-heart" style="color: #000000;"></i></a>
                                </div>
                                <div class="view_button">
                                <a href="info.php?id=' . $row['PropertyID'], '">View</a>
                                </div>
                              </div>
                              <div class="room-info">
                                <a href="info.php?id=' . $row['PropertyID'], '" title="' . $row["title"] . '" >
                                  <h4>' . explode(' ', $row["title"])[0] . " " . explode(' ', $row["title"])[1] . '</h4>
                                </a>
                                <div class="info-row">
                                  <div class="info-col-1">
                                    <div class="room-location">
                                      <p class="location" title="' . "Location:" . $row["location"] . '" >
                                        <span class="fas fa-map-pin"></span> ' . $row["location"] . '
                                      </p>
                                    </div>
                                  </div>
                                  <div class="info-col">
                                    <div class="room-type" title="' . "Category:" . $row["category"] . '">
                                      <img src="./Images/roomLogo.png" alt="" height="20px" width="20px" />
                                      <span class="small-text"> ' . $row["category"] . '</span>
                                    </div>
                                  </div>
                                  <div class="info-col " title="' . "Category:" . "Pice : NPR " . $row["price"] . '">
                                    <div class="room-price">
                                      <img src="./Images/cash.png" alt="" height="20px" width="20px" />
                                      <span class="small-text"> ' . $row["price"] . '</span>
                                    </div>
                                  </div>
                                </div>

                              </div>
                              '; ?>
                                <div class="modify-btn">
                                    <a href="update.php?id=<?php echo $row['PropertyID']; ?>"><button
                                            class="update-btn">Update</button></a>
                                    <form onsubmit="return confirm('Are you sure you want to delete this property?');"
                                        action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
                                        <button type="submit" name=" submit" class="delete-btn">Delete</button>
                                        <input type="hidden" name="delete" value="<?php echo $row['PropertyID']; ?>">
                                    </form>
                                </div>
                            </div>

                        </div>
                        <?php
                            }
                        } ?>
            </div>

        </div>
    </div>

</body>
<script type="module" src="profile.js?v=<? echo $version ?>"></script>

</html>