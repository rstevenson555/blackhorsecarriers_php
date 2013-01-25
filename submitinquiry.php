<?php
require_once "lib/Swift.php";
require_once "lib/Swift/Connection/NativeMail.php"; //There are various connections to use

$swift =& new Swift(new Swift_Connection_NativeMail());

if (!isset($_POST['email'])){
    $from = "dave@blackhorsecarriers.com";
} else {
    $from = $_POST['email'];
}
//$to = "dave@blackhorsecarriers.com";
$to = "terri@blackhorsecarriers.com";
$subject = "Customer Inquiry";
$body = "";

$body = $body . "Name: " . $_POST['name'] . "\n";
$body = $body . "Company: " . $_POST['company'] . "\n";
$body = $body . "Address: " . $_POST['address'] . "\n";
$body = $body . "City: " . $_POST['city'] . "\n";
$body = $body . "State: " . $_POST['state'] . "\n";
$body = $body . "Zip: " . $_POST['zip'] . "\n";

$body = $body . "Phone: " . $_POST['phone'] . "\n";
$body = $body . "Email: " . $_POST['email'] . "\n";
$body = $body . "Interest: " . $_POST['interest'] . "\n";
$body = $body . "Callback Time: " . $_POST['callback'] . "\n";
$body = $body . "Comments: " . $_POST['comments'] . "\n";

$message =& new Swift_Message($subject,$body);

#$message->attach(new Swift_Message_Part($body));

if ( $swift->send($message,$to,$from)) {
    header( 'Location: http://www.blackhorsecarriers.com/index.php' ) ;
} else {
    echo("<p>Word Message delivery failed...</p>");
}

?>
