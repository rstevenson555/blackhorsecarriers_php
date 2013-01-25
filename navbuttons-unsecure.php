<div id="navcontainer">
<ul id="navlist">
  <li> <a href="/index.php"
 style="padding-top: 13px; padding-bottom: 13px;">Home</a>
  </li>
  <li> <a href="/generaloffices.php"
 style="padding-top: 13px; padding-bottom: 13px;">General
Offices</a> </li>
  <li> <a href="/history.php"
 style="padding-top: 13px; padding-bottom: 13px;">History</a>
  </li>
  <li> <a href="https://www.blackhorsecarriers.com/application.php"
 style="padding-top: 13px; padding-bottom: 13px;">Driver
Application</a> </li>
  <li> <a href="/fleetreplacement.php"
 style="padding-top: 13px; padding-bottom: 13px;">Fleet
Replacement</a> </li>
  <li> <a href="/leasing.php"
 style="padding-top: 13px; padding-bottom: 13px;">Leasing</a>
  </li>
  <li> <a href="/drivingforce.php"
 style="padding-top: 13px; padding-bottom: 13px;">Driving
Force</a> </li>
  <li> <a href="/bhcnews.php"
 style="padding-top: 13px; padding-bottom: 13px;">BHC News</a>
  </li>
</ul>
</div><?php 
    session_start(); 
    if ( $_SESSION['auth'] == 'true') { 
        echo '<img style="border: 0px solid ; width: 102px; height: 48px;" alt="Company Store" src="images/companystore.png"><a href="safety.php"><img style="border: 0px solid ; width: 102px; height: 48px;" alt="safety recognition" src="images/safetyrecognition.png"></a><a href="benefits.php"><img style="border: 0px solid ; width: 102px; height: 48px;" alt="driver benefits" src="images/driverbenefits.png"></a>'; 
    } ?>
      </td>
