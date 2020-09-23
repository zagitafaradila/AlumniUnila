$(document).ready(function(){

    {/* Model 1
      var ctx = document.getElementById('chart-jumlah_alumni');
      var myChart = new Chart(ctx, {
          type: 'horizontalBar',
          data: {
              labels: ['Fakultas Teknik', 'Fakultas Mipa', 'Fakultas TI', 'Fakultas Kedokteran', 'Fakultas Hukum', 'Fakultas Psikologi'],
              datasets: [
                  {
                  label: 'Sudah Mengisi',
                  data: [12, 19, 3, 5, 2, 3],
                  backgroundColor: 'rgba(54, 162, 235, 0.2)',
                  borderColor: 'rgba(54, 162, 235, 1)',
                  borderWidth: 1
              },
              {
                label: 'Total Alumni',
                data: [22, 29, 13, 15, 12, 13],
                backgroundColor: 'rgba(255, 159, 64, 0.2)',
                borderColor: 'rgba(255, 206, 86, 1)',
                borderWidth: 1
            },
            ]
          },
          options: {
              scales: {
                  yAxes: [{
                      ticks: {
                          beginAtZero: true
                      }
                  }]
              }
          }
      });  
    */  
        
    
    /* Model 2
      var ctx = document.getElementById("myChart").getContext("2d");

      var data = {
          labels: ["Chocolate", "Vanilla", "Strawberry"],
          datasets: [
              {
                  label: "Blue",
                  backgroundColor: "blue",
                  data: [3,7,4]
              },
              {
                  label: "Red",
                  backgroundColor: "red",
                  data: [4,3,5]
              },
              {
                  label: "Green",
                  backgroundColor: "green",
                  data: [7,2,6]
              }
          ]
      };
      
      var myBarChart = new Chart(ctx, {
          type: 'bar',
          data: data,
          options: {
              barValueSpacing: 20,
              scales: {
                  yAxes: [{
                      ticks: {
                          min: 0,
                      }
                  }]
              }
          }
      });
    */
    }

    {//Line Chart
        var salesChartCanvas = document.getElementById('revenue-chart-canvas').getContext('2d');
        //$('#revenue-chart').get(0).getContext('2d');
        var salesChartData = {
            labels  : label_jumlah_alumni,
            datasets: [
                {
                    label               : 'Jumlah Mengisi',
                    backgroundColor     : 'rgba(60,141,188,0.9)',
                    borderColor         : 'rgba(60,141,188,0.8)',
                    pointRadius          : true,
                    pointColor          : '#3b8bba',
                    pointStrokeColor    : 'rgba(60,141,188,1)',
                    pointHighlightFill  : '#fff',
                    pointHighlightStroke: 'rgba(60,141,188,1)',
                    data                : jumlah_alumni_mengisi
                },
                {
                    label               : 'Jumlah Alumni',
                    backgroundColor     : 'rgba(210, 214, 222, 1)',
                    borderColor         : 'rgba(210, 214, 222, 1)',
                    pointRadius         : false,
                    pointColor          : 'rgba(210, 214, 222, 1)',
                    pointStrokeColor    : '#c1c7d1',
                    pointHighlightFill  : '#fff',
                    pointHighlightStroke: 'rgba(220,220,220,1)',
                    data                : jumlah_alumni
                },
            ]
        }
                
        var salesChartOptions = {
            maintainAspectRatio : false,
            responsive : true,
            legend: {
                display: true
            },
            scales: {
            xAxes: [{
                gridLines : {
                    display : true,
                }
            }],
            yAxes: [{
                gridLines : {
                    display : false,
                }
            }]
            }
        }
                    
        // This will get the first returned node in the jQuery collection.
        var salesChart = new Chart(salesChartCanvas, { 
            type: 'horizontalBar', 
            data: salesChartData, 
            options: salesChartOptions
        })
    }
      

    {// Donut Chart
        var pieChartCanvas = $('#sales-chart-canvas').get(0).getContext('2d')
        var pieData        = {
            labels: [
                'Belum Mengisi', 
                'Sudah Mengisi',
                'Sedang Mengisi',
                'Belum Registrasi',
            ],
            datasets: [
            {
                data: [belum_mengisi,sudah_mengisi,sedang_mengisi,belum_registrasi],
                backgroundColor : ['#f56954', '#00a65a', '#f39c12','#000000'],
            }
            ]
        }
        var pieOptions = {
            legend: {
            display: true
            },
            maintainAspectRatio : false,
            responsive : true,
        }
        //Create pie or douhnut chart
        // You can switch between pie and douhnut using the method below.
        var pieChart = new Chart(pieChartCanvas, {
            type: 'doughnut',
            data: pieData,
            options: pieOptions      
        });
    }//end Donut Chart
});