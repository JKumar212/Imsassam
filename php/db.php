<?php
$host = "localhost";
$user = "root";           // change if using cPanel or online host
$password = "";           // your DB password
$database = "ims_db";     // your database name

$conn = new mysqli($host, $user, $password, $database);

if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
?>
