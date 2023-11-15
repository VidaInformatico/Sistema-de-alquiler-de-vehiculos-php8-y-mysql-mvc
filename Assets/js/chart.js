$(function () {
  /* ChartJS
   * -------
   * Data and config for chartjs
   */
  'use strict';
  // Get context with jQuery - using jQuery's .get() method.
  if ($("#barChart").length) {
    var barChartCanvas = $("#barChart").get(0).getContext("2d");

    const url = base_url + 'dashboard/rentas';
    const http = new XMLHttpRequest();
    http.open("GET", url, true);
    http.send();
    http.onreadystatechange = function () {
      if (this.readyState == 4 && this.status == 200) {
        const res = JSON.parse(this.responseText);
        var barChart = new Chart(barChartCanvas, {
          type: 'bar',
          data: {
            labels: ['Ene', 'Feb', 'Mar', 'Abr', 'May', 'Jun', 'Jul', 'Ago', 'Sep', 'Oct', 'Nov', 'Dic'],
            datasets: [{
              label: 'Total',
              data: [res.renta.ene, res.renta.feb, res.renta.mar,
              res.renta.abr, res.renta.may, res.renta.jun,
              res.renta.jul, res.renta.ago, res.renta.sep,
              res.renta.oct, res.renta.nov, res.renta.dic],
              backgroundColor: [
                'rgba(255, 99, 132, 0.2)',
                'rgba(54, 162, 235, 0.2)',
                'rgba(255, 206, 86, 0.2)',
                'rgba(75, 192, 192, 0.2)',
                'rgba(153, 102, 255, 0.2)',
                'rgba(255, 159, 64, 0.2)',
                'rgba(255, 99, 132, 0.2)',
                'rgba(54, 162, 235, 0.2)',
                'rgba(255, 206, 86, 0.2)',
                'rgba(75, 192, 192, 0.2)',
                'rgba(153, 102, 255, 0.2)',
                'rgba(255, 159, 64, 0.2)'
              ],
              borderColor: [
                'rgba(255,99,132,1)',
                'rgba(54, 162, 235, 1)',
                'rgba(255, 206, 86, 1)',
                'rgba(75, 192, 192, 1)',
                'rgba(153, 102, 255, 1)',
                'rgba(255, 159, 64, 1)',
                'rgba(255,99,132,1)',
                'rgba(54, 162, 235, 1)',
                'rgba(255, 206, 86, 1)',
                'rgba(75, 192, 192, 1)',
                'rgba(153, 102, 255, 1)',
                'rgba(255, 159, 64, 1)'
              ],
              borderWidth: 1,
              fill: false
            }]
          },
          options: {
            scales: {
              yAxes: [{
                ticks: {
                  beginAtZero: true
                }
              }]
            },
            legend: {
              display: false
            },
            elements: {
              point: {
                radius: 0
              }
            }

          }
        });
      }
    }

  }

  if ($("#pieChart").length) {   

    const httppie = new XMLHttpRequest();
    const url = base_url + 'dashboard/rentasSemana';
        httppie.open('GET', url, true);

        httppie.onreadystatechange = function () {
            if (this.readyState === 4 && this.status === 200) {
                // Procesar la respuesta JSON
                const data = JSON.parse(this.responseText);
                console.log(data);
                renderChart(data);
            }
        };

        httppie.send();
    
  }

  // Función para renderizar el gráfico
  function renderChart(data) {
    var pieChartCanvas = $("#pieChart").get(0).getContext("2d");
      var labels = data.map(entry => entry.fecha);
      var totals = data.map(entry => entry.total);

      var pieChart = new Chart(pieChartCanvas, {
        type: 'pie',
        data: {
          datasets: [{
            data: totals,
            backgroundColor: [
              'rgba(255, 99, 132, 0.5)',
              'rgba(54, 162, 235, 0.5)',
              'rgba(255, 206, 86, 0.5)',
              'rgba(75, 192, 192, 0.5)',
              'rgba(153, 102, 255, 0.5)',
              'rgba(255, 159, 64, 0.5)'
            ],
            borderColor: [
              'rgba(255,99,132,1)',
              'rgba(54, 162, 235, 1)',
              'rgba(255, 206, 86, 1)',
              'rgba(75, 192, 192, 1)',
              'rgba(153, 102, 255, 1)',
              'rgba(255, 159, 64, 1)'
            ],
          }],
      
          // These labels appear in the legend and in the tooltips when hovering different arcs
          labels: labels
        },
        options: {
          responsive: true,
          animation: {
            animateScale: true,
            animateRotate: true
          }
        }
      });
  }
});