<?php
session_start();
if (!isset($_SESSION['user_id'])) {
  header("Location: login.html");
  exit;
}
if (!isset($_SESSION['subscription_active']) || $_SESSION['subscription_active'] == false) {
  echo "<h3 style='text-align:center;margin-top:100px;'>🚫 Your subscription has expired. Please upgrade to access analytics.</h3>";
  exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>IMS Analytics</title>
  <link rel="stylesheet" href="assets/style.css">
  <script src="assets/chart.min.js"></script>
</head>
<body>
  <header class="dashboard-header">
    <h2>📊 Analytics Dashboard</h2>
    <nav>
      <ul class="nav-links">
        <li><a href="dashboard.php">🏠 Dashboard</a></li>
        <li><a href="billing.php">🧾 Billing</a></li>
        <li><a href="php/logout.php">🚪 Logout</a></li>
      </ul>
    </nav>
  </header>

  <main class="analytics-main">
    <div class="filter-bar">
      <label for="dateRange">Show data for: </label>
      <select id="dateRange">
        <option value="1">Today</option>
        <option value="7">Last 7 Days</option>
        <option value="30">This Month</option>
      </select>
    </div>

    <div class="card-group">
      <div class="card">💰 Total Sales: ₹<span id="totalSales">0</span></div>
      <div class="card">💸 Expenses: ₹<span id="totalExpenses">0</span></div>
      <div class="card">📦 Items Sold: <span id="itemsSold">0</span></div>
      <div class="card">📑 Invoices: <span id="invoiceCount">0</span></div>
    </div>

    <canvas id="salesChart" style="max-width: 800px; margin: 30px auto;"></canvas>
  </main>

  <script src="assets/analytics.js"></script>
</body>
</html>
