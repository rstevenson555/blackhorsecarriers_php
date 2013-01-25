<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
  <head>
    <meta name="generator" content=
    "HTML Tidy for Mac OS (BBTidy vers 1st December 2002), see www.w3.org">
    <meta http-equiv="content-type" content="text/html; charset=iso-8859-1">
    <link type="text/css" rel="stylesheet" href="images/style.css">
    <meta name="author" content="Robert Stevenson">
    <title>Show Users</title>
  </head>
  <body id="normalbody">
    <script type="text/javascript">
        function resetpassword(button) {
           input_box = confirm("Are you sure you want to reset the password for '" + button + "' ? " );
           if ( input_box==true) {
               window.location.href="invalidatepassword.php?username=" + button;
           }
        }
        function deleteuser(button) {
           input_box = confirm("Are you sure you want to delete the user '" + button + "' ? " );
           if ( input_box==true) {
               window.location.href="deleteuser.php?username=" + button;
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
      <div id="dummy">
        <?php
        if ( !isset($_COOKIE['ID_bhc']))  {
            die("You must <a href=\"login.php\">login</a> to proceed");
        }
            
        // Connects to your Database
        mysql_connect("www.blackhorsecarriers.com", "bla120", "favss+ra") or die( mysql_error());
        mysql_select_db("bla120") or die(mysql_error());
        $results = mysql_query("SELECT * from users") or die(mysql_error());
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
                      <td>User</td>
                      <td>Role</td>
                      <td>Email Address</td>
                      <td>Password</td>
                      <td>Reset Password</td>
                      <td>Delete User</td>
                    </tr>
                  </thead>
                  <tbody class="scrollContent bodyFormat">
                    <?php
                    // ROLE
                    // 1 - SUPERUSER
                    // 2 - BROKER
                    // 3 - BLACKHORSDEUSER
                    define("SUPERUSER",1);
                    define("BROKER",2);
                    define("BLACKHORSEUSER",3);

                    // boolean
                    define("TRUE",1);
                    define("FALSE",0);
                        
                    $counter = 0;
                    while ($row = mysql_fetch_assoc($results)) {
                        if ( $counter % 2 == 0) {
                            echo "<tr class=\"alternateRow\" align=\"left\">\n";
                        } else {
                            echo "<tr class=\"standardRow\" align=\"left\">\n";
                        }
                        $counter = $counter + 1;
                        echo "    <td class=\"loaditem\" width=\"40\" align=\"left\">\n";
                        echo "        " . $row['username'];
                        echo "    </td>\n";

                        $role = $row['role'];
                        if ( $role == SUPERUSER) {
                            $role = 'administrator';
                        } elseif ( $role == BROKER) {
                            $role = 'broker';
                        } elseif ( $role == BLACKHORSEUSER ) {
                            $role = 'blackhorse';
                        }

                        echo "    <td class=\"loaditem\" width=\"60\" align=\"left\">\n";
                        echo "        " . $role;
                        echo "    </td>\n";
                        echo "    <td class=\"loaditem\" width=\"60\" align=\"left\">\n";
                        echo "        " . $row['emailaddress'];
                        echo "    </td>\n";
                        echo "    <td class=\"loaditem\" width=\"60\" align=\"left\">\n";
                        if ( $row['invalid'] == FALSE) {
                            echo "       valid password\n";
                        } elseif ($row['invalid'] == TRUE) {
                            echo "       <i>expired password</i>\n";
                        } else {
                            echo "       unknown\n";
                        }
                        //echo "        " . $row['emailaddress'];
                        echo "    </td>\n";
                        echo "    <td class=\"loaditem\" width=\"60\" align=\"left\">\n";
                        echo "        <input type=\"button\" name=\"resetpassword\" value=\"reset password\" onclick=\"resetpassword('" . $row['username'] . "')\">\n";
                        echo "    </td>\n";
                        echo "    <td class=\"loaditem\" width=\"60\" align=\"left\">\n";
                        echo "        <input type=\"button\" name=\"deleteuser\" value=\"delete user\" onclick=\"deleteuser('" . $row['username'] . "')\">\n";
                        echo "    </td>\n";
                        echo "</tr>\n";
                        }

                        if ( $_COOKIE['role_bhc']!=BROKER)  {
                            echo "<tr>\n";
                            echo "<td class=\"loaditem\" colspan=\"3\"><a href=\"registration.php\">Register New User</a></td>\n";
                            echo "<td class=\"loaditem\" colspan=\"1\"><a href=\"displayloads.php\">Show Loads</a></td>\n";
                            echo "</tr>\n";

                        }
                    ?>
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
