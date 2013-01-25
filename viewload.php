<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
  <head>
    <meta name="generator" content=
    "HTML Tidy for Mac OS (BBTidy vers 1st December 2002), see www.w3.org">
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <link href="images/style.css" rel="stylesheet" type="text/css">
    <meta name="author" content="Robert Stevenson">
    <title>View Loads</title>
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
      <div id="main">
        <form font-family:="" target="_self" onsubmit="javascript:submitForm();" method=
        "post" action="acceptload.php" name="load">
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
             
              //$df_src = 'd/m/Y';
              $df_des = 'm/d/Y';
              $df_src = 'Y-m-d';

          if ( !isset($_COOKIE['ID_bhc']))  {
               die("You must <a href=\"login.php\">login</a> to proceed");
          }
              
          if (!isset($_GET['load'])) {
              die("Missing parameter 'load', cannot call directly, click <a href=\"displayloads.php\">showloads</a> to view all loads");
          }

          //    echo $_GET['load'];
          // Connects to your Database
          mysql_connect("www.blackhorsecarriers.com", "bla120", "favss+ra") or die( mysql_error());
          mysql_select_db("bla120") or die(mysql_error());

          $results = mysql_query("SELECT * from loaddetail where load_number=" . $_GET['load']) or die(mysql_error());
          if (!$results) {
              $message = 'Invalid query: ' . mysql_error() . "\n";
              $message .= 'Whole query: ' . $query;
              die($message);
              }
             
          if ($row = mysql_fetch_assoc($results)) {
          echo "<table>\n";
          echo "    <tr>\n";
          echo "        <td class=\"headingRow\" colspan=\"6\">Load Info</td>\n";
          echo "    </tr>\n";
          echo "    <tr class=\"alternateRow\">\n";
          echo "        <td>Terminal</td>\n";
          echo "        <td>\n";
          echo "            <input  name=\"companyname\" maxlength=\"132\" size=\"40\" value=\"" . $row['company'] . "\">\n";
          echo "        </td>\n";
          echo "        <td>Trailer Type</td>\n";
          echo "        <td colspan=\"1\">\n";
          echo "    <select name=\"trailertype\">\n";
         

          if ( $row['trailer_type'] == REEFER) {
               echo "      <option SELECTED value=\"Reefer\">Reefer</option>\n";
               echo "      <option  value=\"Van\">Van</option>\n";
               echo "      <option  value=\"Flat\">Flat</option>\n";

          } else if ($row['trailer_type'] == VAN) {
               echo "      <option  value=\"Reefer\">Reefer</option>\n";
               echo "      <option SELECTED value=\"Van\">Van</option>\n";
               echo "      <option  value=\"Flat\">Flat</option>\n";
               
          } else if ($row['trailer_type'] == FLAT) {
               echo "      <option  value=\"Reefer\">Reefer</option>\n";
               echo "      <option  value=\"Van\">Van</option>\n";
               echo "      <option SELECTED value=\"Flat\">Flat</option>\n";

          } else {
               echo "      <option  value=\"Reefer\">Reefer</option>\n";
               echo "      <option  value=\"Van\">Van</option>\n";
               echo "      <option  value=\"Flat\">Flat</option>\n";
          }
          
          echo "      </select>\n";
          
          echo "        </td>\n";
          
          echo "    <td>Load Type</td>\n";
          echo "    <td>\n";
          
          echo "    <select name=\"loadtype\">\n";

          if ( $row['load_type'] == LTL) {
              echo "       <option SELECTED value=\"LTL\">LTL</option>\n";
              echo "       <option  value=\"TL\">TL</option>\n";

          } else if ($row['load_type'] == TL) {
              echo "       <option  value=\"LTL\">LTL</option>\n";
              echo "       <option SELECTED value=\"TL\">TL</option>\n";

          } else {
              echo "       <option  value=\"LTL\">LTL</option>\n";
              echo "       <option  value=\"TL\">TL</option>\n";
          }
          
          echo "    </select>\n";
          echo "     </td>\n";
          echo "   </tr>\n";

          $termresults = mysql_query("SELECT * from terminals where terminal='" . $row['company'] . "'") or die(mysql_error());
          //echo "SELECT * from terminals where terminal='" . $row['company'] . "'";

          if (!$termresults) {
              $message = 'Invalid query: ' . mysql_error() . "\n";
              $message .= 'Whole query: ' . $query;
              die($message);
              }
             
          if ($termrow = mysql_fetch_assoc($termresults)) {
              echo "   <tr class=\"alternateRow\">\n";
              echo "       <td>City</td>\n";
              echo "       <td>\n";
              echo "            <input  name=\"city\" maxlength=\"30\" size=\"30\" value=\"" . $termrow['city'] . "\">\n";
              echo "       </td>\n";
              echo "       <td>State</td>\n";
              echo "       <td>\n";
              echo "            <input  name=\"state\" maxlength=\"2\" size=\"2\" value=\"" . $termrow['state'] . "\">\n";
              echo "       </td>\n";
              echo "       <td>Zip</td>\n";
              echo "       <td>\n";
              echo "            <input  name=\"zip\" maxlength=\"6\" size=\"6\" value=\"" . $termrow['zip'] . "\">\n";
              echo "       </td>\n";
              echo "   </tr>\n";
              echo "   <tr class=\"alternateRow\">\n";
              echo "       <td>Phone</td>\n";
              echo "       <td>\n";
              echo "            <input  name=\"phone\" maxlength=\"12\" size=\"12\" value=\"" . $termrow['phone'] . "\">\n";
              echo "       </td>\n";
              echo "   </tr>\n";
          }
          mysql_free_result($termresults);

          echo "   <tr>\n";
          echo "        <td class=\"headingRow\" colspan=\"6\">Starting Point Details</td>\n";
          echo "    </tr>\n";
          echo "    <tr class=\"alternateRow\">\n";
          echo "        <td>City</td>\n";
          echo "        <td><input name=\"origincity\" maxlength=\"132\" size=\"40\" value=\"" . $row['origin_city'] . "\"></td>\n";
          echo "        <td>State</td>\n";
          echo "        <td colspan=\"3\"><input name=\"originstate\" maxlength=\"2\" size=\"2\" value=\"" . $row['origin_state'] . "\"></td>\n";
          echo "    </tr>\n";
          echo "    <tr>\n";
          echo "        <td class=\"headingRow\" colspan=\"6\">Destination Details</td>\n";
          echo "    </tr>\n";
          echo "    <tr class=\"alternateRow\">\n";
          echo "        <td>City</td>\n";
          echo "        <td><input name=\"destinationcity\" maxlength=\"132\" size=\"40\" value=\"" . $row['destination_city'] . "\"></td>\n";
          echo "        <td>State</td>\n";
          echo "        <td colspan=\"3\"><input name=\"destinationstate\" maxlength=\"2\" size=\"2\" value=\"" . $row['destination_state'] . "\"></td>\n";
          echo "    </tr>\n";
          echo "    <tr>\n";
          echo "        <td class=\"headingRow\" colspan=\"6\">Delivery Info -   <i>MM/DD/YYYY</i></td>\n";
          echo "    </tr>\n";
          echo "    <tr class=\"alternateRow\">\n";
          echo "        <td>Ship Date</td>\n";
          echo "        <td><input name=\"dateship\" maxlength=\"10\" size=\"10\" value=\"" . dates_interconv($df_src,$df_des,$row['date_ship']) . "\"></td>\n";
          echo "        <td>Delivery Date</td>\n";
          echo "        <td><input name=\"datedelivery\" maxlength=\"10\" size=\"10\" value=\"" . dates_interconv($df_src,$df_des,$row['date_delivery']) . "\" ></td>\n";
          echo "        <td>Post Date</td>\n";
          echo "        <td><input name=\"datepost\" maxlength=\"10\" size=\"10\" value=\"" . dates_interconv($df_src,$df_des,$row['date_post']) . "\" ></td>\n";
          echo "       <input type=\"hidden\" name=\"loadnumber\" value=\"$_GET[load]\"/>";
          echo "    </tr>\n";
          echo "    <tr>\n";
          echo "        <td class=\"headingRow\" colspan=\"6\">Entered By</td>\n";
          echo "    </tr>\n";
          echo "    <tr class=\"alternateRow\">\n";
          echo "        <td>Created By</td><td colspan=\"6\">" . $row['created_by'] . "</td>\n";
          echo "    </tr>\n";

          if ($row['accepted_by']!="") {
              echo "    <tr>\n";
              echo "        <td class=\"headingRow\" colspan=\"6\">Accepted By</td>\n";
              echo "    </tr>\n";
              echo "    <tr class=\"alternateRow\">\n";
              echo "        <td>Accepted By</td><td colspan=\"5\">" . $row['accepted_by'] . "</td>\n";
              echo "    </tr>\n";
          }
          echo "<tr>\n";

          echo "    <td class=\"headingRow\" colspan=\"1\">Description</td>\n";
          echo "    <td class=\"headingRow\" colspan=\"5\"><textarea name=\"comments\" cols=\"80\" rows=\"5\">\n";
          echo $row['description'];
          echo "</textarea></td>\n";
          echo "  </tr>\n";
          echo "<tr>\n";
          echo "<td class=\"headingRow\" colspan=\"2\">\n";
          $load_status = $row['load_status'];

          if ($load_status == OPENLOAD) {
              echo "<a href=\"acceptload.php?loadnumber=" . $_GET['load'] . "\">Accept Load</a>&nbsp;";
          }

          echo "</td>\n";
          // if you are the user that created this load you can delete it
          if ( $_COOKIE['ID_bhc'] == $row['created_by'])  {
              echo "<td class=\"headingRow\" colspan=\"4\">\n";
              echo "<a href=\"deleteload.php?loadnumber=" . $_GET['load'] . "\">Delete Load</a>&nbsp;";
              echo "</td>\n";
          }
          echo "</table>\n";
          }
          // Free the resources associated with the result set
          // This is done automatically at the end of the script
          mysql_free_result($results);
          ?>
        </form>
      </div>
    </div>
  </body>
</html>
