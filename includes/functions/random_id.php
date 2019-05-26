<?php
    /*
        Get large random number for setting different id's in database. 
    */

    function get_random_id() {
        return random_int(1, 999999999);
    }
?>