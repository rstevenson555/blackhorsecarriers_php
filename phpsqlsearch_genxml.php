<?php

require("phpsqlsearch_dbinfo.php");

// Get parameters from URL
$center_lat = $_GET["lat"];
$center_lng = $_GET["lng"];
$radius = $_GET["radius"];
$initial = $_GET["initial"];

// Start XML file, create parent node
$dom = new DOMDocument("1.0");
$node = $dom->createElement("markers");
$parnode = $dom->appendChild($node);

// Opens a connection to a mySQL server
$connection = mysql_connect("www.blackhorsecarriers.com", $username, $password);
if (!$connection) {
    die("Not connected : " . mysql_error());
}

// Set the active mySQL database
$db_selected = mysql_select_db($database, $connection);
if (!$db_selected) {
    die("Can\'t use db : " . mysql_error());
}

// Search the rows in the markers table
if ($initial == "false") {
    $query = sprintf("SELECT address, name, lat, lng, manager, displaycity, title, phone, manager2,
    title2, phone2, manager3, title3, phone3, ( 3959 * acos( cos( radians('%s') ) * cos( radians( lat ) ) * cos( radians( lng ) - radians('%s') ) + sin( radians('%s') ) * sin( radians( lat ) ) ) ) AS distance FROM markers HAVING distance < '%s' ORDER BY distance LIMIT 0 , 120", mysql_real_escape_string($center_lat), mysql_real_escape_string($center_lng), mysql_real_escape_string($center_lat), mysql_real_escape_string($radius));
} else {
    $query = sprintf("SELECT address, name, lat, lng, manager, displaycity, title, phone, manager2,
    title2, phone2, manager3, title3, phone3, ( 3959 * acos( cos( radians('%s') ) * cos( radians( lat ) ) * cos( radians( lng ) - radians('%s') ) + sin( radians('%s') ) * sin( radians( lat ) ) ) ) AS distance FROM markers HAVING distance < '%s' ORDER BY STATE,CITY LIMIT 0 , 120", mysql_real_escape_string($center_lat), mysql_real_escape_string($center_lng), mysql_real_escape_string($center_lat), mysql_real_escape_string($radius));
}

$result = mysql_query($query);

if (!$result) {
    die("Invalid query: " . mysql_error());
}

//header("Content-type: text/xml");
header("Content-type: application/json");

//var $arry;
// Iterate through the rows, adding XML nodes for each
$r =array();

while ($row = @mysql_fetch_assoc($result)) {
    
//    $arry['name'] = $row['name'];
//    $arry['address'] = $row['address'];
//    $arry['lat'] = $row['lat'];
//    $arry['lng'] = $row['lng'];
//    $arry['distance'] = $row['distance'];
//    $arry['displaycity'] = $row['displaycity'];
//    $arry['manager'] = $row['manager'];
//    $arry['title'] = $row['title'];
//    $arry['phone'] = $row['phone'];
//    $arry['manager2'] = $row['manager2'];
//    $arry['title2'] = $row['title2'];
//    $arry['phone2'] = $row['phone2'];
//    $arry['manager3'] = $row['manager3'];
//    $arry['title3'] = $row['title3'];
//    $arry['phone3'] = $row['phone3'];
    
    $r[] = $row;

//    $node = $dom->createElement("marker");
//    $newnode = $parnode->appendChild($node);
//    $newnode->setAttribute("name", htmlentities($row['name']));
//    $newnode->setAttribute("address", htmlentities($row['address']));
//    $newnode->setAttribute("lat", htmlentities($row['lat']));
//    $newnode->setAttribute("lng", htmlentities($row['lng']));
//    $newnode->setAttribute("distance", htmlentities($row['distance']));
//    $newnode->setAttribute("displaycity", htmlentities($row['displaycity']));
//    $newnode->setAttribute("manager", htmlentities($row['manager']));
//    $newnode->setAttribute("title", htmlentities($row['title']));
//    $newnode->setAttribute("phone", htmlentities($row['phone']));
//    $newnode->setAttribute("manager2", htmlentities($row['manager2']));
//    $newnode->setAttribute("title2", htmlentities($row['title2']));
//    $newnode->setAttribute("phone2", htmlentities($row['phone2']));
//    $newnode->setAttribute("manager3", htmlentities($row['manager3']));
//    $newnode->setAttribute("title3", htmlentities($row['title3']));
//    $newnode->setAttribute("phone3", htmlentities($row['phone3']));
}

//echo $dom->saveXML();
$json_string = json_encode($r);
//var_dump($json_string);
echo $json_string;
?>

