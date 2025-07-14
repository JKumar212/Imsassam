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
  <title>Billing - IMS</title>
  <link rel="stylesheet" href="assets/style.css" />
  <script src="assets/jsPDF.min.js"></script>
</head>
<body>
  <header class="dashboard-header">
    <h2>🧾 Generate Invoice</h2>
    <nav>
      <ul class="nav-links">
        <li><a href="dashboard.php">🏠 Dashboard</a></li>
        <li><a href="analytics.php">📊 Analytics</a></li>
        <li><a href="php/logout.php">🚪 Logout</a></li>
      </ul>
    </nav>
  </header>

  <main class="billing-main">
    <form id="billingForm" class="form-box">
      <label for="customer">Customer Name:</label>
      <input type="text" id="customer" name="customer" required />

      <label for="item">Item Name:</label>
      <input type="text" id="item" name="item" list="itemList" autocomplete="off" required />
      <datalist id="itemList"></datalist>

      <label for="qty">Quantity:</label>
      <input type="number" id="qty" name="qty" required min="1" />

      <label for="price">Price per unit:</label>
      <input type="number" id="price" name="price" required min="0" />

      <label for="discount">Discount (₹):</label>
      <input type="number" id="discount" name="discount" min="0" value="0" />

      <button type="button" onclick="addToBill()">➕ Add to Bill</button>
    </form>

    <hr />

    <div class="invoice-box">
      <h3>🧾 Invoice Preview</h3>
      <table id="invoiceTable">
        <thead>
          <tr>
            <th>Item</th>
            <th>Qty</th>
            <th>Price</th>
            <th>Subtotal</th>
          </tr>
        </thead>
        <tbody></tbody>
      </table>
      <p><strong>Total: ₹<span id="totalAmount">0</span></strong></p>

      <button onclick="downloadPDF()">📄 Download PDF</button>
      <button onclick="window.print()">🖨️ Print</button>
    </div>
  </main>

  <script src="assets/script.js"></script>
  <script>
    // Autocomplete
    document.getElementById('item').addEventListener('input', function () {
      fetch('php/fetch-items.php?q=' + this.value)
        .then(res => res.json())
        .then(data => {
          let list = document.getElementById('itemList');
          list.innerHTML = '';
          data.forEach(item => {
            let option = document.createElement('option');
            option.value = item;
            list.appendChild(option);
          });
        });
    });

    let billItems = [], total = 0;
    function addToBill() {
      let item = document.getElementById('item').value;
      let qty = parseInt(document.getElementById('qty').value);
      let price = parseFloat(document.getElementById('price').value);
      let discount = parseFloat(document.getElementById('discount').value);

      if (!item || qty <= 0 || price < 0) return;

      let subtotal = qty * price - discount;
      total += subtotal;

      let row = `<tr><td>${item}</td><td>${qty}</td><td>${price}</td><td>${subtotal}</td></tr>`;
      document.querySelector('#invoiceTable tbody').innerHTML += row;
      document.getElementById('totalAmount').textContent = total.toFixed(2);

      billItems.push({ item, qty, price, discount, subtotal });
    }

    function downloadPDF() {
      const doc = new jsPDF();
      doc.text("IMS Invoice", 10, 10);
      let y = 20;
      billItems.forEach(b => {
        doc.text(`${b.item} x${b.qty} @${b.price} - Discount ₹${b.discount} = ₹${b.subtotal}`, 10, y);
        y += 10;
      });
      doc.text(`Total: ₹${total.toFixed(2)}`, 10, y + 10);
      doc.save("invoice.pdf");
    }
  </script>
</body>
</html>
