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
  <link rel="stylesheet" href="home.css?v=<? echo $version ?>" />
  <script src="https://kit.fontawesome.com/5a78363638.js" crossorigin="anonymous"></script>
</head>

<body>


  <header>

    <div id="navbar">
      <nav>
        <div class="logo">
          <a href="home.php"><img src="./Images/logo3.png" alt="Logo" width="112" /></a>
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
              <li><a href="profile.php"><i class="fa-solid fa-user"></i> Profile</a></li>
              <li><a href="wishlist.php"><i class="fa-solid fa-heart"></i> WishList</a></li>
              <li><a href="contact.php"><i class="fa-solid fa-message"></i> Contact Us</a></li>
              <li><a href="#"><i class="fa-solid fa-circle-info"></i> Help Center</a></li>
              <li><a href="logout.php" class="user"><i class="fa-solid fa-arrow-right-from-bracket"></i> Log Out</a>
              </li>
            </ul>
          </div>
          <!-- <a href="#" class="left-btn btn">Sign up</a> -->
        </div>
      </nav>
    </div>
  </header>
  <div class="main-contaien center">
    <div class="row">
      <div class="upper">
        <div class="body">
          <div id="slogan">
            <div class="slogan-bold">Rooms for rent</div>
            <div class="slogan-small">Find and rent your perfect room</div>
          </div>
          <form action="serch.php" method="GET">
            <div class="search">
              <div class="search-bar">
                <input class="search-input" required name="location" id="location" type="text"
                  placeholder="Enter an address,city or Zip code" />
                <i class="ico fa-solid fa-location-dot fa-xl" id="small-location"></i>
                <button id="small-arrow" type="submit"><i class="fa-solid fa-arrow-right fa-xl"></i></button>
                <p id="format"></p>
              </div>
            </div>
          </form>
        </div>

        <div class="room-made">
          <div class="cimage"></div>
          <div class="room-slogan">
            <!-- <h1 class="room-slogan-top">A room made just for you!</h1> -->
            <h2 class="room-slogan-bottom">
              Unlock the Door to Your Next <br />
              Adventure: Where Every Room Tells a<br />
              Story!
            </h2>
          </div>
        </div>
      </div>

      <div class="image">
        <div class="image1 place">
          <a href="list.php">
            <button class="button">
              <i class="fa-solid fa-plus"></i> List a place
            </button>
          </a>
        </div>

        <div class="image2 place">
          <a href="serch.php">
            <button class="button">
              <i class="fa-solid fa-plus"></i> Find a place
            </button>
          </a>
        </div>
      </div>
    </div>
  </div>
  <script type="module" src="home.js?v=<? echo $version ?>"></script>
</body>

</html>