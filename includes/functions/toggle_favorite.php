<script>
    function toggleFavorite(){

        var heart_icon = document.getElementByClassName("heart-icon")[0];
        var heart_icon_source = document.getElementByClassName("heart-icon").getAttribute("src");

        if(heart_icon_source == "../img/icons/heart_white.png"){
            heart_icon.setAttribute('src', '../img/icons/heart_orange.png');
        }else{
            heart_icon.setAttribute('src', '../img/icons/heart_white.png');
        }
    }
</script>