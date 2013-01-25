<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
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
        </style>

        <meta name="generator" content=
              "HTML Tidy for Mac OS (BBTidy vers 1st December 2002), see www.w3.org">
        <title>Customer Report</title>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <script type="text/javascript" src="scripts/hover.js"></script>
        <link rel="stylesheet" href="css/black.css" type="text/css" />
        <link type="text/css" rel="stylesheet"
              href="css/style-mock2.css" />
        <link type="text/css" rel="stylesheet"
              href="css/highline_nav.css" />
        <link type="text/css" rel="stylesheet"
              href="css/nav.css" />

        <link rel="stylesheet" href="css/basic.css" type="text/css" />
        <link rel="stylesheet" href="css/galleriffic-5.css" type="text/css" />
        
        <?php include "script_head.php"?>

        <!-- <link rel="stylesheet" href="css/white.css" type="text/css" /> -->

        <script type="text/javascript" src="scripts/jquery-1.3.2.js"></script>
        <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.3/jquery-ui.min.js"></script>

        <script type="text/javascript" src="scripts/jquery.history.js"></script>
        <script type="text/javascript" src="scripts/jquery.galleriffic.js"></script>
        <script type="text/javascript" src="scripts/jquery.opacityrollover.js"></script>
        <!-- We only want the thunbnails to display when javascript is disabled -->


        <link type="text/css" rel="stylesheet" href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.3/themes/base/jquery-ui.css"/>
        <link type="text/css" rel="stylesheet" href="css/style-mock2.css" />
        <link type="text/css" rel="stylesheet" href="css/highline_nav.css" />
        <link type="text/css" rel="stylesheet" href="css/nav.css" />
        <meta content="Robert Stevenson" name="author">
    </head>

    <?php include 'utils.php' ?>
    <?php include 'locations.php' ?>
    <?php
    //session_start();

    function execProcedure($conn,$customerid,$routefrom,$routeto,$dealerfrom,$dealerto,$fromdate,$todate) {
        /* prepare the statement resource */
        $stmt=mssql_init("[dbo].[spBlackHorseDailyPerf]", $conn);

        /* now bind the parameters to it */

        /*(
                              @CustomerId int,
                              @RouteIdFrom int,
                              @RouteIdTo int,
                              @DealerIdFrom int,
                              @DealerIdTo int,
                              @OutboundDateFrom datetime,
                              @OutboundDateTo datetime,
                              @OriginId int
               ) */
        $origin = 0;

        echo "passed customerid" . $customerid;
       echo "passed routefrom" . $routefrom;
       echo "passed routeto" . $routeto;
       echo "passed dealerfrom" . $dealerfrom;
       echo "passed dealerto" . $dealerto;
       echo "passed fromdate" . $fromdate;
       echo "passed todate" . $todate; 

        mssql_bind($stmt, "@CustomerId", $customerid, SQLINT4);
        mssql_bind($stmt, "@RouteIdFrom", $routefrom, SQLINT4);
        mssql_bind($stmt, "@RouteIdTo", $routeto, SQLINT4);
        mssql_bind($stmt, "@DealerIdFrom", $dealerfrom, SQLINT4);
        mssql_bind($stmt, "@DealerIdTo", $dealerto, SQLINT4);
        mssql_bind($stmt, "@OutboundDateFrom", $fromdate, SQLVARCHAR);
        mssql_bind($stmt, "@OutboundDateTo", $todate, SQLVARCHAR);

        mssql_bind($stmt, "@OriginId", $origin, SQLINT4);

        /* now execute the procedure */
        $result = mssql_execute($stmt);

        return $result;
    }
    /**
     * Converts a date string from one format to another (e.g. d/m/Y => Y-m-d, d.m.Y => Y/d/m, ...)
     *
     * @param string $date_format1
     * @param string $date_format2
     * @param string $date_str
     * @return string
     **/
    function dates_interconv( $date_format1, $date_format2, $date_str ) {
        $base_struc     = split('[/.-]', $date_format1);
        $date_str_parts = split('[/.-]', $date_str );

        //print_r( $base_struc ); echo "<br>";
        //print_r( $date_str_parts ); echo "<br>";

        $date_elements = array();

        $p_keys = array_keys( $base_struc );
        foreach ( $p_keys as $p_key ) {
            if ( !empty( $date_str_parts[$p_key] )) {
                $date_elements[$base_struc[$p_key]] = $date_str_parts[$p_key];
            }
            else
                return false;
        }

        $dummy_ts = mktime( 0,0,0, $date_elements['m'],$date_elements['d'],$date_elements['Y']);

        return date( $date_format2, $dummy_ts );
    }

    function getConnection() {
        $host = "baeg-sql01";
        $host = "10.147.160.7";
        $user= 'barcode';
        $pass = "carriers";
        $db= "Blackhorse3";
        //phpinfo();
        $cnx = mssql_connect($host, $user, $pass) or
                die ("Can't connect to Microsoft SQL Server");
        mssql_select_db($db, $cnx) or
                die ("Can't connect to Database");
        return $cnx;
    }


    $df_src = 'm/d/Y';
    //$df_des = 'Y-m-d';
    $df_des = 'm/d/Y';

    if ( !isset($_POST['fromdate']) || strlen($_POST['fromdate'])==0) {
          die("You must specify the start date, try again <a href=\"customer_report.php\">return</a>");
          return;
    } else if ( !isset($_POST['todate']) || strlen($_POST['todate'])==0) {
          die("You must specify the end date, try again <a href=\"customer_report.php\">return</a>");
          return;
    }

    $fromdate = dates_interconv( $df_src, $df_des, $_POST['fromdate']);
    $todate = dates_interconv( $df_src, $df_des, $_POST['todate']);

    $fromdate = $fromdate . " 12:00:00";
    $todate = $todate . " 12:00:00";

    $customer = $_POST['customer'];
    $fromdate = $_POST['fromdate'] . " 12:00:00";
    $todate = $_POST['todate'] . " 12:00:00";
    $routefrom = $_POST['routefrom'];
    $routeto = $_POST['routeto'];
    $dealerfrom = $_POST['dealerfrom'];
    $dealerto = $_POST['dealerto'];

    $rc = 0;

    $conn = getConnection();

    

    $results = execProcedure($conn,$customer,$routefrom,$routeto,$dealerfrom,$dealerto,$fromdate,$todate);

    /*while ($row = mssql_fetch_assoc($results)){
        //foreach ($row as $r) {
            var_dump($row);
            echo "<br/>";
        //}
    //}
    //mssql_free_result($results);

    //header( 'Location: displayloads.php' ) ; */
    ?>
    <body style="color:black;" id="normalbody">
        <div id="page_wrapper">
            <div id="main" style="width:1200px!important;">
                <?php include 'navigation.php' ?>
                <div class="bodyText articleText" style="font-size: 11pt;background-image: url(images/background2.jpg);" >

                    <div style="margin-top:20px;">
                        <!-- { ["freightnumber"]=> string(13) "3602000731957"
                        ["beyondcode"]=> string(1) "2"
                        ["currentstate"]=> string(10) "Outbounded"
                        ["scantimestamp"]=> string(18) "Oct 7 2010 7:41PM"
                        ["routename"]=> string(1) "1"
                        ["dealername"]=> string(15) "Dave Walter BMW"
                        ["dealercode"]=> string(5) "56632"
                        ["address"]=> string(17) "500 W Exchange St"
                        ["CityStateZip"]=> string(15) "Akron, OH 44302"
                        ["originname"]=> NULL
                        ["deliveryscan"]=> NULL
                        ["deliverylocation"]=> NULL
                        ["FreightType"]=> string(5) "Loose" }
                        -->
       <!-- <?php
    echo "   Customer: " . $customer . "<br/>";
    echo "  From Date: " . $fromdate . "<br/>";
    echo "    To Date:   " . $todate . "<br/>";
    echo " From Route:" . $routefrom . "<br/>";
    echo "   To Route:  " . $routeto . "<br/>";
    echo "From Dealer: " . $dealerfrom . "<br/>";
    echo "  To Dealer:  " . $dealerto . "<br/>";
    ?> -->
                        <?php while ($row = mssql_fetch_assoc($results)) { ?>
                        <?php if ($rc++ == 0) { ?>
                                <table>
                                   <tr>
                                       <th>FreightNumber</th>
                                       <th>Current State</th>
                                       <th>Current Date</th>
                                       <th>Route Name</th>
                                       <th>Dealer Name</th>
                                       <th>Dealer Code</th>
                                       <th>Address</th>
                                       <th>City State Zip</th>
                                       <th>Delivery Time</th>
                                       <th>Freight Type</th>
                                   </tr>
                            <?php } ?>

                            <tr>
                                <td> <?php echo $row['freightnumber']; ?> </td>
                                <td> <?php echo $row['currentstate']; ?> </td>
                                <td> <?php echo $row['scantimestamp']; ?> </td>
                                <td> <?php echo $row['routename']; ?> </td>
                                <td> <?php echo $row['dealername']; ?> </td>
                                <td> <?php echo $row['dealercode']; ?> </td>
                                <td> <?php echo $row['address']; ?> </td>
                                <td> <?php echo $row['CityStateZip']; ?> </td>
                                <td> <?php echo $row['deliveryscan']; ?> </td>
                                <td> <?php echo $row['FreightType']; ?> </td>
                            </tr>

                            <?php } ?>
                            <?php if ($rc>0) { ?>
                        </table>
                            <?php } ?>
                    </div>

                </div>
            </div>
        </div>

    </body>
</html>
