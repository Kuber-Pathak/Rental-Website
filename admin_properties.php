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
                                <li><a href="admin.php"><span><i class="fa-solid fa-layer-group"></i>
                                            <p>Dashboard</p>
                                        </span><i class="fa-solid fa-arrow-right dashboard-icon"></i></a>
                                </li>
                                <li class="active"><a href="admin_properties.php"><span><i
                                                class="fa-solid fa-house-chimney"></i>
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
                    <div class="main-table">
                        <div class="property-table">
                            <table class="fl-table">
                                <thead>
                                    <tr>
                                        <th>Id</th>
                                        <th>Title</th>
                                        <th>Type</th>
                                        <th>Category</th>
                                        <th>Purpose</th>
                                        <th>Price</th>
                                        <th>Location</th>
                                        <th>Posted By</th>
                                        <th>User ID</th>
                                        <th>Posted at</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <?php
                                $products = getAllProperties();
                                foreach ($products as $row) {
                                    ?>
                                    <tr>
                                        <td>
                                            <?= $row['PropertyID']; ?>
                                        </td>
                                        <td>
                                            <?= $row['title']; ?>
                                        </td>
                                        <td>
                                            <?= $row['type_name']; ?>
                                        </td>
                                        <td>
                                            <?= $row['category']; ?>
                                        </td>
                                        <td>
                                            <?= $row['purpose']; ?>
                                        </td>
                                        <td>
                                            <?= $row['price']; ?>
                                        </td>

                                        <td>
                                            <?= $row['location']; ?>
                                        </td>
                                        <td>
                                            <?= $row['user_fname']; ?>
                                            <?= $row['user_lname']; ?>
                                        </td>
                                        <td>
                                            <?= $row['user_id']; ?>
                                        </td>
                                        <td>
                                            <?= $row['property_reg_at']; ?>
                                        </td>
                                        <td>
                                            <div class="action-button">
                                                <a href="info.php?id=<?= $row['PropertyID']; ?>">View</a>
                                            </div>
                                        </td>
                                    </tr>
                                <?php } ?>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
</body>
<script type="module" src="admin.js?v=<? echo $version ?>"></script>

</html>