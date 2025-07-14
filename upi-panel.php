<?php
session_start();
include 'db.php';

if (!isset($_SESSION['user_id'])) {
  header("Location: login.html");
  exit;
}

// Fetch UPI QR (stored in a settings table or static file)
$upi_code = "upi://pay?pa=yourupi@bank&pn=IMS&cu=INR"; // replace with your real UPI
?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <title>Donate via UPI</title>
  <link rel="stylesheet" href="assets/style.css">
</head>
<body>
  <div class="container">
    <h2>🙏 Support the Project</h2>
    <p>Scan or click the below UPI code:</p>
    <a href="<?= $upi_code ?>">
      <img src="assets/upi.png" alt="UPI QR" style="max-width:200px;" />
    </a>
    <p><?= $upi_code ?></p>
  </div>
</body>
</html>