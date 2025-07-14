let billItems = [];
let totalAmount = 0;

function addToBill() {
  const item = document.getElementById("item").value.trim();
  const qty = parseInt(document.getElementById("qty").value);
  const price = parseFloat(document.getElementById("price").value);
  const discount = parseFloat(document.getElementById("discount").value || 0);

  if (!item || isNaN(qty) || isNaN(price)) {
    alert("Please fill all fields correctly.");
    return;
  }

  const subtotal = (qty * price) - discount;
  totalAmount += subtotal;

  const billRow = `
    <tr>
      <td>${item}</td>
      <td>${qty}</td>
      <td>${price.toFixed(2)}</td>
      <td>${subtotal.toFixed(2)}</td>
    </tr>
  `;

  document.querySelector("#invoiceTable tbody").insertAdjacentHTML("beforeend", billRow);
  document.getElementById("totalAmount").textContent = totalAmount.toFixed(2);

  billItems.push({ item, qty, price, discount, subtotal });
}

function downloadPDF() {
  if (billItems.length === 0) {
    alert("Nothing to download!");
    return;
  }

  const doc = new jsPDF();
  doc.setFontSize(14);
  doc.text("🧾 IMS Invoice", 20, 20);

  let y = 30;
  billItems.forEach((b, i) => {
    doc.text(`${i + 1}. ${b.item} x${b.qty} @₹${b.price} - ₹${b.discount} = ₹${b.subtotal}`, 20, y);
    y += 10;
  });

  doc.setFontSize(16);
  doc.text(`Total: ₹${totalAmount.toFixed(2)}`, 20, y + 10);

  doc.save("invoice.pdf");
}

// Auto-suggest items
document.getElementById("item").addEventListener("input", function () {
  const query = this.value;
  if (query.length < 2) return;

  fetch(`php/fetch-items.php?q=${query}`)
    .then(res => res.json())
    .then(items => {
      const list = document.getElementById("itemList");
      list.innerHTML = '';
      items.forEach(item => {
        const option = document.createElement("option");
        option.value = item;
        list.appendChild(option);
      });
    });
});
