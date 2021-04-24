jQuery(document).ready(($) => {

  const monthNames = ["Janvier", "Février", "Mars", "Avril", "Mai", "Juin",
  "Juillet", "Août", "Septembre", "Octobre", "Novembre", "December"
  ];

  const ctx = $('#myChart');
  const d = new Date();
  const actualMonth = d.getMonth() + 1;
  const monthName = $('#js_month_name');
  const leftArrow = $('#left_arrow');
  const rightArrow = $('#right_arrow');
  monthName.text(monthNames[actualMonth - 1]);
  let selectedMonth = actualMonth;
  let creditAmount;
  let debitAmount;
  let graph

  const loadGraph = ($selectedMonth = null) => {
    $.ajax({
        url: "http://localhost/www/transaction/src/API/ajaxGraph.php",
        method:"POST",
        data: {selectedMonth:selectedMonth},
        success: (data) => {
            $('#homeDisplay').html(data);
            creditAmount = parseInt($('#credit_amount').html());
            debitAmount = parseInt($('#debit_amount').html());
              graph = new Chart(ctx, {
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
        }
    });
  }

  loadGraph();

  leftArrow.click(() => {
    selectedMonth -= 1;
    $('#js_month_name').text(monthNames[selectedMonth - 1]);
    //need to destroy the graph before generate a new one
    graph.destroy();
    loadGraph(selectedMonth);
  })
  
  rightArrow.click(() => {
    if(selectedMonth !== actualMonth){
      selectedMonth += 1;
      graph.destroy();
    loadGraph(selectedMonth);
    }
    $('#js_month_name').text(monthNames[selectedMonth - 1]);
  })

});