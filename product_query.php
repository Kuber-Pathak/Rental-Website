<?php
function getAllPrducts($order, $userid)
{
      include 'connect.php';
      $sql = "SELECT * FROM Amenities 
        INNER JOIN Property 
        ON Amenities.PropertyID = Property.PropertyID
        INNER JOIN  LocalAreaFacility
        ON LocalAreaFacility.PropertyID = Property.PropertyID
        WHERE Property.user_id <> '$userid'";

      $sql .= $order;
      $result = mysqli_query($conn, $sql);
      if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                  $products[] = $row;
            }
            return $products;
      } else {
            return [];
      }
}
function getLocationPrducts($location, $order, $userid)
{
      include 'connect.php';
      $sql = "SELECT * FROM Amenities 
        INNER JOIN Property 
        ON Amenities.PropertyID = Property.PropertyID
        INNER JOIN  LocalAreaFacility
        ON LocalAreaFacility.PropertyID = Property.PropertyID
        WHERE location = '$location' AND  Property.user_id <> '$userid'";
      $sql .= $order;

      $result = mysqli_query($conn, $sql);

      if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                  $products[] = $row;
            }
            return $products;
      } else {
            return [];
      }
}
function getResidentialOptions()
{
      include 'connect.php';
      $sql = "SELECT * FROM ResidentialOptions ";
      $result = mysqli_query($conn, $sql);

      if (mysqli_num_rows($result) > 0) {
            return $result;
      }

}
function getCommercialOptions()
{
      include 'connect.php';
      $sql = "SELECT * FROM CommercialOptions ";
      $result = mysqli_query($conn, $sql);

      if (mysqli_num_rows($result) > 0) {
            return $result;
      }

}

function getFloorOptions()
{
      include 'connect.php';
      $sql = "SELECT * FROM FloorOptions ";
      $result = mysqli_query($conn, $sql);

      if (mysqli_num_rows($result) > 0) {
            return $result;
      }

}

function alllyFilter($locaion)
{
      include 'connect.php';
      $sql = "SELECT * FROM Amenities 
        INNER JOIN Property 
        ON Amenities.PropertyID = Property.PropertyID
        INNER JOIN  LocalAreaFacility
        ON LocalAreaFacility.PropertyID = Property.PropertyID
        WHERE location = '$locaion' AND ";
      $result = mysqli_query($conn, $sql);

      while ($row = mysqli_fetch_assoc($result)) {
            $products[] = $row;
      }
      return $products;
}
function getTotalProperty($Id)
{
      include 'connect.php';
      $sql = "SELECT COUNT(Property.PropertyID) FROM Amenities 
        INNER JOIN Property 
        ON Amenities.PropertyID = Property.PropertyID
        INNER JOIN  LocalAreaFacility
        ON LocalAreaFacility.PropertyID = Property.PropertyID
        WHERE Property.PropertyID = '$Id' ";
      $result = mysqli_query($conn, $sql);

      return $result;
}

function getAllUserPrducts($uid)
{
      include 'connect.php';
      $sql = "SELECT * FROM Amenities 
        INNER JOIN Property 
        ON Amenities.PropertyID = Property.PropertyID
        INNER JOIN  LocalAreaFacility
        ON LocalAreaFacility.PropertyID = Property.PropertyID
        WHERE user_id = '$uid'";
      $result = mysqli_query($conn, $sql);
      if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                  $products[] = $row;
            }

            return $products;
      }
}
function getWishlist($pid, $uid)
{
      include 'connect.php';
      $sql = "SELECT * FROM wishlist_info 
        WHERE user_id = '$uid' AND 	PropertyID = '$pid'";
      $result = mysqli_query($conn, $sql);
      if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                  $products[] = $row;
            }

            return $products;
      }
}
function getMessage($uid, $start, $rows_per_page)
{
      include 'connect.php';
      $sql = "SELECT * FROM user_message WHERE user_id = '$uid ' LIMIT $start, $rows_per_page";
      $result = mysqli_query($conn, $sql);
      if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                  $products[] = $row;
            }

            return $products;
      } else {
            return [];
      }
}
function getTotalMessage($uid)
{
      include 'connect.php';
      $sql = "SELECT * FROM user_message WHERE user_id = '$uid '";
      $result = mysqli_query($conn, $sql);
      return mysqli_num_rows($result);
}

function getAllProperties()
{
      include 'connect.php';
      $sql = "SELECT * FROM Property 
        INNER JOIN Amenities 
        ON Amenities.PropertyID = Property.PropertyID
        INNER JOIN  LocalAreaFacility
        ON LocalAreaFacility.PropertyID = Property.PropertyID
        INNER JOIN user_cred
        ON Property.user_id = user_cred.user_id
        ";
      $result = mysqli_query($conn, $sql);
      if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                  $products[] = $row;
            }
            return $products;
      } else {
            return [];
      }
}
function getAllUsers()
{
      include 'connect.php';
      $sql = "SELECT * FROM user_cred 
        ";
      $result = mysqli_query($conn, $sql);
      if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                  $products[] = $row;
            }
            return $products;
      } else {
            return [];
      }
}
function getAllMessage()
{
      include 'connect.php';
      $sql = "SELECT * FROM user_message 
        ";
      $result = mysqli_query($conn, $sql);
      if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                  $products[] = $row;
            }
            return $products;
      } else {
            return [];
      }
}

function getUser($uid)
{
      include 'connect.php';
      $sql = "SELECT * FROM user_cred  WHERE `user_id` = '$uid' 
        ";
      $result = mysqli_query($conn, $sql);
      if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                  $products[] = $row;
            }
            return $products;
      } else {
            return [];
      }
}
?>