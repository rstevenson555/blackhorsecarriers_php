<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html >
  <head>
    <meta name="generator"
    content="HTML Tidy for Mac OS (BBTidy vers 1st December 2002), see www.w3.org" />
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <link href="images/style.css" rel="stylesheet" type="text/css" />
    <meta name="author" content="Robert Stevenson" />
    <title>Add New Terminal</title>
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
 <?php
    if ( !isset($_COOKIE['ID_bhc']))  {
        die("You must <a href=\"login.php\">login</a> to proceed");
    }
    if ( $_COOKIE['role_bhc']=="2")  {
         die("You don't have permission to proceed, check <a href=\"displayloads.php\">displayloads</a>");
     }
    
?>    
        <form font-family:="" target="_self" onsubmit="javascript:submitForm();"
        method="post" action="addterminaldetails.php" name="load">
          <table>
            <tr>
              <td class="headingRow" colspan="6">Terminal Info</td>
            </tr>
            <tr class="alternateRow">
              <td>Terminal Name</td>
              <td><input maxlength="132" size="40" name="terminalname" /></td>
              <td>Terminal Manager</td>
              <td colspan="3">
                  <input maxlength="30" size="30" name="manager"/>
              </td>
            </tr>
            <tr>
              <td class="headingRow" colspan="6">Terminal Address</td>
            </tr>
            <tr class="alternateRow">
              <td>City</td>
              <td><input maxlength="132" size="40" name="city" /></td>
              <td>State</td>
              <td><input maxlength="2" size="2" name="state" /></td>
              <td>Zip</td>
              <td colspan="r"><input maxlength="6" size="6" name="zip" /></td>
            </tr>
            <tr class="alternateRow">
              <td>Phone</td>
              <td colspan="5"><input maxlength="12" size="12" name="phone" /></td>
            </tr>
          </table>
          <input value="Submit" name="submit" type="submit" />
        </form>
      </div>
    </div>
  </body>
</html>
