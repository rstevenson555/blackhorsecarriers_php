<?php
    session_start();

    $link = mysql_connect("www.blackhorsecarriers.com", "bla120", "favss+ra") or die( mysql_error());
    $db = mysql_select_db("bla120") or die(mysql_error());

    $query = "INSERT INTO terminals (terminal,manager,city,state,zip,phone) VALUES ('$_POST[terminalname]', '$_POST[manager]', '$_POST[city]', '$_POST[state]', '$_POST[zip]','$_POST[phone]')";


    //echo " " . $query;

    $result = mysql_query($query, $link) or die(mysql_error());
  
    mysql_free_result($result);
    
    header( 'Location: addloads.php' ) ;
    
?>
