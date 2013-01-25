<?php
    $pattern='/(\d{1,3}.?\d{0,3})\s([a-zA-Z]{2,30})\s([a-zA-Z]{2,15})/';
    preg_match($pattern, "200 east st. Warrenville, Il", $matches );
    echo "</br>A match was found</br>";
    echo "<br>matches " . $matches;
    echo "<br>matches[0] " . $matches[0];
    echo "<br>matches[1] " . $matches[1];
    echo "<br>matches[2] " . $matches[2];
    echo "<br>matches[3] " . $matches[3];
?>
