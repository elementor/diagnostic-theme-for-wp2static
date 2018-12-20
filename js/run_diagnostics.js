const monthNames = ["JAN", "FEB", "MAR", "APR", "MAY", "JUN",
  "JUL", "AUG", "SEP", "OCT", "NOV", "DEC"
];

document.addEventListener("DOMContentLoaded", function() {
  var date_datapoints = [];
  var duration_datapoints = [];

  datafile_url = '/exports_data.txt?cb=' +
    Math.random().toString(36).replace(/[^a-z]+/g, '');

  var jqxhr = jQuery.get( datafile_url, function( data ) {
    var datapoint_lines = data.split( "\n" );

    jQuery.each(datapoint_lines, function(index, datapoint_line) {
      if ( datapoint_line ) {
        datapoint_set = datapoint_line.split( "," );

        var date = new Date( datapoint_set[0] * 1000);

        formatted_date = monthNames[date.getMonth()] + ' ' + date.getDate()

        date_datapoints.push( formatted_date );
        duration_datapoints.push( parseFloat( datapoint_set[1] ));
      }
    });

    if (duration_datapoints === undefined || duration_datapoints.length == 0) {
      jQuery('#last_site_generation_duration').html('No data available yet');
    } else {
      // update table with the last export duration
      jQuery('#last_site_generation_duration').html(
        duration_datapoints.slice(-1)[0] +
        ' seconds' 
      );
    }

    var ctx = document.getElementById('chart').getContext('2d');
    window.myLine = new Chart(ctx, config);
 
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

  // JS functions for testing plugin output

  new_img_link = jQuery('#div-with-link-in-custom-attr')
    .attr('custom-attr-in-div');

  jQuery('#img-to-get-src-from-custom-attr')
    .attr('src', new_img_link);

 
});
