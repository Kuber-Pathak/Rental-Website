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
        $sql = "SELECT * FROM Amenities 
        INNER JOIN Property 
        ON Amenities.PropertyID = Property.PropertyID
        INNER JOIN  LocalAreaFacility
        ON LocalAreaFacility.PropertyID = Property.PropertyID
        WHERE  Property.PropertyID = '$propertyID'
        ";
        $result = mysqli_query($conn, $sql);
        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {



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
                                            <input type="radio" selected name="property" <?php if ($row['type_name'] == 'residental') {
                                                echo 'selected checked';
                                            } ?> required value="residental" id="Property1"
                                                onchange="updatePropertyOptions()" />
                                            <label for="Property1">Resident Property</label>
                                        </div>
                                        <div class="form-check">
                                            <input type="radio" <?php if ($row['type_name'] == 'commercial') {
                                                echo 'selected checked';
                                            } ?> name="property" required value="commercial" id="Property2"
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
                                                        <option value="Rent" <?php if ($row['purpose'] == 'Rent') {
                                                            echo 'selected';
                                                        } ?>>
                                                            Rent</option>
                                                        <option value="Sale" <?php if ($row['purpose'] == 'Sale') {
                                                            echo 'selected';
                                                        } ?>>
                                                            Sale</option>
                                                        <option value="Lease" <?php if ($row['purpose'] == 'Lease') {
                                                            echo 'selected';
                                                        } ?>>Lease</option>
                                                        <option value="PayingGuest" <?php if ($row['purpose'] == 'PayingGuest') {
                                                            echo 'selected';
                                                        } ?>>Paying Guest</option>
                                                    </select>
                                                    <label for="purpose">Purpose
                                                        <span class="text-danger">*</span>
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="basic-col2">
                                                <div class="basic-purpose">
                                                    <input type="text" name="title" id="title" required placeholder="Enter your title."
                                                        class="form-control" value="<?php if ($row['title']) {
                                                            echo $row['title'];
                                                        } ?>" />
                                                    <label for="title">Your Title
                                                        <span class="text-danger">*</span>
                                                    </label>
                                                </div>
                                            </div>
                                            <?php
                                            if ($row['type_name'] == "residental") {
                                                ?>
                                                <div class="basic-col3">
                                                    <div class="basic-purpose">
                                                        <select class="form-select" name="category" id="category" required>
                                                            <option value="1BHK" <?php if ($row['category'] == '1BHK') {
                                                                echo 'selected';
                                                            } ?>>
                                                                1BHK
                                                            </option>
                                                            <option value="2BHK" <?php if ($row['category'] == '2BHK') {
                                                                echo 'selected';
                                                            } ?>>
                                                                2BHK

                                                            </option>
                                                            <option value="3BHK" <?php if ($row['category'] == '3BHK') {
                                                                echo 'selected';
                                                            } ?>>
                                                                3BHK
                                                            </option>
                                                            <option value="Flat" <?php if ($row['category'] == 'Flat') {
                                                                echo 'selected';
                                                            }
                                                            ?>>
                                                                Flat
                                                            </option>
                                                            <option value="Single room" <?php if ($row['category'] == 'Single room') {
                                                                echo 'selected';
                                                            }
                                                            ?>>
                                                                Single room
                                                            </option>
                                                            <option value="Two room" <?php if ($row['category'] == 'Two room') {
                                                                echo 'selected';
                                                            }
                                                            ?>>
                                                                Two room
                                                            </option>
                                                        </select>
                                                        <label for="category">Category
                                                            <span class="text-danger">*</span>
                                                        </label>
                                                    </div>
                                                </div>
                                            <?php } else {
                                                ?>
                                                <div class="basic-col3">
                                                    <div class="basic-purpose">
                                                        <select class="form-select" name="category" id="category" required>
                                                            <option value="Shutter" <?php if ($row['category'] == 'Shutter') {
                                                                echo 'selected';
                                                            }
                                                            ?>>Shutter</option>
                                                            <option value="Shop" <?php if ($row['category'] == 'Shop') {
                                                                echo 'selected';
                                                            }
                                                            ?>>Shop</option>
                                                            <option value="Office space" <?php if ($row['category'] == 'Office space') {
                                                                echo 'selected';
                                                            }
                                                            ?>>Office space</option>
                                                            <option value="Warehouse/Godown" <?php if ($row['category'] == 'Warehouse/Godown') {
                                                                echo 'selected';
                                                            }
                                                            ?>>Warehouse/Godown</option>
                                                        </select>
                                                        <label for="category">Category
                                                            <span class="text-danger">*</span>
                                                        </label>
                                                    </div>
                                                </div>
                                            <?php } ?>
                                            <div class="basic-col4">
                                                <label for="main_image">Main Photo <span class="text-danger">*</span></label>
                                                <div class="form-photo">
                                                    <input required class="form-control" type="file" name="main_image"
                                                        id="main_image" />
                                                </div>
                                            </div>
                                            <div class="basic-col5">
                                                <div class="basic-purpose">
                                                    <input required name="price" value="<?php if ($row['price']) {
                                                        echo $row['price'];
                                                    }
                                                    ?>" id="price" type="text" placeholder="Enter your Price."
                                                        class="form-control" />
                                                    <label for="price">Price
                                                        <span class="text-danger">*</span>
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="basic-col6">
                                                <div class="price-option">
                                                    <select required class="form-select" name="price_negotiable" id="price_negotiable">
                                                        <option value="1" <?php if ($row['price_negotiable']) {
                                                            echo 'selected';
                                                        }
                                                        ?>>Yes</option>
                                                        <option value="0" <?php if (!$row['price_negotiable']) {
                                                            echo 'selected';
                                                        }
                                                        ?>>No</option>
                                                    </select>
                                                    <label for="price_negotiable">Price Negotiable <span
                                                            class="text-danger">*</span></label>
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
                                                    <input type="number" id="bedroom" name="bedroom" value="<?php if ($row['bed_no']) {
                                                        echo $row['bed_no'];
                                                    }
                                                    ?>" placeholder="Enter the number of rooms."
                                                        class="form-control" />
                                                    <label for="bedroom">Bed Room eg. 1,2,3 </label>
                                                </div>
                                            </div>
                                            <div class="secondary-col1">
                                                <div class="basic-purpose">
                                                    <select class="form-select" name="kitchen" id="kitchen">
                                                        <option value="1" <?php if ($row['kitchen']) {
                                                            echo 'selected';
                                                        }
                                                        ?>>Yes</option>
                                                        <option value="0" <?php if (!$row['kitchen']) {
                                                            echo 'selected';
                                                        }
                                                        ?>>No</option>
                                                    </select>
                                                    <label for="kitchen">Kitchen</label>
                                                </div>
                                            </div>
                                            <div class="secondary-col2">
                                                <div class="basic-purpose">
                                                    <input type="number" name="bathroom" id="bathroom" value="<?php if ($row['bathroom']) {
                                                        echo $row['bathroom'];
                                                    }
                                                    ?>" placeholder="Enter the number of bathrooms"
                                                        class="form-control" />
                                                    <label for="bathroom">Bath Room eg. 1,2,3 </label>
                                                </div>
                                            </div>
                                            <div class="secondary-col1">
                                                <div class="basic-purpose">
                                                    <select class="form-select" name="furnishing" id="furnishing">
                                                        <option value selected disabled>Select Option</option>
                                                        <option value="Yes" <?php if ($row['furnishing'] == 'Yes') {
                                                            echo 'selected';
                                                        }
                                                        ?>>Yes</option>
                                                        <option value="No" <?php if (!$row['furnishing']) {
                                                            echo 'selected';
                                                        }
                                                        ?>>No</option>
                                                        <option value="Semi Furnished" <?php if ($row['furnishing'] == 'Semi Furnished') {
                                                            echo 'selected';
                                                        }
                                                        ?>>Semi Furnished</option>
                                                    </select>
                                                    <label for="furnishing">Furnishing</label>
                                                </div>
                                            </div>
                                            <div class="secondary-col1">
                                                <div class="basic-purpose">
                                                    <select class="form-select" name="faced" id="Faced">
                                                        <option value <?php if (!$row['faced']) {
                                                            echo 'selected disabled';
                                                        }
                                                        ?>>Select Option</option>
                                                        <option value="East" <?php if ($row['faced'] == "East") {
                                                            echo 'selected';
                                                        }
                                                        ?>>East</option>
                                                        <option value="West" <?php if ($row['faced'] == "West") {
                                                            echo 'selected';
                                                        }
                                                        ?>>West</option>
                                                        <option value="North" <?php if ($row['faced'] == "North") {
                                                            echo 'selected';
                                                        }
                                                        ?>>North</option>
                                                        <option value="South" <?php if ($row['faced'] == "South") {
                                                            echo 'selected';
                                                        }
                                                        ?>>South</option>
                                                    </select>
                                                    <label for="Faced">Faced</label>
                                                </div>
                                            </div>
                                            <div class="secondary-col1">
                                                <div class="basic-purpose">
                                                    <select class="form-select" name="parking" id="Parking">
                                                        <option value="1" <?php if ($row['parking']) {
                                                            echo 'selected';
                                                        }
                                                        ?>>Yes</option>
                                                        <option value="0" <?php if (!$row['parking']) {
                                                            echo 'selected';
                                                        }
                                                        ?>>No</option>
                                                    </select>
                                                    <label for="Parking">Parking</label>
                                                </div>
                                            </div>
                                            <div class="secondary-col1">
                                                <div class="basic-purpose">
                                                    <select class="form-select" name="balcony" id="Balcony">
                                                        <option value="1" <?php if ($row['balcony']) {
                                                            echo 'selected';
                                                        }
                                                        ?>>Yes</option>
                                                        <option value="0" <?php if (!$row['balcony']) {
                                                            echo 'selected';
                                                        }
                                                        ?>>No</option>
                                                    </select>
                                                    <label for="Balcony">Balcony</label>
                                                </div>
                                            </div>
                                            <div class="secondary-col1">
                                                <div class="basic-purpose">
                                                    <select class="form-select" name="rental_floor" id="Rental_Floor">
                                                        <option value <?php if (!$row['rental_floor']) {
                                                            echo 'selected disabled';
                                                        }
                                                        ?>>Select Option</option>
                                                        <option value="Ground Floor" <?php if ($row['rental_floor'] == 'Ground Floor') {
                                                            echo 'selected';
                                                        }
                                                        ?>>Ground Floor</option>
                                                        <option value="First Floor" <?php if ($row['rental_floor'] == 'First Floor') {
                                                            echo 'selected';
                                                        }
                                                        ?>>First Floor</option>
                                                        <option value="Second Floor" <?php if ($row['rental_floor'] == 'Second Floor') {
                                                            echo 'selected';
                                                        }
                                                        ?>>Second Floor</option>
                                                        <option value="Third Floor" <?php if ($row['rental_floor'] == 'Third Floor') {
                                                            echo 'selected';
                                                        }
                                                        ?>>Third Floor</option>
                                                        <option value="Fourth Floor" <?php if ($row['rental_floor'] == 'Fourth Floor') {
                                                            echo 'selected';
                                                        }
                                                        ?>>Fourth Floor</option>
                                                        <option value="Fifth+ Floor" <?php if ($row['rental_floor'] == 'Fifth+ Floor') {
                                                            echo 'selected';
                                                        }
                                                        ?>>Fifth+ Floor</option>
                                                        <option value="Top Floor" <?php if ($row['rental_floor'] == 'Top Floor') {
                                                            echo 'selected';
                                                        }
                                                        ?>>Top Floor</option>
                                                    </select>
                                                    <label for="Rental_Floor">Rental Floor</label>
                                                </div>
                                            </div>
                                            <div class="secondary-col1">
                                                <div class="basic-purpose">
                                                    <select class="form-select" name="water_facility" id="Water_Facility">
                                                        <option value="1" <?php if ($row['water_facility']) {
                                                            echo 'selected';
                                                        }
                                                        ?>>Yes</option>
                                                        <option value="0" <?php if (!$row['water_facility']) {
                                                            echo 'selected';
                                                        } ?>>No
                                                        </option>
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
                                                    <input required type="number" name="contact" id="contact"
                                                        placeholder="Enter your phone number." class="form-control" />
                                                    <label for="contact">Contact Number
                                                        <span class="text-danger">*</span>
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="last-col2">
                                                <div class="price-option">
                                                    <input required type="text" name="location" placeholder="Enter your location"
                                                        class="form-control" id="search_input" />
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
                                                            <input type="checkbox" name="local_area_gym" id="form-check-label1"
                                                                class="form-check-input" value="1" />
                                                            <label for="form-check-label1">GYM</label>
                                                        </div>
                                                        <div class="form-check">
                                                            <input type="checkbox" name="local_area_swimming_pool"
                                                                id="form-check-label2" class="form-check-input" name="local"
                                                                value="1" />
                                                            <label for="form-check-label2">Swimming Pool</label>
                                                        </div>
                                                        <div class="form-check">
                                                            <input type="checkbox" name="local_area_playing_court"
                                                                id="form-check-label3" class="form-check-input" value="1" />
                                                            <label for="form-check-label3">Playing Court</label>
                                                        </div>
                                                        <div class="form-check">
                                                            <input type="checkbox" name="local_area_hospital" id="form-check-label4"
                                                                class="form-check-input" value="1" />
                                                            <label for="form-check-label4">Hospital</label>
                                                        </div>
                                                        <div class="form-check">
                                                            <input type="checkbox" name="local_area_school" id="form-check-label5"
                                                                class="form-check-input" value="1" />
                                                            <label for="form-check-label5">School</label>
                                                        </div>

                                                        <div class="form-check">
                                                            <input type="checkbox" name="local_area_montessori" id="form-check-label6"
                                                                class="form-check-input" value="1" />
                                                            <label for="form-check-label6">Montessori Nursery</label>
                                                        </div>

                                                        <div class="form-check">
                                                            <input type="checkbox" name="local_area_college" id="form-check-label7"
                                                                class="form-check-input" value="1" />
                                                            <label for="form-check-label7">College</label>
                                                        </div>
                                                        <div class="form-check">
                                                            <input type="checkbox" name="local_area_temple" id="form-check-label8"
                                                                class="form-check-input" value="1" />
                                                            <label for="form-check-label8">Temple</label>
                                                        </div>
                                                        <div class="form-check">
                                                            <input type="checkbox" name="local_area_resturants" id="form-check-label9"
                                                                class="form-check-input" value="1" />
                                                            <label for="form-check-label9">Resturants</label>
                                                        </div>
                                                        <div class="form-check">
                                                            <input type="checkbox" name="local_area_super_market"
                                                                id="form-check-label10" class="form-check-input" value="1" />
                                                            <label for="form-check-label10">Super Market</label>
                                                        </div>
                                                        <div class="form-check">
                                                            <input type="checkbox" name="local_area_bus_stop" id="form-check-label11"
                                                                class="form-check-input" value="1" />
                                                            <label for="form-check-label11">Bus Stop</label>
                                                        </div>
                                                        <div class="form-check">
                                                            <input type="checkbox" name="local_area_taxi_stand" id="form-check-label12"
                                                                class="form-check-input" value="1" />
                                                            <label for="form-check-label12">Taxi Stand</label>
                                                        </div>
                                                        <div class="form-check">
                                                            <input type="checkbox" name="local_area_police_station"
                                                                id="form-check-label13" class="form-check-input" value="1" />
                                                            <label for="form-check-label13">Police Station</label>
                                                        </div>
                                                        <div class="form-check">
                                                            <input type="checkbox" name="local_area_bank" id="form-check-label14"
                                                                class="form-check-input" value="1" />
                                                            <label for="form-check-label14">Bank</label>
                                                        </div>
                                                        <div class="form-check">
                                                            <input type="checkbox" name="local_area_banquet_hall"
                                                                id="form-check-label15" class="form-check-input" value="1" />
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
                    <?php
            }
        }
    }
}
?>
</body>
<script src="list.js?v=<?php echo $version; ?>"></script>

</html>