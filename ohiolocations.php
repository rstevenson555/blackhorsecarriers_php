<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">

<html>
    <head>
        <meta name="generator" content=
              "HTML Tidy for Windows (vers 18 June 2008), see www.w3.org" /><?php
echo "<script language=\"JavaScript\">\n";
echo "var locname=\"" . $_GET['locname'] . "\";\n";
echo "var address=\"" . $_GET['site'] . "\";\n";
echo "</script>";
?>
        <script src="http://maps.google.com/maps?file=api&amp;v=2&amp;key=ABQIAAAAKggr7uyFbg3O4gGq2b4JcRQ0oCdIp8IB0nK4dFV3_VqDQXwB4hTy2YZxMdGXBqx6NbsM4IIKpBRe2Q"
                type="text/javascript">
        </script>

<?php include 'map_functions.php' ?>

        <title>Black Horse Carriers Inc.,Ohio locations</title>
        <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.3.2/jquery.min.js"></script>
        <script type="text/javascript" src="scripts/hover.js"></script>

        <link type="text/css" rel="stylesheet"
              href="css/style-mock2.css" />
        <link type="text/css" rel="stylesheet"
              href="css/highline_nav.css" />
        <link type="text/css" rel="stylesheet"
              href="css/nav.css" />
        <meta content="Robert Stevenson" name="author" />
    </head>

    <?php include 'utils.php' ?>
<?php include 'locations.php' ?>
    <body id="normalbody" onload="load()" onunload="GUnload()">
        <div id="page_wrapper">

            <div id="main">
<?php include 'navigation.php' ?>
                <div class="bodyText">
                    <table style="width: 700px;">
                        <tbody>
                            <tr>
                                <td vertical-align="" top="">
                                    <table style="text-align: left; width: 100%;" border="0"
                                           cellpadding="2" cellspacing="10">
                                        <tr>
                                            <td>
                                                <form>
                                                    <div class="citydrop">&nbsp;</div>
                                                </form>
                                            </td>

                                            <td>
<?php include 'statetable.php' ?>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td style="width: 30%">
                                                <table style="text-align: left;" border="0" cellpadding="2"
                                                       cellspacing="10" width="200px">
                                                    <tbody>
                                                        <tr>
                                                            <td>
                                                                <?php
                                                                writelocation("3500 Southwest Blvd", "Grove City", "OH", "43123-2244", "Donald Billups", "Terminal Manager", "614-871-6616");
                                                                ?>
                                                            </td>
                                                        </tr>

                                                        <tr><td><hr /></td></tr>

                                                        <tr>
                                                            <td>
                                                                <?php
                                                                writelocation("1319 W 130th Street", "Hinckley", "OH", "44233", "Gary Dimit", "Terminal Manager", "330-225-2250");
                                                                ?>
                                                            </td>
                                                        </tr>

                                                    </tbody>
                                                </table>
                                                <?php include 'statecity.php' ?>
                                            </td>

                                            <?php include 'map.php' ?>
                                        </tr>
                                    </table>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <script type="text/javascript">
            var gaJsHost = (("https:" == document.location.protocol) ? "https://ssl." : "http://www.");
            document.write(unescape("%3Cscript src='" + gaJsHost + "google-analytics.com/ga.js' type='text/javascript'%3E%3C/script%3E"));
        </script>
        <script type="text/javascript">
            try {
                var pageTracker = _gat._getTracker("UA-12682212-1");
                pageTracker._trackPageview();
            } catch(err) {}</script>
    </body>
</html>
