<script>
  $( function() {
    $( "#dialog" ).dialog({
        position: { my: "left top", at: "left top", of: window },
        resizable: false,
        draggable: false,
        width: 250,
        height: 35,
        show: { effect: "slideDown", duration: 1000 },
        hide: { effect: "slideUp", duration: 1000 },
        open: function() {
            var foo = $(this);
            setTimeout(function() {
               foo.dialog('close');
            }, 3000);
        }
    });
  } );
</script>