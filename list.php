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

  if (isset($_POST['submit'])) {
    // Property details
    $userid = $_SESSION['userid'];
    $type_name = $_POST["property"];
    $purpose = $_POST["purpose"];
    $title = $_POST["title"];
    $category = $_POST["category"];

    $price = $_POST["price"];
    $contact = $_POST["contact"];
    $location = $_POST["location"];
    $description = $_POST["description"];

    // Amenities details
    if (empty($_POST["price_negotiable"])) {
      $price_negotiable = null;
      $price_negotiable = ($price_negotiable === 'true') ? 1 : 0;
    } else {
      $price_negotiable = $_POST["price_negotiable"];
    }

    if (empty($_POST["dob"])) {
      $dob = NULL;
    } else {
      $dob = $_POST["dob"];
    }

    if (empty($_POST["bedroom"])) {
      $bed_no = NULL;
    } else {
      $bed_no = $_POST["bedroom"];
    }
    if (empty($_POST["kitchen"])) {
      $kitchen = null;
      $kitchen = ($kitchen === 'true') ? 1 : 0;
    } else {
      $kitchen = $_POST["kitchen"];
      // $kitchen = ($kitchen === 'true') ? 1 : 0;
    }
    if (empty($_POST["bathroom"])) {
      $bathroom = null;
      $bathroom = ($bathroom === 'true') ? 1 : 0;
    } else {
      $bathroom = $_POST["bathroom"];
      // $bathroom = ($bathroom === 'true') ? 1 : 0;
    }
    if (empty($_POST["furnishing"])) {
      $furnishing = null;
    } else {
      $furnishing = $_POST["furnishing"];
    }
    if (empty($_POST["faced"])) {
      $faced = null;
    } else {
      $faced = $_POST["faced"];
    }
    if (empty($_POST["parking"])) {
      $parking = null;
      $parking = ($parking === 'true') ? 1 : 0;
    } else {
      $parking = $_POST["parking"];
      // $parking = ($parking === 'true') ? 1 : 0;
    }
    if (empty($_POST["balcony"])) {
      $balcony = null;
      $balcony = ($balcony === 'true') ? 1 : 0;
    } else {
      $balcony = $_POST["balcony"];
      // $balcony = ($balcony === 'true') ? 1 : 0;
    }
    if (empty($_POST["rental_floor"])) {
      $rental_floor = null;
      $rental_floor = ($rental_floor === 'true') ? 1 : 0;
    } else {
      $rental_floor = $_POST["rental_floor"];
      // $rental_floor = ($rental_floor === 'true') ? 1 : 0;
    }
    if (empty($_POST["water_facility"])) {
      $water_facility = null;
      $water_facility = ($water_facility === 'true') ? 1 : 0;
    } else {
      $water_facility = $_POST["water_facility"];
      // $water_facility = ($water_facility === 'true') ? 1 : 0;
    }
    if (empty($_POST["road_type"])) {
      $road_type = null;
    } else {
      $road_type = $_POST["road_type"];
    }
    if (empty($_POST["sitting_rooms"])) {
      $sitting_rooms = 0;
    } else {
      $sitting_rooms = $_POST["sitting_rooms"];
    }


    //local area detail
    if (empty($_POST["local_area_gym"])) {
      $local_area_gym = null;
      $local_area_gym = ($local_area_gym === 'true') ? 1 : 0;
    } else {
      $local_area_gym = $_POST["local_area_gym"];
      // $local_area_gym = ($local_area_gym==='true') ? 1 : 0;
    }
    if (empty($_POST["local_area_swimming_pool"])) {
      $local_area_swimming_pool = null;
      $local_area_swimming_pool = ($local_area_swimming_pool === 'true') ? 1 : 0;
    } else {
      $local_area_swimming_pool = $_POST["local_area_swimming_pool"];
      // $local_area_swimming_pool = ($local_area_swimming_pool==='true') ? 1 : 0;
    }
    if (empty($_POST["local_area_playing_court"])) {
      $local_area_playing_court = null;
      $local_area_playing_court = ($local_area_playing_court === 'true') ? 1 : 0;
    } else {
      $local_area_playing_court = $_POST["local_area_playing_court"];
      // $local_area_playing_court = ($local_area_playing_court==='true') ? 1 : 0;
    }
    if (empty($_POST["local_area_hospital"])) {
      $local_area_hospital = null;
      $local_area_hospital = ($local_area_hospital === 'true') ? 1 : 0;
    } else {
      $local_area_hospital = $_POST["local_area_hospital"];
      // $local_area_hospital = ($local_area_hospital==='true') ? 1 : 0;
    }
    if (empty($_POST["local_area_school"])) {
      $local_area_school = null;
      $local_area_school = ($local_area_school === 'true') ? 1 : 0;
    } else {
      $local_area_school = $_POST["local_area_school"];
      // $local_area_school = ($local_area_school==='true') ? 1 : 0;
    }
    if (empty($_POST["local_area_montessori"])) {
      $local_area_montessori = null;
      $local_area_montessori = ($local_area_montessori === 'true') ? 1 : 0;
    } else {
      $local_area_montessori = $_POST["local_area_montessori"];
      // $local_area_montessori = ($local_area_montessori==='true') ? 1 : 0;
    }
    if (empty($_POST["local_area_college"])) {
      $local_area_college = null;
      $local_area_college = ($local_area_college === 'true') ? 1 : 0;
    } else {
      $local_area_college = $_POST["local_area_college"];
      // $local_area_college = ($local_area_college==='true') ? 1 : 0;
    }
    if (empty($_POST["local_area_temple"])) {
      $local_area_temple = null;
      $local_area_temple = ($local_area_temple === 'true') ? 1 : 0;
    } else {
      $local_area_temple = $_POST["local_area_temple"];
      // $local_area_temple = ($local_area_temple==='true') ? 1 : 0;
    }
    if (empty($_POST["local_area_resturants"])) {
      $local_area_resturants = null;
      $local_area_resturants = ($local_area_resturants === 'true') ? 1 : 0;
    } else {
      $local_area_resturants = $_POST["local_area_resturants"];
      // $local_area_resturants = ($local_area_resturants==='true') ? 1 : 0;
    }
    if (empty($_POST["local_area_super_market"])) {
      $local_area_super_market = null;
      $local_area_super_market = ($local_area_super_market === 'true') ? 1 : 0;
    } else {
      $local_area_super_market = $_POST["local_area_super_market"];
      // $local_area_super_market = ($local_area_super_market==='true') ? 1 : 0;
    }
    if (empty($_POST["local_area_bus_stop"])) {
      $local_area_bus_stop = null;
      $local_area_bus_stop = ($local_area_bus_stop === 'true') ? 1 : 0;
    } else {
      $local_area_bus_stop = $_POST["local_area_bus_stop"];
      // $local_area_bus_stop = ($local_area_bus_stop==='true') ? 1 : 0;
    }
    if (empty($_POST["local_area_taxi_stand"])) {
      $local_area_taxi_stand = null;
      $local_area_taxi_stand = ($local_area_taxi_stand === 'true') ? 1 : 0;
    } else {
      $local_area_taxi_stand = $_POST["local_area_taxi_stand"];
      // $local_area_taxi_stand = ($local_area_taxi_stand==='true') ? 1 : 0;
    }
    if (empty($_POST["local_area_police_station"])) {
      $local_area_police_station = null;
      $local_area_police_station = ($local_area_police_station === 'true') ? 1 : 0;
    } else {
      $local_area_police_station = $_POST["local_area_police_station"];
      // $local_area_police_station = ($local_area_police_station==='true') ? 1 : 0;
    }
    if (empty($_POST["local_area_bank"])) {
      $local_area_bank = null;
      $local_area_bank = ($local_area_bank === 'true') ? 1 : 0;
    } else {
      $local_area_bank = $_POST["local_area_bank"];
      // $local_area_bank = ($local_area_bank==='true') ? 1 : 0;
    }
    if (empty($_POST["local_area_banquet_hall"])) {
      $local_area_banquet_hall = null;
      $local_area_banquet_hall = ($local_area_banquet_hall === 'true') ? 1 : 0;
    } else {
      $local_area_banquet_hall = $_POST["local_area_banquet_hall"];
      // $local_area_banquet_hall = ($local_area_banquet_hall==='true') ? 1 : 0;
    }
    if (empty($_POST["local_area_gas_station"])) {
      $local_area_gas_station = null;
      $local_area_gas_station = ($local_area_gas_station === 'true') ? 1 : 0;
    } else {
      $local_area_gas_station = $_POST["local_area_gas_station"];
      // $local_area_gas_station = ($local_area_gas_station==='true') ? 1 : 0;
    }


    $cimage = base64_encode(file_get_contents($_FILES['main_image']["tmp_name"]));
    $cimage = mysqli_real_escape_string($conn, $cimage);

    // Insert into Property table
    $propertyInsertQuery = "INSERT INTO Property (user_id, type_name, purpose, title, category, mainphoto, price, price_negotiable, contact, location,  description) 
                                VALUES ('$userid', '$type_name', '$purpose', '$title', '$category', '$cimage', '$price', '$price_negotiable', '$contact', '$location', '$description')";
    mysqli_query($conn, $propertyInsertQuery);

    // Get the last inserted property ID
    $propertyID = mysqli_insert_id($conn);
    // Insert into Amenities table
    $amenitiesInsertQuery = "INSERT INTO Amenities (PropertyID, dob, bed_no, kitchen, bathroom, furnishing, faced, parking, balcony, rental_floor, water_facility, road_type, sitting_rooms) 
  VALUES ('$propertyID', '$dob', '$bed_no', '$kitchen', '$bathroom', '$furnishing', '$faced', '$parking', '$balcony', '$rental_floor', '$water_facility', '$road_type', '$sitting_rooms')";
    mysqli_query($conn, $amenitiesInsertQuery);

    // Insert data into the LocalAreaFacility table
    $localAreaFacilityInsertQuery = "INSERT INTO LocalAreaFacility (PropertyID, local_area_gym, local_area_swimming_pool, local_area_playing_court, local_area_hospital, local_area_school, local_area_montessori, local_area_college, local_area_temple, local_area_resturants, local_area_super_market, local_area_bus_stop, local_area_taxi_stand, local_area_police_station, local_area_bank, local_area_banquet_hall, local_area_gas_station) 
  VALUES ('$propertyID', '$local_area_gym', '$local_area_swimming_pool', '$local_area_playing_court', '$local_area_hospital', '$local_area_school', '$local_area_montessori', '$local_area_college', '$local_area_temple', '$local_area_resturants', '$local_area_super_market','$local_area_bus_stop','$local_area_taxi_stand','$local_area_police_station' ,'$local_area_bank', '$local_area_banquet_hall', '$local_area_gas_station')";
    mysqli_query($conn, $localAreaFacilityInsertQuery);

    header("Location: profile.php");
    $_SESSION['sucess'] = "Property Listed Sucessfully";

  }
}

?>
<!DOCTYPE html>
<html>

<head>
  <title>List Website</title>
  <link rel="stylesheet" href="list.css?v=<? echo $version; ?>" />
  <script src="https://kit.fontawesome.com/5a78363638.js" crossorigin="anonymous"></script>
</head>

<body>
  <header>

    <div id="navbar">
      <nav class="center">
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
  <div class="main">
    <div class="main-container center">
      <form action="<?php echo $_SERVER["PHP_SELF"]; ?>" method="POST" enctype="multipart/form-data"
        onsubmit="return showConfirmation()">
        <div class="row">
          <div class="form-title">
            <h6>Add Residental Details</h6>
            <p>All the fields with * are mandotary</p>
          </div>
          <div class="column-box">
            <div class="column-details">
              <span class="form-number">1.</span>
              <h2>Choose Your Property <br>
                <p class="property-must">Property Type
                  <span class="text-danger">*</span>
                </p>
              </h2>


            </div>
          </div>
          <div class="property-option">
            <div class="form-check">
              <input type="radio" name="property" required value="residental" id="Property1"
                onchange="updatePropertyOptions()" />
              <label for="Property1">Resident Property</label>
            </div>
            <div class="form-check">
              <input type="radio" name="property" required value="commercial" id="Property2"
                onchange="updatePropertyOptions()" />
              <label for="Property2">Commercial Property</label>
            </div>
          </div>
          <div class="column-box">
            <div class="column-details">
              <span class="form-number">2.</span>
              <h2>Basic Detials:</h2>
            </div>
          </div>
          <div class="basic-form">
            <div class="row">
              <div class="basic-col1">
                <div class="basic-purpose">
                  <select class="form-select" required name="purpose" id="purpose">
                    <option value="" selected disabled>Choose Purpose:</option>
                    <option value="Rent">Rent</option>
                    <option value="Sale">Sale</option>
                    <option value="Lease">Lease</option>
                    <option value="PayingGuest">Paying Guest</option>
                  </select>
                  <label for="purpose">Purpose
                    <span class="text-danger">*</span>
                  </label>
                </div>
              </div>
              <div class="basic-col2">
                <div class="basic-purpose">
                  <input type="text" name="title" id="title" required placeholder="Enter your title."
                    class="form-control" />
                  <label for="title">Your Title
                    <span class="text-danger">*</span>
                  </label>
                </div>
              </div>
              <div class="basic-col3">
                <div class="basic-purpose">
                  <select class="form-select" name="category" id="category" required>
                    <option value disabled selected>
                      Select Property Type first.
                    </option>
                  </select>
                  <label for="category">Category
                    <span class="text-danger">*</span>
                  </label>
                </div>
              </div>
              <div class="basic-col4">
                <label for="main_image">Main Photo <span class="text-danger">*</span></label>
                <div class="form-photo">
                  <input required class="form-control" type="file" name="main_image" id="main_image" />
                </div>
              </div>
              <div class="basic-col5">
                <div class="basic-purpose">
                  <input required name="price" id="price" type="text" placeholder="Enter your Price."
                    class="form-control" />
                  <label for="price">Price
                    <span class="text-danger">*</span>
                  </label>
                </div>
              </div>
              <div class="basic-col6">
                <div class="price-option">
                  <select required class="form-select" name="price_negotiable" id="price_negotiable">
                    <option value selected disabled>Select Option</option>
                    <option value="1">Yes</option>
                    <option value="0">No</option>
                  </select>
                  <label for="price_negotiable">Price Negotiable <span class="text-danger">*</span></label>
                </div>
              </div>
            </div>
          </div>
          <div class="column-box">
            <div class="column-details">
              <span class="form-number">3.</span>
              <h2>Amenities:</h2>
            </div>
          </div>
          <div class="basic-form">
            <div class="row">
              <div class="secondary-col1">
                <div class="basic-purpose">
                  <select class="form-select" name="dob" id="date_of_build">
                    <option value selected disabled>Select Date</option>
                  </select>
                  <label for="date_of_build">Date of Build </label>
                </div>
              </div>
              <div class="secondary-col2">
                <div class="basic-purpose">
                  <input type="number" id="bedroom" name="bedroom" placeholder="Enter the number of rooms."
                    class="form-control" />
                  <label for="bedroom">Bed Room eg. 1,2,3 </label>
                </div>
              </div>
              <div class="secondary-col1">
                <div class="basic-purpose">
                  <select class="form-select" name="kitchen" id="kitchen">
                    <option value selected disabled>Select Kitchen</option>
                    <option value="1">Yes</option>
                    <option value="0">No</option>
                  </select>
                  <label for="kitchen">Kitchen</label>
                </div>
              </div>
              <div class="secondary-col2">
                <div class="basic-purpose">
                  <input type="number" name="bathroom" id="bathroom" placeholder="Enter the number of bathrooms"
                    class="form-control" />
                  <label for="bathroom">Bath Room eg. 1,2,3 </label>
                </div>
              </div>
              <div class="secondary-col1">
                <div class="basic-purpose">
                  <select class="form-select" name="furnishing" id="furnishing">
                    <option value selected disabled>Select Option</option>
                    <option value="Yes">Yes</option>
                    <option value="No">No</option>
                    <option value="Semi Furnished">Semi Furnished</option>
                  </select>
                  <label for="furnishing">Furnishing</label>
                </div>
              </div>
              <div class="secondary-col1">
                <div class="basic-purpose">
                  <select class="form-select" name="faced" id="Faced">
                    <option value selected disabled>Select Option</option>
                    <option value="East">East</option>
                    <option value="West">West</option>
                    <option value="North">North</option>
                    <option value="South">South</option>
                  </select>
                  <label for="Faced">Faced</label>
                </div>
              </div>
              <div class="secondary-col1">
                <div class="basic-purpose">
                  <select class="form-select" name="parking" id="Parking">
                    <option value selected disabled>Select Option</option>
                    <option value="1">Yes</option>
                    <option value="0">No</option>
                  </select>
                  <label for="Parking">Parking</label>
                </div>
              </div>
              <div class="secondary-col1">
                <div class="basic-purpose">
                  <select class="form-select" name="balcony" id="Balcony">
                    <option value selected disabled>Select Option</option>
                    <option value="1">Yes</option>
                    <option value="0">No</option>
                  </select>
                  <label for="Balcony">Balcony</label>
                </div>
              </div>
              <div class="secondary-col1">
                <div class="basic-purpose">
                  <select class="form-select" name="rental_floor" id="Rental_Floor">
                    <option value selected disabled>Select Option</option>
                    <option value="Ground Floor">Ground Floor</option>
                    <option value="First Floor">First Floor</option>
                    <option value="Second Floor">Second Floor</option>
                    <option value="Third Floor">Third Floor</option>
                    <option value="Fourth Floor">Fourth Floor</option>
                    <option value="Fifth+ Floor">Fifth+ Floor</option>
                    <option value="Top Floor">Top Floor</option>
                  </select>
                  <label for="Rental_Floor">Rental Floor</label>
                </div>
              </div>
              <div class="secondary-col1">
                <div class="basic-purpose">
                  <select class="form-select" name="water_facility" id="Water_Facility">
                    <option value selected disabled>Select Option</option>
                    <option value="1">Yes</option>
                    <option value="0">No</option>
                  </select>
                  <label for="Water_Facility">Water Facility</label>
                </div>
              </div>
              <div class="secondary-col1">
                <div class="basic-purpose">
                  <select class="form-select" name="road_type" id="Road_Type">
                    <option value selected disabled>Select Option</option>
                    <option value="Goreto Bato">Goreto Bato</option>
                    <option value="Black Pitched">Black Pitched</option>
                    <option value="Gravel Road">Gravel Road</option>
                    <option value="Dhalan Road">Dhalan Road</option>
                    <option value="Muddy Road">Muddy Road</option>
                  </select>
                  <label for="Road_Type">Road Type</label>
                </div>
              </div>
              <div class="secondary-col2">
                <div class="basic-purpose">
                  <input type="number" name="sitting_rooms" id="Sitting_Rooms"
                    placeholder="Enter number of sitting rooms." class="form-control" />
                  <label for="Sitting_Rooms">Sitting Rooms</label>
                </div>
              </div>
            </div>
          </div>
          <div class="column-box">
            <div class="column-details">
              <span class="form-number">4.</span>
              <h2>More Details:</h2>
            </div>
          </div>
          <div class="basic-form">
            <div class="row">
              <div class="last-col1">
                <div class="basic-purpose">
                  <input required type="number" name="contact" id="contact" placeholder="Enter your phone number."
                    class="form-control" />
                  <label for="contact">Contact Number
                    <span class="text-danger">*</span>
                  </label>
                </div>
              </div>
              <div class="last-col2">
                <div class="price-option">
                  <input required type="text" name="location" placeholder="Enter your location" class="form-control"
                    id="search_input" />
                  <label for="search_input">Location <span class="text-danger">*</span>
                  </label>
                </div>
                <!-- <div class="last-col3">
                  <div class="image-purpose">
                    <input type="text" name="latitude" placeholder="Enter Latitude ."
                      class="form-control location-input1" />
                    <input type="text" name="longitude" placeholder="Enter Longitude."
                      class="form-control location-input2" />

                    <label for="">Latitude and Longitude (optional)
                    </label>
                  </div>
                </div> -->
              </div>
              <div class="last-col4">
                <label for="Description">Description <span class="text-danger">*</span></label>
                <div class="description-text">
                  <textarea class="form-control" required name="description" id="Description"
                    placeholder="Describe your property."></textarea>
                </div>
              </div>
              <div class="last-col5">
                <div class="local-select">
                  <span class="radioTtitle">Local Area Facilities</span>
                  <div class="local-options">
                    <div class="form-check">
                      <input type="checkbox" name="local_area_gym" id="form-check-label1" class="form-check-input"
                        value="1" />
                      <label for="form-check-label1">GYM</label>
                    </div>
                    <div class="form-check">
                      <input type="checkbox" name="local_area_swimming_pool" id="form-check-label2"
                        class="form-check-input" name="local" value="1" />
                      <label for="form-check-label2">Swimming Pool</label>
                    </div>
                    <div class="form-check">
                      <input type="checkbox" name="local_area_playing_court" id="form-check-label3"
                        class="form-check-input" value="1" />
                      <label for="form-check-label3">Playing Court</label>
                    </div>
                    <div class="form-check">
                      <input type="checkbox" name="local_area_hospital" id="form-check-label4" class="form-check-input"
                        value="1" />
                      <label for="form-check-label4">Hospital</label>
                    </div>
                    <div class="form-check">
                      <input type="checkbox" name="local_area_school" id="form-check-label5" class="form-check-input"
                        value="1" />
                      <label for="form-check-label5">School</label>
                    </div>

                    <div class="form-check">
                      <input type="checkbox" name="local_area_montessori" id="form-check-label6"
                        class="form-check-input" value="1" />
                      <label for="form-check-label6">Montessori Nursery</label>
                    </div>

                    <div class="form-check">
                      <input type="checkbox" name="local_area_college" id="form-check-label7" class="form-check-input"
                        value="1" />
                      <label for="form-check-label7">College</label>
                    </div>
                    <div class="form-check">
                      <input type="checkbox" name="local_area_temple" id="form-check-label8" class="form-check-input"
                        value="1" />
                      <label for="form-check-label8">Temple</label>
                    </div>
                    <div class="form-check">
                      <input type="checkbox" name="local_area_resturants" id="form-check-label9"
                        class="form-check-input" value="1" />
                      <label for="form-check-label9">Resturants</label>
                    </div>
                    <div class="form-check">
                      <input type="checkbox" name="local_area_super_market" id="form-check-label10"
                        class="form-check-input" value="1" />
                      <label for="form-check-label10">Super Market</label>
                    </div>
                    <div class="form-check">
                      <input type="checkbox" name="local_area_bus_stop" id="form-check-label11" class="form-check-input"
                        value="1" />
                      <label for="form-check-label11">Bus Stop</label>
                    </div>
                    <div class="form-check">
                      <input type="checkbox" name="local_area_taxi_stand" id="form-check-label12"
                        class="form-check-input" value="1" />
                      <label for="form-check-label12">Taxi Stand</label>
                    </div>
                    <div class="form-check">
                      <input type="checkbox" name="local_area_police_station" id="form-check-label13"
                        class="form-check-input" value="1" />
                      <label for="form-check-label13">Police Station</label>
                    </div>
                    <div class="form-check">
                      <input type="checkbox" name="local_area_bank" id="form-check-label14" class="form-check-input"
                        value="1" />
                      <label for="form-check-label14">Bank</label>
                    </div>
                    <div class="form-check">
                      <input type="checkbox" name="local_area_banquet_hall" id="form-check-label15"
                        class="form-check-input" value="1" />
                      <label for="form-check-label15">Banquet Hall</label>
                    </div>
                    <div class="form-check">
                      <input type="checkbox" name="local_area_gas_station" id="form-check-label16"
                        class="form-check-input" value="1" />
                      <label for="form-check-label16">Gas Station</label>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="submit-btn">
            <button class="approval-btn" type="submit" name="submit">
              SUBMIT FOR APPROVAL
              <i class="fas fa-arrow-right" style="padding-left: 0.5rem"></i>
            </button>
          </div>
        </div>
      </form>
    </div>
  </div>
</body>
<script src="list.js?v=<?php echo $version; ?>"></script>

</html>