<?php

echo "<!DOCTYPE html PUBLIC \"-//W3C//DTD XHTML 1.0 Strict//EN\" \"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd\">\n";
echo "<html>\n";
echo "<head>\n";
echo "<meta http-equiv=\"content-type\" content=\"text/html; charset=iso-8859-1\" />\n";
echo "<link type=\"text/css\" rel=\"stylesheet\" href=\"images/style.css\">\n";
echo "<meta name=\"author\" content=\"Robert Stevenson\">\n";
echo "<title>Current Loads</title>\n";
echo "</head>\n";

echo "<body id=\"dummy\">\n";

// Connects to your Database
mysql_connect("www.blackhorsecarriers.com", "bla120", "favss+ra") or die( mysql_error());
mysql_select_db("bla120") or die("ksdkksdf " . mysql_error());

$results = mysql_query("SELECT * from loaddetail") or die(mysql_error());

if (!$results) {
    $message = 'Invalid query: ' . mysql_error() . "\n";
    $message .= 'Whole query: ' . $query;
    die($message);
    }

echo "<table width=\"100%\" cellspacing=\"0\" cellpadding=\"0\" bordercolor=\"#ffffff\" border=\"1\" align=\"left\">\n";
echo "<tr><td>";
echo "<div class=\"TableContainer\">\n";
echo "<table class=\"scrollTable\">\n";
echo "  <thead class=\"fixedHeader headerFormat\">\n";
echo "    <tr>";
echo "      <td>Select</td>";
echo "      <td>Stat</td>";
echo "      <td>Company</td>";
echo "      <td>Load #</td>";
echo "      <td>Trailer</td>";
echo "      <td>Load</td>";
echo "      <td>City</td>";
echo "      <td>State</td>";
echo "      <td>City</td>";
echo "      <td>State</td>";
echo "      <td>Ship</td>";
echo "      <td>Delivery</td>";
echo "      <td>Post</td>";
echo "    </tr>\n";
echo "    <tr>";
echo "      <td></td>";
echo "    <td></td>";
echo "      <td></td>";
echo "      <td></td>";
echo "      <td>Type</td>";
echo "      <td>Type</td>";
echo "      <td></td>";
echo "      <td>Province</td>";
echo "      <td></td>";
echo "      <td>Province</td>";
echo "      <td></td>";
echo "      <td>Date</td>";
echo "      <td></td>";
echo "    </tr>\n";
echo "  </thead>\n";
echo "<tbody class=\"scrollContent bodyFormat\">\n";

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
    echo "                <a target=\"_top\" href=\"viewload.php?load=0\">\n";
    echo "                   <img width=\"18\" height=\"18\" border=\"0\" align=\"absmiddle\" src=\"/images/view.gif\" alt=\"View Load 0\"/>\n";
    echo "                </a>\n";
    echo "            </td>\n";
    echo "            <td>\n";
    echo "                <input id=\"chkViewLoad\" type=\"checkbox\" name=\"chkViewLoad\" value=\"0\"/>\n";
    echo "            </td>\n";
    echo "        </tr>\n";
    echo "      </table>\n";
    echo "    </td>\n";

    echo "    <td class=\"loaditem\" width=\"20\" align=\"left\">\n";
    echo "        <img width=\"18\" height=\"18\" src=\"images/greenstatus.gif\" alt=\"green\"/>\n";
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

    echo "    <td class=\"loaditem\" width=\"60\" align=\"left\">\n";
    echo "        " . $row['load_type'];
    echo "    </td>\n";

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
    echo "        " . $row['date_ship'];
    echo "    </td>\n";

    echo "    <td class=\"loaditem\" width=\"70\" align=\"left\">\n";
    echo "        " . $row['date_delivery'];
    echo "    </td>\n";

    echo "    <td class=\"loaditem\" width=\"70\" align=\"left\">\n";
    echo "        " . $row['date_post'];
    echo "    </td>\n";

    echo "</tr>\n";
    }

echo "</tbody></table></div></td</tr></table>\n";

// Free the resources associated with the result set
// This is done automatically at the end of the script
mysql_free_result($results);

echo "</body>\n";
echo "</html>\n";

?>

