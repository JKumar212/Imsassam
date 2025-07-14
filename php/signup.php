<?php
include 'db.php';

$name = $_POST['name'];
$phone = $_POST['phone'];
$email = $_POST['email'];
$password = $_POST['password'];

// Check for duplicate mobile
$check = $conn->prepare("SELECT id FROM users WHERE phone = ?");
$check->bind_param("s", $phone);
$check->execute();
$result = $check->get_result();

if ($result->num_rows > 0) {
  echo "Mobile number already registered.";
  exit;
}

// Insert new user
$expiry = date('Y-m-d', strtotime("+30 days"));  // Free trial
$sql = $conn->prepare("INSERT INTO users (name, phone, email, password, subscription_expiry) VALUES (?, ?, ?, ?, ?)");
$sql->bind_param("sssss", $name, $phone, $email, $password, $expiry);
$sql->execute();

header("Location: ../login.html");
?>
