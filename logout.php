<?php
session_start();
session_unset();
session_destroy();
// header("location:login.php");
echo "<script> window.location.href='signup.php';</script>";
?>