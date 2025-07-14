<?php
session_start();
include 'db.php';

$user_id = $_SESSION['user_id'];
$days = intval($_GET['days']);
$start_date = date('Y-m-d', strtotime("-$days days"));

$stmt = $conn->prepare("SELECT total_amount, invoice_date FROM invoices WHERE user_id = ? AND invoice_date >= ?");
$stmt->bind_param("is", $user_id, $start_date);
$stmt->execute();
$result = $stmt->get_result();

$data = [
  "total_sales" => 0,
  "expenses" => 0,
  "items_sold" => 0,
  "invoice_count" => 0,
  "daily_sales" => []
];

while ($row = $result->fetch_assoc()) {
  $data['total_sales'] += $row['total_amount'];
  $data['invoice_count']++;

  $date = $row['invoice_date'];
  if (!isset($data['daily_sales'][$date])) $data['daily_sales'][$date] = 0;
  $data['daily_sales'][$date] += $row['total_amount'];
}

// Simulated expense (or you can fetch from DB)
$data['expenses'] = $data['total_sales'] * 0.2;

echo json_encode($data);
?>
