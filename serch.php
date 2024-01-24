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
  $username = $_SESSION['name'];
  // $sql = "SELECT * FROM Amenities 
  //       INNER JOIN Property 
  //       ON Amenities.PropertyID = Property.PropertyID
  //       INNER JOIN  LocalAreaFacility
  //       ON LocalAreaFacility.PropertyID = Property.PropertyID";
  // $result = mysqli_query($conn, $sql);
}
?>
<!DOCTYPE html>
<html>

<head>
  <title>Search Website</title>
  <link rel="stylesheet" href="search.css?v=<? echo $version ?>" />
  <script src="https://kit.fontawesome.com/5a78363638.js" crossorigin="anonymous"></script>
</head>

<body>

  <header>
    <div id="navbar">
      <nav class="center">
        <div class="logo">
          <a href="home.php"><img src="Images/logo3.png" alt="Logo" width="112" /></a>
        </div>
        <ul class="middle-side">
          <li>
            <a href="#">WhishList <i class="fa-regular fa-heart"></i></a>
          </li>
          <li><a href="#">Contact Us</a></li>
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
  <form action="#" method="GET" id="searchForm">
    <div class=" main">
      <div class="container center">
        <div class="banner-image">
          <img src="./Images/room.jpg" alt="" id="perfect" />
        </div>
        <div class="main-content">

          <div class="search">

            <div class="search-container">
              <div class="search-filter">
                <h4>Search Filters</h4>
              </div>
              <div class="location-search">
                <label for="">Choose Locations</label>
                <div class="search-bar">
                  <input id="location" name="location" value="<?php if (isset($_GET['location'])) {
                    echo $_GET['location'];
                  } else {
                    // echo "200";
                  } ?>" name="endPrice" type="text" placeholder="Select or type." />
                  <i class="magnify fa-solid fa-magnifying-glass"></i>
                </div>
              </div>
              <div class="price-search">
                <div class="price-label">
                  <p>Price Range ( Rs. )</p>
                </div>
                <div class="price-input">
                  <div class="price-field">
                    <span>Min.</span>
                    <input type="number" name="startPrice" value="<?php if (isset($_GET['startPrice'])) {
                      echo $_GET['startPrice'];
                    } else {
                      // echo "100";
                    } ?>" class="input-min" />
                  </div>
                  <div class="separator">-</div>
                  <div class="price-field">
                    <span>Max.</span>
                    <input type="number" value="<?php if (isset($_GET['endPrice'])) {
                      echo $_GET['endPrice'];
                    } else {
                      // echo "200";
                    } ?>" name="endPrice" class="input-max" />
                  </div>
                </div>
              </div>

              <div class="property-type">
                <h2>Property Type</h2>
                <div class="property-options">
                  <div>
                    <b>Residential Property</b>
                  </div>
                  <?php
                  $residentals = getResidentialOptions();
                  foreach ($residentals as $residental) {
                    $Rchecked = [];
                    if (isset($_GET['Rcategory'])) {
                      $Rchecked = $_GET['Rcategory'];
                    }
                    ?>
                    <div class="option">
                      <input type="checkbox" name="Rcategory[]" id="<?php echo $residental['Rname']; ?>" value="<?php if (isset($_GET['Rcategory[]'])) {
                           echo $_GET['Rname'];
                         } else {
                           echo $residental['Rname'];
                         } ?>" class="btn-check" <?php if (in_array($residental["Rname"], $Rchecked)) {
                            echo "checked";
                          } ?> />
                      <label class="option-label <?php if (in_array($residental["Rname"], $Rchecked)) {
                        echo "active";
                      } ?>" for="<?php echo $residental['Rname']; ?>">
                        <?php echo $residental['Rname']; ?>
                      </label>
                    </div>
                    <?php
                  }

                  ?>
                  <div><b>Commercial Property</b></div>
                  <?php
                  $Commercials = getCommercialOptions();
                  foreach ($Commercials as $Commercial) {
                    $Cchecked = [];
                    if (isset($_GET['Rcategory'])) {
                      $Cchecked = $_GET['Rcategory'];
                    }
                    ?>
                    <div class="option">
                      <input type="checkbox" name="Rcategory[]" id="<?php echo $Commercial['Cname']; ?>" value="<?php if (isset($_GET['Ccategory[]'])) {
                           echo $_GET['Cname'];
                         } else {
                           echo $Commercial['Cname'];
                         } ?>" class="btn-check" <?php if (in_array($Commercial["Cname"], $Cchecked)) {
                            echo "checked";
                          } ?> />
                      <label class="option-label <?php if (in_array($Commercial["Cname"], $Cchecked)) {
                        echo "active";
                      } ?>" for="<?php echo $Commercial['Cname']; ?>">
                        <?php echo $Commercial['Cname']; ?>
                      </label>
                    </div>
                    <?php
                  }

                  ?>

                </div>
              </div>
              <div class="floor">
                <h2>Floor</h2>
                <div class="floor-search">
                  <div class="floor-form">
                    <?php
                    $Floors = getFloorOptions();
                    foreach ($Floors as $Floor) {
                      $Fchecked = [];
                      if (isset($_GET['Fcategory'])) {
                        $Fchecked = $_GET['Fcategory'];
                      }
                      ?>
                      <div class="form-check">
                        <input type="checkbox" name="Fcategory[]" value="<?php if (isset($_GET['Fcategory[]'])) {
                          echo $_GET['Fname'];
                        } else {
                          echo $Floor['Fname'];
                        } ?>" id="<?php echo $Floor['Fname']; ?>" <?php if (in_array($Floor['Fname'], $Fchecked)) {
                              echo "checked";
                            } ?> />
                        <label for="<?php echo $Floor['Fname']; ?>">
                          <?php echo $Floor['Fname']; ?>
                        </label>
                      </div>
                      <?php
                    }
                    ?>
                  </div>
                </div>
              </div>
              <button type="submit" name="submit" class="filter-button">Apply Filter</button>
            </div>

          </div>
          <?php
          if (isset($_GET['submit'])) {
            $sql = "SELECT * FROM Amenities 
            INNER JOIN Property 
            ON Amenities.PropertyID = Property.PropertyID
            INNER JOIN  LocalAreaFacility
            ON LocalAreaFacility.PropertyID = Property.PropertyID
            WHERE Property.user_id <> '$userid'";
            if (isset($_GET['location']) && $_GET['location'] != null) {
              $location = $_GET['location'];
              $sql .= " AND location = '$location'";
            }
            if (isset($_GET['startPrice']) && $_GET['startPrice'] != null) {
              $startPrice = $_GET['startPrice'];
              $sql .= " AND price >= '$startPrice'";
            }
            if (isset($_GET['endPrice']) && $_GET['endPrice'] != null) {
              $endPrice = $_GET['endPrice'];
              $sql .= " AND price <= '$endPrice'";
            }
            if (isset($_GET['Rcategory']) && $_GET['Rcategory'] != null) {
              $Rcategory = $_GET['Rcategory'];
              $RcategoryString = "'" . implode("', '", $Rcategory) . "'";
              $sql .= " AND category IN ($RcategoryString)";
            }
            // if (isset($_GET['Ccategory']) && $_GET['Ccategory'] != null) {
            //   $Ccategory = $_GET['Ccategory'];
            //   $CcategoryString = "'" . implode("', '", $Ccategory) . "'";
            //   $sql .= " AND category IN ($CcategoryString)";
            // }
            if (isset($_GET['Fcategory']) && $_GET['Fcategory'] != null) {
              $Fcategory = $_GET['Fcategory'];
              $FcategoryString = "'" . implode("', '", $Fcategory) . "'";
              $sql .= " AND rental_floor IN ($FcategoryString)";
            }

            ?>
            <div class="room-container">
              <div class="room-title">
                <div class="room-sort">
                  <div class="sort-select">
                    <span>Sort By</span>
                    <select name="order" id="sortOrder" class="sort" onchange="sortProduct()">
                      <option value="" selected disabled>Select options:</option>
                      <option value="latest" <?php if (isset($_GET['order']) && $_GET['order'] == "latest") {
                        echo "selected";
                      } ?>>Latest
                        Property</option>
                      <option value="oldest" <?php if (isset($_GET['order']) && $_GET['order'] == "oldest") {
                        echo "selected";
                      } ?>>Oldest Property</option>
                      <option value="lowest" <?php if (isset($_GET['order']) && $_GET['order'] == "lowest") {
                        echo "selected";
                      } ?>>Lowest Price</option>
                      <option value="highest" <?php if (isset($_GET['order']) && $_GET['order'] == "highest") {
                        echo "selected";
                      } ?>>Highest Price</option>
                    </select>
                  </div>
                </div>

                <?php
                if (isset($_GET['order'])) {
                  if ($_GET['order'] == "latest") {
                    $sql .= " ORDER BY Property.property_reg_at DESC";
                  }
                  if ($_GET['order'] == "oldest") {
                    $sql .= " ORDER BY Property.property_reg_at ASC";
                  }
                  if ($_GET['order'] == "lowest") {
                    $sql .= " ORDER BY Property.price ASC";
                  }
                  if ($_GET['order'] == "highest") {
                    $sql .= " ORDER BY Property.price DESC";
                  }
                } else {
                  $sql .= " ORDER BY Property.property_reg_at DESC";
                }
                $result = mysqli_query($conn, $sql);
                $totalrows = mysqli_num_rows($result);
                ?>
                <div class="room-result">
                  <span>Showing
                    <?= $totalrows ?> results
                  </span>
                </div>
              </div>
              <div class="room-lists" id="product-wrapper">
                <?php
                while ($row = mysqli_fetch_assoc($result)) {
                  echo '
              <div class="room-box">

                <div class="room-content">
                  <div class="room-img">
                    <a href="info.php?id=' . $row['PropertyID'], '"><img src="data:image/jpeg;base64,' . $row["mainphoto"] . '" alt="" /></a>
                      <div class="room-fav">
                      <a href="wishlist.php?id=' . $row['PropertyID'], '"<i class="fa-regular fa-heart" style="color: #000000;"></i></a>
                      </div>
                      <div class="view_button">
                      <a href="info.php?id=' . $row['PropertyID'], '">View</a>
                      </div>
                    </div>
                    <div class="room-info">
                      <a href="info.php?id=' . $row['PropertyID'], '" title="' . $row["title"] . '" >
                        <h4>' . explode(' ', $row["title"])[0] . " " . explode(' ', $row["title"])[1] . ' </h4>
                    </a>
                    <div class="info-row">
                      <div class="info-col-1">
                        <div class="room-location">
                          <p class="location" title="' . " Location:" . $row["location"] . '" >
                              <span class="fas fa-map-pin"></span> ' . $row["location"] . '
                            </p>
                          </div>
                        </div>
                        <div class="info-col">
                          <div class="room-type" title="' . "Category:" . $row["category"] . '">
                            <img src="./Images/roomLogo3.png" alt="" height="20px" width="20px" />
                           <span class="small-text"> ' . $row["category"] . '</span>
                          </div>
                        </div>
                        <div class="info-col " title="' . "Category:" . "Pice : NPR " . $row["price"] . '">
                          <div class="room-price">
                            <img src="./Images/cash.png" alt="" height="20px" width="20px" />
                            <span class="small-text">' . "NPR " . $row["price"] . '</span>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>

                </div>
            
             ';
                } ?>

                <?php
          } else { ?>
                <div class="room-container">
                  <div class="room-title">
                    <div class="room-sort">
                      <div class="sort-select">
                        <span>Sort By</span>
                        <select name="order" id="sortOrder" class="sort" onchange="sortProduct()">
                          <option value="" selected disabled>Select options:</option>
                          <option value="latest" <?php if (isset($_GET['order']) && $_GET['order'] == "latest") {
                            echo "selected";
                          } ?>>Latest
                            Property</option>
                          <option value="oldest" <?php if (isset($_GET['order']) && $_GET['order'] == "oldest") {
                            echo "selected";
                          } ?>>Oldest Property</option>
                          <option value="lowest" <?php if (isset($_GET['order']) && $_GET['order'] == "lowest") {
                            echo "selected";
                          } ?>>Lowest Price</option>
                          <option value="highest" <?php if (isset($_GET['order']) && $_GET['order'] == "highest") {
                            echo "selected";
                          } ?>>Highest Price</option>
                        </select>
                      </div>
                    </div>

                    <?php
                    if (isset($_GET['order'])) {
                      if ($_GET['order'] == "latest") {
                        $order = " ORDER BY Property.property_reg_at DESC";
                      }
                      if ($_GET['order'] == "oldest") {
                        $order = " ORDER BY Property.property_reg_at ASC";
                      }
                      if ($_GET['order'] == "lowest") {
                        $order = " ORDER BY Property.price ASC";
                      }
                      if ($_GET['order'] == "highest") {
                        $order = " ORDER BY Property.price DESC";
                      }
                    } else {
                      $order = " ORDER BY Property.property_reg_at DESC";
                    }
                    // while ($row = mysqli_fetch_assoc($result)) {
                    if (isset($_GET['location']) && $_GET['location'] != NULL) {
                      $products = getLocationPrducts($_GET['location'], $order, $userid);
                    } else {
                      $products = getAllPrducts($order, $userid);
                    }

                    $totalrows = count($products);
                    ?>
                    <div class="room-result">
                      <span>Showing
                        <?= $totalrows ?> results
                      </span>
                    </div>
                  </div>
                  <div class=" room-lists" id="product-wrapper">
                    <?php

                    foreach ($products as $row) {
                      echo '
              <div class="room-box">
                <div class="room-content">
                  <div class="room-img">
                    <a href="info.php?id=' . $row['PropertyID'], '"><img src="data:image/jpeg;base64,' . $row["mainphoto"] . '" alt="" /></a>
                    <div class="room-fav">
                    <a href="wishlist.php?id=' . $row['PropertyID'], '"<i class="fa-regular fa-heart" style="color: #000000;"></i></a>
                    </div>
                    <div class="view_button">
                    <a href="info.php?id=' . $row['PropertyID'], '">View</a>
                    </div>
                  </div>
                  <div class="room-info">
                    <a href="info.php?id=' . $row['PropertyID'], '" title="' . $row["title"] . '" >
                      <h4>' . explode(' ', $row["title"])[0] . " " . explode(' ', $row["title"])[1] . '</h4>
                    </a>
                    <div class="info-row">
                      <div class="info-col-1">
                        <div class="room-location">
                          <p class="location" title="' . "Location:" . $row["location"] . '" >
                            <span class="fas fa-map-pin"></span> ' . $row["location"] . '
                          </p>
                        </div>
                      </div>
                      <div class="info-col">
                        <div class="room-type" title="' . "Category:" . $row["category"] . '">
                          <img src="./Images/roomLogo.png" alt="" height="20px" width="20px" />
                          <span class="small-text"> ' . $row["category"] . '</span>
                        </div>
                      </div>
                      <div class="info-col " title="' . "Category:" . "Pice : NPR " . $row["price"] . '">
                        <div class="room-price">
                          <img src="./Images/cash.png" alt="" height="20px" width="20px" />
                          <span class="small-text"> ' . $row["price"] . '</span>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>

              </div>
            
           ';
                    }
          } ?>
                </div>
                <div class="room-footer">
                  <div class="room-nav">
                    <div class="nav">
                      <ul class="room-page">
                        <li class="page-item">
                          <span class="page-link">
                            < </span>
                        </li>
                        <li class="page-item">
                          <a href="#" class="page-link">1</a>
                        </li>
                        <li class="page-item">
                          <a href="#" class="page-link">2</a>
                        </li>
                        <li class="page-item">
                          <a href="#" class="page-link">3</a>
                        </li>
                        <li class="page-item">
                          <a href="#" class="page-link">4</a>
                        </li>
                        <li class="page-item">
                          <a href="#" class="page-link">5</a>
                        </li>
                        <li class="page-item">
                          <a href="#" class="page-link">6</a>
                        </li>
                        <li class="page-item">
                          <a href="#" class="page-link">7</a>
                        </li>
                        <li class="page-item">
                          <span class="page-link"> > </span>
                        </li>
                      </ul>
                    </div>
                  </div>
                </div>
              </div>

            </div>
          </div>
        </div>
  </form>
</body>
<script src="search.js?v=<? echo $version ?>"></script>

</html>