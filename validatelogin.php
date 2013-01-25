<?php 
    session_start();

    $_SESSION['auth'] = "false";
    $username = $_POST['username']; 

    if ($username == 'bob' || $username=='terri' || $username=='gerry') { 
        $_SESSION['user'] = $username;
        $_SESSION['auth'] = 'true';
        header('location:bhcnews.php'); 
    } else {
        header('location:loginfailed.html'); 
    }
?>
