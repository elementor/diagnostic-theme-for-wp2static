document.addEventListener("DOMContentLoaded", function() {
  var date_datapoints = [];
  var duration_datapoints = [];

  datafile_url = server_vars.wp_uploads_URL + '/exports_data.txt';

  var jqxhr = jQuery.get( datafile_url, function( data ) {
    var datapoint_lines = data.split( "\n" );

    jQuery.each(datapoint_lines, function(index, datapoint_line) {

      datapoint_set = datapoint_line.split( "," );

      date_datapoints.push( datapoint_set[0]);
      duration_datapoints.push( datapoint_set[1]);
    });
 
    console.log(date_datapoints);
    console.log(duration_datapoints);
 
  })
  .fail(function() {
    alert( "Couldn't load data file" );
  });

  var config = {
      type: 'line',
      data: {
          labels: date_datapoints,
          datasets: [{
              label: 'Seconds to generate static site',
              backgroundColor: window.chartColors.red,
              borderColor: window.chartColors.red,
              data: duration_datapoints,
              fill: false,
          }, 
        ]
      },
      options: {
          responsive: true,
          title: {
              display: true,
              text: 'Export durations with each build'
          },
          tooltips: {
              mode: 'index',
              intersect: false,
          },
          hover: {
              mode: 'nearest',
              intersect: true
          },
          scales: {
              xAxes: [{
                  display: true,
                  scaleLabel: {
                      display: true,
                      labelString: 'Date'
                  }
              }],
              yAxes: [{
                  ticks: {
                    reverse: true
                  },
                  display: true,
                  scaleLabel: {
                      display: true,
                      labelString: 'Export duration'
                  }
              }]
          }
      }
  };

  window.onload = function() {
      var ctx = document.getElementById('chart').getContext('2d');
      window.myLine = new Chart(ctx, config);
  };
 
});
