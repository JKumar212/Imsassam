document.addEventListener("DOMContentLoaded", () => {
  const filter = document.getElementById("dateRange");
  const totalSales = document.getElementById("totalSales");
  const totalExpenses = document.getElementById("totalExpenses");
  const itemsSold = document.getElementById("itemsSold");
  const invoiceCount = document.getElementById("invoiceCount");

  let chartInstance;

  function fetchAnalytics(days = 7) {
    fetch(`php/fetch-analytics.php?days=${days}`)
      .then(res => res.json())
      .then(data => {
        totalSales.textContent = data.total_sales.toFixed(2);
        totalExpenses.textContent = data.expenses.toFixed(2);
        itemsSold.textContent = data.items_sold || 0;
        invoiceCount.textContent = data.invoice_count || 0;

        const labels = Object.keys(data.daily_sales);
        const values = Object.values(data.daily_sales);

        if (chartInstance) chartInstance.destroy();
        chartInstance = new Chart(document.getElementById("salesChart"), {
          type: 'bar',
          data: {
            labels: labels,
            datasets: [{
              label: 'Sales (₹)',
              data: values,
              backgroundColor: '#2ecc71'
            }]
          },
          options: {
            responsive: true,
            scales: {
              y: {
                beginAtZero: true
              }
            }
          }
        });
      });
  }

  filter.addEventListener("change", () => {
    fetchAnalytics(filter.value);
  });

  fetchAnalytics(filter.value);
});
