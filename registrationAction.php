<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
  <head>
    <meta name="generator" content=
    "HTML Tidy for Mac OS (BBTidy vers 1st December 2002), see www.w3.org">

    <title>Register New User</title>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <link href="images/style.css" rel="stylesheet" type="text/css">
    <meta content="Robert Stevenson" name="author">
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

<?php
    session_start();
    
    // Connects to your Database
    mysql_connect("www.blackhorsecarriers.com", "bla120", "favss+ra") or die(mysql_error());
    mysql_select_db("bla120") or die(mysql_error());

    //This makes sure they did not leave any fields blank
    if (!$_POST['username'] | !$_POST['pass'] | !$_POST['pass2'] ) {
        die('You did not complete all of the required fields');
    }

    // checks if the username is in use
    if (!get_magic_quotes_gpc()) {
        $_POST['username'] = addslashes($_POST['username']);
    }
    $usercheck = $_POST['username'];
    $check = mysql_query("SELECT username FROM users WHERE username = '$usercheck'")
        or die(mysql_error());
    $check2 = mysql_num_rows($check);

    //if the name exists it gives an error
    if ($check2 != 0) {
        die('Sorry, the username '.$_POST['username'].' is already in use.');
    }

    // this makes sure both passwords entered match
    if ($_POST['newpass'] != $_POST['newpass2']) {
        die('Your passwords did not match.'); }

    // here we encrypt the password and add slashes if needed
    $_POST['pass'] = md5($_POST['pass2']);
    if (!get_magic_quotes_gpc()) {
        $_POST['pass'] = addslashes($_POST['pass']);
        $_POST['username'] = addslashes($_POST['username']);
    }

    // 1 = superuser
    // 2 = Broker
    // 3 = blackhorse user
    // 
    define("SUPERUSER",1);
    define("BROKER",2);
    define("BLACKHORSEUSER",3);

    $role = BLACKHORSEUSER;
    if ( $_POST['role']=="broker") {
        $role = BROKER;
    }

    if ( $_POST['role'] == "blackhorse") {
        $role = BLACKHORSEUSER;
    }

    // now we insert it into the database
    $insert = "INSERT INTO users (username, password, role,emailaddress,invalid) VALUES ('" . $_POST['username'] . "', '" . $_POST['pass'] . "'," . $role . ",'" . $_POST['email'] . "',0)";
    
    //echo $insert;
    //echo $insert . "<br/>";
    $add_member = mysql_query($insert) 
        or die(mysql_error());

    $_SESSION['username'] = $_POST['username']; 

    mysql_free_result( $add_member );
?>

    <h1>User Registered</h1>

    <p>New User registered</p>
    <hr/>
    <a href="registration.php">Register another user</a> 
    <br/>
    <br/>
    <a href="displayloads.php">Show all Loads</a> 
  </body>
</html>

