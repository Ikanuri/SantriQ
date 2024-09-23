function getChartColorsArray(chartId) {
  if (document.getElementById(chartId) !== null) {
    var colors = document.getElementById(chartId).getAttribute("data-colors");
    colors = JSON.parse(colors);
    return colors.map(function (value) {
      var newValue = value.replace(" ", "");
      if (newValue.indexOf("--") != -1) {
        var color = getComputedStyle(document.documentElement).getPropertyValue(
          newValue
        );
        if (color) return color;
      } else {
        return newValue;
      }
    });
  }
}


//  Sales Statistics
fetch('/pelanggaranBulanan')
  .then(response => response.json())
  .then(data => {
    // push data to dataSet
    var barchartColors = getChartColorsArray("overview");
    var dataSet = [];
    for (let index = 0; index < 12; index++) {
      dataSet.push(data[index + 1]);
    }
    var options = {
      series: [{
        data: dataSet
      }],
      chart: {
        toolbar: {
          show: false,
        },
        height: 323,
        type: 'bar',
        events: {
          click: function (chart, w, e) {
          }
        }
      },

      plotOptions: {
        bar: {
          columnWidth: '80%',
          distributed: true,
          horizontal: false,
          borderRadius: 8,
        }
      },


      fill: {
        opacity: 1,
      },

      stroke: {
        show: false,
      },
      dataLabels: {
        enabled: false,
      },
      legend: {
        show: false
      },
      colors: barchartColors,
      xaxis: {
        categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
      }
    };
    var chart = new ApexCharts(document.querySelector("#overview"), options);
    chart.render();
  });
// Saleing Categories
fetch('/persentasePelanggaran')
  .then(response => response.json())
  .then(data => {
    var barchartColors = getChartColorsArray("saleing-categories");
    var options = {
      chart: {
        height: 335,
        type: 'donut',
      },
      series: [data[0], data[1]],
      labels: ["Melanggar", "Tidak Melanggar"],
      colors: barchartColors,
      plotOptions: {
        pie: {
          startAngle: 25,
          donut: {
            size: '70%',
            labels: {
              show: true,
              total: {
                show: true,
                label: 'Santri',
                fontSize: '20px',
                fontFamily: 'Montserrat,sans-serif',
                fontWeight: 600,
              }
            }
          }
        }
      },

      legend: {
        show: false,
        position: 'bottom',
        horizontalAlign: 'center',
        verticalAlign: 'middle',
        floating: false,
        fontSize: '9px',
        offsetX: 0,

      },

      dataLabels: {
        style: {
          fontSize: '9px',
          fontFamily: 'Montserrat,sans-serif',
          fontWeight: 'regular',
          colors: undefined
        },

        background: {
          enabled: true,
          foreColor: '#fff',
          padding: 4,
          borderRadius: 2,
          borderWidth: 1,
          borderColor: '#fff',
          opacity: 1,
        },
      },
      responsive: [{
        breakpoint: 600,
        options: {
          chart: {
            height: 240
          },
          legend: {
            show: false
          },
        }
      }]
    }
    var chart = new ApexCharts(
      document.querySelector("#saleing-categories"),
      options
    );
    chart.render();
  });
