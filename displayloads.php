<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
  <head>
    <meta name="generator" content=
    "HTML Tidy for Mac OS (BBTidy vers 1st December 2002), see www.w3.org">
    <meta http-equiv="content-type" content="text/html; charset=iso-8859-1">
    <link type="text/css" rel="stylesheet" href="images/style.css">
    <meta name="author" content="Robert Stevenson">
    <title>Current Loads</title>
  </head>
  <body id="normalbody">
    <div id="page_wrapper">
      <div id="header_wrapper">
        <div id="header">
           <div id="logoheader" class="column">
              <a href="index.php"><img src="images/image001.png" alt="logo" align="top" border="0" style="margin-right: 25px;"></a>
              <img src="images/7-Tractorsfacing-Left.png" alt="trucks" align="top" border="0">
          </div>
        </div>
        <?php include 'navbuttons.php' ?>
      </div>
      <div id="dummy">
        <?php
             define("REEFER","Reefer");
             define("VAN", "Van");
             define("FLAT","Flat");
             define("LTL","LTL");
             define("TL","TL");

             // 1 = open load
             // 2 = revised load (accepted)
             // 3 = closed load
             // 4 = recalled load
             define("OPENLOAD",1);
             define("REVISEDLOAD",2);
             define("CLOSEDLOAD",3);
             define("RECALLEDLOAD",4);

             define("SUPERUSER",1);
             define("BROKER",2);
             define("BLACKHORSEUSER",3);
            
             /**
             * Converts a date string from one format to another (e.g. d/m/Y => Y-m-d, d.m.Y => Y/d/m, ...)
             *
             * @param string $date_format1
             * @param string $date_format2
             * @param string $date_str
             * @return string
             **/
            function dates_interconv( $date_format1, $date_format2, $date_str )
            {
                $base_struc     = split('[/.-]', $date_format1);
                $date_str_parts = split('[/.-]', $date_str );
               
                //print_r( $base_struc ); echo "<br>";
                //print_r( $date_str_parts ); echo "<br>";
               
                $date_elements = array();
               
                $p_keys = array_keys( $base_struc );
                foreach ( $p_keys as $p_key )
                {
                    if ( !empty( $date_str_parts[$p_key] ))
                    {
                        $date_elements[$base_struc[$p_key]] = $date_str_parts[$p_key];
                    }
                    else
                        return false;
                }
               
                $dummy_ts = mktime( 0,0,0, $date_elements['m'],$date_elements['d'],$date_elements['Y']);
               
                return date( $date_format2, $dummy_ts );
            }
          
            function todate( $date_format1, $date_str )
            {
                $base_struc     = split('[/.-]', $date_format1);
                $date_str_parts = split('[/.-]', $date_str );
               
                //print_r( $base_struc ); echo "<br>";
                //print_r( $date_str_parts ); echo "<br>";
               
                $date_elements = array();
               
                $p_keys = array_keys( $base_struc );
                foreach ( $p_keys as $p_key )
                {
                    if ( !empty( $date_str_parts[$p_key] ))
                    {
                        $date_elements[$base_struc[$p_key]] = $date_str_parts[$p_key];
                    }
                    else
                        return false;
                }
               
                $dummy_ts = mktime( 0,0,0, $date_elements['m'],$date_elements['d'],$date_elements['Y']);
               
                return $dummy_ts;
            }


        //$df_src = 'd/m/Y';
        $df_des = 'm/d/Y';
        $df_src = 'Y-m-d';
        if ( !isset($_COOKIE['ID_bhc']))  {
            die("You must <a href=\"login.php\">login</a> to proceed");
        }
            
        // Connects to your Database
        mysql_connect("www.blackhorsecarriers.com", "bla120", "favss+ra") or die( mysql_error());
        mysql_select_db("bla120") or die(mysql_error());
        $results = mysql_query("SELECT * from loaddetail order by date_delivery") or die(mysql_error());
        if (!$results) {
            $message = 'Invalid query: ' . mysql_error() . "\n";
            $message .= 'Whole query: ' . $query;
            die($message);
            }
        ?>
        <table class="loadtable" cellspacing="0" cellpadding="0" align="left">
          <tr>
            <td>
              <div class="tableContainer">
                <table>
                  <thead class="fixedHeader headerFormat">
                    <tr>
                      <td colspan="5">View Details</td>
                      <td colspan="2">Starting Point</td>
                      <td colspan="2">Destination</td>
                      <td colspan="3">Date & Time Available</td>
                    </tr>
                    <tr>
                      <td>Select</td>
                      <td><img width="18" height="18" border="0" align="absmiddle" alt=
                      "Select to Sort by Status" src="/images/all_status.gif"></td>
                      <td>Terminal</td>
                      <td>Load #</td>
                      <td>Trailer<br>
                      Type</td>
                      <!--<td>Load<br/>Type</td> -->
                      <td>City</td>
                      <td>State<br>
                      Province</td>
                      <td>City</td>
                      <td>State<br>
                      Province</td>
                      <td>Ship</td>
                      <td>Delivery<br>
                      Date</td>
                      <td>Post</td>
                    </tr>
                  </thead>
                  
                  <tbody class="scrollContent bodyFormat">
                    <?php
                    $counter = 0;
                    while ($row = mysql_fetch_assoc($results)) {
                        if ( $counter % 2 == 0) {
                            echo "<tr class=\"alternateRow\" align=\"left\">\n";
                        } else {
                            echo "<tr class=\"standardRow\" align=\"left\">\n";
                        }
                        $counter = $counter + 1;
                        echo "    <td class=\"loaditem\" width=\"40\" align=\"left\">\n";
                        echo "      <table width=\"100%\" cellspacing=\"0\" cellpadding=\"0\" border=\"0\" align=\"center\">\n";
                        echo "        <tr>\n";
                        echo "            <td>\n";
                        echo "                <a target=\"_top\" href=\"viewload.php?load=" . $row['load_number'] . "\">\n";
                        echo "                   <img width=\"18\" height=\"18\" border=\"0\" align=\"absmiddle\" src=\"/images/view.gif\" title=\"View Load\" alt=\"View Load\"/>\n";
                        echo "                </a>\n";
                        echo "            </td>\n";
                        //echo "            <td>\n";
                        //echo "                <input id=\"chkViewLoad\" type=\"checkbox\" name=\"chkViewLoad\" value=\"0\"/>\n";
                        //echo "            </td>\n";
                        echo "        </tr>\n";
                        echo "      </table>\n";
                        echo "    </td>\n";
                        echo "    <td class=\"loaditem\" width=\"20\" align=\"left\">\n";
                        $load_status = $row['load_status'];

                        // 1 = open load
                        // 2 = revised load
                        // 3 = closed load
                        // 4 = recalled load
                        $delivery = dates_interconv($df_src,$df_des,$row['date_delivery']);
                        $now = date("Y-m-d");
                        $now = dates_interconv("Y-m-d",$df_des,$now);
                        //echo " delivery: " . $delivery;
                        //echo " now: " . $now;
                        if ( $delivery == $now) {
                               //echo " now: " . $now;
                                echo "        <img width=\"18\" height=\"18\" src=\"images/redstatus.gif\" title=\"closed\" alt=\"closed\"/>\n";
                        } else {
                            if ( $load_status == OPENLOAD ) {
                                echo "        <img width=\"18\" height=\"18\" src=\"images/greenstatus.gif\" title=\"open\" alt=\"open\"/>\n";
                            } elseif ($load_status == REVISEDLOAD ) {
                                echo "        <img width=\"18\" height=\"18\" src=\"images/yellowstatus.gif\" title=\"revised\" alt=\"revised\"/>\n";
                            }
                        } 
                        
                        /* elseif ($load_status == 3 ) {
                            echo "        <img width=\"18\" height=\"18\" src=\"images/bluestatus.gif\" title=\"closed\" alt=\"closed\"/>\n";
                        } elseif ($load_status == 4 ) {
                            echo "        <img width=\"18\" height=\"18\" src=\"images/redstatus.gif\" title=\"recalled\" alt=\"recalled\"/>\n";
                        } */
                        echo "    </td>\n";
                        echo "    <td class=\"loaditem\" width=\"120\" align=\"left\">\n";
                        echo "        " . $row['company'];
                        echo "    </td>\n";
                        echo "    <td class=\"loaditem\" width=\"60\" align=\"left\">\n";
                        echo "        " . $row['load_number'];
                        echo "    </td>\n";
                        echo "    <td class=\"loaditem\" width=\"60\" align=\"left\">\n";
                        echo "        " . $row['trailer_type'];
                        echo "    </td>\n";
                        //echo "    <td class=\"loaditem\" width=\"60\" align=\"left\">\n";
                        //echo "        " . $row['load_type'];
                        //echo "    </td>\n";
                        echo "    <td class=\"loaditem\" width=\"60\" align=\"left\">\n";
                        echo "        " . $row['origin_city'];
                        echo "    </td>\n";
                        echo "    <td class=\"loaditem\" width=\"60\" align=\"left\">\n";
                        echo "        " . $row['origin_state'];
                        echo "    </td>\n";
                        echo "    <td class=\"loaditem\" width=\"60\" align=\"left\">\n";
                        echo "        " . $row['destination_city'];
                        echo "    </td>\n";
                        echo "    <td class=\"loaditem\" width=\"60\" align=\"left\">\n";
                        echo "        " . $row['destination_state'];
                        echo "    </td>\n";
                        echo "    <td class=\"loaditem\" width=\"70\" align=\"left\">\n";
                        echo "        " . dates_interconv($df_src,$df_des,$row['date_ship']);
                        echo "    </td>\n";
                        echo "    <td class=\"loaditem\" width=\"70\" align=\"left\">\n";
                        echo "        " . dates_interconv($df_src,$df_des,$row['date_delivery']);
                        echo "    </td>\n";
                        echo "    <td class=\"loaditem\" width=\"70\" align=\"left\">\n";
                        echo "        " . dates_interconv($df_src,$df_des,$row['date_post']);
                        echo "    </td>\n";
                        echo "</tr>\n";
                        }

                        echo "<tr class=\"descriptionRow\">\n";
                        echo "<td>&nbsp;</td>\n";
                        echo "</tr>\n";

                        if ( $_COOKIE['role_bhc']!=BROKER)  {
                            echo "<tr>\n";
                            echo "<td class=\"loaditem\" colspan=\"3\"><a href=\"addloads.php\">Add New Load</a></td>\n";
                            echo "<td class=\"loaditem\" colspan=\"1\"><a href=\"showusers.php\">Show Users</a></td>\n";
                            echo "</tr>\n";

                        }
                    ?>
                  <tr class="descriptionRow" >
                      <td colspan="3"><img style="vertical-align:top" src="/images/view.gif"> - View Details</td>
                      <td colspan="2"><img style="vertical-align:top" src="/images/greenstatus.gif"> - Available Load</td>
                      <!--<td colspan="2"><img src="/images/bluestatus.gif"> - Closed Load</td> -->
                      <td colspan="2"><img style="vertical-align:top" src="/images/redstatus.gif"> - Delivery Today</td>
                      <td colspan="2"><img style="vertical-align:top" src="/images/yellowstatus.gif"> - Accepted</td>
                  </tr>
                  </tbody>
                </table>
              </div>
            </td>
          </tr>
        </table>
        <?php
        // Free the resources associated with the result set
        // This is done automatically at the end of the script
        mysql_free_result($results);
        $results = mysql_query("delete from loaddetail where now() > date_add(date_delivery,interval 7 day)") or die(mysql_error());
        mysql_free_result($results);
        ?>
      </div>
    </div>
  </body>
</html>
