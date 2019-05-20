<script>
    $('.heart-icon').on({
    'click': function(){

        if ( $(this).attr('src') == '../img/icons/heart_white.png' ) {
            $(this).attr('src','../img/icons/heart_orange.png');
        } else {
            $(this).attr('src','../img/icons/heart_white.png');
        }        
    }
});
</script>
