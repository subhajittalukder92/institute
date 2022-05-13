<?php
$conn=mysqli_connect("localhost","root","","institute");

if (mysqli_connect_errno()) {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  exit;
}
// Change db to "test" db
mysqli_select_db($conn, "institute");