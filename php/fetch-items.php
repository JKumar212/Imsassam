<?php
session_start();
include 'db.php';

$user_id = $_SESSION['user_id'];
$q = $_GET['q'];

$stmt = $conn->prepare("SELECT DISTINCT item_name FROM stock WHERE user_id = ? AND item_name LIKE CONCAT(?, '%') LIMIT 10");
$stmt->bind_param("is", $user_id, $q);
$stmt->execute();
$result = $stmt->get_result();

$items = [];
while ($row = $result->fetch_assoc()) {
  $items[] = $row['item_name'];
}

echo json_encode($items);
?>
