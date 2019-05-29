<script>
  $( function() {
    $( "#slider-range" ).slider({
      range: true,
      min: 0,
      max: 4000,
      values: [ 700, 3300],
      slide: function( event, ui ) {
        $( "#amount" ).val( ui.values[ 0 ] + " €   -   " + ui.values[ 1 ] + " €");
        $("#price_min").val(ui.values[ 0 ]);
        $("#price_max").val(ui.values[ 1 ]);
      }
    });
    $( "#amount" ).val( $( "#slider-range" ).slider( "values", 0 ) + " €" + 
      "   -   " + $( "#slider-range" ).slider( "values", 1 ) + " €" );
  } );
  </script>