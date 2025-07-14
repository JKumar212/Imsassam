<?php
session_start();
include 'db.php';

$user_id = $_SESSION['user_id'];
$amount = $_GET['amount'];
$payment_id = $_GET['payment_id'];

// Add months based on amount
$months = ($amount == 297) ? 3 : 12;
$new_expiry = date('Y-m-d', strtotime("+$months months"));

$stmt = $conn->prepare("UPDATE users SET subscription_expiry = ? WHERE id = ?");
$stmt->bind_param("si", $new_expiry, $user_id);
$stmt->execute();

header("Location: ../dashboard.php");
?>
