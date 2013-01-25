<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<!--
 Copyright 2008 Google Inc. 
 Licensed under the Apache License, Version 2.0: 
 http://www.apache.org/licenses/LICENSE-2.0 
-->
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="content-type" content="text/html; charset=utf-8"/>
        <title>Black Horse Carriers Inc. Find Nearest Terminal</title>
        <script src="http://maps.google.com/maps?file=api&v=2&key=ABQIAAAAKggr7uyFbg3O4gGq2b4JcRQ0oCdIp8IB0nK4dFV3_VqDQXwB4hTy2YZxMdGXBqx6NbsM4IIKpBRe2Q"
        type="text/javascript"></script>

        <?php include "script_head.php" ?>

        <link type="text/css" rel="stylesheet" href="css/style-mock2.css" />
        <link type="text/css" rel="stylesheet" href="css/highline_nav.css" />
        <link type="text/css" rel="stylesheet" href="css/nav.css" />

        <meta content="Robert Stevenson" name="author" />

        <script type="text/javascript">
            //<![CDATA[
            var map;
            var geocoder;

            function load() {
                if (GBrowserIsCompatible()) {
                    geocoder = new GClientGeocoder();
                    map = new GMap2(document.getElementById('map'));
                    map.addControl(new GSmallMapControl());
                    map.addControl(new GMapTypeControl());
                    map.setCenter(new GLatLng(40, -100), 4);
                }
            }

            /*function searchLocations() {
                var address = document.getElementById('addressInput').value;
                geocoder.getLatLng(address, function(latlng) {
                    if (!latlng) {
                        alert(address + ' not found');
                    } else {
                        searchLocationsNear(latlng,0);
                    }
                });
            }*/
            
            function searchLocations(radius,initial) {
                //alert("radius "+radius);
                var address = document.getElementById('addressInput').value;
                geocoder.getLatLng(address, function(latlng) {
                    if (!latlng) {
                        alert(address + ' not found');
                    } else {
                        searchLocationsNear(latlng,radius,initial);
                    }
                });
            }

            function searchLocationsNear(center,lradius,initial) {
                var radius = (lradius==0) ? document.getElementById('radiusSelect').value : lradius;
                var searchUrl = 'phpsqlsearch_genxml.php?lat=' + center.lat() + '&lng=' + center.lng() + '&radius=' + radius + '&initial=' + initial;
                $.getJSON(searchUrl, function(json) {	   
                    map.clearOverlays();

                    var sidebar = document.getElementById('sidebar');
                    sidebar.innerHTML = '';
                    //if (markers.length == 0) {
                    if (json == null) {
                        sidebar.innerHTML = 'No results found.';
                        map.setCenter(new GLatLng(40, -100), 4);
                        return;
                    }

                    var bounds = new GLatLngBounds();
                    $.each(json, function(key,message) {
                        //var message = this;
                        var name = message['name'];
                        //alert(name);
                        //alert(name);
                        var citystate_header = message['displaycity'];
                        var address = message['address'];
                        var distance = message['distance'];
                        var point = new GLatLng(parseFloat(message['lat']),parseFloat(message['lng']));
                        
                        var manager = "<br/><b>" + message['title'] + '</b>, ' + message['manager'];
                        manager += (message['phone']!='') ? "<br/>" + message['phone'] : '';
                              
                        if ( message['title2']!='') {
                            var manager2 = "<br/><b>" + message['title2'] + '</b>, ' + message['manager2'] +
                                "" + ((message['phone2']!='') ? ',<br/>' + message['phone2'] : '');
                            manager += manager2;
                        }
                        
                        if ( message['title3']!='') {
                            var manager3 = "<br/><b>" + message['title3'] + '</b>, ' + message['manager3'] +
                                '<br/> ' + message['phone3'];
                            manager += manager3;
                        }       
         
                        var marker = createMarker(point, name, address);
                        map.addOverlay(marker);
                        
                        var originalAddress = address;
                        address = address.substring(0, address.indexOf(","));
                        var citystatezip = originalAddress.substring(originalAddress.indexOf(",")+1);
                        //citystatezip += "blah";
                        var sidebarEntry = createSidebarEntry(marker, name, address, citystatezip, distance, manager, manager2);
//                        
                        sidebar.appendChild(sidebarEntry);
                        bounds.extend(point);
                    });
                    map.setCenter(bounds.getCenter(), map.getBoundsZoomLevel(bounds));
                });
            }

            function buildMapLink()
            {
                return "<a style=\"color:#126C52;font-style:italic;font-size:8pt;\" target=\"_blank\" href=\"http://maps.google.com/maps?saddr="+ document.getElementById("addressInput").value;

            }
            function createMarker(point, name, address) {
                var marker = new GMarker(point);
                
                var street = name.substring(0,name.indexOf(','));
                var citystatezip = name.substring(name.indexOf(','), name.length);
                
                // marker text
                var html = '<b>' + name + '</b> <br/>' + address.substring(0,address.indexOf(","));
                //var html = '<b>' + name + '</b> <br/>' + street + "<br/>" + citystatezip;

                html += "<br/>";
        
                html += buildMapLink();
                html += "&daddr=" + address;
                
                html += "\">Get Directions</a>";
                GEvent.addListener(marker, 'click', function() {
                    marker.openInfoWindowHtml(html);
                });
                return marker;
            }

            function createSidebarEntry(marker, name, streetaddress, citystate, distance, manager, manager2) {
                var div = document.createElement('div');
                //var html = '<b>' + name + '</b> (' + distance.toFixed(1) + ')<br/>' + streetaddress + ",<br/>" + citystate;
                var html = '<h2>' + name + '</h2><br/>' + streetaddress + ",<br/>" + citystate;
                html += manager;
                html += "<br/><a target=\"_blank\" href=\"http://maps.google.com/maps?saddr="+ document.getElementById("addressInput").value;
                html += "&daddr=" + streetaddress + "," + citystate;
                html += "\">Get Directions</a><br/>&nbsp;";
                div.innerHTML = html;
                div.style.cursor = 'pointer';
                div.style.marginBottom = '5px'; 
                GEvent.addDomListener(div, 'click', function() {
                    GEvent.trigger(marker, 'click');
                });
                GEvent.addDomListener(div, 'mouseover', function() {
                    //div.style.backgroundColor = '#eee';
                    div.style.backgroundColor = '#8F8F58';
                });
                GEvent.addDomListener(div, 'mouseout', function() {
                    //div.style.backgroundColor = '#fff';
                    div.style.backgroundColor = '#B3B38E';
                });
                return div;
            }
            
            // polling for Enter or Return keys (id =13)//
            function submitenter(e)
            {
                var keycode;
                if (window.event) keycode = window.event.keyCode;
                else if (e) keycode = e.which;
                else return true;

                if (keycode == 13)
                {
                    //document.searchform.submit();
                    searchLocations(0,false)
                    return false;
                }
                else
                    return true;
            }
            //]]>
        </script>
    </head>

    <?php include 'utils.php' ?>
    <?php include 'locations.php' ?>

    <body id="normalbody" onload="load();
        document.getElementById('addressInput').value='Carol Stream, Il';
        searchLocations(12000,true);
        document.getElementById('addressInput').value='';
        document.getElementById('addressInput').focus();" 
          onunload="GUnload()">

        <div id="page_wrapper">
            <div id="main">
                <?php include 'navigation.php' ?>
                <div class="bodyText">
                    <!--<table style="width: 700px;">
                        <tbody>-->
                    <div class="addressHeader">
                        Starting Address: <input type="text" id="addressInput" onkeypress="return submitenter(event)"/>

                        Radius: <select onchange="searchLocations(0,false)" id="radiusSelect">
                            <option value="25" >25</option>
                            <option value="50" >50</option>
                            <option value="75" >75</option>
                            <option value="100" selected>100</option>
                            <option value="200">200</option>
                            <option value="300">300</option>

                        </select>
                        <input type="button" onclick="searchLocations(0,false)" value="Search Locations"/>
                        <input type="button" onclick="load();document.getElementById('addressInput').value='Carol Stream, Il';searchLocations(12000,true);document.getElementById('addressInput').value='';document.getElementById('addressInput').focus();" value="Reset"/>
                        <br/>    
                        <span style="font-size:8pt;">(Enter City State; State; or Zipcode)</span>
                        <br/>
                    </div>
                    <div style="width:100%;height:100%; font-family:Arial, sans-serif; font-size:11px; border:1px solid black">

                        <div style="height:100%">
                            <div id="sidebar" style="float:left; overflow-y:scroll;-webkit-overflow-scrolling:touch;height: 480px; font-size: 11px; color: #000"></div>
                            <div id="map" style=" overflow-y:scroll; width:600px; height:500px;"></div> 
                        </div>
                    </div>
                    <!-- </tbody>-->
                    <!-- </table>-->
                </div>
            </div>
        </div>

    </body>
</html>
