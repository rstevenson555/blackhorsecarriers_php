<html>
  <head>
    <meta name="generator" content=
    "HTML Tidy for Mac OS (BBTidy vers 1st December 2002), see www.w3.org">

    <title>Login</title>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <link href="images/style.css" rel="stylesheet" type="text/css">
    <meta content="Robert Stevenson" name="author">
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
        <form action="loginAction.php" method="post">
          <table border="0">
            <tr>
              <td colspan="2">
                <h1>Login</h1>
              </td>
            </tr>

            <tr>
              <td>Username:</td>

              <td><input type="text" name="username" maxlength="40"></td>
            </tr>

            <tr>
              <td>Password:</td>

              <td><input type="password" name="pass" maxlength="50"></td>
            </tr>

            <?php

                define("SUPERUSER",1);
                define("BROKER",2);
                define("BLACKHORSEUSER",3);
                
                // 1 = administrator
                if ( $_COOKIE['role_bhc']!= SUPERUSER && isset($_COOKIE['role_bhc']) )  {

                    echo "<tr>\n";
                    echo "<td><a href=\"registration.php\">Register New User</a></td>\n";
                    echo "</tr>\n";
                }
            ?>

            <tr>
              <td>
              </td>
            </tr>

            <tr>
              <td colspan="2" align="right"><input type="submit" name="submit" value=
              "Login"></td>
            </tr>
          </table>
        </form>
      </div>
    </div>
  </body>
</html>

