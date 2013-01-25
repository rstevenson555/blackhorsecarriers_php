<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">

<html>
  <head>
    <meta name="generator" content=
    "HTML Tidy for Mac OS (BBTidy vers 1st December 2002), see www.w3.org">

    <title>Register New User</title>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <link href="images/style.css" rel="stylesheet" type="text/css">
    <meta content="Robert Stevenson" name="author">
    <script type="text/javascript" src="images/jquery-1.1.3.pack.js"></script>
    <script type="text/javascript">
        $(document).ready(function(){
            //$("a").click(function() {
                //$(this).hide("slow");

                //alert("Hello world!");
            //})
        });
    </script>
  </head>

  <body id="normalbody">
    <div id="page_wrapper">
      <div id="header_wrapper">
        <div id="header"> 
          <div id="logoheader" class="column">
            <a href="index.php"><img src="images/image001.png" alt="logo" align="top"
            border="0" style="margin-right: 25px;"></a> <img src=
            "images/7-Tractorsfacing-Left.png" alt="trucks" align="top" border="0">
          </div> 
        </div> 
        <?php include 'navbuttons.php' ?>
      </div>

      <div id="main">
      <?php

      define("SUPERUSER",1);
      define("BROKER",2);
      define("BLACKHORSEUSER",3);
          
      if ( !isset($_COOKIE['ID_bhc']))  {
          die("You must <a href=\"login.php\">login</a> to proceed");
      }
      if ( $_COOKIE['role_bhc']==BROKER)  {
           die("You don't have permission to proceed, check <a href=\"displayloads.php\">displayloads</a>");
       }
?>    
        <form action="registrationAction.php" method="post">
          <table border="0">
            <tr>
              <td colspan="2">
                <h1>Register New User</h1>
              </td>
            </tr>

            <tr>
              <td>Username:</td>

              <td><input type="text" name="username" maxlength="60"></td>
            </tr>

            <tr>
              <td>Password:</td>

              <td><input type="password" name="pass" maxlength="10"></td>
            </tr>

            <tr>
              <td>Confirm Password:</td>

              <td><input type="password" name="pass2" maxlength="10"></td>
            </tr>

            <tr>
              <td>Email Address:</td>

              <td><input type="text" name="email" maxlength="50"></td>
            </tr>

            <tr>
               <td>Role:</td>
               <td>
               <input type="radio" name="role" value="blackhorse" checked="true">Blackhorse User
               <input type="radio" name="role" value="broker">Broker
               </td>
            </tr>

            <!-- <tr>
                <td>
                <a href="showusers.php">Show All Users</a>
                </td>
            </tr> -->

            <tr>
              <th colspan="2" align="right"><input type="submit" name="submit" value=
              "Register"></th>
            </tr>
          </table>
        </form>
      </div>
    </div>
  </body>
</html>

