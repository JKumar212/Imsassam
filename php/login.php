<?php
session_start();
include 'db.php';

$phone = $_POST['phone'];
$email = $_POST['email'];
$password = $_POST['password'];

$sql = "SELECT * FROM users WHERE phone = ? AND email = ? AND password = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("sss", $phone, $email, $password);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 1) {
  $user = $result->fetch_assoc();
  $_SESSION['user_id'] = $user['id'];
  $_SESSION['username'] = $user['name'];

  $today = date('Y-m-d');
  $_SESSION['subscription_active'] = (strtotime($user['subscription_expiry']) >= strtotime($today));

  header("Location: ../dashboard.php");
  exit;
} else {
  echo "Invalid credentials.";
}
?>
