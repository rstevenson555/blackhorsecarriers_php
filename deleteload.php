<?php
    session_start();
    
    $link = mysql_connect("www.blackhorsecarriers.com", "bla120", "favss+ra") or die( mysql_error());
    $db = mysql_select_db("bla120") or die(mysql_error());

    //$query = "update loaddetail set company='$_POST[companyname]',load_status=2,trailer_type='$_POST[trailertype]',load_type='$_POST[loadtype]',origin_city='$_POST[origincity]',origin_state='$_POST[originstate]',destination_city='$_POST[destinationcity]',destination_state='$_POST[destinationstate]',date_ship='$ship',date_delivery='$delivery',date_post='$post',accepted_by='$_SESSION[username]' where load_number='$_POST[loadnumber]'";

    $query = "delete from loaddetail where load_number='$_GET[loadnumber]'";

    $result = mysql_query($query, $link) or die(mysql_error());
   
    header( 'Location: displayloads.php' ) ;
    
?>
