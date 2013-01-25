<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<?php
header("Expires:");
    header("Cache-Control:");
    header("Pragma:");
    header("Last-Modified:");

session_start();
?>
<html>
    <head>
        <title>Application Error</title>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <link href="images/style.css" rel="stylesheet" type="text/css">
        <meta content="Robert Stevenson" name="author">
        <link type="text/css" rel="stylesheet"
              href="css/style-mock2.css" />
        <link type="text/css" rel="stylesheet"
              href="css/highline_nav.css" />
        <link type="text/css" rel="stylesheet"
              href="css/nav.css" />
        <meta content="Robert Stevenson" name="author">
                    <?php include "script_head.php" ?>

    </head>

    <?php include 'utils.php' ?>
    <?php include 'locations.php' ?>

    <body id="normalbody">
        <div id="page_wrapper">
            <div id="main">
                <?php include 'navigation.php' ?>

                <div class="bodyText" style="margin-top:20px;">
                    <p><font size="2"><b>
                                <?php
                                //$error = $_SESSION['ERROR'];
                                //echo "Error " . $error;
                                echo "<p>" . $_REQUEST['error'] . "</p>";
                                ?>
                            </b></font><br/>&nbsp;</p>
                </div>
                <!--<FORM><INPUT type=button value=" Back " onClick="history.back();"></FORM> -->

            </div>
        </div>
        iew();
            } catch(err) {}</script>
    </body>
</html>

