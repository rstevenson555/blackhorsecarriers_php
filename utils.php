<script>
    function updateloc(city,displaycity,state,zip,manager,title,phone,manager2,title2,phone2,manager3,title3,phone3)
    { 
        //alert(city);
        //alert(displaycity);
        var xhr; 
        try {  xhr = new ActiveXObject('Msxml2.XMLHTTP');   }
        catch (e) 
        {
            try {   xhr = new ActiveXObject('Microsoft.XMLHTTP');    }
            catch (e2) 
            {
                try {  xhr = new XMLHttpRequest();     }
                catch (e3) {  xhr = false;   }
            }
        }

        xhr.onreadystatechange  = function()
        { 
            if(xhr.readyState  == 4)
            {
                //if(xhr.status  == 200) 
                //    document.ajax.dyn="Received:"  + xhr.responseText; 
                //else 
                //   document.ajax.dyn="Error code " + xhr.status;
            }
        }; 

        var updateloc = "updateloc.php?city="+escape(city)+"&displaycity="+escape(displaycity)+"&state="+escape(state)+"&zip="+escape(zip)
            +"&manager="+escape(manager)+"&title="+escape(title)+"&phone="+escape(phone)
            +"&manager2="+escape(manager2)+"&title2="+escape(title2)+"&phone2="+escape(phone2)
            +"&manager3="+escape(manager3)+"&title3="+escape(title3)+"&phone3="+escape(phone3);
        
        //alert(updateloc);
        xhr.open("GET", updateloc,  true); 
        xhr.send(); 
    } 
</script>
    
<?php
function writelocation($address,$city,$state,$zip,$manager,$title,$phone) {
    //echo "<h3 style=\"margin-top:0px; top: 0px;\">";
	//echo "$city";
    $displaycity = $city;
	writeCityLink($address,$displaycity,$city,$state,$zip);
	//echo "</h3>\n";
    echo "$address<br />\n";
    echo "$city, $state $zip<br /><br />\n";
    echo "<b>$title</b><br />\n";
    echo "&nbsp;&nbsp;$manager<br />\n";
    if ($phone) echo "&nbsp;&nbsp;$phone<br />\n";
    echo "<br />\n";
    
    echo "<script type=\"text/javascript\">\n";
    echo "    showAddress(\"$address, $city, $state $zip\");\n";
    echo "    updateloc(\"$city\",\"$displaycity\",\"$state\",\"$zip\",\"$manager\",\"$title\",\"$phone\",null,null,null,null,null,null);\n";
    echo "</script>\n";
    //function updateloc(city,displaycity,state,zip,manager,title,phone,manager2,title2,phone2,manager3,title3,phone3)
//
	//writeViewMapLink($address,$city,$state,$zip);
    /*echo "<b><a href=\"";
    echo $_SERVER['PHP_SELF'];
    $encodedaddress = urlencode($address);
    echo "?site=$encodedaddress,$city,$state+$zip&amp;locname=$city\">";
	echo "View Map";
	echo "</a></b>"; */
}
function writelocation_cityoverride($address,$displaycity,$city,$state,$zip,$manager,$title,$phone) {
    //echo "<h3 style=\"margin-top:0px; top: 0px;\">";
	//echo "$city";
	writeCityLink($address,$displaycity,$city,$state,$zip);
	//echo "</h3>\n";
    echo "$address<br />\n";
    echo "$city, $state $zip<br /><br />\n";
    echo "<b>$title</b><br />\n";
    echo "&nbsp;&nbsp;$manager<br />\n";
    if ($phone) echo "&nbsp;&nbsp;$phone<br />\n";
    echo "<br />\n";
    
    echo "<script type=\"text/javascript\">\n";
    echo "    showAddress(\"$address, $city, $state $zip, $displaycity\");\n";
    echo "    updateloc(\"$city\",\"$displaycity\",\"$state\",\"$zip\",\"$manager\",\"$title\",\"$phone\",null,null,null,null,null,null);\n";
    echo "</script>\n";

	//writeViewMapLink($address,$city,$state,$zip);
    /*echo "<b><a href=\"";
    echo $_SERVER['PHP_SELF'];
    $encodedaddress = urlencode($address);
    echo "?site=$encodedaddress,$city,$state+$zip&amp;locname=$city\">";
	echo "View Map";
	echo "</a></b>"; */
}
function writelocation2($address,$city,$state,$zip,$manager,$title,$phone,$manager2,$title2,$phone2) {
    //echo "<h3 style=\"margin-top:0px; top: 0px;\">";
	//echo "$city";
    $displaycity = $city;
	writeCityLink($address,$displaycity,$city,$state,$zip);
	//echo "</h3>\n";
    echo "$address<br />\n";
    echo "$city, $state $zip<br /><br />\n";
    echo "<b>$title</b><br />\n";
    echo "&nbsp;&nbsp;$manager<br />\n";
    if ($phone) echo "&nbsp;&nbsp;$phone<br />\n";
    if ($title) echo "<b>$title2</b><br />\n";
    if ($manager2) echo "&nbsp;&nbsp;$manager2<br />\n";
    if ($phone2) echo "&nbsp;&nbsp;$phone2<br />\n";
    echo "<br />";
    
        //function updateloc(city,displaycity,state,zip,manager,title,phone,manager2,title2,phone2,manager3,title3,phone3)

    echo "<script type=\"text/javascript\">\n";
    //echo "    showAddress(\"$address, $city, $state $zip, $displaycity\");\n";
    echo "    updateloc(\"$city\",\"$displaycity\",\"$state\",\"$zip\",\"$manager\",\"$title\",\"$phone\",\"$manager2\",\"$title2\",\"$phone2\",null,null,null);\n";
    echo "</script>\n";

	//writeViewMapLink($address,$city,$state,$zip);
    /*echo "<b><a href=\"";
    echo $_SERVER['PHP_SELF'];
    $encodedaddress = urlencode($address);
    echo "?site=$encodedaddress,$city,$state+$zip&amp;locname=$city\">";
	echo "View Map";
	echo "</a></b>"; */
}

function writelocation3($address,$city,$state,$zip,$manager,$title,$phone,$manager2,$title2,$phone2,$manager3,$title3,$phone3) {
    //echo "<h3 style=\"margin-top:0px; top: 0px;\">";
	//echo "$city";
    $displaycity = $city;
	writeCityLink($address,$displaycity,$city,$state,$zip);
	//echo "</h3>\n";
    echo "$address<br />\n";
    echo "$city, $state $zip<br /><br />\n";
    if ($title) echo "<b>$title</b><br />\n";
    if ($manager) echo "&nbsp;&nbsp;$manager<br />\n";
    if ($phone) echo "&nbsp;&nbsp;$phone<br />\n";
    if ($title2) echo "<b>$title2</b><br />\n";
    if ($manager2) echo "&nbsp;&nbsp;$manager2<br />\n";
    if ($phone2) echo "&nbsp;&nbsp;$phone2<br />\n";
    if ($title3) echo "<b>$title3</b><br />\n";
    if ($manager3) echo "&nbsp;&nbsp;$manager3<br />\n";
    if ($phone3) echo "&nbsp;&nbsp;$phone3<br />\n";
    echo "<br />";
    
    echo "<script type=\"text/javascript\">\n";
    //echo "    showAddress(\"$address, $city, $state $zip, $displaycity\");\n";
    echo "    updateloc(\"$city\",\"$displaycity\",\"$state\",\"$zip\",\"$manager\",\"$title\",\"$phone\",\"$manager2\",\"$title2\",\"$phone2\",\"$manager3\",\"$title3\",\"$phone3\");\n";
    echo "</script>\n";

	//writeViewMapLink($address,$city,$state,$zip);
}

function writeCityLink($address,$displaycity,$city,$state,$zip) {
    echo "<h1 style=\"margin-top:0px; top: 0px;\">";
    echo "<b><a class=\"city\" name=\"";
    echo "";
    echo $displaycity;
    echo "\" href=\"";
    echo $_SERVER['PHP_SELF'];
    $encodedaddress = urlencode($address);
    echo "?site=$encodedaddress,$city,$state+$zip&amp;locname=$displaycity\">";
	echo "$displaycity";
	echo "</a></b>";
	echo "</h1>\n";
}

function writeViewMapLink($address,$city,$state,$zip) {
    echo "<b><a href=\"";
    echo $_SERVER['PHP_SELF'];
    $encodedaddress = urlencode($address);
    echo "?site=$encodedaddress,$city,$state+$zip&amp;locname=$city\">";
	echo "View Map";
	echo "</a></b>";
}
?>