<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<?php include 'php_db.php' ?>

<?php
$host = "baeg-sql01";
$host = "10.147.160.7";
$user= 'barcode';
$pass = "carriers";
$db= "Blackhorse3";
?>
<html>
    <head>
        <style type="text/css">
            span.highlight
            {
                background-color:yellow
            }
            .reportcriteria {
                padding-top:2px;
                padding-bottom:2px;
            }
            div.ui-datepicker { 
                font-family: Verdana,Arial,sans-serif;
                font-size: 10px; margin-left:10px }

        </style>

        <meta name="generator" content=
              "HTML Tidy for Mac OS (BBTidy vers 1st December 2002), see www.w3.org">
        <title>Customer Report</title>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">

        <!-- <link rel="stylesheet" href="css/white.css" type="text/css" /> -->

        <link rel="stylesheet" href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.3/themes/base/jquery-ui.css" type="text/css" media="all" />
        <link rel="stylesheet" href="http://static.jquery.com/ui/css/demo-docs-theme/ui.theme.css" type="text/css" media="all" />
        <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.4.2/jquery.min.js" type="text/javascript"></script>
        <script src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.3/jquery-ui.min.js" type="text/javascript"></script>

        <script type="text/javascript" src="scripts/hover.js"></script>

        <!-- We only want the thunbnails to display when javascript is disabled -->

        <link rel="stylesheet" href="css/black.css" type="text/css" />
        <link type="text/css" rel="stylesheet" href="css/style-mock2.css" />
        <link type="text/css" rel="stylesheet" href="css/highline_nav.css" />
        <link type="text/css" rel="stylesheet" href="css/nav.css" />
        <meta content="Robert Stevenson" name="author">
    </head>

    <?php include 'utils.php' ?>
    <?php include 'locations.php' ?>
    <?php
    $sdb                = new MSSQLDB($host, $user, $pass, $db);
    $dealerdrop = "";
    $routedrop = "";
    $customerdrop = "";
    $currcust = 1;

    function buildCustomerDrop($sdb,$cust) {
        $customerdrop = "";
        $query            = "select CustomerId,Name from customerreference order by Name";
        $results = $sdb->query_database($query);
        foreach ($results as $row) {
            if ($cust == $row['CustomerId'])
                $customerdrop = $customerdrop . "<OPTION selected=\'YES\' VALUE=\"" . $row['CustomerId'] . "\">" . $row['Name'] . "</OPTION>\n";
            else
                $customerdrop = $customerdrop . "<OPTION VALUE=\"" . $row['CustomerId'] . "\">" . $row['Name'] . "</OPTION>\n";
        }
        return $customerdrop;
    }

    function buildDealerDrop($sdb,$cust) {
        $dealerdrop = "";
        $query      = "select DealerId,Name,BlackhorseDealerCode from dealerreference where CustomerId=" . $cust . " order by Name";
        $results = $sdb->query_database($query);
        foreach ($results as $row) {
            $dealerdrop = $dealerdrop . "<OPTION VALUE=\"" . $row['DealerId'] . "\">" . $row['Name'] . "</OPTION>\n";
        }
        return $dealerdrop;
    }

    function buildRouteDrop($sdb,$cust) {
        $routedrop = "";
        $query            = "select RouteId,Name from routereference where CustomerId=" . $cust . " order by Name";
        $results = $sdb->query_database($query);
        foreach ($results as $row) {
            $routedrop = $routedrop . "<OPTION VALUE=\"" . $row['RouteId'] . "\">" . $row['Name'] . "</OPTION>\n";
        }
        return $routedrop;
    }
    ?>
    <body style="color:black;" id="normalbody">
        <div id="page_wrapper">
            <div id="main">
                <?php include 'navigation.php' ?>
                <div class="bodyText articleText" style="font-size: 11pt;background-image: url(images/background2.jpg);" >

                    <?php
                    if ( isset($_REQUEST['currcust']))
                        $currcust = $_REQUEST['currcust'];
                    else
                        $currcust = 1;

                    $customerdrop = buildCustomerDrop($sdb,$currcust);
                    $dealerdrop = buildDealerDrop($sdb,$currcust);
                    $routedrop = buildRouteDrop($sdb,$currcust);
                    ?>

                    <script type="text/javascript">
                        <!--
                        function reload_drop(obj)
                        {
                            value = obj.options[obj.selectedIndex].value;
                            location = 'customer_report.php?currcust=' + value;

                        }
                        $(function() {
                            $( "#fromdatepicker" ).datepicker({
                                gotoCurrent:true,
                                defaultDate:-1,
                                onSelect: function(dateText, inst) {
                                    $("#fromdate").val(dateText);
                                }
                            });
                        });
                        $(function() {
                            $( "#todatepicker" ).datepicker({
                                gotoCurrent:true,
                                defaultDate:-1,
                                onSelect: function(dateText, inst) {
                                    $("#todate").val(dateText);
                                }
                            });
                        });
                        //-->
                    </script>
                    <form font-family:="" target="_self" onsubmit="javascript:submitForm();"
                          method="post" action="submit_customer_criteria.php" name="criteria">

                        <div class="reportcriteria" style="margin-top:20px;">
                            <div style="float:left;width:120px;">Customer</div>
                            <select onChange="javascript:reload_drop(this);" style=";" NAME="customer">
                                <?php
                                echo $customerdrop;
                                ?>
                            </select>
                        </div>

                        <div style="width:100%">
                            <div>
                                <span style="margin-left:10px;">From Date</span>
                                <span style="padding-left:130px;">To Date</span>
                            </div>
                        </div>

                        <div class="reportcriteria" style="height:250px;" >
                            <div id="fromdatepicker" style="float:left;"></div>
                            <input style="display:none" name="fromdate" id="fromdate"/>
                            <div id="todatepicker" style="float:left;"></div>
                            <input style="display:none" name="todate" id="todate"/>
                        </div>

                        <div class="reportcriteria" style="width:100%;">
                            <div style="float:left;width:120px;">Route From</div>
                            <select style=";" NAME="routefrom">
                                <?php
                                echo $routedrop;
                                ?>
                            </select>
                        </div>

                        <div style="width:100%;" class="reportcriteria">
                            <div style="float:left;width:120px;">Route To</div>
                            <select style=";" style="" NAME="routeto">
                                <?php
                                echo $routedrop;
                                ?>
                            </select>
                        </div>

                        <div style="width:100%;" class="reportcriteria">
                            <div style="float:left;width:120px;">Dealer From</div>
                            <select style=";" style="" NAME="dealerfrom">
                                <?php
                                echo $dealerdrop;
                                ?>
                            </select>
                        </div>

                        <div class="reportcriteria" style="width:100%;">
                            <div style="float:left;width:120px;">Dealer To</div>
                            <select style=";" style="" NAME="dealerto">
                                <?php
                                echo $dealerdrop;
                                ?>
                            </select>
                        </div>
                        <input value="Submit" name="submit" type="submit" />
                    </form>

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
