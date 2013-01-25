<?php include 'php_db.php' ?>

<?php

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

    function getDBVersion()
    {
        // Do a simple query, select the version of
       // MSSQL and print it.
       $version = mssql_query('SELECT @@VERSION');
       $row = mssql_fetch_array($version);

       echo $row[0];

       // Clean up
       mssql_free_result($version);
    }


    function getDealDirect($conn) {
        $deal = mssql_query("select * from dealerreference",$conn);
        //$deal = mssql_query("select * from routereference",$cnx);
        //echo $deal;

        //while ($row = mssql_fetch_array($deal)){
        while ($row = mssql_fetch_assoc($deal)){
            //unarray($row);
            //echo $row['Name'];
            //echo $row['DealerId']. "&nbsp;";
            //echo $row['CustomerId']. "&nbsp;";
            //echo $row['Name']. "&nbsp;";
            var_dump($row);
            //Array ( [0] => 1 [DealerId] => 1 [1] => 1 [CustomerId] => 1 [2] => 10718 [BlackhorseDealerCode] => 10718 [3] => 10718 [CustomerDealerCode] => 10718 [4] => 1 [BeyondCode] => 1 [5] => BMW of Orland Park [Name] => BMW of Orland Park [6] => 8470 W 159th St [Address] => 8470 W 159th St [7] => Orland Park [City] => Orland Park [8] => IL [State] => IL [9] => 60462-4942 [Zip] => 60462-4942 [10] => [Phone] => [11] => 11 [RouteId] => 11 [12] => 1 [Active] => 1 [13] => 0 [UpdateId] => 0 )
            echo "<br/>";
        };

        //$row = mssql_fetch_array($deal);
        //echo $row[0];

        mssql_free_result($deal);
    }
    function getCustomerDirect($conn) {
        $deal = mssql_query("select * from customerreference",$conn);
        while ($row = mssql_fetch_assoc($deal)){
            var_dump($row);
        }
    }

    function getRouteDirect($conn) {
        $deal = mssql_query("select * from routereference",$conn);
        //$deal = mssql_query("select * from routereference",$cnx);
        //echo $deal;

        //while ($row = mssql_fetch_array($deal)){
        while ($row = mssql_fetch_assoc($deal)){
            //unarray($row);
            //echo $row['Name'];
            //echo $row['DealerId']. "&nbsp;";
            //echo $row['CustomerId']. "&nbsp;";
            //echo $row['Name']. "&nbsp;";
            var_dump($row);
            echo $row['Name'];
            //Array ( [0] => 1 [DealerId] => 1 [1] => 1 [CustomerId] => 1 [2] => 10718 [BlackhorseDealerCode] => 10718 [3] => 10718 [CustomerDealerCode] => 10718 [4] => 1 [BeyondCode] => 1 [5] => BMW of Orland Park [Name] => BMW of Orland Park [6] => 8470 W 159th St [Address] => 8470 W 159th St [7] => Orland Park [City] => Orland Park [8] => IL [State] => IL [9] => 60462-4942 [Zip] => 60462-4942 [10] => [Phone] => [11] => 11 [RouteId] => 11 [12] => 1 [Active] => 1 [13] => 0 [UpdateId] => 0 )
            echo "<br/>";
        };

        //$row = mssql_fetch_array($deal);
        //echo $row[0];

        mssql_free_result($deal);
    }

    function getFreightDirect($conn) {
        $deal = mssql_query("select * from freight",$conn);

        while ($row = mssql_fetch_assoc($deal)){
            var_dump($row);
            echo "<br/>";
        };

        mssql_free_result($deal);
    }

    function getAllDirect($conn) {
        $query = "select a.freightnumber, d.beyondcode, a.currentstate, b.scantimestamp, c.name as routename, d.name as dealername, d.blackhorsedealercode as dealercode,
               d.address, d.city + ', ' + d.state + ' ' + d.zip as CityStateZip, o.name as originname,
               (select t.scantimestamp from scanevent t where t.freightid = a.freightid and a.currentstate = 'Delivered' and
               t.application = 'Delivery')  as deliveryscan,
               (select t.location from scanevent t where t.freightid = a.freightid and a.currentstate = 'Delivered' and
               t.application = 'Delivery')  as deliverylocation, e.name as FreightType
               from freight a inner join scanevent b on a.freightid = b.freightid and (ltrim(rtrim(b.application)) = 'Outbound' or ltrim(rtrim(b.application)) = 'Inbound')
               inner join routereference c on a.routeid = c.routeid
               inner join freighttypereference e on a.freighttypeid = e.freighttypeid
               inner join dealerreference d on a.dealerid = d.dealerid
               left outer join originreference o on a.originid = o.originid
               where a.customerid > 0
               and (a.routeid >= 0 and a.routeid <= 9999)
               and (a.dealerid >= 0 and a.dealerid <= 9999)
               and (scantimestamp >= '1/1/2010 12:00:00' and scantimestamp < dateadd(day,1,'10/1/2010 12:00:00'))
               order by a.routeid, a.dealerid, b.scantimestamp";
        $deal = mssql_query($query,$conn);
        while ($row = mssql_fetch_assoc($deal)){
            var_dump($row);
            echo "<br/>";
        };
    }

    function getScanDirect($conn) {
        $deal = mssql_query("select * from scanevent",$conn);
        //$deal = mssql_query("select * from routereference",$cnx);
        //echo $deal;

        //while ($row = mssql_fetch_array($deal)){
        while ($row = mssql_fetch_assoc($deal)){
            //unarray($row);
            //echo $row['Name'];
            //echo $row['DealerId']. "&nbsp;";
            //echo $row['CustomerId']. "&nbsp;";
            //echo $row['Name']. "&nbsp;";
            var_dump($row);
            //echo $row['Name'];
            //Array ( [0] => 1 [DealerId] => 1 [1] => 1 [CustomerId] => 1 [2] => 10718 [BlackhorseDealerCode] => 10718 [3] => 10718 [CustomerDealerCode] => 10718 [4] => 1 [BeyondCode] => 1 [5] => BMW of Orland Park [Name] => BMW of Orland Park [6] => 8470 W 159th St [Address] => 8470 W 159th St [7] => Orland Park [City] => Orland Park [8] => IL [State] => IL [9] => 60462-4942 [Zip] => 60462-4942 [10] => [Phone] => [11] => 11 [RouteId] => 11 [12] => 1 [Active] => 1 [13] => 0 [UpdateId] => 0 )
            echo "<br/>";
        };

        //$row = mssql_fetch_array($deal);
        //echo $row[0];

        mssql_free_result($deal);
    }

    function execProcedure($conn)
    {
        /* prepare the statement resource */
       $stmt=mssql_init("myprocedure", $conn);

       /* now bind the parameters to it */
       mssql_bind($stmt, "@id",    $id,    SQLINT4,    FALSE);
       mssql_bind($stmt, "@name",  $name,  SQLVARCHAR, FALSE);
       mssql_bind($stmt, "@email", $email, SQLVARCHAR, FALSE);

       /* now execute the procedure */
       $result = mssql_execute($stmt);
    }

    function unarray($row) {
        foreach($row as $key => $value) {
            global $$key;
            $$key = $value;
            //echo $$key;
        }
    }

    function getDeal($host,$user,$pass,$db) {
       $sdb                = new MSSQLDB($host, $user, $pass, $db);
       //var_dump($sdb);
       $query            = "select * from dealerreference";
       $results = $sdb->query_database($query);

       foreach ($results as $row) {
           //echo $row;
           echo $row['DealerId'] . "&nbsp;";
           echo $row['Name'] . "&nbsp;";
           echo "<br/>";
       }
    }

    function getRoute($host,$user,$pass,$db) {
       $sdb                = new MSSQLDB($host, $user, $pass, $db);
       //var_dump($sdb);
       $query            = "select * from routereference";
       $results = $sdb->query_database($query);

       echo $results;

       foreach ($results as $row ) {
           //echo $row['DealerId'] . "&nbsp;";
           //echo $row['Name'] . "&nbsp;";
           //echo $row;
           //echo $value;
           echo "<br/>";
       }
    }

    function disconnect() {
        mssql_close();
    }

    function main($cnx,$host,$user,$pass,$db) {
        echo "dealerdirect <br/>";
        getCustomerDirect($cnx);
        getDealDirect($cnx);

        //getDeal($host,$user,$pass,$db);
        //getRoute($host,$user,$pass,$db);
        echo "routedirect <br/>";
        getRouteDirect($cnx);
        //getCustomerDirect($cnx);
        echo "freight <br/>";
        getFreightDirect($cnx);
        //getScanDirect($cnx);
        echo "all scan data <br/>";
        getAllDirect($cnx);

        disconnect();
    }

    main($cnx,$host,$user,$pass,$db);
?>
