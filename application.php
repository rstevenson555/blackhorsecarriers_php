<?php
session_start();

function get_locations() {

    require("phpsqlsearch_dbinfo.php");

// Opens a connection to a mySQL server
    $connection = mysql_connect("www.blackhorsecarriers.com", $username, $password);
    if (!$connection) {
        die("Not connected : " . mysql_error());
    }

// Set the active mySQL database
    $db_selected = mysql_select_db($database, $connection);
    if (!$db_selected) {
        die("Can\'t use db : " . mysql_error());
    }

// Search the rows in the markers table
    $query = "SELECT name from markers";

    $result = mysql_query($query);

    if (!$result) {
        die("Invalid query: " . mysql_error());
    }

    return $result;
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
    <head>
        <title>Black Horse Carriers Inc.,Employment Application</title>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">

        <link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.8/themes/base/jquery.ui.all.css" type="text/css" media="all"/>

        <link type="text/css" rel="stylesheet"
              href="css/style-mock2.css" />
        <link type="text/css" rel="stylesheet"
              href="css/highline_nav.css" />
        <link type="text/css" rel="stylesheet"
              href="css/nav.css" />

        <meta content="Robert Stevenson" name="author">
        <?php include "script_head.php" ?>

    </head>


    <?php include 'locations.php' ?>
    <body id="normalbody">
    <style type="text/css">
        .appl_inputs {
            background-color: #E7E7BA;
        }
        .redstar {
            color: red;
            size: -1;
        }
    </style>
    <script type="text/javascript">
        var initlist = [];
        function areYouSure(form)
        {
            var answer = confirm("Are you sure you want to continue?")
            if (answer){   
                document.forms["application"].submit();
            }
        }
        function confirm(form)
        {
            //var answer = confirm("Are you sure you want to continue?")
            //if (answer){   
            document.forms["application"].submit();
            //}
        }
    </script>

    <div id="page_wrapper">
        <div id="main">
            <?php include 'navigation.php' ?>
            <script  src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.8.18/jquery-ui.min.js" type="text/javascript"></script>


            <?php
            $form_token = uniqid();
            /*             * * add the form token to the session ** */
            $_SESSION['form_token'] = $form_token;

// return session variables
            function sv($name) {
                return !isset($_SESSION[$name]) ? "" : $_SESSION[$name];
            }
            ?>

            <div style="margin-top:20px;">
                <b>*Note: Fill in all applicable information before you hit Submit.  Click Submit only once.</b>
                <br/>

                <?php
                $test = '';
                if (isset($_GET['test'])) {
                    $test = $_GET['test'];
                }
                if ($test === 'true') {
                    ?>
                    <form enctype="multipart/form-data" style="" target="_self"  onsubmit="javascript:confirm();" 
                          method="post" action="https://www.blackhorsecarriers.com/applicationpost.php?test=true" name="application">
                          <?php } else {
                              ?>
                        <form enctype="multipart/form-data" style="" target="_self" onsubmit="javascript:areYouSure();" 
                              method="post" action="https://www.blackhorsecarriers.com/applicationpost.php" name="application">
                              <?php } ?>


                        <div class="bodyText">
                            <table style="font-size:10pt;width: 100%;" border="0" cellpadding="2" cellspacing="0">

                                <tbody>
                                    <tr class="dotUnder">

                                        <td valign="top" width="100"><font size="-1">First Name:</font><font class="redstar">*</font> </td>

                                        <td style="width: 322px;" valign="top"> <font size="-1">
                                                <input type="text" class="appl_inputs" name="Fname" value="<?php echo sv('Fname'); ?>" size="30" type="text"></font> </td>

                                        <td style="width: 117px;" valign="top"><font size="-1">Last
                                                Name:</font><font class="redstar">*</font>
                                        </td>


                                        <td style="width: 359px;" colspan="3" valign="top"> <font size="-1">
                                                <input type="text" class="appl_inputs" size="30" name="Lname" value="<?php echo sv('Lname'); ?>" type="text">
                                            </font>
                                        </td>

                                    </tr>

                                    <tr>

                                        <td><font size="-1">Date of Application</font><font class="redstar">*</font> </td>

                                <script type="text/javascript">
                                    initlist.push(function() {
                                        $("#dateof_application").datepicker({ changeMonth: true,changeYear: true, constrainInput: true});
                                    });
                                </script>
                                <td><font size="-1">
                                        <input type="text" class="appl_inputs"  name="dateof_application" id="dateof_application" value="<?php echo date('m/d/Y'); ?>" size="9"></font></td> 

                                <td></td>

                                <td></td>

                                <td></td>

                                <td></td>

                                </tr>

                                <tr>

                                    <td colspan="5">
                                        <div style="text-align: center;"><font size="-1"><span style="font-weight: bold;"><br>

                                                    Black Horse Carriers, Inc.</span><br style="font-weight: bold;">

                                                <span style="font-weight: bold;">150 Village Court</span><br style="font-weight: bold;">

                                                <span style="font-weight: bold;">Carol Stream, Il
                                                    60188</span><br>

                                                <br>

                                            </font> </div>

                                        <div style="text-align: left; margin-left: 40px;"><font size="-1">In
                                                compliance with Federal and State equal employment opportunity laws,
                                                qualified applications are considered for all positions without regard
                                                to race, color, religion, sex, national origin, age, marital status,
                                                veteran status, non-job related disability, or any other protected
                                                group status.<br>

                                                <br>

                                            </font>
                                            <div style="text-align: center;"><font size="-1"><span style="font-weight: bold;">To Be Read And Signed By Applicant<br>

                                                        <br>

                                                    </span></font>
                                                <div style="text-align: left;"><font size="-1"><span style="font-weight: bold;"></span>I
                                                        authorize you to make such investigations and inquiries of my personal,
                                                        employment financial or medical history and other related matters as
                                                        may be necessary in arriving at an employment decision. (Generally,
                                                        inquiries regarding medical history will be made only if and after a
                                                        conditional offer of emplyment has been extended. I hereby release
                                                        employers, schools, health care providers and other persons from all
                                                        liability in responding to inquiries and releasing information in
                                                        connection with my application.<br>

                                                        <br>

                                                        In the event of employment, I understand that false or misleading
                                                        information given in my application or interview(s) may result in
                                                        discharge. I understand, also, that I am required to abide by all rules
                                                        and regulations of Black Horse Carriers, Inc.<br>

                                                        <br>

                                                        I understand that information I provide regarding current and/or
                                                        previous employers may be used, and those employers will be contacted,
                                                        for the purpose of investigating my safety performance history as
                                                        required by 49 CFR 391.23(d) and (e). &nbsp;I understand that I
                                                        have
                                                        the right to:<br>

                                                    </font>
                                                    <ul>

                                                        <li><font size="-1">Review information
                                                                provided by employers;</font></li>

                                                        <li><font size="-1">Have errors in the
                                                                information corrected by
                                                                previous
                                                                employers and for those previous employers to re-send the corrected
                                                                information to the prospective employer; and</font></li>

                                                        <li><font size="-1">Have rebuttal
                                                                statement attached to the alleged
                                                                erroneous
                                                                information, if the previous employer(s) and I cannot agree on the
                                                                accuracy of the information.</font></li>

                                                    </ul>

                                                    <font size="-1">The Information provided in the
                                                        Application for Employment is true,
                                                        correct, and complete. &nbsp;If I am accepted for employment, any
                                                        mistatement or omission of fact on this application or provided in
                                                        any interview may result in my dismissal. &nbsp;I understand that
                                                        this
                                                        Application for Employment and other Company documents are not
                                                        contracts of employment.<br>

                                                        <br>

                                                        I authorize the company to thoroughly investigate my references,
                                                        personal history, work record, and other matters related to my
                                                        suitability for employment. &nbsp;I also release the Company from
                                                        any
                                                        and all claims, demands, or liabilities arising out of or in any way
                                                        related to such investigation or disclosure.<br>

                                                        <br>
                                                        I understand and agree that if I am employed, my employment is for no
                                                        definite period of time and may be terminated at any time, with or
                                                        without prior notice, at the option of either myself or the Company,
                                                        and that no promises or representations contrary to the foregoing are
                                                        binding on the Company unless made in writing and signed by me and the
                                                        Company's President.<br>

                                                        <br>

                                                        <span style="font-weight: bold;"></span></font>
                                                </div>

                                            </div>

                                        </div>

                                    </td>

                                    <td></td>

                                    <td></td>

                                </tr>

                                <tr>

                                    <td><font size="-1">Accept Signature</font><font class="redstar">*</font></td>


                                    <td><font size="-1">
                                            <input type="text" class="appl_inputs" size="45" name="accept_signature" value="<?php echo sv('accept_signature'); ?>"></font></td>

                                    <td><font size="-1">Accept Date</font><font class="redstar">*</font></td>

                                <script type="text/javascript">
                                    initlist.push(function() {
                                        $("#accept_date").datepicker({changeMonth: true,changeYear: true});
                                    });
                                </script>


                                <td><font size="-1">

                                        <input type="text"  class="appl_inputs" name="accept_date" id="accept_date" value="<?php echo date('m/d/Y'); ?>" size="9"/></font></td>

                                <td></td>

                                <td></td>

                                </tr>

                                </tbody>
                            </table>

                            <hr/><br/>

                            <table style="font-size:10pt;width: 100%;" border="0" cellpadding="2" cellspacing="0">

                                <tbody>
                                    <tr class="dotUnder">

                                        <td></td>

                                        <td></td>

                                        <td></td>

                                        <td></td>

                                        <td></td>

                                        <td></td>

                                    </tr>

                                    <tr class="dotUnder">

                                        <td valign="top"><font size="-1">Terminal </font><font class="redstar">*</font></td>

                                        <td style="width: 322px;" valign="top"> <font size="-1">
                                                <!--<input size="30" name="terminal" value="<?php echo sv('terminal'); ?>"> -->
                                                <?php $result = get_locations(); ?>
                                                <?php
                                                $name = "Select";
                                                echo "<select name=\"terminal\">";
                                                echo "<option value=\"" . $name . "\">" . $name . "</option>";

                                                while ($row = @mysql_fetch_assoc($result)) {
                                                    $name = $row['name'];
                                                    $name_pieces = explode(",", $name);
                                                    echo "<option value=\"" . $name . "\">" . $name . "</option>";
                                                }
                                                echo "</select>";
                                                ?> 

                                            </font>
                                        </td>

                                        <td style="width: 117px;" valign="top">
                                        </td>

                                        <td style="width: 359px;" colspan="3" valign="top"> <font size="-1">
                                                <input type="hidden" name="date_of_application" value="<?php echo sv('date_of_application'); ?>"></font> </td>

                                    </tr>

                                    <tr class="dotUnder">

                                        <td valign="top"><font size="-1">Positions applied for:</font><font class="redstar">*</font>
                                        </td>

                                        <td valign="top"> <font size="-1"><input type="text" class="appl_inputs" size="35" name="position_appliedfor" value="<?php echo sv('position_appliedfor'); ?>"><br>

                                            </font> </td>

                                        <td colspan="4" valign="top"><font size="-1">NONE SPECIFIED
                                                <input name="timeapplied" value="applied_none" type="radio" checked="true">AM 
                                                <input name="timeapplied" value="applied_am" type="radio"> PM(SAT) 
                                                <input name="timeapplied" value="applied_pmsat" type="radio"> PM(SUN) 
                                                <input name="timeapplied" value="applied_pmsun" type="radio"> OTR 
                                                <input name="timeapplied" value="applied_otr" type="radio"> EC 
                                                <input name="timeapplied" value="applied_ec" type="radio"> PT 
                                                <input name="timeapplied" value="applied_pt" type="radio">

                                            </font> </td>

                                    </tr>

                                    <tr class="dotUnder">

                                        <td valign="top"><!--<font size="-1">Name: </font><font class="redstar">*</font>-->
                                        </td>

                                        <td style="width: 322px;" valign="top"> <font size="-1">
                                                <input size="30" type="hidden" name="Name" value="<?php echo sv('Name'); ?>"></font>
                                        </td>

                                        <td style="width: 117px;" valign="top"><font size="-1">SSN:</font><font class="redstar">*</font> </td>

                                        <td style="width: 359px;" colspan="3" valign="top"> <font size="-1">
                                                <input type="text" class="appl_inputs" size="3" name="SSN1" maxlength="3" value="<?php echo sv('SSN1'); ?>" type="text">- 
                                                <input type="text" class="appl_inputs" size="2" name="SSN2" maxlength="2" value="<?php echo sv('SSN2'); ?>" type="text">
                                                - <input type="text" class="appl_inputs" size="4" name="SSN3"  maxlength="4" value="<?php echo sv('SSN3'); ?>" type="text"></font> </td>

                                    </tr>

                                    <tr class="dotUnder">

                                        <td valign="top"><font size="-1">Current Address:</font><font class="redstar">*</font>
                                        </td>

                                        <td colspan="3" style="width: 322px;" valign="top"> <font size="-1">
                                                <input type="text" class="appl_inputs" size="75" name="CurrentAddress" value="<?php echo sv('CurrentAddress'); ?>"> <span class="verdana10"></span>&nbsp;<br>

                                            </font> </td>

                                    </tr>
                                    <tr class="dotUnder">

                                        <td valign="top"><font size="-1">City:</font><font class="redstar">*</font>
                                        </td>

                                        <td colspan="2" style=";" valign="top"> <font size="-1">
                                                <input type="text" class="appl_inputs" size="30" name="CurrentCity" value="<?php echo sv('CurrentCity'); ?>"> <span class="verdana10"></span>&nbsp;<br>

                                            </font> </td>

                                    </tr>
                                    <tr class="dotUnder">

                                        <td valign="top"><font size="-1">State:</font><font class="redstar">*</font> </td>

                                        <td colspan="1" style="" valign="top"> <font size="-1">
                                                <!--<input size="2" name="CurrentState" value="<?php echo sv('CurrentState'); ?>"> -->
                                                <select name="CurrentState">
                                                    <option value="" selected>Select</option>
                                                    <option value="AL">Alabama</option>
                                                    <option value="AK">Alaska</option>
                                                    <option value="AZ">Arizona</option>
                                                    <option value="AR">Arkansas</option>
                                                    <option value="CA">California</option>
                                                    <option value="CO">Colorado</option>
                                                    <option value="CT">Connecticut</option>
                                                    <option value="DE">Delaware</option>
                                                    <option value="DC">District of Columbia</option>
                                                    <option value="FL">Florida</option>
                                                    <option value="GA">Georgia</option>
                                                    <option value="HI">Hawaii</option>
                                                    <option value="ID">Idaho</option>
                                                    <option value="IL">Illinois</option>
                                                    <option value="IN">Indiana</option>
                                                    <option value="IA">Iowa</option>
                                                    <option value="KS">Kansas</option>
                                                    <option value="KY">Kentucky</option>
                                                    <option value="LA">Louisiana</option>
                                                    <option value="ME">Maine</option>
                                                    <option value="MD">Maryland</option>
                                                    <option value="MA">Massachusetts</option>
                                                    <option value="MI">Michigan</option>
                                                    <option value="MN">Minnesota</option>
                                                    <option value="MS">Mississippi</option>
                                                    <option value="MO">Missouri</option>
                                                    <option value="MT">Montana</option>
                                                    <option value="NE">Nebraska</option>
                                                    <option value="NV">Nevada</option>
                                                    <option value="NH">New Hampshire</option>
                                                    <option value="NJ">New Jersey</option>
                                                    <option value="NM">New Mexico</option>
                                                    <option value="NY">New York</option>
                                                    <option value="NC">North Carolina</option>
                                                    <option value="ND">North Dakota</option>
                                                    <option value="OH">Ohio</option>
                                                    <option value="OK">Oklahoma</option>
                                                    <option value="OR">Oregon</option>
                                                    <option value="PA">Pennsylvania</option>
                                                    <option value="RI">Rhode Island</option>
                                                    <option value="SC">South Carolina</option>
                                                    <option value="SD">South Dakota</option>
                                                    <option value="TN">Tennessee</option>
                                                    <option value="TX">Texas</option>
                                                    <option value="UT">Utah</option>
                                                    <option value="VT">Vermont</option>
                                                    <option value="VA">Virginia</option>
                                                    <option value="WA">Washington</option>
                                                    <option value="WV">West Virginia</option>
                                                    <option value="WI">Wisconsin</option>
                                                    <option value="WY">Wyoming</option>
                                                </select>
                                                <span class="verdana10"></span>&nbsp;<br></font> </td>

                                        <td valign="top"><font size="-1">Zip:</font><font class="redstar">*</font> </td>
                                        <td colspan="1" style="" valign="top"> <font size="-1">
                                                <input type="text" class="appl_inputs" size="9" name="CurrentZip" value="<?php echo sv('CurrentZip'); ?>"> <span class="verdana10"></span>&nbsp;<br>
                                            </font> </td>

                                    </tr>

                                    <tr>

                                        <td><font size="-1">Previous Address:</font></td>

                                        <td colspan="3"><font size="-1">
                                                <input type="text" class="appl_inputs" size="75" name="PreviousAddress" value="<?php echo sv('PreviousAddress'); ?>"></font></td>

                                    </tr>
                                    <tr>

                                        <td><font size="-1">City:</font></td>

                                        <td colspan="2"><font size="-1">
                                                <input type="text" class="appl_inputs" size="35" name="PreviousCity" value="<?php echo sv('PreviousCity'); ?>"></font></td>

                                    </tr>
                                    <tr>

                                        <td><font size="-1">State:</font></td>

                                        <td colspan="1"><font size="-1">
                                               <!-- <input size="2" name="PreviousState" value="<?php echo sv('PreviousState'); ?>">-->
                                                <select name="PreviousState">
                                                    <option value="" selected>Select</option>
                                                    <option value="AL">Alabama</option>
                                                    <option value="AK">Alaska</option>
                                                    <option value="AZ">Arizona</option>
                                                    <option value="AR">Arkansas</option>
                                                    <option value="CA">California</option>
                                                    <option value="CO">Colorado</option>
                                                    <option value="CT">Connecticut</option>
                                                    <option value="DE">Delaware</option>
                                                    <option value="DC">District of Columbia</option>
                                                    <option value="FL">Florida</option>
                                                    <option value="GA">Georgia</option>
                                                    <option value="HI">Hawaii</option>
                                                    <option value="ID">Idaho</option>
                                                    <option value="IL">Illinois</option>
                                                    <option value="IN">Indiana</option>
                                                    <option value="IA">Iowa</option>
                                                    <option value="KS">Kansas</option>
                                                    <option value="KY">Kentucky</option>
                                                    <option value="LA">Louisiana</option>
                                                    <option value="ME">Maine</option>
                                                    <option value="MD">Maryland</option>
                                                    <option value="MA">Massachusetts</option>
                                                    <option value="MI">Michigan</option>
                                                    <option value="MN">Minnesota</option>
                                                    <option value="MS">Mississippi</option>
                                                    <option value="MO">Missouri</option>
                                                    <option value="MT">Montana</option>
                                                    <option value="NE">Nebraska</option>
                                                    <option value="NV">Nevada</option>
                                                    <option value="NH">New Hampshire</option>
                                                    <option value="NJ">New Jersey</option>
                                                    <option value="NM">New Mexico</option>
                                                    <option value="NY">New York</option>
                                                    <option value="NC">North Carolina</option>
                                                    <option value="ND">North Dakota</option>
                                                    <option value="OH">Ohio</option>
                                                    <option value="OK">Oklahoma</option>
                                                    <option value="OR">Oregon</option>
                                                    <option value="PA">Pennsylvania</option>
                                                    <option value="RI">Rhode Island</option>
                                                    <option value="SC">South Carolina</option>
                                                    <option value="SD">South Dakota</option>
                                                    <option value="TN">Tennessee</option>
                                                    <option value="TX">Texas</option>
                                                    <option value="UT">Utah</option>
                                                    <option value="VT">Vermont</option>
                                                    <option value="VA">Virginia</option>
                                                    <option value="WA">Washington</option>
                                                    <option value="WV">West Virginia</option>
                                                    <option value="WI">Wisconsin</option>
                                                    <option value="WY">Wyoming</option>
                                                </select>
                                            </font></td>

                                        <td><font size="-1">Zip:</font></td>

                                        <td colspan="1"><font size="-1">
                                                <input type="text" class="appl_inputs" size="9" name="PreviousZip" value="<?php echo sv('PreviousZip'); ?>"></font></td>

                                    </tr>

                                    <tr>

                                        <td><font size="-1">Home phone number:</font></td>

                                        <td><font size="-1"><input type="text" class="appl_inputs" name="home_phone_number" value="<?php echo sv('home_phone_number'); ?>"></font></td>

                                        <td><font size="-1">Cell Phone<br>

                                                Other Phone</font></td>

                                        <td><font size="-1"><input type="text" class="appl_inputs" name="cell_phone_number" value="<?php echo sv('cell_phone_number'); ?>"><br>

                                                <input type="text" class="appl_inputs" name="other_phone_number" value="<?php echo sv('other_phone_number'); ?>"></font> </td>

                                    </tr>

                                    <tr class="dotUnder">

                                        <td valign="top"><font size="-1">Do
                                                you have the right to work in
                                                the United States?<br>

                                            </font> </td>

                                        <td style="width: 322px;" valign="top"><font size="-1"> Yes 
                                                <input type="radio" class="appl_inputs" name="usa" value="usa_yes">
                                                No <input type="radio" class="appl_inputs" name="usa" value="usa_no" checked="true"><br>

                                            </font> </td>

                                        <td style="width: 117px;" valign="top"><font size="-1">Date of Birth:</font><font class="redstar">*</font>
                                        </td>

                                <script type="text/javascript">
                                    initlist.push(function() {
                                        $("#dob").datepicker({changeMonth: true,changeYear: true});
                                    });
                                </script>

                                <td style="width: 359px;" valign="top"> <font size="-1">

                                        <input type="text"  class="appl_inputs" name="dob" id="dob" value="<?php echo sv('dob'); ?>" size="9" type="text">    
                                        <input type="text" class="appl_inputs" name="DOBday" id="DOBday" type="hidden">
                                        <input type="text" class="appl_inputs" name="DOByear" id="DOByear" type="hidden">

                                    </font> </td>

                                </tr>

                                <tr>

                                    <td><font size="-1">Have you worked for this
                                            company before?</font></td>

                                    <td><font size="-1">Yes <input name="thiscompany" value="thiscompany_yes" type="radio">
                                            No <input name="thiscompany" value="thiscompany_no" type="radio" checked="true"></font></td>

                                    <td><font size="-1">Date of employment</font></td>

                                <script type="text/javascript">
                                    initlist.push(function() {
                                        $("#date_employment").datepicker({changeMonth: true,changeYear: true  });
                                        $("#to_employment").datepicker({changeMonth: true,changeYear: true });
                                    });
                                </script>
                                <td><font size="-1"><input type="text"  class="appl_inputs" name="date_employment" id="date_employment" value="<?php echo sv('date_employment'); ?>" size="9"> to<br>

                                        <input type="text"  class="appl_inputs" name="to_employment" id="to_employment" value="<?php echo sv('to_employment'); ?>" size="9"></font> </td>

                                <td></td>

                                </tr>

                                <tr>

                                    <td><font size="-1">Position held</font></td>

                                    <td><font size="-1">
                                            <input type="text" class="appl_inputs" size="40" name="position_held" value="<?php echo sv('position_held'); ?>"></font></td>

                                    <td><font size="-1">Reason for Leaving</font></td>

                                    <td><font size="-1">
                                            <input type="text" class="appl_inputs" maxlength="132" name="reason_forleaving" value="<?php echo sv('reason_forleaving'); ?>"></font></td>

                                    <td></td>

                                </tr>

                                <tr>

                                    <td><font size="-1">Are you now employed?</font></td>

                                    <td><font size="-1">Yes 
                                            <input name="employed" value="employed_yes" type="radio">
                                            No 
                                            <input name="employed" value="employed_no" type="radio" checked="true"></font></td>

                                    <td><font size="-1">If not how long since
                                            leaving last employment?</font></td>

                                    <td><font size="-1"><input type="text" class="appl_inputs" name="longsinceleaving" value="<?php echo sv('longsinceleaving'); ?>"></font></td>

                                    <td></td>

                                </tr>

                                <tr>

                                    <td colspan="2"><font size="-1">May
                                            we contact your employer at
                                            this time?</font></td>

                                    <td><font size="-1">Yes 
                                            <input name="contact" value="contact_yes" type="radio">
                                            No 
                                            <input name="contact" value="contact_no" type="radio" checked="true"></font></td>

                                    <td></td>

                                    <td></td>

                                </tr>

                                <tr>

                                    <td><font size="-1">Who referred you?</font></td>

                                    <td><font size="-1">
                                            <input type="text" class="appl_inputs" size="35" name="who_referredyou" value="<?php echo sv('who_referredyou'); ?>"></font></td>

                                    <td><font size="-1">Rate of pay expected?</font></td>

                                    <td><font size="-1">
                                            <input type="text" class="appl_inputs" name="rate_payexpected" value="<?php echo sv('rate_payexpected'); ?>"></font></td>

                                    <td></td>

                                </tr>

                                <tr>

                                    <td><font size="-1">Have you ever been
                                            convicted of a felony?</font></td>

                                    <td><font size="-1">Yes 
                                            <input name="felony" value="felony_yes" type="radio">
                                            No 
                                            <input name="felony" value="felony_no" type="radio" checked="true"></font></td>

                                    <td></td>

                                    <td></td>

                                    <td></td>

                                </tr>

                                <tr>

                                    <td colspan="2"><font size="-1">If
                                            yes, please explain fully and
                                            provide dates. Conviction of a crime is not an automatic bar to
                                            employment. All circumstances will be considered.</font></td>

                                    <td colspan="2"><font size="-1">
                                            <textarea class="appl_inputs" cols="45" rows="3" name="felony_reason"></textarea></font></td>

                                    <td></td>

                                </tr>

                                <tr>

                                    <td colspan="2"><font size="-1">If
                                            offered a position with this
                                            company when would you be able to start?</font></td>

                                    <td><font size="-1"><input type="text" class="appl_inputs" name="start_date" value="<?php echo sv('start_date'); ?>"></font></td>

                                    <td></td>

                                    <td></td>

                                </tr>

                                <tr>

                                    <td colspan="2"><font size="-1">Is
                                            there any reason you might be
                                            unable to perform the essential functions of the job with or without
                                            reasonable accommodation for which you have applied (as described in
                                            the attached job description)?</font></td>

                                    <td colspan="2"><font size="-1">Yes 
                                            <input name="perform" value="perform_yes" type="radio">
                                            No <input name="perform" value="perform_no" type="radio" checked="true"></font></td>

                                    <td></td>

                                </tr>

                                <tr>

                                    <td colspan="2"><font size="-1">If
                                            yes, explain if you wish.</font></td>

                                    <td colspan="2"><font size="-1">
                                            <textarea class="appl_inputs" cols="45" rows="3" name="unable_explaination"></textarea></font></td>

                                    <td></td>

                                </tr>

                                <tr>

                                    <td style="text-align: center; font-weight: bold;" colspan="5"><font size="-1"><big><span style="color: rgb(102, 102, 102);"><br>

                                                    Employment History</span></big><br>

                                            <br>

                                        </font>
                                        <div style="text-align: justify;"><font size="-1"><span style="font-weight: normal;">All
                                                    driver applications to
                                                    drive a commercial motor vehicle in interstate or intrastate commerce
                                                    must provide the following information on all employers during the
                                                    preceding 10 years. &nbsp;List complete mailing address, street
                                                    number, city, state and zip code.</span><br style="font-weight: normal;">

                                                <br style="font-weight: normal;">

                                            </font>
                                            <div style="text-align: center;">
                                                <div style="text-align: left;"><font size="-1"><span style="font-weight: normal;">(Please list employers starting
                                                            with the most recent first. &nbsp;Add another sheet if necessary.)</span></font><br>

                                                    <font size="-1"> </font></div>

                                            </div>

                                        </div>

                                    </td>

                                    <td></td>

                                </tr>

                                <tr>

                                    <td style="text-align: center;" colspan="2"><font size="-1"><span style="font-weight: bold;">Employer</span></font></td>

                                    <td style="text-align: center;" colspan="2"><font size="-1"><span style="font-weight: bold;">Date</span></font></td>

                                    <td></td>

                                </tr>

                                <tr>

                                    <td><font size="-1">Name</font><font class="redstar">*</font></td>

                                    <td><font size="-1"><input type="text" class="appl_inputs" size="40" name="emp_name" value="<?php echo sv('emp_name'); ?>"></font></td>

                                <script type="text/javascript">
                                    initlist.push(function() {
                                        $("#emp_from").datepicker({ changeMonth: true,changeYear: true });
                                        $("#emp_to").datepicker({ changeMonth: true,changeYear: true });
                                    });
                                </script>
                                <td><font size="-1">From <font class="redstar">*</font><input type="text"  class="appl_inputs" size="9" id="emp_from" name="emp_from" value="<?php echo sv('emp_from'); ?>"></font></td>

                                <td><font size="-1">To <font class="redstar">*</font><input type="text"  class="appl_inputs" size="9" id="emp_to" name="emp_to" value="<?php echo sv('emp_to'); ?>"></font></td>

                                <td></td>

                                </tr>

                                <tr>

                                    <td><font size="-1">Address</font><font class="redstar">*</font></td>

                                    <td><font size="-1"><input type="text" class="appl_inputs" size="40" name="emp_address" value="<?php echo sv('emp_address'); ?>"></font></td>

                                    <td colspan="1"><font size="-1">Position</font><font class="redstar">*</font></td>

                                    <td><font size="-1"><input type="text" class="appl_inputs" size="30" name="emp_position" value="<?php echo sv('emp_position'); ?>"></font></td>

                                    <td></td>

                                </tr>

                                <tr>

                                    <td><font size="-1">City, State, Zip</font><font class="redstar">*</font></td>

                                    <td><font size="-1"><input type="text" class="appl_inputs" size="40" name="emp_citystatezip" value="<?php echo sv('emp_citystatezip'); ?>"></font></td>

                                    <td><font size="-1">Salary/Wage</font><font class="redstar">*</font></td>

                                    <td><font size="-1"><input type="text" class="appl_inputs" size="25" name="emp_salary" value="<?php echo sv('emp_salary'); ?>"></font></td>

                                    <td></td>

                                </tr>

                                <tr>

                                    <td><font size="-1">Contact Person</font><font class="redstar">*</font></td>

                                    <td><font size="-1"><input type="text" class="appl_inputs" size="40" name="emp_contact" value="<?php echo sv('emp_contact'); ?>"></font></td>

                                    <td><font size="-1">Reason for Leaving</font><font class="redstar">*</font></td>

                                    <td><font size="-1"><input type="text" class="appl_inputs" maxlength="132" name="emp_leaving_reason" value="<?php echo sv('emp_leaving_reason'); ?>"></font></td>

                                    <td></td>

                                </tr>

                                <tr>

                                    <td><font size="-1">Phone #</font><font class="redstar">*</font></td>

                                    <td><font size="-1"><input type="text" class="appl_inputs" size="12" name="emp_phone" value="<?php echo sv('emp_phone'); ?>"></font></td>

                                    <td></td>

                                    <td></td>

                                    <td></td>

                                </tr>

                                <tr>

                                    <td colspan="2" style="padding-top:20px;padding-bottom:20px;"><font size="-1">Were you subject to the FMCSRs while employed? <br>
                                            Yes<input value="fmcsr_yes" name="fmcsr" type="radio">No
                                            <input value="fmcsr_no" name="fmcsr" type="radio" checked="true"></font></td>

                                    <td></td>

                                    <td></td>

                                    <td></td>

                                </tr>

                                <tr>

                                    <td colspan="3" style="padding-top:20px;padding-bottom:20px;"><font size="-1">Was your job designated as a
                                            Safety-Sensitive function in any DOT-Regulated mode subject to the
                                            Drug and Alcohol Testing Requirements of 49 CFR Part 40? <br>

                                            Yes<input name="emp_safety" value="emp_safety_yes" type="radio">
                                            No<input value="emp_safety_no" name="emp_safety" type="radio" checked="true"></font></td>

                                    <td></td>

                                    <td></td>

                                </tr>

                                <tr>

                                    <td style="text-align: center;" colspan="2"><font size="-1"><span style="font-weight: bold;">Employer</span></font></td>

                                    <td style="text-align: center;" colspan="2"><font size="-1"><span style="font-weight: bold;">Date</span></font></td>

                                    <td></td>

                                </tr>

                                <tr>

                                    <td><font size="-1">Name</font></td>

                                    <td><font size="-1"><input type="text" class="appl_inputs" size="40" name="emp_name1" value="<?php echo sv('emp_name1'); ?>"></font></td>

                                <script type="text/javascript">
                                    initlist.push(function() {
                                        $("#emp_from1").datepicker({changeMonth: true,changeYear: true });
                                        $("#emp_to1").datepicker({changeMonth: true,changeYear: true });
                                    });
                                </script>

                                <td><font size="-1">From <input type="text"  class="appl_inputs" size="9" id="emp_from1" name="emp_from1" value="<?php echo sv('emp_from1'); ?>"></font></td>

                                <td><font size="-1">To <input type="text"  class="appl_inputs" size="9" id="emp_to1" name="emp_to1" value="<?php echo sv('emp_to1'); ?>"></font></td>

                                <td></td>

                                </tr>

                                <tr>

                                    <td><font size="-1">Address</font></td>

                                    <td><font size="-1"><input type="text" class="appl_inputs" size="40" name="emp_address1" value="<?php echo sv('emp_address1'); ?>"></font></td>

                                    <td colspan="1"><font size="-1">Position</font></td>

                                    <td><font size="-1"><input type="text" class="appl_inputs" size="30" name="emp_position1" value="<?php echo sv('emp_position1'); ?>"></font></td>

                                    <td></td>

                                </tr>

                                <tr>

                                    <td><font size="-1">City, State, Zip</font></td>

                                    <td><font size="-1"><input type="text" class="appl_inputs" size="40" name="emp_citystatezip1" value="<?php echo sv('emp_citystatezip1'); ?>"></font></td>

                                    <td><font size="-1">Salary/Wage</font></td>

                                    <td><font size="-1"><input type="text" class="appl_inputs" size="25" name="emp_salary1" value="<?php echo sv('emp_salary1'); ?>"></font></td>

                                    <td></td>

                                </tr>

                                <tr>

                                    <td><font size="-1">Contact Person</font></td>

                                    <td><font size="-1"><input type="text" class="appl_inputs" size="40" name="emp_contact1" value="<?php echo sv('emp_contact1'); ?>"></font></td>

                                    <td><font size="-1">Reason for Leaving</font></td>

                                    <td><font size="-1"><input type="text" class="appl_inputs" maxlength="132" name="emp_leaving_reason1" value="<?php echo sv('emp_leaving_reason1'); ?>"></font></td>

                                    <td></td>

                                </tr>

                                <tr>

                                    <td><font size="-1">Phone #</font></td>

                                    <td><font size="-1"><input type="text" class="appl_inputs" size="12" name="emp_phone1" value="<?php echo sv('emp_phone1'); ?>"></font></td>

                                    <td></td>

                                    <td></td>

                                    <td></td>

                                </tr>

                                <tr>

                                    <td colspan="2" style="padding-top:20px;padding-bottom:20px;"><font size="-1">Were you subject to the FMCSRs while employed? <br>

                                            Yes<input value="fmcsr1_yes" name="fmcsr1" type="radio">No
                                            <input value="fmcsr1_no" name="fmcsr1" type="radio" checked="true"></font></td>

                                    <td></td>

                                    <td></td>

                                    <td></td>

                                </tr>

                                <tr>

                                    <td colspan="3" style="padding-top:20px;padding-bottom:20px;"><font size="-1">Was your job designated as a
                                            Safety-Sensitive function in any DOT-Regulated mode subject to the
                                            Drug and Alcohol Testing Requirements of 49 CFR Part 40? <br>

                                            Yes<input value="emp_safety1_yes" name="emp_safety2" type="radio">
                                            No<input value="emp_safety2_no" name="emp_safety2" type="radio" checked="true"></font></td>

                                    <td></td>

                                    <td></td>

                                </tr>

                                <tr>

                                    <td style="text-align: center;" colspan="2"><font size="-1"><span style="font-weight: bold;">Employer</span></font></td>

                                    <td style="text-align: center;" colspan="2"><font size="-1"><span style="font-weight: bold;">Date</span></font></td>

                                    <td></td>

                                </tr>

                                <tr>

                                    <td><font size="-1">Name</font></td>

                                    <td><font size="-1"><input type="text" class="appl_inputs" size="40" name="emp_name2" value="<?php echo sv('emp_name2'); ?>"></font></td>

                                <script type="text/javascript">
                                    initlist.push(function() {
                                        $("#emp_from2").datepicker({changeMonth: true,changeYear: true  });
                                        $("#emp_to2").datepicker({changeMonth: true,changeYear: true  });
                                    });
                                </script>
                                <td><font size="-1">From <input type="text"  class="appl_inputs" size="9" id="emp_from2" name="emp_from2" value="<?php echo sv('emp_from2'); ?>"></font></td>

                                <td><font size="-1">To <input type="text"  class="appl_inputs" size="9" id="emp_to2" name="emp_to2" value="<?php echo sv('emp_to2'); ?>"></font></td>

                                <td></td>

                                </tr>

                                <tr>

                                    <td><font size="-1">Address</font></td>

                                    <td><font size="-1"><input type="text" class="appl_inputs" size="40" name="emp_address2" value="<?php echo sv('emp_address2'); ?>"></font></td>

                                    <td colspan="1"><font size="-1">Position</font></td>

                                    <td><font size="-1"><input type="text" class="appl_inputs" size="30" name="emp_position2" value="<?php echo sv('emp_position2'); ?>"></font></td>

                                    <td></td>

                                </tr>

                                <tr>

                                    <td><font size="-1">City, State, Zip</font></td>

                                    <td><font size="-1"><input type="text" class="appl_inputs" size="40" name="emp_citystatezip2" value="<?php echo sv('emp_citystatezip2'); ?>"></font></td>

                                    <td><font size="-1">Salary/Wage</font></td>

                                    <td><font size="-1"><input type="text" class="appl_inputs" size="25" name="emp_salary2" value="<?php echo sv('emp_salary2'); ?>"></font></td>

                                    <td></td>

                                </tr>

                                <tr>

                                    <td><font size="-1">Contact Person</font></td>

                                    <td><font size="-1"><input type="text" class="appl_inputs" size="40" name="emp_contact2" value="<?php echo sv('emp_contact2'); ?>"></font></td>

                                    <td><font size="-1">Reason for Leaving</font></td>

                                    <td><font size="-1"><input type="text" class="appl_inputs" maxlength="132" name="emp_leaving_reason2" value="<?php echo sv('emp_leaving_reason2'); ?>"></font></td>

                                    <td></td>

                                </tr>

                                <tr>

                                    <td><font size="-1">Phone #</font></td>

                                    <td><font size="-1"><input type="text" class="appl_inputs" size="12" name="emp_phone2" value="<?php echo sv('emp_phone2'); ?>"></font></td>

                                    <td></td>

                                    <td></td>

                                    <td></td>

                                </tr>

                                <tr>

                                    <td colspan="2" style="padding-top:20px;padding-bottom:20px;"><font size="-1">Were you subject to the FMCSRs while employed? <br>

                                            Yes<input value="fmcsr2_yes" name="fmcsr2" type="radio">No
                                            <input value="fmcsr2_no" name="fmcsr2" type="radio" checked="true"></font></td>

                                    <td></td>

                                    <td></td>

                                    <td></td>

                                </tr>

                                <tr>

                                    <td colspan="3" style="padding-top:20px;padding-bottom:20px;"><font size="-1">Was your job designated as a
                                            Safety-Sensitive function in any DOT-Regulated mode subject to the
                                            Drug and Alcohol Testing Requirements of 49 CFR Part 40? <br>

                                            Yes<input value="emp_safety3_yes" name="emp_safety3" type="radio">
                                            No<input value="emp_safety3_no" name="emp_safety3" type="radio" checked="true"></font></td>

                                    <td></td>

                                    <td></td>

                                </tr>

                                <tr>

                                    <td style="text-align: center;" colspan="2"><font size="-1"><span style="font-weight: bold;">Employer</span></font></td>

                                    <td style="text-align: center;" colspan="2"><font size="-1"><span style="font-weight: bold;">Date</span></font></td>

                                    <td></td>

                                </tr>

                                <tr>

                                    <td><font size="-1">Name</font></td>

                                    <td><font size="-1"><input type="text" class="appl_inputs" size="40" name="emp_name3" value="<?php echo sv('emp_name3'); ?>"></font></td>

                                <script type="text/javascript">
                                    initlist.push(function() {
                                        $("#emp_from3").datepicker({ changeMonth: true,changeYear: true });
                                        $("#emp_to3").datepicker({ changeMonth: true,changeYear: true });
                                    });
                                </script>
                                <td><font size="-1">From <input type="text"  class="appl_inputs" size="9" id="emp_from3" name="emp_from3" value="<?php echo sv('emp_from3'); ?>"></font></td>

                                <td><font size="-1">To <input type="text"  class="appl_inputs" size="9" id="emp_to3" name="emp_to3" value="<?php echo sv('emp_to3'); ?>"></font></td>

                                <td></td>

                                </tr>

                                <tr>

                                    <td><font size="-1">Address</font></td>

                                    <td><font size="-1"><input type="text" class="appl_inputs" size="40" name="emp_address3" value="<?php echo sv('emp_address3'); ?>"></font></td>

                                    <td colspan="1"><font size="-1">Position</font></td>

                                    <td><font size="-1"><input type="text" class="appl_inputs" size="30" name="emp_position3" value="<?php echo sv('emp_position3'); ?>"></font></td>

                                    <td></td>

                                </tr>

                                <tr>

                                    <td><font size="-1">City, State, Zip</font></td>

                                    <td><font size="-1"><input type="text" class="appl_inputs" size="40" name="emp_citystatezip3" value="<?php echo sv('emp_citystatezip3'); ?>"></font></td>

                                    <td><font size="-1">Salary/Wage</font></td>

                                    <td><font size="-1"><input type="text" class="appl_inputs" size="25" name="emp_salary3" value="<?php echo sv('emp_salary3'); ?>"></font></td>

                                    <td></td>

                                </tr>

                                <tr>

                                    <td><font size="-1">Contact Person</font></td>

                                    <td><font size="-1"><input type="text" class="appl_inputs" size="40" name="emp_contact3" value="<?php echo sv('emp_contact3'); ?>"></font></td>

                                    <td><font size="-1">Reason for Leaving</font></td>

                                    <td><font size="-1"><input type="text" class="appl_inputs" maxlength="132" name="emp_leaving_reason3" value="<?php echo sv('emp_leaving_reason3'); ?>"></font></td>

                                    <td></td>

                                </tr>

                                <tr>

                                    <td><font size="-1">Phone #</font></td>

                                    <td><font size="-1"><input type="text" class="appl_inputs" size="12" name="emp_phone3" value="<?php echo sv('emp_phone3'); ?>"></font></td>

                                    <td></td>

                                    <td></td>

                                    <td></td>

                                </tr>

                                <tr>

                                    <td colspan="2" style="padding-top:20px;padding-bottom:20px;"><font size="-1">Were you subject to the FMCSRs while employed? <br>

                                            Yes<input value="fmcsr3_yes" name="fmcsr3" type="radio">No
                                            <input value="fmcsr3_no" name="fmcsr3" type="radio" checked="true"></font></td>

                                    <td></td>

                                    <td></td>

                                    <td></td>

                                </tr>

                                <tr>

                                    <td colspan="3" style="padding-top:20px;padding-bottom:20px;"><font size="-1">Was your job designated as a
                                            Safety-Sensitive function in any DOT-Regulated mode subject to the
                                            Drug and Alcohol Testing Requirements of 49 CFR Part 40? <br>

                                            Yes<input value="emp_safety4_yes" name="emp_safety4" type="radio">
                                            No<input value="emp_safety4_no" name="emp_safety4" type="radio" checked="true"></font></td>

                                    <td></td>

                                    <td></td>

                                </tr>

                                <tr>

                                    <td style="text-align: center;" colspan="2"><font size="-1"><span style="font-weight: bold;">Employer</span></font></td>

                                    <td style="text-align: center;" colspan="2"><font size="-1"><span style="font-weight: bold;">Date</span></font></td>

                                    <td></td>

                                </tr>

                                <tr>

                                    <td><font size="-1">Name</font></td>

                                    <td><font size="-1"><input type="text" class="appl_inputs" size="40" name="emp_name4" value="<?php echo sv('emp_name4'); ?>"></font></td>

                                <script type="text/javascript">
                                    initlist.push(function() {
                                        $("#emp_from4").datepicker({changeMonth: true,changeYear: true  });
                                        $("#emp_to4").datepicker({ changeMonth: true,changeYear: true });
                                    });
                                </script>
                                <td><font size="-1">From <input type="text"  class="appl_inputs" size="9" id="emp_from4" name="emp_from4" value="<?php echo sv('emp_from4'); ?>"></font></td>

                                <td><font size="-1">To <input type="text"  class="appl_inputs" size="9" id="emp_to4" name="emp_to4" value="<?php echo sv('emp_to4'); ?>"></font></td>

                                <td></td>

                                </tr>

                                <tr>

                                    <td><font size="-1">Address</font></td>

                                    <td><font size="-1"><input type="text" class="appl_inputs" size="40" name="emp_address4" value="<?php echo sv('emp_address4'); ?>"></font></td>

                                    <td colspan="1"><font size="-1">Position</font></td>

                                    <td><font size="-1"><input type="text" class="appl_inputs" size="30" name="emp_position4" value="<?php echo sv('emp_position4'); ?>"></font></td>

                                    <td></td>

                                </tr>

                                <tr>

                                    <td><font size="-1">City, State, Zip</font></td>

                                    <td><font size="-1"><input type="text" class="appl_inputs" size="40" name="emp_citystatezip4" value="<?php echo sv('emp_citystatezip4'); ?>"></font></td>

                                    <td><font size="-1">Salary/Wage</font></td>

                                    <td><font size="-1"><input type="text" class="appl_inputs" size="25" name="emp_salary4" value="<?php echo sv('emp_salary4'); ?>"></font></td>

                                    <td></td>

                                </tr>

                                <tr>

                                    <td><font size="-1">Contact Person</font></td>

                                    <td><font size="-1"><input type="text" class="appl_inputs" size="40" name="emp_contact4" value="<?php echo sv('emp_contact4'); ?>"></font></td>

                                    <td><font size="-1">Reason for Leaving</font></td>

                                    <td><font size="-1"><input type="text" class="appl_inputs" maxlength="132" name="emp_leaving_reason4" value="<?php echo sv('emp_leaving_reason4'); ?>"></font></td>

                                    <td></td>

                                </tr>

                                <tr>

                                    <td><font size="-1">Phone #</font></td>

                                    <td><font size="-1"><input type="text" class="appl_inputs" size="12" name="emp_phone4" value="<?php echo sv('emp_phone4'); ?>"></font></td>

                                    <td></td>

                                    <td></td>

                                    <td></td>

                                </tr>

                                <tr>

                                    <td colspan="2" style="padding-top:20px;padding-bottom:20px;"><font size="-1">Were you subject to the FMCSRs while employed? <br>

                                            Yes<input value="fmcsr4_yes" name="fmcsr4" type="radio">No
                                            <input value="fmcsr4_no" name="fmcsr4" type="radio" checked="true"></font></td>

                                    <td></td>

                                    <td></td>

                                    <td></td>

                                </tr>

                                <tr>

                                    <td colspan="3" style="padding-top:20px;padding-bottom:20px;"><font size="-1">Was your job designated as a
                                            Safety-Sensitive function in any DOT-Regulated mode subject to the
                                            Drug and Alcohol Testing Requirements of 49 CFR Part 40? <br>

                                            Yes<input value="emp_safety5_yes" name="emp_safety5" type="radio">
                                            No<input value="emp_safety5_no" name="emp_safety5" type="radio" checked="true"></font></td>

                                    <td></td>

                                    <td></td>

                                </tr>

                                <tr>

                                    <td style="text-align: center;" colspan="2"><font size="-1"><span style="font-weight: bold;">Employer</span></font></td>

                                    <td style="text-align: center;" colspan="2"><font size="-1"><span style="font-weight: bold;">Date</span></font></td>

                                    <td></td>

                                </tr>

                                <tr>

                                    <td><font size="-1">Name</font></td>

                                    <td><font size="-1"><input type="text" class="appl_inputs" size="40" name="emp_name5" value="<?php echo sv('emp_name5'); ?>"></font></td>

                                <script type="text/javascript">
                                    initlist.push(function() {
                                        $("#emp_from5").datepicker({changeMonth: true,changeYear: true  });
                                        $("#emp_to5").datepicker({ changeMonth: true,changeYear: true });
                                    });
                                </script>
                                <td><font size="-1">From <input type="text"  class="appl_inputs"  size="9" id="emp_from5" name="emp_from5" value="<?php echo sv('emp_from5'); ?>"></font></td>

                                <td><font size="-1">To <input type="text"  class="appl_inputs" size="9" id="emp_to5" name="emp_to5" value="<?php echo sv('emp_to5'); ?>"></font></td>

                                <td></td>

                                </tr>

                                <tr>

                                    <td><font size="-1">Address</font></td>

                                    <td><font size="-1"><input type="text" class="appl_inputs" size="40" name="emp_address5" value="<?php echo sv('emp_address5'); ?>"></font></td>

                                    <td colspan="1"><font size="-1">Position</font></td>

                                    <td><font size="-1"><input type="text" class="appl_inputs" size="30" name="emp_position5" value="<?php echo sv('emp_position5'); ?>"></font></td>

                                    <td></td>

                                </tr>

                                <tr>

                                    <td><font size="-1">City, State, Zip</font></td>

                                    <td><font size="-1"><input type="text" class="appl_inputs" size="40" name="emp_citystatezip5" value="<?php echo sv('emp_citystatezip5'); ?>"></font></td>

                                    <td><font size="-1">Salary/Wage</font></td>

                                    <td><font size="-1"><input type="text" class="appl_inputs" size="25" name="emp_salary5" value="<?php echo sv('emp_salar5'); ?>"></font></td>

                                    <td></td>

                                </tr>

                                <tr>

                                    <td><font size="-1">Contact Person</font></td>

                                    <td><font size="-1"><input type="text" class="appl_inputs" size="40" name="emp_contact5" value="<?php echo sv('emp_contact5'); ?>"></font></td>

                                    <td><font size="-1">Reason for Leaving</font></td>

                                    <td><font size="-1"><input type="text" class="appl_inputs" maxlength="132" name="emp_leaving_reason5" value="<?php echo sv('emp_leaving_reason5'); ?>"></font></td>

                                    <td></td>

                                </tr>

                                <tr>

                                    <td><font size="-1">Phone #</font></td>

                                    <td><font size="-1"><input type="text" class="appl_inputs" size="12" name="emp_phone5" value="<?php echo sv('emp_phone5'); ?>"></font></td>

                                    <td></td>

                                    <td></td>

                                    <td></td>

                                </tr>

                                <tr>

                                    <td colspan="2" style="padding-top:20px;padding-bottom:20px;"><font size="-1">Were you subject to the FMCSRs while employed? <br>

                                            Yes<input value="fmcsr5_yes" name="fmcsr5" type="radio">No
                                            <input value="fmcsr5_no" name="fmcsr5" type="radio" checked="true"></font></td>

                                    <td></td>

                                    <td></td>

                                    <td></td>

                                </tr>

                                <tr>

                                    <td colspan="3" style="padding-top:20px;padding-bottom:20px;"><font size="-1">Was your job designated as a
                                            Safety-Sensitive function in any DOT-Regulated mode subject to the
                                            Drug and Alcohol Testing Requirements of 49 CFR Part 40? <br>

                                            Yes<input value="emp_safety6_yes" name="emp_safety6" type="radio">
                                            No<input value="emp_safety6_no" name="emp_safety6" type="radio" checked="true"></font></td>

                                    <td></td>

                                    <td></td>

                                </tr>

                                <tr>

                                    <td style="text-align: center;" colspan="2"><font size="-1"><span style="font-weight: bold;">Employer</span></font></td>

                                    <td style="text-align: center;" colspan="2"><font size="-1"><span style="font-weight: bold;">Date</span></font></td>

                                    <td></td>

                                </tr>

                                <tr>

                                    <td><font size="-1">Name</font></td>

                                    <td><font size="-1"><input type="text" class="appl_inputs" size="40" name="emp_name6" value="<?php echo sv('emp_name6'); ?>"></font></td>

                                <script type="text/javascript">
                                    initlist.push(function() {
                                        $("#emp_from6").datepicker({changeMonth: true,changeYear: true  });
                                        $("#emp_to6").datepicker({ changeMonth: true,changeYear: true });
                                    });
                                </script>
                                <td><font size="-1">From <input type="text"  class="appl_inputs" size="9" id="emp_from6" name="emp_from6" value="<?php echo sv('emp_from6'); ?>"></font></td>

                                <td><font size="-1">To <input type="text"  class="appl_inputs" size="9" id="emp_to6" name="emp_to6" value="<?php echo sv('emp_to6'); ?>"></font></td>

                                <td></td>

                                </tr>

                                <tr>

                                    <td><font size="-1">Address</font></td>

                                    <td><font size="-1"><input type="text" class="appl_inputs" size="40" name="emp_address6" value="<?php echo sv('emp_address6'); ?>"></font></td>

                                    <td colspan="1"><font size="-1">Position</font></td>

                                    <td><font size="-1"><input type="text" class="appl_inputs" size="30" name="emp_position6" value="<?php echo sv('emp_position6'); ?>"></font></td>

                                    <td></td>

                                </tr>

                                <tr>

                                    <td><font size="-1">City, State, Zip</font></td>

                                    <td><font size="-1"><input type="text" class="appl_inputs" size="40" name="emp_citystatezip6" value="<?php echo sv('emp_citystatezip6'); ?>"></font></td>

                                    <td><font size="-1">Salary/Wage</font></td>

                                    <td><font size="-1"><input type="text" class="appl_inputs" size="25" name="emp_salary6" value="<?php echo sv('emp_salary6'); ?>"></font></td>

                                    <td></td>

                                </tr>

                                <tr>

                                    <td><font size="-1">Contact Person</font></td>

                                    <td><font size="-1"><input type="text" class="appl_inputs" size="40" name="emp_contact6" value="<?php echo sv('emp_contact6'); ?>"></font></td>

                                    <td><font size="-1">Reason for Leaving</font></td>

                                    <td><font size="-1"><input type="text" class="appl_inputs" maxlength="132" name="emp_leaving_reason6" value="<?php echo sv('emp_leaving_reason6'); ?>"></font></td>

                                    <td></td>

                                </tr>

                                <tr>

                                    <td><font size="-1">Phone #</font></td>

                                    <td><font size="-1"><input type="text" class="appl_inputs" name="emp_phone6" size="12" value="<?php echo sv('emp_phone6'); ?>"></font></td>

                                    <td></td>

                                    <td></td>

                                    <td></td>

                                </tr>

                                <tr>

                                    <td colspan="2" style="padding-top:20px;padding-bottom:20px;"><font size="-1">Were you subject to the FMCSRs while employed? <br>

                                            Yes<input value="fmcsr6_yes" name="fmcsr6" type="radio">No
                                            <input value="fmcsr6_no" name="fmcsr6" type="radio" checked="true"></font></td>

                                    <td></td>

                                    <td></td>

                                    <td></td>

                                </tr>

                                <tr>

                                    <td colspan="3" style="padding-top:20px;padding-bottom:20px;"><font size="-1">Was your job designated as a
                                            Safety-Sensitive function in any DOT-Regulated mode subject to the
                                            Drug and Alcohol Testing Requirements of 49 CFR Part 40? <br>

                                            Yes<input value="cfr40_yes" name="cfr40" type="radio">
                                            No<input value="cfr40_no" name="cfr40" type="radio" checked="true"><br>

                                            <br>

                                        </font> </td>

                                    <td></td>

                                    <td></td>

                                </tr>

                                <tr>

                                    <td colspan="4"><font size="-1">*Includes
                                            vehicles having
                                            a FVWR of 26,001 lbs. or more, vehicles designed to transport 16 or
                                            more passengers (including the driver), or any size vehicles used to
                                            transport hazardous materials in a quantity requiring placarding.<br>

                                            <br>

                                            ~The Federal Motor Carrier Safety Regulations (FMCSRs) apply to anyone
                                            operating a motor vehicle on a highway in interstate commerce to
                                            transport passengers or property when the vehicle: (1) weighs or has a
                                            GVWR of 10,001 pounds or more, (2) is designed or used to transport more
                                            than 8 passengers (including the driver) or (3) is of any size and is
                                            used to transport hazardous materials in a quantity requiring
                                            placarding.<br>

                                            <br>

                                        </font> </td>

                                    <td></td>

                                </tr>

                                <tr>

                                    <td colspan="3"><font size="-1">ACCIDENT RECORD FOR PAST 3 YEARS OR MORE<br>

                                            <br>

                                        </font> </td>

                                    <td></td>

                                    <td></td>

                                </tr>

                                <tr>

                                    <td><font size="-1"><span style="font-weight: bold;"></span></font></td>

                                    <td><font size="-1"><span style="font-weight: bold;">Nature of Accident</span><br style="font-weight: bold;">

                                            <span style="font-weight: bold;">(Head-On,
                                                Rear-End, Upset, ETC)</span></font> </td>

                                    <td><font size="-1"><span style="font-weight: bold;">Fatalities</span></font></td>

                                    <td><font size="-1"><span style="font-weight: bold;">Injuries</span></font></td>

                                    <td><font size="-1"><span style="font-weight: bold;">Hazardous</span><br style="font-weight: bold;">

                                            <span style="font-weight: bold;">Material Spill</span></font>
                                    </td>

                                </tr>

                                <tr>

                                    <td><font size="-1">(1)Last Accident</font></td>

                                    <td><font size="-1">
                                            <input type="text" class="appl_inputs" size="40" maxlength="125" name="accident" value="<?php echo sv('accident'); ?>"></font></td>

                                    <td><font size="-1">
                                            <input type="text" class="appl_inputs" name="fatalities" value="<?php echo sv('fatalities'); ?>"></font></td>

                                    <td><font size="-1">
                                            <input type="text" class="appl_inputs" name="injuries" value="<?php echo sv('injuries'); ?>"></font></td>

                                    <td><font size="-1">
                                            <input type="text" class="appl_inputs" name="hazardousspill" value="<?php echo sv('hazardousspill'); ?>"></font></td>

                                </tr>

                                <tr>

                                    <td><font size="-1">(2)Next Previous</font></td>

                                    <td><font size="-1">
                                            <input type="text" class="appl_inputs" maxlength="125" size="40" name="accident2" value="<?php echo sv('accident2'); ?>"></font></td>

                                    <td><font size="-1">
                                            <input type="text" class="appl_inputs" name="fatalities2" value="<?php echo sv('fatalities2'); ?>"></font></td>

                                    <td><font size="-1">
                                            <input type="text" class="appl_inputs" name="injuries2" value="<?php echo sv('injuries2'); ?>"></font></td>

                                    <td><font size="-1">
                                            <input type="text" class="appl_inputs" name="hazardousspill2" value="<?php echo sv('hazardousspill2'); ?>"></font></td>

                                </tr>

                                <tr>

                                    <td><font size="-1">(3)Next Previous</font></td>

                                    <td><font size="-1">
                                            <input type="text" class="appl_inputs" maxlength="132" size="40" name="accident3" value="<?php echo sv('accident3'); ?>"></font></td>

                                    <td><font size="-1">
                                            <input type="text" class="appl_inputs" name="fatalities3" value="<?php echo sv('fatalities3'); ?>"></font></td>

                                    <td><font size="-1">
                                            <input type="text" class="appl_inputs" name="injuries3" value="<?php echo sv('injuries3'); ?>"></font></td>

                                    <td><font size="-1">
                                            <input type="text" class="appl_inputs" name="hazardousspill3" value="<?php echo sv('hazardousspill3'); ?>"></font></td>

                                </tr>

                                <tr>

                                    <td><font size="-1"><span style="font-weight: bold;"><br>

                                            </span></font></td>

                                    <td><font size="-1"><span style="font-weight: bold;">Location</span></font></td>

                                    <td><font size="-1"><span style="font-weight: bold;"></span></font><font size="-1"><span style="font-weight: bold;">Date</span></font></td>

                                    <td><font size="-1"><span style="font-weight: bold;"></span></font><font size="-1"><span style="font-weight: bold;">Charge</span></font></td>

                                    <td><font size="-1"><span style="font-weight: bold;">Penalty</span></font></td>

                                </tr>

                                <script type="text/javascript">
                                    initlist.push(function() {
                                        $("#trafficdate").datepicker({changeMonth: true,changeYear: true  });
                                        $("#trafficdate2").datepicker({ changeMonth: true,changeYear: true });
                                        $("#trafficdate3").datepicker({ changeMonth: true,changeYear: true });
                                    });
                                </script>

                                <tr>

                                    <td><font size="-1">(1)contd. Last Accident<br>

                                        </font></td>

                                    <td><font size="-1">
                                            <input type="text" class="appl_inputs" name="trafficloc" value="<?php echo sv('trafficloc'); ?>"></font></td>

                                    <td><font size="-1">
                                            <input type="text"  class="appl_inputs" name="trafficdate" size="9" id="trafficdate" value="<?php echo sv('trafficdate'); ?>"></font></td>

                                    <td><font size="-1">
                                            <input type="text" class="appl_inputs" name="trafficcharge" value="<?php echo sv('trafficcharge'); ?>"></font></td>

                                    <td><font size="-1">
                                            <input type="text" class="appl_inputs" name="trafficpenalty" value="<?php echo sv('trafficpenalty'); ?>"></font></td>

                                </tr>

                                <tr>

                                    <td><font size="-1">(2)contd. Next Previous<br>

                                        </font></td>

                                    <td><font size="-1">
                                            <input type="text" class="appl_inputs" name="trafficloc2" value="<?php echo sv('trafficloc2'); ?>"></font></td>

                                    <td><font size="-1">
                                            <input type="text"  class="appl_inputs" name="trafficdate2" size="9" id="trafficdate2" value="<?php echo sv('trafficdate2'); ?>"></font></td>

                                    <td><font size="-1">
                                            <input type="text" class="appl_inputs" name="trafficcharge2" value="<?php echo sv('trafficcharge2'); ?>"></font></td>

                                    <td><font size="-1">
                                            <input type="text" class="appl_inputs" name="trafficpenalty2" value="<?php echo sv('trafficpenalty2'); ?>"></font></td>

                                </tr>

                                <tr>

                                    <td><font size="-1">(3)contd. Next Previous<br>

                                        </font></td>

                                    <td><font size="-1">
                                            <input type="text" class="appl_inputs" name="trafficloc3" value="<?php echo sv('trafficlo3'); ?>"></font></td>

                                    <td><font size="-1">
                                            <input type="text"  class="appl_inputs" name="trafficdate3" size="9" id="trafficdate3" value="<?php echo sv('trafficdate3'); ?>"></font></td>

                                    <td><font size="-1">
                                            <input type="text" class="appl_inputs" name="trafficcharge3" value="<?php echo sv('trafficcharge3'); ?>"></font></td>

                                    <td><font size="-1">
                                            <input type="text" class="appl_inputs" name="trafficpenalty3" value="<?php echo sv('trafficpenalty3'); ?>"></font></td>

                                </tr>

                                <tr>

                                    <td style="text-align: center;" colspan="5"><font size="-1"><br>

                                            <br>

                                            <big><span style="font-weight: bold; color: rgb(102, 102, 102);">Experience
                                                    and
                                                    Qualifications - Driver</span></big></font> <br>

                                    </td>

                                    <td></td>

                                </tr>


                                <tr>

                                    <td><font size="-1"><span style="font-weight: bold;">Driver </span><br style="font-weight: bold;">

                                            <span style="font-weight: bold;">License</span></font>
                                    </td>

                                    <td><font size="-1"><span style="font-weight: bold;">State</span></font><font class="redstar">*</font></td>

                                    <td><font size="-1"><span style="font-weight: bold;">License Number</span></font><font class="redstar">*</font></td>

                                    <td><font size="-1"><span style="font-weight: bold;">Type</span></font><font class="redstar">*</font></td>

                                    <td><font size="-1"><span style="font-weight: bold;">Expiration Date</span></font><font class="redstar">*</font></td>

                                </tr>

                                <script type="text/javascript">
                                    initlist.push(function() {
                                        $("#qualifyexpiration").datepicker({changeMonth: true,changeYear: true  });
                                    });
                                </script>

                                <tr>

                                    <td></td>

                                    <td><font size="-1"><!--<input size="2" name="qualifystate" value="<?php echo sv('qualifystate'); ?>">-->
                                            <select name="qualifystate">
                                                <option value="" selected>Select</option>
                                                <option value="AL">Alabama</option>
                                                <option value="AK">Alaska</option>
                                                <option value="AZ">Arizona</option>
                                                <option value="AR">Arkansas</option>
                                                <option value="CA">California</option>
                                                <option value="CO">Colorado</option>
                                                <option value="CT">Connecticut</option>
                                                <option value="DE">Delaware</option>
                                                <option value="DC">District of Columbia</option>
                                                <option value="FL">Florida</option>
                                                <option value="GA">Georgia</option>
                                                <option value="HI">Hawaii</option>
                                                <option value="ID">Idaho</option>
                                                <option value="IL">Illinois</option>
                                                <option value="IN">Indiana</option>
                                                <option value="IA">Iowa</option>
                                                <option value="KS">Kansas</option>
                                                <option value="KY">Kentucky</option>
                                                <option value="LA">Louisiana</option>
                                                <option value="ME">Maine</option>
                                                <option value="MD">Maryland</option>
                                                <option value="MA">Massachusetts</option>
                                                <option value="MI">Michigan</option>
                                                <option value="MN">Minnesota</option>
                                                <option value="MS">Mississippi</option>
                                                <option value="MO">Missouri</option>
                                                <option value="MT">Montana</option>
                                                <option value="NE">Nebraska</option>
                                                <option value="NV">Nevada</option>
                                                <option value="NH">New Hampshire</option>
                                                <option value="NJ">New Jersey</option>
                                                <option value="NM">New Mexico</option>
                                                <option value="NY">New York</option>
                                                <option value="NC">North Carolina</option>
                                                <option value="ND">North Dakota</option>
                                                <option value="OH">Ohio</option>
                                                <option value="OK">Oklahoma</option>
                                                <option value="OR">Oregon</option>
                                                <option value="PA">Pennsylvania</option>
                                                <option value="RI">Rhode Island</option>
                                                <option value="SC">South Carolina</option>
                                                <option value="SD">South Dakota</option>
                                                <option value="TN">Tennessee</option>
                                                <option value="TX">Texas</option>
                                                <option value="UT">Utah</option>
                                                <option value="VT">Vermont</option>
                                                <option value="VA">Virginia</option>
                                                <option value="WA">Washington</option>
                                                <option value="WV">West Virginia</option>
                                                <option value="WI">Wisconsin</option>
                                                <option value="WY">Wyoming</option>
                                            </select>
                                        </font></td>

                                    <td><font size="-1"><input type="text" class="appl_inputs" name="qualifylicense" value="<?php echo sv('qualifylicense'); ?>"></font></td>

                                    <td><font size="-1"><input type="text" class="appl_inputs" name="qualifytype" value="<?php echo sv('qualifytype'); ?>"></font></td>

                                    <td><font size="-1"><input type="text"  class="appl_inputs" name="qualifyexpiration" size="9" id="qualifyexpiration" value="<?php echo sv('qualifyexpiration'); ?>"></font></td>

                                </tr>

                                <tr>

                                    <td colspan="2"><font size="-1">Have you ever been denied a license, permit or privilege to operate a motor vehicle?</font></td>

                                    <td><font size="-1">Yes<input name="denied" value="denied_yes" type="radio">No
                                            <input name="denied" value="denied_no" type="radio" checked="true"></font></td>

                                    <td></td>

                                    <td></td>

                                </tr>

                                <tr>

                                    <td colspan="2"><font size="-1">Has
                                            any license, permit, or
                                            privilege ever been suspended or revoked?</font></td>

                                    <td><font size="-1">Yes
                                            <input name="revoked" value="revoked_yes" type="radio">No
                                            <input name="revoked" value="revoked_no" type="radio" checked="true"></font></td>

                                    <td></td>

                                    <td></td>

                                </tr>

                                <tr>

                                    <td style="text-align: center;" colspan="5"><font size="-1"><br>

                                            <br>

                                            <big><span style="font-weight: bold; color: rgb(102, 102, 102);">Driving
                                                    Experience</span></big></font> </td>

                                    <td></td>

                                </tr>

                                <tr>

                                    <td><font size="-1"><span style="font-weight: bold;">Class of Equipment</span></font></td>

                                    <td><font size="-1"><span style="font-weight: bold;">Type of Equipment</span></font></td>

                                    <td><font size="-1"><span style="font-weight: bold;">Dates From/To</span></font></td>

                                    <td><font size="-1"><span style="font-weight: bold;">Approx No Of Miles (Total)</span></font></td>

                                    <td></td>

                                </tr>

                                <script type="text/javascript">
                                    initlist.push(function() {
                                        $("#experiencefrom").datepicker({changeMonth: true,changeYear: true  });
                                        $("#experiencefrom2").datepicker({ changeMonth: true,changeYear: true });
                                        $("#experiencefrom3").datepicker({ changeMonth: true,changeYear: true });
                                        $("#experiencefrom4").datepicker({ changeMonth: true,changeYear: true });
                                        $("#experiencefrom5").datepicker({ changeMonth: true,changeYear: true });
                                        $("#experiencefrom6").datepicker({ changeMonth: true,changeYear: true });
                                        $("#experiencefrom7").datepicker({ changeMonth: true,changeYear: true });
                                        
                                        $("#experienceto").datepicker({changeMonth: true,changeYear: true  });
                                        $("#experienceto2").datepicker({ changeMonth: true,changeYear: true });
                                        $("#experienceto3").datepicker({ changeMonth: true,changeYear: true });
                                        $("#experienceto4").datepicker({ changeMonth: true,changeYear: true });
                                        $("#experienceto5").datepicker({ changeMonth: true,changeYear: true });
                                        $("#experienceto6").datepicker({ changeMonth: true,changeYear: true });
                                        $("#experienceto7").datepicker({ changeMonth: true,changeYear: true });
                                    });
                                </script>

                                <tr>

                                    <td style="padding-top:20px;padding-bottom:20px;"><font size="-1">Straight Truck <br>

                                            Yes<input name="straight" value="straightyes" type="radio"><br/>No
                                            <input name="straight" value="straightno" type="radio" checked="true"></font> </td>

                                    <td><font size="-1">
                                            Van<input name="equip" value="equipvan" type="radio" checked="true">
                                            Tank<input name="equip" value="equiptank" type="radio">
                                            Flat<input name="equip" value="equipflat" type="radio">
                                            Dump<input name="equip" value="equipdump" type="radio">
                                            Reefer<input name="equip" value="equipreefer" type="radio"></font></td>

                                    <td><font size="-1">
                                            <input type="text"  class="appl_inputs" name="experiencefrom" size="9" id="experiencefrom" value="<?php echo sv('experiencefrom'); ?>">
                                            <input type="text"  class="appl_inputs" name="experienceto" size="9" id="experienceto" value="<?php echo sv('experienceto'); ?>">
                                        </font></td>

                                    <td><font size="-1">
                                            <input type="text" class="appl_inputs" name="miles" value="<?php echo sv('miles'); ?>"></font></td>

                                    <td></td>

                                </tr>

                                <tr>

                                    <td style="padding-top:20px;padding-bottom:20px;"><font size="-1">Tractor and <br>
                                            Semi-Trailer<br>

                                            Yes<input name="tractor" value="tractoryes" type="radio"><br/>No
                                            <input name="tractor" value="tractorno" type="radio" checked="true"></font></td>

                                    <td><font size="-1">Van
                                            <input name="equip2" value="equip2van" type="radio" checked="true">Tank
                                            <input name="equip2" value="equip2tank" type="radio">Flat
                                            <input name="equip2" value="equip2flat" type="radio">Dump
                                            <input name="equip2" value="equip2dump" type="radio">Reefer
                                            <input name="equip2" value="equip2reefer" type="radio"></font></td>

                                    <td><font size="-1">
                                            <input type="text"  class="appl_inputs" name="experiencefrom2" size="9" id="experiencefrom2" value="<?php echo sv('experiencefrom2'); ?>">
                                            <input type="text"  class="appl_inputs" name="experienceto2" size="9" id="experienceto2" value="<?php echo sv('experienceto2'); ?>">
                                        </font></td>

                                    <td><font size="-1">
                                            <input type="text" class="appl_inputs" name="miles2" value="<?php echo sv('miles2'); ?>"></font></td>

                                    <td></td>

                                </tr>

                                <tr>

                                    <td style="padding-top:20px;padding-bottom:20px;"><font size="-1">Tractor and Two-Trailers <br>

                                            Yes<input name="twotrailers" value="twotrailersyes" type="radio"><br/>No
                                            <input name="twotrailers" value="twotrailersno" type="radio" checked="true"></font></td>

                                    <td><font size="-1">Van
                                            <input name="equip3" value="equip3van" type="radio" checked="true">Tank
                                            <input name="equip3" value="equip3tank" type="radio">Flat
                                            <input name="equip3" value="equip3flat" type="radio">Dump
                                            <input name="equip3" value="equip3dump" type="radio">Reefer
                                            <input name="equip3" value="equip3reefer" type="radio"></font></td>

                                    <td><font size="-1">
                                            <input type="text"  class="appl_inputs" name="experiencefrom3" size="9" id="experiencefrom3" value="<?php echo sv('experiencefrom3'); ?>">
                                            <input type="text"  class="appl_inputs" name="experienceto3" size="9" id="experienceto3" value="<?php echo sv('experienceto3'); ?>">
                                        </font></td>

                                    <td><font size="-1">
                                            <input type="text" class="appl_inputs" name="miles3" value="<?php echo sv('miles3'); ?>"></font></td>

                                    <td></td>

                                </tr>

                                <tr>

                                    <td style="padding-top:20px;padding-bottom:20px;"><font size="-1">Tractor and Three-Trailers <br>

                                            Yes<input name="threetrailers" value="threetrailersyes" type="radio"><br/>No
                                            <input name="threetrailers" value="threetrailersno" type="radio" checked="true"></font></td>

                                    <td><font size="-1">Van
                                            <input name="equip4" value="equip4van" type="radio" checked="true">Tank
                                            <input name="equip4" value="equip4tank" type="radio">Flat
                                            <input name="equip4" value="equip4flat" type="radio">Dump
                                            <input name="equip4" value="equip4dump" type="radio">Reefer
                                            <input name="equip4" value="equip4reefer" type="radio"></font></td>

                                    <td><font size="-1">
                                            <input type="text"  class="appl_inputs" name="experiencefrom4" size="9" id="experiencefrom4" value="<?php echo sv('experiencefrom4'); ?>">
                                            <input type="text"  class="appl_inputs" name="experienceto4" size="9" id="experienceto4" value="<?php echo sv('experienceto4'); ?>">
                                        </font></td>

                                    <td><font size="-1">
                                            <input type="text" class="appl_inputs" name="miles4" value="<?php echo sv('miles4'); ?>"></font></td>

                                    <td></td>

                                </tr>

                                <tr>

                                    <td colspan="2" style="padding-top:20px;padding-bottom:20px;">
                                        <font size="-1">Motor Coach - School Bus (More than 8) <br>

                                            Yes<input name="school8" value="school8yes" type="radio"><br/>No
                                            <input name="school8" value="schoo8lno" type="radio" checked="true"></font></td>

                                    <td><font size="-1">
                                            <input type="text"  class="appl_inputs" name="experiencefrom5" size="9" id="experiencefrom5" value="<?php echo sv('experiencefrom5'); ?>">
                                            <input type="text"  class="appl_inputs" name="experienceto5" size="9" id="experienceto5" value="<?php echo sv('experienceto5'); ?>">
                                        </font></td>

                                    <td><font size="-1">
                                            <input type="text" class="appl_inputs" name="miles5" value="<?php echo sv('miles5'); ?>"></font></td>

                                    <td></td>

                                </tr>

                                <tr>

                                    <td colspan="2" style="padding-top:20px;padding-bottom:20px;">
                                        <font size="-1">Motor Coach - School Bus (More than 15) <br>

                                            Yes<input name="school15" value="school15yes" type="radio"><br/>No
                                            <input name="shool15" value="school15no" type="radio" checked="true"></font></td>

                                    <td><font size="-1">
                                            <input type="text"  class="appl_inputs" name="experiencefrom6" size="9" id="experiencefrom6" value="<?php echo sv('experiencefrom6'); ?>">
                                            <input type="text"  class="appl_inputs" name="experienceto6" size="9" id="experienceto6" value="<?php echo sv('experienceto6'); ?>">
                                        </font></td>

                                    <td><font size="-1">
                                            <input type="text" class="appl_inputs" name="miles6" value="<?php echo sv('miles6'); ?>"></font></td>

                                    <td></td>

                                </tr>

                                <tr>

                                    <td><font size="-1">Other</font></td>

                                    <td><font size="-1">
                                            <input type="text" class="appl_inputs" maxlength="132" size="40" name="otherequipment" value="<?php echo sv('otherequipment'); ?>"></font></td>

                                    <td><font size="-1">
                                            <input type="text"  class="appl_inputs" name="experiencefrom7" size="9" id="experiencefrom7" value="<?php echo sv('experiencefrom7'); ?>">
                                            <input type="text"  class="appl_inputs" name="experienceto7" size="9" id="experienceto7" value="<?php echo sv('experienceto7'); ?>">
                                        </font></td>

                                    <td><font size="-1">
                                            <input type="text" class="appl_inputs" name="miles7" value="<?php echo sv('miles7'); ?>"></font></td>

                                    <td></td>

                                </tr>

                                <tr>

                                    <td colspan="2"><font size="-1">List
                                            States Operated in for Last 5
                                            years:</font></td>

                                    <td colspan="2"><font size="-1">
                                            <input type="text" class="appl_inputs" maxlength="132" size="50" name="statesoperated" value="<?php echo sv('statesoperated'); ?>"></font></td>

                                    <td></td>

                                </tr>

                                <tr>

                                    <td colspan="2"><font size="-1">Show
                                            special Courses or training
                                            that will help you as a driver:</font></td>

                                    <td colspan="2"><font size="-1">
                                            <input type="text" class="appl_inputs" maxlength="132" size="50" name="specialtraining" value="<?php echo sv('specialtraining'); ?>"></font></td>

                                    <td></td>

                                </tr>

                                <tr>

                                    <td colspan="2"><font size="-1">Which
                                            Safe driving awards do you
                                            hold and from whom?</font></td>

                                    <td colspan="2"><font size="-1">
                                            <input type="text" class="appl_inputs" maxlength="132" size="50" name="drivingawards" value="<?php echo sv('drivingawards'); ?>"></font></td>

                                    <td></td>

                                </tr>

                                <tr>

                                    <td colspan="2"><font size="-1">Show
                                            any trucking, transportation
                                            or other experience that may help in your work for this company</font></td>

                                    <td colspan="2"><font size="-1">
                                            <input type="text" class="appl_inputs" maxlength="132" size="50" name="othertruckingexperience" value="<?php echo sv('othertruckingexperience'); ?>"></font></td>

                                    <td></td>

                                </tr>

                                <tr>

                                    <td colspan="2"><font size="-1">List
                                            courses and training other
                                            than shown elsewhere in this application</font></td>

                                    <td colspan="2"><font size="-1">
                                            <input type="text" class="appl_inputs" maxlength="132" size="50" name="othertraining" value="<?php echo sv('othertraining'); ?>"></font></td>

                                    <td></td>

                                </tr>

                                <tr>

                                    <td colspan="2"><font size="-1">List
                                            special equipment or
                                            technical materials you can work with (other than those already shown)</font></td>

                                    <td colspan="2"><font size="-1">
                                            <input type="text" class="appl_inputs" maxlength="132" size="50" value="<?php sv('othermaterials') ?>" name="othermaterials"></font></td>

                                    <td></td>

                                </tr>

                                <tr>

                                    <td style="text-align: center; color: rgb(102, 102, 102);" colspan="5"><big><font size="-1"><big><span style="font-weight: bold;"><br>

                                                        Education</span></big></font></big></td>

                                    <td></td>

                                </tr>

                                <tr>

                                    <td colspan="2"><font size="-1"><span style="font-weight: bold;">Choose
                                                the Highest Grade Completed</span></font></td>

                                    <td><font size="-1"><span style="font-weight: bold;">High
                                                School</span></font></td>

                                    <td colspan="2"><font size="-1"><span style="font-weight: bold; float: right; width: 167px; padding-right: 20px;">College</span></font></td>

                                    <td></td>

                                </tr>

                                <tr>

                                    <td colspan="2"><font size="-1">1
                                            <input name="grade" value="grade1" type="radio" checked="true">2
                                            <input name="grade" value="grade2" type="radio">3
                                            <input name="grade" value="grade3" type="radio">4
                                            <input name="grade" value="grade4" type="radio">5
                                            <input name="grade" value="grade5" type="radio">6
                                            <input name="grade" value="grade6" type="radio">7
                                            <input name="grade" value="grade7" type="radio">8
                                            <input name="grade" value="grade8" type="radio"></font></td>

                                    <td colspan="3"><font size="-1">0
                                            <input name="highschool" value="high0" type="radio" checked="true">1
                                            <input name="highschool" value="high1" type="radio">2
                                            <input name="highschool" value="high2" type="radio">3
                                            <input name="highschool" value="high3" type="radio">4
                                            <input name="highschool" value="high4" type="radio"></font>

                                        <div style="float:right;padding-right:20px;"><font size="-1">0
                                                <input name="college" value="college0" type="radio" checked="true">1
                                                <input name="college" value="college1" type="radio">2
                                                <input name="college" value="college2" type="radio">3
                                                <input name="college" value="college3" type="radio">4
                                                <input name="college" value="college4" type="radio"></font></div>
                                    </td>



                                    <td></td>

                                </tr>

                                
                                <tr style="height:55px;">

                                   
                                    <td colspan="2" style="font-size: -1;font-weight: bold"><font size="-1">Last School Attended
                                            (Name/City State)</font><font class="redstar">*</font></td>

                                    <td colspan="2"><font size="-1"><input type="text" class="appl_inputs" maxlength="132" size="50" name="lastschool" value="<?php echo sv('lastschool'); ?>"></font></td>

                                    <td></td>

                                    <td></td>

                                </tr>

                                <tr>

                                    <td colspan="3"><font size="-1"><br/>This certifies that this application was completed by me, and that all entries on it and information in it are true and completed to the best of my knowledge.<br>

                                        </font> </td>

                                    <td></td>

                                    <td></td>

                                </tr>

                                <tr>

                                    <td><font size="-1">Signature</font><font class="redstar">*</font></td>

                                    <td><font size="-1"><input type="text" class="appl_inputs" maxlength="132" size="40" name="finalsignature" value="<?php echo sv('finalsignature'); ?>"></font></td>

                                    <td><font size="-1">Date</font><font class="redstar">*</font></td>

                                <script type="text/javascript">
                                    initlist.push(function() {
                                        $("#finaldate").datepicker({ changeMonth: true,changeYear: true});
                                    });
                                </script>
                                        <td><font size="-1"><!--<input name="finaldate" value="<!--?php echo sv('finaldate'); ?>"></font></td>-->
                                        <input type="text" class="appl_inputs"  name="finaldate" id="finaldate" value="<?php echo date('m/d/Y'); ?>" size="9"></font></td>

                                <td></td>

                                </tr>

                                <tr>
                                    <td><font size="-1">Email Address</font></td>
                                    <td><font size="-1"><input type="text" class="appl_inputs" maxlength="132" size="40" name="emailaddress" value="<?php echo sv('emailaddress'); ?>"></font></td>
                                </tr>

                                <tr>
                                    <td><font size="-1">Upload Resume</font></td>
                                    <td><font size="-1"><input type="file" class="appl_inputs" name="uploadedfile"></font></td>
                                </tr>


                                <input type="hidden" name="MAX_FILE_SIZE" value="100000" />
                                <input type="hidden" name="form_token" value="<?php echo $form_token; ?>" />

                                </tbody>
                            </table>
                        </div>

                        <font size="-1"><br>

                            <br>

                            <br>

                        </font>
                        <div style="text-align: center;"><font size="-1">
                                <input value="Submit" name="submit" type="submit"><br>

                            </font> </div>

                    </form>

            </div>
        </div>
    </div>

    <script type="text/javascript">
        $(document).ready(function(){
            for(var i in initlist){
                f =initlist[i];
                f();
            } 
        });
        
    </script>
</body>
</html>
