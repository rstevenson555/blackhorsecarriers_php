<?php
require("phpsqlsearch_dbinfo.php");

function quoted($str)
{
    if (is_null($str) || $str == "null") 
        return "NULL";
    return "'" . $str . "'";
}
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 * 
 * 
 */

// Connects to your Database
$conn = mysql_connect("www.blackhorsecarriers.com", $username, $password) or die(mysql_error());
mysql_select_db($database) or die(mysql_error());

/*
 *  xhr.open("GET", "updateloc.php?city="+escape(city)+"&displaycity="+escape(displaycity)+"&state="+escape(state)+"&zip="+escape(zip)
            +"&manager="+escape(manager)+"&title="+escape(title)+"&phone="+escape(phone)
            +"&manager2="+escape(manager2)+"&title2="+escape(title2)+"&phone2="+escape(phone2)
            +"&manager3="+escape(manager3)+"&title3="+escape(title3)+"&phone3="+escape(phone3),  true); 
        xhr.send(); 
 */
$name = $_GET["city"];


$city = substr($_GET["city"], 0, strrpos($_GET["city"], " "));
$city = $_GET["city"];

$displaycity=$_GET["displaycity"];

$state = $_GET["state"];
$zip = $_GET["zip"];
$manager = $_GET["manager"];
$title = $_GET["title"];
$phone= $_GET["phone"];
$manager2 = $_GET["manager2"];
$phone2 = $_GET["phone2"];
$title2 = $_GET["title2"];
$manager3 = $_GET["manager3"];
$title3 = $_GET["title3"];
$phone3 = $_GET["phone3"];

//echo $name;
//echo $state;
$nm = $name . "," . $state;

$query = "update markers set CITY='$city',displaycity='$displaycity',STATE='$state',ZIP='$zip'";
$query .= ",manager=" . quoted($manager) .",title=" . quoted($title) . ",phone=" .quoted($phone);
$query .= ",manager2=".quoted($manager2).",title2=".quoted($title2).",phone2=".quoted($phone2);
$query .= ",manager3=".quoted($manager3).",title3=".quoted($title3).",phone3=".quoted($phone3) ." where name=".quoted($nm);

//echo $query;
//echo $_GET["city"];

echo " " . $query;
$results = mysql_query($query, $conn) or die(mysql_error());
mysql_free_result($results);
?>
