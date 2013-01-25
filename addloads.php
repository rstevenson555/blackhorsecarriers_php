<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html >
  <head>
    <meta name="generator"
    content="HTML Tidy for Mac OS (BBTidy vers 1st December 2002), see www.w3.org" />
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <link href="images/style.css" rel="stylesheet" type="text/css" />
    <meta name="author" content="Robert Stevenson" />
    <title>Add New Loads</title>
  </head>
  <body id="normalbody">
    <script type="text/javascript">
        function deleteTerminal() {
           var terminaltext = document.load.companyname.options[document.load.companyname.selectedIndex].text;
           input_box = confirm("Are you sure you want to delete the terminal '" + terminaltext + "' ? " );
           if ( input_box==true) {
               window.location.href="deleteterminal.php?company=" + terminaltext;
           }
        }
    </script>
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
 <?php
    if ( !isset($_COOKIE['ID_bhc']))  {
        die("You must <a href=\"login.php\">login</a> to proceed");
    }

        // Connects to your Database
        mysql_connect("www.blackhorsecarriers.com", "bla120", "favss+ra") or die( mysql_error());
        mysql_select_db("bla120") or die(mysql_error());
        $results = mysql_query("SELECT * from terminals ") or die(mysql_error());
        if (!$results) {
            $message = 'Invalid query: ' . mysql_error() . "\n";
            $message .= 'Whole query: ' . $query;
            die($message);
            }
    
?>    
        <form font-family:="" target="_self" onsubmit="javascript:submitForm();"
        method="post" action="addformdetails.php" name="load">
          <table>
            <tr>
              <td class="headingRow" colspan="6">Load Info</td>
            </tr>
            <tr class="alternateRow">
              <td>Terminal [<a href="addterminal.php">add</a>/<a name="delete" href="javascript:deleteTerminal();">delete</a>]</td>
              <td><!--<input maxlength="132" size="40" name="companyname" />-->
                 <select name="companyname" >
                <?php
                    while ($row = mysql_fetch_assoc($results)) {
                       echo "<option value=\"" . $row['terminal'] . "\">".$row['terminal']."</option>";
                    }
                    mysql_free_result($results);
                    
                ?>
                 </select>
              </td>
              <td>Trailer Type</td>
              <td colspan="1"><!--<input maxlength="10" size="10" name="trailertype" />--> 
              <select name="trailertype">
                <option value="Reefer">Reefer</option>
                <option value="Van">Van</option>
                <option value="Flat">Flat</option>
                </select></td>
              <!-- <td>Load Type</td>
              <td><input maxlength="2" size="2" name="loadtype" /></td> -->
              <td>Load Type</td>
              <td>
              <select name="loadtype">
                 <option value="LTL">LTL</option>
                 <option value="TL">TL</option>
              </select>
              </td>
            </tr>
            <tr>
              <td class="headingRow" colspan="6">Starting Point Details</td>
            </tr>
            <tr class="alternateRow">
              <td>City</td>
              <td><input maxlength="132" size="40" name="origincity" /></td>
              <td>State</td>
              <td colspan="3"><input maxlength="2" size="2" name="originstate" /></td>
            </tr>
            <tr>
              <td class="headingRow" colspan="6">Destination Details</td>
            </tr>
            <tr class="alternateRow">
              <td>City</td>
              <td><input maxlength="132" size="40" name="destinationcity" /></td>
              <td>State</td>
              <td colspan="3"><input maxlength="2" size="2" name="destinationstate" /></td>
            </tr>
            <tr>
              <td class="headingRow" colspan="6">Delivery Info - <i>MM/DD/YYYY</i></td>
            </tr>
            <tr class="alternateRow">
              <td>Ship Date</td>
              <td><input maxlength="10" size="10" name="dateship" /></td>
              <td>Delivery Date</td>
              <td><input maxlength="10" size="10" name="datedelivery" /></td>
              <td>Post Date</td>
              <td><input maxlength="10" size="10" name="datepost" /></td>
            </tr>
            <tr>
              <td class="headingRow" colspan="1">Description</td>
              <td class="headingRow" colspan="5"><textarea name="comments" cols="80" rows="5"></textarea></td>
            </tr>
          </table>
          <input value="Submit" name="submit" type="submit" />
        </form>
      </div>
    </div>
  </body>
</html>
