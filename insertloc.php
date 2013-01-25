<?php
require("phpsqlsearch_dbinfo.php");

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 * 
 * 
 */

// Connects to your Database
$conn = mysql_connect("www.blackhorsecarriers.com", $username, $password) or die(mysql_error());
mysql_select_db($database) or die(mysql_error());
//    $results = mysql_query("SELECT * from markers") or die(mysql_error());
//    if (!$results) {
//        $message = 'Invalid query: ' . mysql_error() . "\n";
//        $message .= 'Whole query: ' . $query;
//        die($message);
//        }
//echo $_GET['city'];
//$results = mysql_query("SELECT name from markers where name='$_GET[city]'", $conn) or die(mysql_error());
//echo $results;
//if (!$results) {
$city = substr($_GET[city], 0, strrpos($_GET[city], " "));

$query = "INSERT INTO markers ( name, address,lat,lng) VALUES ('$city', '$_GET[address]', '$_GET[lat]', '$_GET[lng]')";

//echo " " . $query;
//$result = mysql_query($query, $conn) or die(mysql_error());
//mysql_free_result($results);
//}
?>
