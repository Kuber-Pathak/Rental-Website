<?php
include 'config.php';
include 'connect.php';
if (isset($_POST['usubmit'])) {
    $ufname = $_POST['ufname'];
    $ulname = $_POST['ulname'];
    $ugender = $_POST['ugender'];
    $udate = $_POST['ubirthDate'];
    $uemail = $_POST['uemail'];
    $upassword = $_POST['upassword'];
    $usertype = $_POST['usertype'];
    if (!empty($ufname) && !empty($ulname) && !empty($uemail) && !empty($udate) && !empty($upassword) && !empty($ugender)) {
        $sql = "SELECT * FROM user_cred WHERE user_email='$uemail'";
        $result = mysqli_query($conn, $sql);
        if (mysqli_num_rows($result) > 0) {
            // $emailerror = " * Email Already exists.";
            echo '<script>
                alert("** Email Already Exists!");
              </script>';
        } else {

            $sql = "INSERT INTO user_cred (user_fname,user_lname,user_gender,user_dob,user_email,user_password,usertype) VALUES ( '$ufname' , '$ulname ', '$ugender', '$udate','$uemail','$upassword','$usertype')";

            $result = mysqli_query($conn, $sql);

            if ($result) {
                // header("Location:login.php");
                // echo "<script> window.location.href='login.php';</script>";
                echo '<script>
            alert(" Signed up sucessfully !");
          </script>';
            }
        }
    }
}
if (isset($_POST['isubmit'])) {
    session_start();
    $iemail = $_POST['iemail'];
    $ipassword = $_POST['ipassword'];
    if (!empty($iemail) && !empty($ipassword)) {
        $sql = "SELECT * FROM user_cred WHERE user_email='$iemail' AND user_password='$ipassword'";
        $result = mysqli_query($conn, $sql);
        if (mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_assoc($result);
            $_SESSION['userid'] = $row['user_id'];
            $_SESSION['name'] = $row['user_fname'];
            $_SESSION['logged_in'] = true;
            // header("Location:home.php");
            echo "<script> window.location.href='home.php';</script>";
        } else {
            echo '<script>
            alert("** Invalid email or password !!");
          </script>';
        }
    }
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>Sign up</title>
    <link rel="stylesheet" href="signup.css?v=<? echo $version ?>">
    <script src="https://kit.fontawesome.com/5a78363638.js" crossorigin="anonymous"></script>

<body>

    <div class="container">
        <div class="error">
            <p class="s_error" id="format">
                <?php
                if (isset($error)) {
                    echo $error;
                }
                ?>

            </p>
        </div>
        <div class="red-box" id="targetd">
            <form onsubmit="return CheckPassword(document.form1.password)" name="form1" method="POST"
                action="<?php $_SERVER['PHP_SELF']; ?>">
                <div class="signin">
                    <div class="center">
                        <h1 class="header"> Sign Up</h1>
                        <div class="loginoption">
                            <div class="loginicon">
                                <a href="#"><i class="fa-brands fa-facebook-f fa-xl"></i>
                                </a>
                            </div>
                            <div class="loginicon">
                                <a href="#"> <i class="fa-brands fa-google-plus-g fa-xl"></i>
                                </a>
                            </div>
                            <div class="loginicon">
                                <a href="#"> <i class="fa-brands fa-linkedin-in fa-xl"></i>
                                </a>
                            </div>
                        </div>
                        <h4> or use your email</h4>

                    </div>
                    <div class="center">
                        <div class="two">
                            <div class="searchbar">
                                <i class="fa-regular fa-envelope fa-xl"></i>
                                <input class="nameid search" name="ufname" required id="fname" type="text"
                                    placeholder="First Name" />

                            </div>
                            <div class="searchbar">
                                <i class="fa-regular fa-envelope fa-xl"></i>
                                <input class="nameid search" id="lname" required name="ulname" type="text"
                                    placeholder="Last Name" />

                            </div>
                        </div>

                        <div class="one">
                            <div class="searchbar">
                                <i class="fa-regular fa-envelope fa-xl"></i>
                                <input class="emailid search" id="email" name="uemail" required type="email"
                                    placeholder="Email" />

                            </div>
                        </div>

                        <div class="one">
                            <div class="searchbar">
                                <i class="fa-solid fa-key"></i>
                                <input class="passwordid search" id="password" required name="upassword" type="password"
                                    placeholder="password" />
                                <div class="icons">
                                    <i class="fa-regular fa-eye " id="show"></i>
                                    <i class="fa-regular fa-eye-slash" id="hide"></i>
                                </div>
                            </div>
                        </div>
                        <div class="two">
                            <div class="searchbar">
                                <label for="birthDate">
                                    <h5>DOB:</h5>
                                </label>
                                <input class="nameid search" id="birthDate" required name="ubirthDate" type="date" />
                            </div>
                            <div class="searchbar">
                                <h5> Gender</h5>
                                <input class="nameid search" value="male" required name="ugender" id="male"
                                    type="radio" />
                                <label for="male">
                                    <h5>Male</h5>
                                </label>
                                <input class="nameid search" value="female" required name="ugender" id="female"
                                    type="radio" />
                                <label for="female">
                                    <h5>Female</h5>
                                </label>
                            </div>

                        </div>
                        <div class="one">
                            <input type="hidden" name="usertype" id="usertype" value="user">
                        </div>

                        <div class="center">
                            <button name="usubmit" class="button">
                                <h2>SIGN UP</h2>
                            </button>
                        </div>

                        <div class="mediaup" onclick="dubanimation()"> Sign In </div>
                    </div>


                </div>
            </form>
        </div>
        <div class="gray-box" id="targeta">
            <form method="POST" action="<?php $_SERVER['PHP_SELF']; ?>">
                <div class="signin">
                    <div class="center">
                        <h1 class="header"> Sign in</h1>
                        <div class="loginoption">
                            <div class="loginicon">
                                <a href="#"><i class="fa-brands fa-facebook-f fa-xl"></i>
                                </a>
                            </div>
                            <div class="loginicon">
                                <a href="#"> <i class="fa-brands fa-google-plus-g fa-xl"></i>
                                </a>
                            </div>
                            <div class="loginicon">
                                <a href="#"> <i class="fa-brands fa-linkedin-in fa-xl"></i>
                                </a>
                            </div>
                        </div>
                        <h4> or use your email</h4>

                    </div>
                    <div class="center">
                        <div class="searchbar">
                            <i class="fa-regular fa-envelope fa-xl"></i>
                            <input class="emailid search" id="iemail" name="iemail" required type="email"
                                placeholder="Email" />

                        </div>
                        <div class="searchbar">
                            <i class="fa-solid fa-key"></i>
                            <input class="passwordid search" id="ipassword" name="ipassword" required type="password"
                                placeholder="password" />
                            <div class="iicons">
                                <i class="fa-regular fa-eye " id="ishow"></i>
                                <i class="fa-regular fa-eye-slash" id="ihide"></i>
                            </div>
                        </div>
                        <div class="center">
                            <a href="#"><u>Forgot your password?</u></a>
                            <button name="isubmit" class="button">
                                <h2>SIGN IN</h2>
                            </button>
                        </div>
                        <div class="mediaup" onclick="subanimation()"> Sign Up </div>
                    </div>


                </div>
            </form>
        </div>

        <div class="green-box" id="targetc">
            <div class="center">
                <div class="signup">
                    <h1 class="title">Welcome</h1>
                    <h2 class="subtitle">Start Your Journey<br> with Roomie</h2>
                </div>
                <button class="butt" onclick="DoAnimation();">
                    <h2>SIGN UP</h2>
                </button>
            </div>
        </div>

        <div class="black-box" id="targetb">
            <div class="center">
                <div class="signup">
                    <h1 class="title">Welcome Back!</h1>
                    <h2 class="subtitle">Enter personal details<br>to your account</h2>
                </div>
                <button class="butt" onclick="RevAnimation();">
                    <h2>SIGN IN</h2>
                </button>
            </div>
        </div>
    </div>


    <script src="signup.js?v=<? echo $version ?>"></script>

</body>

</html>