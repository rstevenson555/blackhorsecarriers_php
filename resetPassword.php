<?php

//Checks if there is a login cookie

    // Connects to your Database
    mysql_connect("www.blackhorsecarriers.com", "bla120", "favss+ra") or die(mysql_error());
    mysql_select_db("bla120") or die(mysql_error());

    $check = mysql_query("update users set invalid = 1 " . " WHERE username = '$username'")
        or die(mysql_error());
    header("Location: showusers.php");
?>
