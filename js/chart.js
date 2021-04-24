jQuery(document).ready(($) => {

  const monthNames = ["Janvier", "Février", "Mars", "Avril", "Mai", "Juin",
  "Juillet", "Août", "Septembre", "Octobre", "Novembre", "December"
  ];

  const ctx = $('#myChart');
  const d = new Date();
  const actualMonth = d.getMonth() + 1;
  const actualYear = d.getFullYear();
  const monthName = $('#js_month_name');
  monthName.text(monthNames[actualMonth - 1] + " " + actualYear);
  let selectedMonth = actualMonth;
  let selectedYear = actualYear;
  let creditAmount;
  let debitAmount;
  let graph

  const loadGraph = (selectedMonth, selectedYear) => {
    $.ajax({
        url: "http://localhost/www/transaction/src/API/ajaxGraph.php",
        method:"POST",
        data: {selectedMonth:selectedMonth, selectedYear:selectedYear},
        success: (data) => {
            $('#js_amount_display').html(data);
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

  loadGraph(actualMonth, actualYear);
  $('#right_arrow').css("visibility", "hidden");

  $('#left_arrow').click(() => {
    selectedMonth -= 1;
    if(selectedMonth === 0){
      selectedMonth = 12; 
      selectedYear -= 1;
    }
    console.log(selectedYear);
    //need to destroy the graph before generate a new one inside the success callback in the AJAX
    graph.destroy();
    if($('#right_arrow').css("visibility") === "hidden" && selectedMonth !== actualMonth) $('#right_arrow').css("visibility", "visible");
    loadGraph(selectedMonth, selectedYear);
    $('#js_month_name').text(monthNames[selectedMonth - 1] + " " + selectedYear);
  })
  
  $('#right_arrow').click(() => {
    selectedMonth += 1;
    graph.destroy();
    if(selectedMonth === 13){
      selectedMonth = 1;
      selectedYear += 1;
    }
    if(selectedMonth === actualMonth) $('#right_arrow').css("visibility", "hidden");
    loadGraph(selectedMonth, selectedYear);
    $('#js_month_name').text(monthNames[selectedMonth - 1] + " " + selectedYear);
  })

});