<script type="text/javascript">
    var geocoder = new GClientGeocoder();
    var map = null;
    var marker = null;
    var infoTabs = null;
    
    function searchLocations() {
        var address = document.getElementById('addressInput').value;
        geocoder.getLatLng(address, function(latlng) {
            if (!latlng) {
                alert(address + ' not found');
            } else {
                searchLocationsNear(latlng);
            }
        });
    }

    function searchLocationsNear(center) {
        var radius = document.getElementById('radiusSelect').value;
        var searchUrl = 'phpsqlsearch_genxml.php?lat=' + center.lat() + '&lng=' + center.lng() + '&radius=' + radius;
        GDownloadUrl(searchUrl, function(data) {
            var xml = GXml.parse(data);
            var markers = xml.documentElement.getElementsByTagName('marker');
            map.clearOverlays();

            var sidebar = document.getElementById('sidebar');
            sidebar.innerHTML = '';
            if (markers.length == 0) {
                sidebar.innerHTML = 'No results found.';
                map.setCenter(new GLatLng(40, -100), 4);
                return;
            }

            var bounds = new GLatLngBounds();
            for (var i = 0; i < markers.length; i++) {
                var name = markers[i].getAttribute('name');
                var address = markers[i].getAttribute('address');
                var distance = parseFloat(markers[i].getAttribute('distance'));
                var point = new GLatLng(parseFloat(markers[i].getAttribute('lat')),
                parseFloat(markers[i].getAttribute('lng')));

                var marker = createMarker(point, name, address);
                map.addOverlay(marker);
                var sidebarEntry = createSidebarEntry(marker, name, address, distance);
                sidebar.appendChild(sidebarEntry);
                bounds.extend(point);
            }
            map.setCenter(bounds.getCenter(), map.getBoundsZoomLevel(bounds));
        });
    }

    function createMarker(point, name, address) {
        var marker = new GMarker(point);
        var html = '<b>' + name + '</b> <br/>' + address;
        GEvent.addListener(marker, 'click', function() {
            marker.openInfoWindowHtml(html);
        });
        return marker;
    }

    function createSidebarEntry(marker, name, address, distance) {
        var div = document.createElement('div');
        var html = '' + name + ' (' + distance.toFixed(1) + ')      ' + address;
        div.innerHTML = html;
        div.style.cursor = 'pointer';
        div.style.marginBottom = '5px';
        GEvent.addDomListener(div, 'click', function() {
            GEvent.trigger(marker, 'click');
        });
        GEvent.addDomListener(div, 'mouseover', function() {
            div.style.backgroundColor = '#eee';
        });
        GEvent.addDomListener(div, 'mouseout', function() {
            div.style.backgroundColor = '#fff';
        });
        return div;
    }
    function load() {
        if (GBrowserIsCompatible()) {
            map = new GMap2(document.getElementById("map"));
            //map.setCenter(new GLatLng(37.4419, -122.1419), 13);
            map.addControl(new GMapTypeControl());
            map.addControl(new GScaleControl());
            map.addControl(new GLargeMapControl());
            //map.setCenter(new GLatLng(41.913672,-88.119935), 13);
            var modaddress = address;
            modaddress = address.substring(0,address.indexOf(",")+1);
            modaddress = modaddress + "<br/>";
            city = address.substring(address.indexOf(",")+1,address.length);

            modaddress = modaddress + address.substring(address.indexOf(",")+1,address.length);
            // Our info window content
            infoTabs = [
                new GInfoWindowTab(locname, modaddress)

            ];
            //geocoder = new GClientGeocoder();
            showAddress(city,address);
        }
    }
    function insertLoc(city,address,lat,lng)
    { 
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

        xhr.open("GET", "insertloc.php?city="+escape(city)+"&address="+escape(address)+"&lat="+escape(lat)+"&lng="+escape(lng),  true); 
        xhr.send(); 
    } 
    function showAddress(city,address) {
        geocoder.getLatLng(
        address,
        function(point) {
            if (!point) {
                alert(address + " not found");
            } else {
                map.setCenter(point,13);
                marker = new GMarker(map.getCenter());
                GEvent.addListener(marker, "click", function() {
                    marker.openInfoWindowTabsHtml(infoTabs);
                });
                map.addOverlay(marker);
                marker.openInfoWindowTabsHtml(infoTabs);
                insertLoc(city,address,marker.getLatLng().lat(),marker.getLatLng().lng())

            }
        }
    );
    }
</script>
