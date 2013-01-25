<?php
?>
    <div id="navcontainer">
<ul id="navlist">
  <li> <a id="home" href="/index.php" style="padding-top: 3px; padding-bottom: 3px;">Home</a>
  </li>
  <li> <a id="general" href="/generaloffices.php" style="padding-top: 3px; padding-bottom: 3px;">General
Offices</a> </li>
  <li> <a id="history" href="/history.php" style="padding-top: 3px; padding-bottom: 3px;">History</a>
  </li>
  <li> <a id="application" href="https://mmm2607.sbc-webhosting.com/bla120/application.php" style="padding-top: 3px; padding-bottom: 3px;">Driver
Application</a> </li>
  <li> <a id="fleet" href="/fleetreplacement.php" style="padding-top: 3px; padding-bottom: 3px;">Fleet
Replacement</a> </li>
  <li> <a id="leasing" href="/leasing.php" style="padding-top: 3px; padding-bottom: 3px;" >Leasing</a>
  </li>
  <li> <a id="driving" href="/drivingforce.php" style="padding-top: 3px; padding-bottom: 3px;">Driving
Force</a> </li>
  <li> <a id="news" href="/bhcnews.php" style="padding-top: 3px; padding-bottom: 3px;">BHC News</a>
  </li>
</ul>
</div><?php 
    //if ( isset($_SESSION['username'])) { 
    if ( isset($_COOKIE['ID_bhc'])) { 
        //echo "username : " . $_SESSION['username']. "<br/>";
        //echo '<img style="border: 0px solid ; width: 102px; height: 48px;" alt="Company Store" src="images/companystore.png"><a href="safety.php"><img style="border: 0px solid ; width: 102px; height: 48px;" alt="safety recognition" src="images/safetyrecognition.png"></a><a href="benefits.php"><img style="border: 0px solid ; width: 102px; height: 48px;" alt="driver benefits" src="images/driverbenefits.png"></a>'; 
    } ?>

