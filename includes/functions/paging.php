<?php
     
    // number of entries per page
    $page_entries = 50;

    // decides, which character should be used for GET
    $paging_combination_character = (empty($_GET) or (count($_GET) == 1 and isset($_GET['page']))) ? "?" : "&";

    // deletes every "page=x" in URL
    $paging_url = preg_replace("/[\?|\&]page.*/", "", $_SERVER['REQUEST_URI']);

    // sets default values
    $page_current = 1;
    $page_next = 2;
    $page_back = 0;
    $is_first_page = false;
    $is_last_page = false;

    // sets how many pages exist
    if(getResultsCount($sql_select) % $page_entries == 0){
        $page_count = getResultsCount($sql_select) / $page_entries;
    }else{
        $page_count = (floor((getResultsCount($sql_select) / $page_entries))) + 1;
    }


    // sets new page-values
    if(isset($_GET['page']))
    {
        $page_current = $_GET['page'];
        $page_next = $_GET['page'] + 1;
        $page_back = $_GET['page'] - 1;
    }
    
    // sets how many entries need to be skipped
    $skip = $page_back * $page_entries;

    if($page_current == 1)
    {
        $is_first_page = true;
    }

    if($page_current == $page_count)
    {
        $is_last_page = true;
    }

    $sql_select_with_paging = $sql_select.' LIMIT '.$skip.','.$page_entries;

?>