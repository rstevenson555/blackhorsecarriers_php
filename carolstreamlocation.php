<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<?php 
echo "<script language=\"JavaScript\">\n";
echo "var locname=\"".$_GET['locname']."\""; 
echo "var address=\"".$_GET['site']."\""; 
echo "</script>";
?>
  <script src="http://maps.google.com/maps?file=api&amp;v=2&amp;key=ABQIAAAAKggr7uyFbg3O4gGq2b4JcRQ0oCdIp8IB0nK4dFV3_VqDQXwB4hTy2YZxMdGXBqx6NbsM4IIKpBRe2Q"
 type="text/javascript"></script>
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

            // Our info window content
            infoTabs = [ 
    
                new GInfoWindowTab(locname, address)
    
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
                       }
                    }
              );
    }

    //]]>
    </script>

  <title>Batavia Office</title>


  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">

  <link href="images/style.css" rel="stylesheet" type="text/css">

  <meta content="Robert Stevenson" name="author">

</head>


<body onload="load()" onunload="GUnload()">

<table
 style="text-align: left; width: 100%; height: 188px; font-family: Tahoma;"
 border="0" cellpadding="0" cellspacing="0">
  <tbody>
    <tr>
      <td
 style="width: 425px; text-align: left; vertical-align: top; height: 188px; white-space: nowrap;"
 colspan="1">
      <dl>
      </dl>
      <a href="index.html"><img
 style="border: 0px solid ; width: 233px; height: 142px;"
 alt="logo" src="images/image001.png" align="top"
 hspace="20" vspace="20"></a><img
 style="width: 540px; height: 142px;" alt="trucks"
 src="images/7-Tractorsfacing-Left.png" align="top"
 hspace="20" vspace="20">
      <dl>
      </dl>
      </td>
    </tr>
  </tbody>
</table>

<table style="text-align: left; width: 678px; height: 43px;" border="0" cellpadding="0" cellspacing="0">

  <tbody>

    <tr>

      <td style="height: 50px; text-align: left;"><a href="bhcnews.html"><img style="border: 0px solid ; width: 102px; height: 48px;" alt="bhc news" src="but_1a.gif"></a><a href="application.html"><img style="border: 0px solid ; width: 102px; height: 48px;" alt="driver application" src="but_3aDriver%20Applicatiion.gif"></a><strong><a href="safety.html"><img style="border: 0px solid ; width: 102px; height: 48px;" alt="safety recognition" src="but_4aSafety-Recognition.gif"></a></strong><img style="border: 0px solid ; width: 102px; height: 48px;" alt="driver benefits" src="but_1aDriver-Benefits.gif">
      </td>

    </tr>

  </tbody>
</table>

<table>
    <tr>
        <td>
            <div id="map" style="width: 500px; height: 300px;"></div>
        </td>
        <td>
        </td>
    </tr>
</table>

&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;<br>

<br>

</body>
</html>
