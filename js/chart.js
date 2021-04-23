const ctx = document.getElementById('myChart');

const monthNames = ["Janvier", "Février", "Mars", "Avril", "Mai", "Juin",
  "Juillet", "Août", "Septembre", "Octobre", "Novembre", "December"
];

const d = new Date();
document.getElementById('js_mont_name').innerHTML = monthNames[d.getMonth()];

const creditAmount = parseInt(document.getElementById('credit_amount').textContent);
const debitAmount = parseInt(document.getElementById('debit_amount').textContent);

const myChart = new Chart(ctx, {
    type: 'doughnut',
    data: {
          datasets: [{
            label: 'My First Dataset',
            data: [creditAmount, debitAmount],
            backgroundColor: [
              'rgb(111, 207, 151)',
              'rgb(245, 125, 144)'
            ],
            hoverOffset: 4
          }]
    }
});