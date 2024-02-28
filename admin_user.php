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
    if (isset($_GET['delete_id'])) {
        $del_id = $_GET['delete_id'];
        $sql_get_propertyID = "SELECT * FROM Property WHERE user_id = '$del_id'";
        $result_get_propertyID = mysqli_query($conn, $sql_get_propertyID);
        if (mysqli_num_rows($result_get_propertyID) > 0) {
            while ($row = mysqli_fetch_assoc($result_get_propertyID)) {
                $property_id = $row['PropertyID'];
                $sql1 = "DELETE FROM LocalAreaFacility WHERE PropertyID = '$property_id'";
                $result1 = mysqli_query($conn, $sql1);
                $sql2 = "DELETE FROM Amenities WHERE PropertyID = '$property_id'";
                $result2 = mysqli_query($conn, $sql2);
                $sql3 = "DELETE FROM wishlist_info WHERE PropertyID = '$property_id'";
                $result4 = mysqli_query($conn, $sql3);
                $sql4 = "DELETE FROM user_message WHERE PropertyID = '$property_id'";
                $result4 = mysqli_query($conn, $sql4);
                $sql5 = "DELETE FROM Property WHERE PropertyID = '$property_id'";
                $result5 = mysqli_query($conn, $sql5);
            }
        }
        $sql_get_message = "SELECT * FROM user_message WHERE fromName = '$del_id'";
        $result_get_message = mysqli_query($conn, $sql_get_message);
        if (mysqli_num_rows($result_get_message) > 0) {
            $sql_del_message = "DELETE FROM user_message WHERE fromName = '$del_id'";
            $result_del_message = mysqli_query($conn, $sql_del_message);
        }
        $sql_get_wishlist = "SELECT * FROM wishlist_info WHERE user_id = '$del_id'";
        $result_get_wishlist = mysqli_query($conn, $sql_get_wishlist);
        if (mysqli_num_rows($result_get_wishlist) > 0) {
            $sql_del_wishlist = "DELETE FROM wishlist_info WHERE user_id = '$del_id'";
            $result_del_wishlist = mysqli_query($conn, $sql_del_wishlist);
        }
        $sql6 = "DELETE FROM user_cred WHERE user_id = '$del_id'";
        $result6 = mysqli_query($conn, $sql6);
        if ($result6) {
            $sucess = "User deleted Sucessfully";
        } else {
            unset($sucess);
        }
    }
    if (isset($_GET['e_id'])) {
        $e_id = $_GET['e_id'];
        $user_fname = $_GET['user_fname'];
        $user_lname = $_GET['user_lname'];
        $user_email = $_GET['user_email'];
        $user_dob = $_GET['user_dob'];
        $user_gender = $_GET['user_gender'];
        $sql = "UPDATE user_cred SET `user_fname` = '$user_fname', `user_lname` = '$user_lname',`user_email` = '$user_email' ,`user_gender` = '$user_gender', `user_dob` = '$user_dob' WHERE `user_id` = '$e_id'";
        $result = mysqli_query($conn, $sql);
        if ($result) {
            $sucess = "Details Upadted Sucessfully";

        }
    }

}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>Admin Panel</title>
    <link rel="stylesheet" href="admin_properties.css?v=<? echo $version ?>" />
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
            }
            ?>
            <div class="row">
                <div class="left-column">
                    <div class="left-data">
                        <div class="dashboard">
                            <ul class="dashboard-menu">
                                <li><a href="admin.php"><span><i class="fa-solid fa-layer-group"></i>
                                            <p>Dashboard</p>
                                        </span><i class="fa-solid fa-arrow-right dashboard-icon"></i></a>
                                </li>
                                <li><a href="admin_properties.php"><span><i class="fa-solid fa-house-chimney"></i>
                                            <p>Properties</p>
                                        </span> <i class="fa-solid fa-arrow-right dashboard-icon"></i></a>
                                </li>
                                <li class="active"><a href="admin_user.php"><span><i class="fa-solid fa-user"></i>
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
                <div class="right-column">
                    <div class="main-table">
                        <div class="property-table">
                            <table class="fl-table">
                                <thead>
                                    <tr>
                                        <th>Id</th>
                                        <th>First Name</th>
                                        <th>Last Name</th>
                                        <th>Email</th>
                                        <th>Gender</th>
                                        <th>DOB</th>
                                        <th>Usertype</th>
                                        <th>Registered At</th>
                                        <th>Acion</th>
                                    </tr>
                                </thead>
                                <?php
                                $products = getAllUsers();
                                foreach ($products as $row) {
                                    ?>
                                    <form action="" method="GET">
                                        <tr>
                                            <td>
                                                <?= $row['user_id']; ?>
                                            </td>
                                            <td>
                                                <?= $row['user_fname']; ?>
                                            </td>
                                            <td>
                                                <?= $row['user_lname']; ?>
                                            </td>
                                            <td>
                                                <?= $row['user_email']; ?>
                                            </td>
                                            <td>
                                                <?= $row['user_gender']; ?>
                                            </td>

                                            <td>
                                                <?= $row['user_dob']; ?>
                                            </td>

                                            <td>
                                                <?= $row['usertype']; ?>
                                            </td>
                                            <td>
                                                <?= $row['user_regdate']; ?>
                                            </td>

                                            <td>
                                                <div class="action-button">
                                                    <!-- <a href="admin_edit_user.php?edit_id=<?= $row['user_id']; ?>"><i
                                                            class="fa-regular fa-pen-to-square"></i></a> -->
                                                    <a onclick="return confirmSubmit()"
                                                        href="?delete_id=<?= $row['user_id']; ?>"><i
                                                            class="fa-solid fa-trash"></i></a>
                                                </div>
                                            </td>
                                        </tr>
                                    </form>
                                <?php } ?>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <script>
                function confirmSubmit() {
                    return confirm("Are you sure ?");
                }
            </script>

            <script type="module" src="admin.js?v=<? echo $version; ?>"></script>
</body>

</html>