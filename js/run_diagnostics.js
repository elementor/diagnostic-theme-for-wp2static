document.addEventListener("DOMContentLoaded", function() {
  var date_datapoints = [];
  var duration_datapoints = [];

  datafile_url = '/exports_data.txt';

  var jqxhr = jQuery.get( datafile_url, function( data ) {
    var datapoint_lines = data.split( "\n" );

    jQuery.each(datapoint_lines, function(index, datapoint_line) {

      datapoint_set = datapoint_line.split( "," );

      date_datapoints.push( datapoint_set[0]);
      duration_datapoints.push( datapoint_set[1]);
    });

    // update table with the last export duration
    jQuery('#last_site_generation_duration').html('something');
 
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

  // JS functions for testing plugin output

  new_img_link = jQuery('#div-with-link-in-custom-attr')
    .attr('custom-attr-in-div');

  jQuery('#img-to-get-src-from-custom-attr')
    .attr('src', new_img_link);

 
});
