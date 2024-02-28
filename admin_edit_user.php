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
    $u_id = $_GET['edit_id'];
    if (isset($_POST['edit_submit'])) {
        $user_fname = $_POST['user_fname'];
        $user_lname = $_POST['user_lname'];
        $user_email = $_POST['user_email'];
        $user_password = $_POST['user_password'];
        $user_dob = $_POST['user_dob'];
        $user_gender = $_POST['user_gender'];
        $hashedPassword = password_hash($user_password, PASSWORD_DEFAULT);
        $sql = "SELECT * FROM user_cred WHERE user_email='$user_email' AND user_id != $u_id";
        $result = mysqli_query($conn, $sql);
        if (mysqli_num_rows($result) > 0) {
            $sucess = '<i class="fa-solid fa-triangle-exclamation"></i> Email Already exists.';
        } else {
            $sql = "UPDATE user_cred SET `user_fname` = '$user_fname', `user_lname` = '$user_lname',`user_email` = '$user_email',`user_password` = '$hashedPassword' ,`user_gender` = '$user_gender', `user_dob` = '$user_dob' WHERE `user_id` = '$u_id'";
            $result = mysqli_query($conn, $sql);
            if ($result) {
                $sucess = '<i class="fa-solid fa-check"></i> Details Upadted Sucessfully';
            }
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>Admin Panel</title>
    <link rel="stylesheet" href="admin_edit_user.css?v=<? echo $version ?>" />
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
                                <li><a href="admin_user.php"><span><i class="fa-solid fa-user"></i>
                                            <p>Users</p>
                                        </span> <i class="fa-solid fa-arrow-right dashboard-icon"></i></a>
                                </li>
                                <li class="active"><a href="admin_user.php"><span><i class="fa-solid fa-user"></i>
                                            <p>Edit User Details</p>
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
                    <?php
                    $products = getUser($u_id);
                    foreach ($products as $row) {

                        ?>
                        <form name="update_form" action="" method="POST">
                            <div class="update-details">
                                <div class="update-body">
                                    <div class="ones">
                                        <label for="f_name">First Name:</label>
                                        <input id="f_name" name="user_fname" required type="text"
                                            value="<?= $row['user_fname']; ?>">
                                    </div>
                                    <div class="ones">
                                        <label for="f_lame">Last Name</label>
                                        <input id="f_lame" name="user_lname" required type="text"
                                            value="<?= $row['user_lname']; ?>">
                                    </div>
                                    <div class="ones">
                                        <label for="dob">DOB</label>
                                        <input type="text" name="user_dob" id="dob" required
                                            value="<?= $row['user_dob']; ?>" placeholder="Eg: yyyy-mm-dd">
                                    </div>
                                    <div class="radio_ones">
                                        <label> Gender :</label>
                                        <input <?php
                                        if ($row['user_gender'] == "male") {
                                            echo 'checked';
                                        } else {
                                            echo '';
                                        }
                                        ?> name="user_gender" id="male" value="male" required type="radio" />
                                        <label for="male">Male </label>
                                        <input <?php
                                        if ($row['user_gender'] == "female") {
                                            echo 'checked';
                                        } else {
                                            echo '';
                                        }
                                        ?> name="user_gender" id="female" value=" female" required type="radio" />
                                        <label for="female">Female</label>
                                    </div>
                                    <div class="ones">
                                        <label for="uemail">Email</label>
                                        <input name="user_email" type="email" id="uemal" required
                                            value="<?= $row['user_email']; ?>">
                                    </div>
                                    <div class="ones">
                                        <label for="upwd">New Password</label>
                                        <input type="password" name="user_password" id="upwd">
                                        <div class="icons">
                                            <i class="fa-regular fa-eye " id="ihide"></i>
                                            <i class="fa-regular fa-eye-slash" id="ishow"></i>
                                        </div>
                                    </div>
                                    <div class="submit-btn">
                                        <input onclick="return checkDetails()" type="submit" name="edit_submit"
                                            value="Update">
                                    </div>
                                    <p class="error"></p>
                                </div>
                            </div>
                        </form>
                    <?php } ?>
                </div>
            </div>

            <script>
                function confirmSubmit() {
                    return confirm("Are you sure ?");
                }

                function checkDetails() {
                    var dob = document.getElementById("dob").value;
                    var password = document.getElementById("upwd").value;

                    // Simple regex for basic email and date validation
                    var dateRegex = /^\d{4}-\d{2}-\d{2}$/; // Simple validation for yyyy-mm-dd format'
                    var dateRegx = /^\d{4}-\d{2}-\d{2}(?:\s\d{2}:\d{2}:\d{2})?$/;

                    var pass_rgex =
                        /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/;

                    if (!dateRegex.test(dob) && !dateRegx.test(dob)) {
                        document.querySelector(".error").innerHTML =
                            "**Please enter the date in yyyy-mm-dd format.";
                        return false;
                    }
                    if (!pass_rgex.test(password) && password) {
                        document.querySelector(".error").innerHTML =
                            "** Password must contain:<br> Minimum 8 characters<br> 1 uppercase<br> 1 lowercase<br> 1 number <br> 1special character.";
                        return false;
                    }
                    return true;
                }

            </script>

            <script type="module" src="admin.js?v=<? echo $version; ?>"></script>
</body>

</html>