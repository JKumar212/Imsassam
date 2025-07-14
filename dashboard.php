<?php
session_start();
if (!isset($_SESSION['user_id'])) {
  header("Location: login.html");
  exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Dashboard - IMS</title>
  <link rel="stylesheet" href="assets/style.css" />
</head>
<body>
  <header class="dashboard-header">
    <h2>Welcome, <?php echo $_SESSION['username']; ?> 👋</h2>
    <nav>
      <ul class="nav-links">
        <li><a href="dashboard.php">🏠 Home</a></li>
        <li><a href="billing.php">🧾 Billing</a></li>
        <li><a href="analytics.php">📊 Analytics</a></li>
        <li><a href="php/logout.php" onclick="return confirm('Logout now?')">🚪 Logout</a></li>
      </ul>
    </nav>
  </header>

  <main class="dashboard-main">
    <section class="card-grid">
      <div class="card">
        <h3>📦 Manage Stock</h3>
        <p>Add, edit, or delete items in your inventory.</p>
        <a href="stock.php" class="btn">Open</a>
      </div>

      <div class="card">
        <h3>🧾 Create Bill</h3>
        <p>Generate invoices with discount and item suggestion.</p>
        <a href="billing.php" class="btn">Open</a>
      </div>

      <div class="card">
        <h3>📈 View Analytics</h3>
        <p>Visualize your sales, expenses, and growth.</p>
        <a href="analytics.php" class="btn">Open</a>
      </div>

      <div class="card">
        <h3>💳 Subscription</h3>
        <p>Upgrade to premium for unlimited access.</p>
        <a href="subscription.php" class="btn secondary">Upgrade</a>
      </div>
    </section>
  </main>
</body>
</html>
