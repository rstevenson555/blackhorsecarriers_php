<?php

//Checks if there is a login cookie
if(isset($_COOKIE['ID_bhc']))
//if there is, it logs you in and directes you to the members page
{
    $username = $_COOKIE['ID_bhc'];
    $pass = $_COOKIE['Key_bhc'];

    // Connects to your Database
    mysql_connect("www.blackhorsecarriers.com", "bla120", "favss+ra") or die(mysql_error());
    mysql_select_db("bla120") or die(mysql_error());

    $check = mysql_query("SELECT * FROM users WHERE username = '$username'")
        or die(mysql_error());
    while($info = mysql_fetch_array( $check ))
    {
        if ($pass != $info['password'])
        {
        }
        else
        {
            //$_SESSION['username'] = $username;
            //echo $_SESSION['username'];
            //SetCookie("ID_bhc", $username, $expire);
            header("Location: displayloads.php");

        }
    }
} 


//if the login form is submitted
if (isset($_POST['submit'])) { // if form has been submitted

    // makes sure they filled it in
    if(!$_POST['username'] | !$_POST['pass']) {
        die('You did not fill in a required field.');
    }
    // checks it against the database

    if (!get_magic_quotes_gpc()) {
        $_POST['email'] = addslashes($_POST['email']);
    }

    // Connects to your Database
    mysql_connect("www.blackhorsecarriers.com", "bla120", "favss+ra") or die(mysql_error());
    mysql_select_db("bla120") or die(mysql_error());

    $check = mysql_query("SELECT * FROM users WHERE username = '".$_POST['username']."'")
        or die(mysql_error());

    //Gives error if user dosen't exist
    $check2 = mysql_num_rows($check);
    if ($check2 == 0) {
        die('That user does not exist in our database.
            <a href=registration.php>Click Here to Register</a>');
    }

    define("TRUE",1);
    define("FALSE",0);

    while($info = mysql_fetch_array( $check ))
    {
        if ( $info['invalid'] == TRUE) {
            die("Your password has expired, please set your new password.
            <a href=resetPassword.php>Reset Password</a>");
        }
        $_POST['pass'] = stripslashes($_POST['pass']);
        $info['password'] = stripslashes($info['password']);

        //gives error if the password is wrong
        if (md5($_POST['pass']) != $info['password']) {
            die('Incorrect password, please try again.
               <a href=login.php>Login</a>');
        }
        else
        {
            define( DAYINSECONDS, 86400);

            // if login is ok then we add a cookie
            $_POST['username'] = stripslashes($_POST['username']);
            $expire = time() + DAYINSECONDS;
            //echo "<br>" . time() ."</br>";
            //echo "<br>" . $expire . "</br>";
            SetCookie("ID_bhc", $_POST['username'], $expire);
            SetCookie("Key_bhc", $_POST['pass'], $expire);
            SetCookie("role_bhc", $info['role'], $expire);
   
            //then redirect them to the members area
            //$_SESSION['username'] = $_POST['username'];
            header("Location: displayloads.php");
        }
    }
}
?>

