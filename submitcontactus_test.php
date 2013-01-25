<?php
require_once "lib/Swift.php";
require_once "lib/Swift/Connection/NativeMail.php"; //There are various connections to use
require_once "lib/Swift/Connection/SMTP.php"; //There are various connections to use


//$swift =& new Swift(new Swift_Connection_NativeMail());
$swift =& new Swift(new Swift_Connection_SMTP("mx1.blackhorsecarriers.com"));


if (!isset($_POST['email'])){
    $from = "dave@blackhorsecarriers.com";
} else {
    $from = $_POST['email'];
}
//$to = "dave@blackhorsecarriers.com";
//$to = "info@blackhorsecarriers.com";
$to = "rstevenson555@comcast.net";
$subject = "Contact Us";
$body = "";

$body = $body . "Name: " . $_POST['name'] . "\n";

$body = $body . "Email: " . $_POST['email'] . "\n";
$body = $body . "Comments: " . $_POST['comments'] . "\n";

$message =& new Swift_Message($subject,$body);

#$message->attach(new Swift_Message_Part($body));

if ( $swift->send($message,$to,$from)) {
    header( 'Location: http://www.blackhorsecarriers.com/index.php' ) ;
} else {
    echo("<p>Word Message delivery failed...</p>");
}

?>
