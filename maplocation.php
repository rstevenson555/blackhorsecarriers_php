<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
  <head>
    <meta name="generator" content=
    "HTML Tidy for Mac OS (BBTidy vers 1st December 2002), see www.w3.org"><?php 
    echo "<script language=\"JavaScript\">\n";
    echo "var locname=\"".$_GET['locname']."\";\n"; 
    echo "var address=\"".$_GET['site']."\";\n"; 
    echo "</script>";
    ?>
    <script src=
    "http://maps.google.com/maps?file=api&amp;v=2&amp;key=ABQIAAAAKggr7uyFbg3O4gGq2b4JcRQ0oCdIp8IB0nK4dFV3_VqDQXwB4hTy2YZxMdGXBqx6NbsM4IIKpBRe2Q"
     type="text/javascript">
    </script>
    <script type="text/javascript">
    //<![CDATA[
    var geocoder = null;
    var map = null;
    var marker = null;
    var infoTabs = null; 
    function load() {
        if (GBrowserIsCompatible()) {
            map = new GMap2(document.getElementById("map"));
            //map.setCenter(new GLatLng(37.4419, -122.1419), 13);
            map.addControl(new GMapTypeControl());
            map.addControl(new GScaleControl());
            map.addControl(new GLargeMapControl());
            //map.setCenter(new GLatLng(41.913672,-88.119935), 13);
            var modaddress = address;
            modaddress = address.substring(0,address.indexOf(",")+1)
            modaddress = modaddress + "<br/>"
            modaddress = modaddress + address.substring(address.indexOf(",")+1,address.length);;
            // Our info window content
            infoTabs = [ 
                new GInfoWindowTab(locname, modaddress)
    
                ];
            geocoder = new GClientGeocoder();
            showAddress(address);
        }
    }
    function showAddress(address) {
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
                       }
                    }
              );
    }
    //]]>
        </script>
    <title>Batavia Office</title>
  <script type="text/javascript" src="images/mootools.js"></script>
  <script type="text/javascript" src="images/imageMenu.js"></script>
  <link type="text/css" rel="stylesheet" href="images/style-mock2.css">
      <link type="text/css" rel="stylesheet" href="images/style-mock2.css">
      <link type="text/css" rel="stylesheet" href="images/imageMenu.css">

  </head>
  <body id="normalbody" onload="load()" onunload="GUnload()">
    <div id="page_wrapper">
      <div id="header_wrapper">
        <?php include 'logofull.php' ?>
        <script language="JavaScript" type="text/javascript">
			window.addEvent('domready', function(){
				var myMenu = new ImageMenu($$('#imageMenu a'),{openWidth:310, border:2, open:0, onOpen:function(e,i){location.href=e;}});
			});
		</script> 

      </div>
      <div id="main" style="background-color: #DADADA">
        <table>
          <tr>
            <td>
              <div id="map" style="width: 500px; height: 300px;">
              </div>
            </td>
            <td>
            </td>
          </tr>
        </table>
        <br>
        <br>
      </div>
    </div>
  </body>
</html>
