<?php
session_start();
include 'db.php';

$user_id = $_SESSION['user_id'];
$stmt = $conn->prepare("SELECT subscription_expiry FROM users WHERE id = ?");
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();

if ($row = $result->fetch_assoc()) {
  $today = date('Y-m-d');
  echo (strtotime($row['subscription_expiry']) >= strtotime($today)) ? "active" : "expired";
}
?>
