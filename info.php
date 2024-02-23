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
  if (isset($_GET['id'])) {
    $propertyID = $_GET['id'];
    $row_count_sql = "SELECT * FROM LocalAreaFacility WHERE PropertyID = $propertyID ";
    $row_count_sql_result = mysqli_query($conn, $row_count_sql);
    while ($row_LocalAreaFacility = mysqli_fetch_assoc($row_count_sql_result)) {
      $columns = array_diff_key($row_LocalAreaFacility, array('PropertyID' => 0, 'LocalAreaFacilityID' => 0));
      $row_count = array_sum($columns) > 0 ? true : false;

    }

    $sql = "SELECT * FROM Amenities 
    INNER JOIN Property 
    ON Amenities.PropertyID = Property.PropertyID
    INNER JOIN  LocalAreaFacility
    ON LocalAreaFacility.PropertyID = Property.PropertyID
    WHERE Property.PropertyID = $propertyID
    ";
    $result = mysqli_query($conn, $sql);


    ?>
    <!DOCTYPE html>
    <html>

    <head>
      <title>Info Website</title>
      <link rel="stylesheet" href="info.css?v=<? echo $version ?>" />
      <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"
        integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin="" />
      <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"
        integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>
      <script src="https://kit.fontawesome.com/5a78363638.js" crossorigin="anonymous"></script>
    </head>
    <?php
    if ($result) {
      while ($row = mysqli_fetch_assoc($result)) {
        $Location = $row['location'];
        ?>

        <body onload="findAddress(' <?php echo $Location; ?> ') ">
          <header>
            <div id="navbar">
              <nav class="center">
                <div class="logo">
                  <a href="home.php"><img src="Images/logo3.png" alt="Logo" width="112" /></a>
                </div>
                <ul class="middle-side">
                  <li>
                    <a href="wishlist.php">WhishList <i class="fa-regular fa-heart"></i></a>
                  </li>
                  <li><a href="contact.php">Contact Us</a></li>
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

          <div class="main">
            <div class="main-container center">
              <div class="row">
                <div class="main-title">
                  <h1>
                    <?php echo $row["title"]; ?>
                  </h1>
                </div>
                <div class="column">
                  <div class="product-image">
                    <div class="row">
                      <div class="col-1">
                        <img src="<?php echo "data:image;base64," . $row["mainphoto"]; ?>" alt="Room Image" />

                      </div>
                      <div class="col-1">
                        <img src="<?php echo "data:image;base64," . $row["mainphoto"]; ?>" alt="Room Image" />
                      </div>
                    </div>
                  </div>
                </div>
                <div class="column-2">
                  <div class="column">
                    <div class="row">
                      <div class="col-2">
                        <div class="room-info">
                          <h1 class="room-title">
                            <?php echo $row["description"]; ?>
                          </h1>
                          <div class="room-location">
                            <p class="locationpin">
                              <span class="fas fa-map-pin"></span>
                              <?php echo $row["location"]; ?>
                            </p>
                          </div>
                          <p class="room-type">
                            <?php echo $row["type_name"] . " property"; ?>
                          </p>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="column">
                    <div class="row box-shadow">
                      <div class="c1">
                        <div class="amenities">
                          <div class="amenities-title">Purpose</div>
                          <div class="amenities-content">
                            <?php echo $row["purpose"]; ?>
                          </div>
                        </div>
                      </div>
                      <div class="c1">
                        <div class="amenities">
                          <div class="amenities-title">Rent Price</div>
                          <div class="amenities-content">
                            <?php echo "Rs. " . (int) $row["price"]; ?>
                          </div>
                        </div>
                      </div>
                      <?php
                      if ($row["dob"]) {
                        echo '
                      <div class="c1">
                        <div class="amenities">
                          <div class="amenities-title">Build Year</div>
                            <div class="amenities-content">
                              ' . $row["dob"] . '
                            </div>
                        </div>
                      </div>  
                  ';
                      }
                      ?>
                      <?php
                      if ($row["bed_no"]) {
                        echo '
                      <div class="c1">
                        <div class="amenities">
                          <div class="amenities-title">Bedroom</div>
                            <div class="amenities-content">
                              ' . $row["bed_no"] . '
                            </div>
                        </div>
                      </div>  
                  ';
                      }
                      ?>
                      <?php
                      if ($row["kitchen"]) {
                        echo '
                      <div class="c1">
                        <div class="amenities">
                          <div class="amenities-title">Kitchen</div>
                            <div class="amenities-content">
                              ' . $row["kitchen"] . '
                            </div>
                        </div>
                      </div>  
                  ';
                      }
                      ?>
                      <?php
                      if ($row["bathroom"]) {
                        echo '
                      <div class="c1">
                        <div class="amenities">
                          <div class="amenities-title">Bathroom</div>
                            <div class="amenities-content">
                              ' . $row["bathroom"] . '
                            </div>
                        </div>
                      </div>  
                  ';
                      }
                      ?>
                      <?php
                      if ($row["furnishing"]) {
                        echo '
                      <div class="c1">
                        <div class="amenities">
                          <div class="amenities-title">Furishing</div>
                            <div class="amenities-content">
                              ' . $row["furnishing"] . '
                            </div>
                        </div>
                      </div>  
                  ';
                      }
                      ?>

                      <?php
                      if ($row["faced"]) {
                        echo '
                      <div class="c1">
                        <div class="amenities">
                          <div class="amenities-title">Faced</div>
                            <div class="amenities-content">
                              ' . $row["faced"] . '
                            </div>
                        </div>
                      </div>  
                  ';
                      }
                      ?>
                      <?php
                      if ($row["parking"]) {
                        echo '
                      <div class="c1">
                        <div class="amenities">
                          <div class="amenities-title">Parking</div>
                            <div class="amenities-content">
                              ' . $row["parking"] . '
                            </div>
                        </div>
                      </div>  
                  ';
                      }
                      ?>

                      <?php
                      if ($row["balcony"]) {
                        echo '
                      <div class="c1">
                        <div class="amenities">
                          <div class="amenities-title">Balcony</div>
                            <div class="amenities-content">
                              ' . $row["balcony"] . '
                            </div>
                        </div>
                      </div>  
                  ';
                      }
                      ?>
                      <?php
                      if ($row["rental_floor"]) {
                        echo '
                      <div class="c1">
                        <div class="amenities">
                          <div class="amenities-title">Floor</div>
                            <div class="amenities-content">
                              ' . $row["rental_floor"] . '
                            </div>
                        </div>
                      </div>  
                  ';
                      }
                      ?>
                      <?php
                      if ($row["water_facility"]) {
                        echo '
                      <div class="c1">
                        <div class="amenities">
                          <div class="amenities-title">Water Facility</div>
                            <div class="amenities-content">
                              ' . $row["water_facility"] . '
                            </div>
                        </div>
                      </div>  
                  ';
                      }
                      ?>
                      <?php
                      if ($row["road_type"]) {
                        echo '
                      <div class="c1">
                        <div class="amenities">
                          <div class="amenities-title">Road Type</div>
                            <div class="amenities-content">
                              ' . $row["road_type"] . '
                            </div>
                        </div>
                      </div>  
                  ';
                      }
                      ?>
                      <?php
                      if ($row["sitting_rooms"]) {
                        echo '
                      <div class="c1">
                        <div class="amenities">
                          <div class="amenities-title">Sitting Rooms</div>
                            <div class="amenities-content">
                              ' . $row["sitting_rooms"] . '
                            </div>
                        </div>
                      </div>  
                  ';
                      }
                      ?>
                    </div>
                  </div>
                  <?php
                  if ($row_count) {
                    echo '
                  <div class="column box-shadow">
                    <h5>Local Area Facilities</h5>
                    <div class="row">';

                    if ($row['local_area_gym']) {
                      echo '
                      <div class="c1">
                        <div class="amenities">
                          <div class="amenities-title">Gym</div>
                          <div class="amenities-content">Gym</div>
                        </div>
                      </div>
                      ';
                    }
                    if ($row['local_area_swimming_pool']) {
                      echo '
                      <div class="c1">
                        <div class="amenities">
                          <div class="amenities-title">Swimming Pool</div>
                          <div class="amenities-content">Swimming Pool</div>
                        </div>
                      </div>
                      ';
                    }
                    if ($row['local_area_playing_court']) {
                      echo '
                      <div class="c1">
                        <div class="amenities">
                          <div class="amenities-title">Playing Court</div>
                          <div class="amenities-content">Playing Court</div>
                        </div>
                      </div>
                      ';
                    }
                    if ($row['local_area_hospital']) {
                      echo '
                      <div class="c1">
                        <div class="amenities">
                          <div class="amenities-title">Hospital</div>
                          <div class="amenities-content">Hospital</div>
                        </div>
                      </div>
                      ';
                    }
                    if ($row['local_area_school']) {
                      echo '
                      <div class="c1">
                        <div class="amenities">
                          <div class="amenities-title">School</div>
                          <div class="amenities-content">School</div>
                        </div>
                      </div>
                      ';
                    }
                    if ($row['local_area_montessori']) {
                      echo '
                      <div class="c1">
                        <div class="amenities">
                          <div class="amenities-title">Montessori</div>
                          <div class="amenities-content">Montessori</div>
                        </div>
                      </div>
                      ';
                    }
                    if ($row['local_area_college']) {
                      echo '
                      <div class="c1">
                        <div class="amenities">
                          <div class="amenities-title">College</div>
                          <div class="amenities-content">College</div>
                        </div>
                      </div>
                      ';
                    }
                    if ($row['local_area_temple']) {
                      echo '
                      <div class="c1">
                        <div class="amenities">
                          <div class="amenities-title">Temple</div>
                          <div class="amenities-content">Temple</div>
                        </div>
                      </div>
                      ';
                    }

                    if ($row['local_area_resturants']) {
                      echo '
                      <div class="c1">
                        <div class="amenities">
                          <div class="amenities-title">Resturants</div>
                          <div class="amenities-content">Resturants</div>
                        </div>
                      </div>
                      ';
                    }
                    if ($row['local_area_super_market']) {
                      echo '
                      <div class="c1">
                        <div class="amenities">
                          <div class="amenities-title">Super Market</div>
                          <div class="amenities-content">Super Market</div>
                        </div>
                      </div>
                      ';
                    }
                    if ($row['local_area_bus_stop']) {
                      echo '
                      <div class="c1">
                        <div class="amenities">
                          <div class="amenities-title">Bus stop</div>
                          <div class="amenities-content">Bus stop</div>
                        </div>
                      </div>
                      ';
                    }
                    if ($row['local_area_taxi_stand']) {
                      echo '
                      <div class="c1">
                        <div class="amenities">
                          <div class="amenities-title">taxi stand</div>
                          <div class="amenities-content">Taxi stand</div>
                        </div>
                      </div>
                      ';
                    }
                    if ($row['local_area_police_station']) {
                      echo '
                      <div class="c1">
                        <div class="amenities">
                          <div class="amenities-title">Police station</div>
                          <div class="amenities-content">Police station</div>
                        </div>
                      </div>
                      ';
                    }
                    if ($row['local_area_bank']) {
                      echo '
                      <div class="c1">
                        <div class="amenities">
                          <div class="amenities-title">Bank</div>
                          <div class="amenities-content">Bank</div>
                        </div>
                      </div>
                      ';
                    }
                    if ($row['local_area_banquet_hall']) {
                      echo '
                      <div class="c1">
                        <div class="amenities">
                          <div class="amenities-title">Banquet Hall</div>
                          <div class="amenities-content">Banquet Hall</div>
                        </div>
                      </div>
                      ';
                    }
                    if ($row['local_area_gas_station']) {
                      echo '
                      <div class="c1">
                        <div class="amenities">
                          <div class="amenities-title">Gas station</div>
                          <div class="amenities-content">Gas station</div>
                        </div>
                      </div>
                      ';
                    }
                    echo ' 
                </div>
              </div>
              ';
                  } ?>

                  <div class="column">
                    <button class="book-btn" onclick="return showBookConfirmation()">Submit for Confirmation</button>
                  </div>
                </div>
                <div class="column-3">
                  <?php
                  if (isset($_POST['submit_message'])) {
                    if (empty($_POST['message'])) {
                      $empty = "*Message cannot be empty";
                    } else {
                      $message = $_POST['message'];
                      $toUser = $_POST['toUser'];
                      $msg_check = "SELECT * FROM user_message WHERE message='$message' AND fromName='$username' AND user_id='$toUser' AND PropertyID='$propertyID' ";
                      $msg_check_result = mysqli_query($conn, $msg_check);
                      if (mysqli_num_rows($msg_check_result) == 0) {
                        $msg_sql = "INSERT INTO user_message (message,PropertyID,fromName,user_id) VALUES('$message','$propertyID','$username','$toUser')";
                        $msg_result = mysqli_query($conn, $msg_sql);
                        if ($msg_result) {
                          $sucess = "Message sent sucessfully";
                        }
                      }
                    }
                  }
                  ?>
                  <?php
                  $check_sql = "SELECT * FROM Property WHERE user_id='$userid' AND PropertyID ='$propertyID'";
                  $check_result = mysqli_query($conn, $check_sql);
                  if (mysqli_num_rows($check_result) == 0) {
                    ?>
                    <form action="" method="POST">
                      <div class="message-form">
                        <div>
                          <?php
                          $user_sql = "SELECT * from user_cred 
                            INNER JOIN Property
                            ON Property.user_id = user_cred .user_id
                            WHERE Property.PropertyID = $propertyID
                            ";
                          $user_result = mysqli_query($conn, $user_sql);

                          while ($user_row = mysqli_fetch_assoc($user_result)) {
                            ?>

                            <div class="profile-image">
                              <input type="hidden" name="toUser" value="<?php echo $row['user_id']; ?>">
                              <img src="Images/profile.jpg" alt="" />
                              <div class="profile-info">
                                <span class="user-info">
                                  <?php echo $user_row['user_fname'] . " " . $user_row['user_lname'] ?>
                                </span>
                                <span class="user-info">
                                  <?php echo 'Contact: ' . $user_row['contact']; ?>
                                </span>
                              </div>
                            </div>
                            <div class="message-container">
                              <div class="message-box">
                                <textarea placeholder="Write a Message." name="message" id="message"></textarea>
                                <div class="error">
                                  <?php
                                  if (isset($empty)) {
                                    echo $empty;
                                  }
                                  ?>
                                </div>
                                <button class="message-btn" name="submit_message" value="submit"
                                  onclick="return showMessageConfirmation()">Send
                                  Message</button>
                              </div>
                            </div>


                          </div>
                        </div>
                      </form>
                      <?php
                          } ?>
                    <?php
                  }
                  ?>
                  <div id="map"></div>

                </div>
              </div>
            </div>
            <?php
            if (isset($sucess)) {
              echo '
            <div class="sucess show">
              <span class="sucess_msg">
              
              <i class="fa-solid fa-check"></i>
                  ' . '&nbsp;' . $sucess . '
                  
              </span>
            </div>';
              unset($sucess);
            }
            ?>
          </div>

          <?php

      }
    }

  }
}
?>
</body>
<script src="info.js?v=<? echo $version; ?>"></script>

</html>