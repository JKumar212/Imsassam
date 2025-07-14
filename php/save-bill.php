<?php
session_start();
include 'db.php';

$user_id = $_SESSION['user_id'];
$data = json_decode(file_get_contents("php://input"), true);

$customer = $data['customer'];
$total = $data['total'];
$items = json_encode($data['items']);
$date = date('Y-m-d');

$stmt = $conn->prepare("INSERT INTO invoices (user_id, customer_name, items, total_amount, invoice_date) VALUES (?, ?, ?, ?, ?)");
$stmt->bind_param("issds", $user_id, $customer, $items, $total, $date);
$stmt->execute();

echo "Saved";
?>
