<?php
    session_start();

    /**
     * Converts a date string from one format to another (e.g. d/m/Y => Y-m-d, d.m.Y => Y/d/m, ...)
     *
     * @param string $date_format1
     * @param string $date_format2
     * @param string $date_str
     * @return string
     **/
    function dates_interconv( $date_format1, $date_format2, $date_str )
    {
        $base_struc     = split('[/.-]', $date_format1);
        $date_str_parts = split('[/.-]', $date_str );
       
        //print_r( $base_struc ); echo "<br>";
        //print_r( $date_str_parts ); echo "<br>";
       
        $date_elements = array();
       
        $p_keys = array_keys( $base_struc );
        foreach ( $p_keys as $p_key )
        {
            if ( !empty( $date_str_parts[$p_key] ))
            {
                $date_elements[$base_struc[$p_key]] = $date_str_parts[$p_key];
            }
            else
                return false;
        }
       
        $dummy_ts = mktime( 0,0,0, $date_elements['m'],$date_elements['d'],$date_elements['Y']);
       
        return date( $date_format2, $dummy_ts );
    }
   
    //$df_src = 'd/m/Y';
    $df_src = 'm/d/Y';
    $df_des = 'Y-m-d';
   
    //$iso_date = dates_interconv( $df_src, $df_des, '25/12/2005');
    $ship = dates_interconv( $df_src, $df_des, $_POST['dateship']);
    $delivery = dates_interconv( $df_src, $df_des, $_POST['datedelivery']);
    $post = dates_interconv( $df_src, $df_des, $_POST['datepost']);

    //echo " " .$ship;
    //echo " " .$delivery;
    //echo " " .$post;
    
    $link = mysql_connect("www.blackhorsecarriers.com", "bla120", "favss+ra") or die( mysql_error());
    $db = mysql_select_db("bla120") or die(mysql_error());

    $results = mysql_query("SELECT max(load_number) as load_number from loaddetail" ) or die(mysql_error());

    if (!$results) {
        $message = 'Invalid query: ' . mysql_error() . "\n";
        $message .= 'Whole query: ' . $query;
        die($message);
    }

    $max_load = 0;

    if ($row = mysql_fetch_assoc($results)) {
        $max_load = ($row['load_number'] + 1);
    }

    $query = "INSERT INTO loaddetail (company, load_number, trailer_type, load_type, origin_city, origin_state, destination_city,destination_state,date_ship,date_delivery,date_post,created_by, description) VALUES ('$_POST[companyname]', '$max_load', '$_POST[trailertype]', '$_POST[loadtype]', '$_POST[origincity]', '$_POST[originstate]','$_POST[destinationcity]', '$_POST[destinationstate]','$ship', '$delivery','$post','$_SESSION[username]','$_POST[comments]')";

    //echo " " . $query;

    $result = mysql_query($query, $link) or die(mysql_error());
  
    mysql_free_result($result);
    
    header( 'Location: displayloads.php' ) ;
    
?>
