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
var barchartColors = getChartColorsArray("overview");
var options = {
  series: [{
    data: [4, 6, 10, 17, 15, 19, 23, 27, 29, 25, 32, 35]
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