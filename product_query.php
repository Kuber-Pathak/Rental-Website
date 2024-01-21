<?php
function getAllPrducts($order)
{
      include 'connect.php';
      $sql = "SELECT * FROM Amenities 
        INNER JOIN Property 
        ON Amenities.PropertyID = Property.PropertyID
        INNER JOIN  LocalAreaFacility
        ON LocalAreaFacility.PropertyID = Property.PropertyID";

      $sql .= $order;
      $result = mysqli_query($conn, $sql);

      while ($row = mysqli_fetch_assoc($result)) {
            $products[] = $row;
      }
      return $products;
}
function getLocationPrducts($location, $order)
{
      include 'connect.php';
      $sql = "SELECT * FROM Amenities 
        INNER JOIN Property 
        ON Amenities.PropertyID = Property.PropertyID
        INNER JOIN  LocalAreaFacility
        ON LocalAreaFacility.PropertyID = Property.PropertyID
        WHERE location = '$location'";
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

?>