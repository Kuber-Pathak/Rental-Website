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
    if (isset($_GET['page-nr'])) {
        $page_id = $_GET['page-nr'];
    } else {
        $page_id = 1;
    }
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>Rental website</title>
    <link rel="stylesheet" href="profile_msg.css?v=<? echo $version ?>" />
    <script src="https://kit.fontawesome.com/5a78363638.js" crossorigin="anonymous"></script>
</head>

<body id="<?= $page_id; ?>">
    <header>
        <div id="navbar">
            <nav class="center">
                <div class="logo">
                    <a href="home.php"><img src="Images/logo3.png" alt="Logo" width="112" /></a>
                </div>
                <ul class="middle-side">
                <li><a href="home.php">Home</a></li>
                    <li>
                        <a href="wishlist.php">WhishList <i class="fa-regular fa-heart"></i></a>
                    </li>
                    
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
                            <li><a href="profile.php"><i class="fa-solid fa-user"></i> Profile</a></li>
                            <li><a href="wishlist.php"><i class="fa-solid fa-heart"></i> WishList</a></li>
                            <li><a href="contact.php"><i class="fa-solid fa-message"></i> Contact Us</a></li>
                            <li><a href="#"><i class="fa-solid fa-circle-info "></i> Help Center</a></li>
                            <li><a href="logout.php" class="user"><i class="fa-solid fa-arrow-right-from-bracket"></i>
                                    Log Out</a>
                            </li>
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
                                <li><a href="profile.php"><span> Your Properties </span><i
                                            class="fa-solid fa-arrow-right"></i></a>
                                </li>
                                <li class="active"><a href=""><span> Your Messages</span> <i
                                            class="fa-solid fa-arrow-right"></i></a>
                                </li>
                                <li><a href="profile_edit.php"><span> Edit Details</span> <i
                                            class="fa-solid fa-arrow-right"></i></a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class=" right-column">
                    <div class="total-message">
                        <p><i class="fa-solid fa-circle-info fa-xl"></i>Info: You have
                            <?= getTotalMessage($userid); ?> messages.
                        </p>
                    </div>
                    <div class="message-lists" id="product-wrapper">
                        <?php
                        $start = 0;
                        $rows_per_page = 5;
                        $nr_of_rows = getTotalMessage($userid);
                        $pages = ceil($nr_of_rows / $rows_per_page);
                        if (isset($_GET['page-nr'])) {
                            $page = $_GET['page-nr'] - 1;
                            $start = $page * $rows_per_page;
                        }
                        $messages = getMessage($userid, $start, $rows_per_page);
                        foreach ($messages as $row) {
                            ?>
                            <div class="message-box">
                                <div class="profile-data">
                                    <div class="profile-info">
                                        <div class="user-profile"><span class="profile-photo">
                                                <?php echo $row['fromName'][0]; ?>
                                            </span></div>
                                    </div>
                                </div>
                                <div class="message-content">
                                    <h1>From :
                                        <?= $row['fromName']; ?>
                                    </h1>
                                    <p>
                                        <?= $row['message']; ?>
                                    </p>
                                </div>
                                <div class="message-date">
                                    <span>
                                        <?php
                                        $dateTimeString = $row['msg_reg_at'];

                                        // Convert the datetime string into a timestamp
                                        $timestamp = strtotime($dateTimeString);
                                        // Format the timestamp to only show the date part
                                        $dateOnly = date('Y-m-d', $timestamp);

                                        echo $dateOnly;
                                        ?>
                                    </span>
                                    <span>
                                        <?php
                                        // Format the timestamp to only show the hour and minute in 12-hour format with AM or PM
                                        $timeOnly = date('h:i A', $timestamp);
                                        echo " at " . $timeOnly;
                                        ?>
                                    </span>
                                </div>
                            </div>
                        <?php } ?>
                    </div>
                    <div class="message-footer">
                        <ul class="message-page">
                            <li class="page-item">
                                <?php if (isset($_GET['page-nr']) && $_GET['page-nr'] > 1) {
                                    ?>
                                    <a href="?page-nr=<?php echo $_GET['page-nr'] - 1; ?> " class="page-link">
                                        < </a>
                                        <?php } else {
                                    ?>
                                            <a class="page-link">
                                                < </a>
                                                    <?php
                                } ?>
                            </li>
                            <?php
                            for ($counter = 1; $counter <= $pages; $counter++) {
                                ?>
                                <li class="page-item">
                                    <a href="?page-nr=<?= $counter; ?>" class="page-link">
                                        <?= $counter; ?>
                                    </a>
                                </li>
                                <?php
                            }
                            ?>
                            <li class="page-item">
                                <?php if (!isset($_GET['page-nr'])) {
                                    ?>
                                    <a href="?page-nr=2" class="page-link">
                                        > </a>
                                <?php } else {
                                    if ($_GET['page-nr'] >= $pages) {
                                        ?>
                                        <a class="page-link">
                                            > </a>
                                        <?php
                                    } else {
                                        ?>
                                        <a href="?page-nr=<?php echo $_GET['page-nr'] + 1; ?> " class="page-link">
                                            > </a>
                                        <?php
                                    }
                                } ?>
                            </li>
                        </ul>


                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
<script type="module" src="profile.js?v=<? echo $version ?>"></script>

</html>