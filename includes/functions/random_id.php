<?php
    function get_random_id(){
        $result = 0;
        $result = random_int(1, 999999999);
        return $result;
    }
?>