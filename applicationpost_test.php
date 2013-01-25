<?php

session_start();

// save all post variables into session
foreach ($_POST as $k => $v) {
    $_SESSION[$k] = $v;
}

require_once "lib/Swift.php";
require_once "lib/Swift/Connection/NativeMail.php"; //There are various connections to use
require_once "lib/Swift/Connection/SMTP.php"; //There are various connections to use
#$swift =& new Swift(new Swift_Connection_NativeMail());
$swift = & new Swift(new Swift_Connection_SMTP("mx1.blackhorsecarriers.com"));

$to = "job.application@blackhorsecarriers.com";
#$to = "rstevenson555@comcast.net";
$from = "job.application@blackhorsecarriers.com";


$subject = "application submitted";
$body = "";
//foreach ($_POST as $key => $value)
//{
//$body = $body . $key . "=" . $value . "<br/>";
//}
//echo $body;
//exit(0);

if ($_POST['Fname'] == $_POST['Lname']) {
    //echo("<p>Bad First Name/Last name, please press 'back', correct and resubmit your application.<p>");
    $_SESSION['ERROR'] = "Invalid First Name (and or) Last Name, please press 'back' correct and resubmit your application";
    header('Location: http://www.blackhorsecarriers.com/applicationerror.php?error=' . $_SESSION['ERROR']);
    exit(0);
}

$_POST['Name'] = $_POST['Fname'] . " " . $_POST['Lname'];

$regs = "";

// MM/DD/YYYY
if (!ereg("^([0-9]{1,2})/([0-9]{1,2})/([0-9]{4})$", $_POST['dateof_application'], $regs)) {
    $_SESSION['ERROR'] = "Invalid date of application, enter date in MM/DD/YYYY format and please press 'back' correct and resubmit your application";
    header('Location: http://www.blackhorsecarriers.com/applicationerror.php?error=' . $_SESSION['ERROR']);
    exit(0);
}

$_POST['date_of_application'] = $_POST['dateof_application'];

if ($_POST['accept_signature'] == "") {
    $_SESSION['ERROR'] = "'Accept Signature' is required please press 'back' correct and resubmit your application";
    header('Location: http://www.blackhorsecarriers.com/applicationerror.php?error=' . $_SESSION['ERROR']);
    exit(0);
}

// MM/DD/YYYY
if (!ereg("^([0-9]{1,2})/([0-9]{1,2})/([0-9]{4})$", $_POST['accept_date'], $regs)) {
    $_SESSION['ERROR'] = "Invalid 'Accept Date', enter date in MM/DD/YYYY format and please press 'back' correct and resubmit your application";
    header('Location: http://www.blackhorsecarriers.com/applicationerror.php?error=' . $_SESSION['ERROR']);
    exit(0);
}

//if ($_POST['DOBmonth'] == "0" || $_POST['DOBday'] == "0" || $_POST['DOByear'] == "0000") {
if ($_POST['dob'] == "") {
    $_SESSION['ERROR'] = "'Birth Date' MUST be set, please press 'back' correct and resubmit your application";
    header('Location: http://www.blackhorsecarriers.com/applicationerror.php?error=' . $_SESSION['ERROR']);
    exit(0);
}

if ($_POST['position_appliedfor'] == "") {
    $_SESSION['ERROR'] = "'Position Applied For' MUST be set, please press 'back' correct and resubmit your application";
    header('Location: http://www.blackhorsecarriers.com/applicationerror.php?error=' . $_SESSION['ERROR']);
    exit(0);
}

if ($_POST['CurrentAddress'] == "") {
    $_SESSION['ERROR'] = "'Current Address' MUST be set, please press 'back' correct and resubmit your application";
    header('Location: http://www.blackhorsecarriers.com/applicationerror.php?error=' . $_SESSION['ERROR']);
    exit(0);
}

if ($_POST['SSN1'] == "" || $_POST['SSN2'] == "" || $_POST['SSN3'] == "") {
    $_SESSION['ERROR'] = "'Social Security Number' must be set, please press 'back' correct and resubmit your application";
    header('Location: http://www.blackhorsecarriers.com/applicationerror.php?error=' . $_SESSION['ERROR']);
    exit(0);
}

if ($_POST['finalsignature'] == "") {
    $_SESSION['ERROR'] = "Final 'Signature' is required, please press 'back' correct and resubmit your application";
    header('Location: http://www.blackhorsecarriers.com/applicationerror.php?error=' . $_SESSION['ERROR']);
    exit(0);
}

// MM/DD/YYYY
if (!ereg("^([0-9]{1,2})/([0-9]{1,2})/([0-9]{4})$", $_POST['finaldate'], $regs)) {
    $_SESSION['ERROR'] = "Invalid Application 'Completion Date', enter date in MM/DD/YYYY format and please press 'back' correct and resubmit your application";
    header('Location: http://www.blackhorsecarriers.com/applicationerror.php?error=' . $_SESSION['ERROR']);
    exit(0);
}

/* * * check all expected variables are set ** */
if (!isset($_POST['Fname'], $_POST['form_token'], $_SESSION['form_token'])) {
    $message = "Invalid Submission; please press 'back' correct and resubmit your application";

    $_SESSION['ERROR'] = $message;
    header('Location: http://www.blackhorsecarriers.com/applicationerror.php?error=' . $_SESSION['ERROR']);
}
/* * * check the form tokens match ** */ elseif ($_POST['form_token'] != $_SESSION['form_token']) {
    $message = "Access denied; please press 'back' correct and resubmit your application";

    $_SESSION['ERROR'] = $message;
    header('Location: http://www.blackhorsecarriers.com/applicationerror.php?error=' . $_SESSION['ERROR']);
}
/* * * check the input name is a string between 1 and 50 characters ** */ elseif (strlen(trim($_POST['Fname'])) == 0 || strlen(trim($_POST['Fname'])) > 50) {
    $message = "Invalid First Name; please press 'back' correct and resubmit your application";

    $_SESSION['ERROR'] = $message;
    header('Location: http://www.blackhorsecarriers.com/applicationerror.php?error=' . $_SESSION['ERROR']);
}


//if ( $_POST['Fname'] == "joe" ) {
//    if ($_POST['Lname'] == 'smith') {
//echo "Date " . $regs[0] . "<br/>";
//echo "Month " . $regs[1] . " ";
//echo "Day " . $regs[2] . " ";
//echo "Year " . $regs[3] . " ";
//exit(0);
//}
//}

$_POST['SSN1'] = "XXX";
$_POST['SSN2'] = "XX";

# now wipe session vars
// save all post variables into session
foreach ($_POST as $k => $v) {
    #$_SESSION[$k]=$v;
    unset($_SESSION[$k]);
}


$body = $body . "First Name: " . $_POST['Fname'] . "     Last Name: " . $_POST['Lname'] . "\n";
$body = $body . "Date of Application: " . $_POST['dateof_application'] . "\n";
$body = $body . "
Black Horse Carriers, Inc.\n
150 Village Court\n
Carol Stream, Il 60188\n

In compliance with Federal and State equal employment opportunity laws, qualified applications are considered for all positions without regard to race, color, religion, sex, national origin, age, marital status, veteran status, non-job related disability, or any other protected group status.\n

To Be Read And Signed By Applicant\n

I authorize you to make such investigations and inquiries of my personal, employment financial or medical history and other related matters as may be necessary in arriving at an employment decision. (Generally, inquiries regarding medical history will be made only if and after a conditional offer of emplyment has been extencded.) I herby release emploiyers, schools, health care providers and other persons from all liability in resonsding to inquiries and releasing information in connection with my application.\n

In the event of employment, I understand that false or misleading information given in my application or interview(s) may result in discharge. I understand, also, that I am required to abide by all rules and regulations of Black Horse Carriers, Inc.\n

I understand that information I provide regarding current and/or previous employers may be used, and those employers will be contacted, for the purpose of investigating my safety performance history as required by 49 CFR 391.23(d) and (e).  I understand that I have the right to:\n

    * Review information privided by employers;
\n
    * Have errors in the information corrected by previous employers and for those previous employers to re-send the corrected information to the prospective employer; and
\n
    * Have rebuttal statement attached to the alleged erroneous information, if the previous employer(s) and I cannot agree on the accuracy of the information.
\n

The Information provided in the Application for Employment is true, correct, and complete.  If I am accepted for employment, any misstratement or omission of fact on this application or provided in any interview may result in my dismissal.  I understand that this Application for Employment and other. Company documents are not contracts of employment.\n

I authorize the company to thoroughly investigate my references, personal history, work record, and other matters related to my suitability for employment.  I also release the Company from any and all claims, demands, or liabilities arisiting out of or in any way related to such investigation or disclosure.\n

I understand and agree that if I am employed, my employment is for no definite period of time and my be terminated at any time, with or without prioer notice, at the option of either myself or the Company, and that no primises or representations contrary to the foregoing are binding on the Company unless made in writing and signed by me and the Companys Presisdent.\n";
$body = $body . "\n";

$body = $body . "Signature: " . $_POST['accept_signature'] . "     Date: " . $_POST['accept_date'] . "\n";
$body = $body . "Terminal: " . $_POST['terminal'] . "     Date of application: " . $_POST['date_of_application'] . "\n";
$body = $body . "Positions applied for: " . $_POST['position_appliedfor'];
if ($_POST['applied'] == "applied_am")
    $body = $body . " AM ";
if ($_POST['applied'] == "applied_pmsat")
    $body = $body . " PM(SAT) ";
if ($_POST['applied'] == "applied_pmsun")
    $body = $body . " PM(SUN) ";
if ($_POST['applied'] == "applied_otr")
    $body = $body . " OTR ";
if ($_POST['applied'] == "applied_ec")
    $body = $body . " EC ";
if ($_POST['applied'] == "applied_pt")
    $body = $body . " PT ";

$body = $body . "\n";
$body = $body . "Name: " . $_POST['Name'] . "     SSN " . $_POST['SSN1'] . "-" . $_POST['SSN2'] . "-" . $_POST['SSN3'] . "\n";
$body = $body . "Current Address: " . $_POST['CurrentAddress'] . "\n";
$body = $body . "        City: " . $_POST['CurrentCity'] . "\n";
$body = $body . "        State: " . $_POST['CurrentState'] . "\n";
$body = $body . "        Zip: " . $_POST['CurrentZip'] . "\n";
$body = $body . "Previous Address: " . $_POST['PreviousAddress'] . "\n";
$body = $body . "        City: " . $_POST['PreviousCity'] . "\n";
$body = $body . "        State: " . $_POST['PreviousState'] . "\n";
$body = $body . "        Zip: " . $_POST['PreviousZip'] . "\n";
$body = $body . "Home Phone: " . $_POST['home_phone_number'] . "\n";
$body = $body . " Cell Phone: " . $_POST['cell_phone_number'] . "\n";
$body = $body . " Other Phone: " . $_POST['other_phone_number'] . "\n";
$body = $body . "\n";
$body = $body . "Do you have the right to work in the United States: " . ( $_POST['usa'] == "usa_yes" ? " Yes" : " No") . "\n";
//$body = $body . "Date of Birth: " . $_POST['DOBmonth'] . "/" . $_POST['DOBday'] . "/" . $_POST['DOByear'] . "\n";
$body = $body . "Date of Birth: " . $_POST['dob'] . "\n";
$body = $body . "Have you worked for this company before: " . ( $_POST['thiscompany'] == "thiscompany_yes" ? " Yes" : " No") . "\n";
$body = $body . "Date of Employment ( From:" . $_POST['date_employment'] . " To: " . $_POST['to_employment'] . " ) " . "\n";
$body = $body . "Position Held:" . $_POST['position_held'] . " Reason for leaving: " . $_POST['reason_forleaving'] . " ) " . "\n";
$body = $body . "Are you now employed?: " . ( $_POST['employed'] == "employed_yes" ? " Yes" : " No") . "      If not how long since leaving: " . $_POST['longsinceleaving'] . "\n";
$body = $body . "May we contact your employer at this time: " . ( $_POST['contact'] == "contact_yes" ? " Yes" : " No") . "\n";
$body = $body . "Who referred you? " . $_POST['who_referredyou'] . "\n";
$body = $body . "Rate of pay expected? " . $_POST['rate_payexpected'] . "\n";
$body = $body . "Have you ever been convicted of a felony? " . ( $_POST['felony'] == "felony_yes" ? " Yes" : " No") . "\n";
$body = $body . "If yes, please explain and privde dates? " . $_POST['felony_reason'] . "\n";
$body = $body . "If offered a position when would you be able to start? " . $_POST['start_date'] . "\n";
$body = $body . "Is there any reason you might be unable to perform the essential functions of the job with or without reasonable accomodation for which you have applied? " . ( $_POST['perform'] == "perform_yes" ? " Yes" : " No") . "\n";
$body = $body . "If yes, explain: " . $_POST['unable_explanation'] . "\n";
$body = $body . "Employment History\n

All driver applications to drive a commercial motor vehicle in interstate or intrastate commerce must provide the following information on all employers during the preceding 10 years.  List complete mailing address, street number, city, state and zip code.\n

(Please list employers starting with the most recent first.  Add another sheet if necessary.)\n";
// --------------- EMPLOYER0 SECTION -----------------------------------------------------------------------------
$body = $body . "Employer Name: " . $_POST['emp_name'] . "\n";
$body = $body . "From: " . $_POST['emp_from'] . " To:" . $_POST['emp_to'] . "\n";
$body = $body . "Employer Address: " . $_POST['emp_address'] . "\n";
$body = $body . "Position: " . $_POST['emp_position'] . "\n";
$body = $body . "City, State, Zip: " . $_POST['emp_citystatezip'] . "\n";
$body = $body . "Salary: " . $_POST['emp_salary'] . "\n";
$body = $body . "Contact: " . $_POST['emp_contact'] . "\n";
$body = $body . "Reason Left: " . $_POST['emp_leaving_reason'] . "\n";
$body = $body . "Employer Phone: " . $_POST['emp_phone'] . "\n";
$body = $body . "Were you subject to the FMCSRs While Employed? " . ( $_POST['fmcsr'] == "fmcsr_yes" ? " Yes" : " No") . "\n";
$body = $body . "Was your job designated as a Safety-Sensitive Function in any dot-regulated mode subject to the Drug and Alchohol Testing Requirements of 49 CFR Part 40? " . ( $_POST['emp_safety'] == "emp_safety_yes" ? " Yes" : " No") . "\n";

$body = $body . "\n";
// --------------- EMPLOYER1 SECTION -----------------------------------------------------------------------------
$body = $body . "Employer Name: " . $_POST['emp_name1'] . "\n";
$body = $body . "From: " . $_POST['emp_from1'] . " To:" . $_POST['emp_to1'] . "\n";
$body = $body . "Employer Address: " . $_POST['emp_address1'] . "\n";
$body = $body . "Position: " . $_POST['emp_position1'] . "\n";
$body = $body . "City, State, Zip: " . $_POST['emp_citystatezip1'] . "\n";
$body = $body . "Salary: " . $_POST['emp_salary1'] . "\n";
$body = $body . "Contact: " . $_POST['emp_contact1'] . "\n";
$body = $body . "Reason Left: " . $_POST['emp_leaving_reason1'] . "\n";
$body = $body . "Employer Phone: " . $_POST['emp_phone1'] . "\n";
$body = $body . "Were you subject to the FMCSRs While Employed? " . ( $_POST['fmcsr1'] == "fmcsr_yes1" ? " Yes" : " No") . "\n";
$body = $body . "Was your job designated as a Safety-Sensitive Function in any dot-regulated mode subject to the Drug and Alchohol Testing Requirements of 49 CFR Part 40? " . ( $_POST['emp_safety1'] == "emp_safety1_yes" ? " Yes" : " No") . "\n";

$body = $body . "\n";
// --------------- EMPLOYER2 SECTION -----------------------------------------------------------------------------
$body = $body . "Employer Name: " . $_POST['emp_name2'] . "\n";
$body = $body . "From: " . $_POST['emp_from2'] . " To:" . $_POST['emp_to2'] . "\n";
$body = $body . "Employer Address: " . $_POST['emp_address2'] . "\n";
$body = $body . "Position: " . $_POST['emp_position2'] . "\n";
$body = $body . "City, State, Zip: " . $_POST['emp_citystatezip2'] . "\n";
$body = $body . "Salary: " . $_POST['emp_salary2'] . "\n";
$body = $body . "Contact: " . $_POST['emp_contact2'] . "\n";
$body = $body . "Reason Left: " . $_POST['emp_leaving_reason2'] . "\n";
$body = $body . "Employer Phone: " . $_POST['emp_phone2'] . "\n";
$body = $body . "Were you subject to the FMCSRs While Employed? " . ( $_POST['fmcsr2'] == "fmcsr_yes2" ? " Yes" : " No") . "\n";
$body = $body . "Was your job designated as a Safety-Sensitive Function in any dot-regulated mode subject to the Drug and Alchohol Testing Requirements of 49 CFR Part 40? " . ( $_POST['emp_safety2'] == "emp_safety2_yes" ? " Yes" : " No") . "\n";

$body = $body . "\n";
// --------------- EMPLOYER3 SECTION -----------------------------------------------------------------------------
$body = $body . "Employer Name: " . $_POST['emp_name3'] . "\n";
$body = $body . "From: " . $_POST['emp_from3'] . " To:" . $_POST['emp_to3'] . "\n";
$body = $body . "Employer Address: " . $_POST['emp_address3'] . "\n";
$body = $body . "Position: " . $_POST['emp_position3'] . "\n";
$body = $body . "City, State, Zip: " . $_POST['emp_citystatezip3'] . "\n";
$body = $body . "Salary: " . $_POST['emp_salary3'] . "\n";
$body = $body . "Contact: " . $_POST['emp_contact3'] . "\n";
$body = $body . "Reason Left: " . $_POST['emp_leaving_reason3'] . "\n";
$body = $body . "Employer Phone: " . $_POST['emp_phone3'] . "\n";
$body = $body . "Were you subject to the FMCSRs While Employed? " . ( $_POST['fmcsr3'] == "fmcsr_yes3" ? " Yes" : " No") . "\n";
$body = $body . "Was your job designated as a Safety-Sensitive Function in any dot-regulated mode subject to the Drug and Alchohol Testing Requirements of 49 CFR Part 40? " . ( $_POST['emp_safety3'] == "emp_safety3_yes" ? " Yes" : " No") . "\n";

$body = $body . "\n";
// --------------- EMPLOYER4 SECTION -----------------------------------------------------------------------------
$body = $body . "Employer Name: " . $_POST['emp_name4'] . "\n";
$body = $body . "From: " . $_POST['emp_from4'] . " To:" . $_POST['emp_to4'] . "\n";
$body = $body . "Employer Address: " . $_POST['emp_address4'] . "\n";
$body = $body . "Position: " . $_POST['emp_position4'] . "\n";
$body = $body . "City, State, Zip: " . $_POST['emp_citystatezip4'] . "\n";
$body = $body . "Salary: " . $_POST['emp_salary4'] . "\n";
$body = $body . "Contact: " . $_POST['emp_contact4'] . "\n";
$body = $body . "Reason Left: " . $_POST['emp_leaving_reason4'] . "\n";
$body = $body . "Employer Phone: " . $_POST['emp_phone4'] . "\n";
$body = $body . "Were you subject to the FMCSRs While Employed? " . ( $_POST['fmcsr4'] == "fmcsr_yes" ? " Yes" : " No") . "\n";
$body = $body . "Was your job designated as a Safety-Sensitive Function in any dot-regulated mode subject to the Drug and Alchohol Testing Requirements of 49 CFR Part 40? " . ( $_POST['emp_safety4'] == "emp_safety4_yes" ? " Yes" : " No") . "\n";

$body = $body . "\n";
// --------------- EMPLOYER5 SECTION -----------------------------------------------------------------------------
$body = $body . "Employer Name: " . $_POST['emp_name5'] . "\n";
$body = $body . "From: " . $_POST['emp_from5'] . " To:" . $_POST['emp_to5'] . "\n";
$body = $body . "Employer Address: " . $_POST['emp_address5'] . "\n";
$body = $body . "Position: " . $_POST['emp_position5'] . "\n";
$body = $body . "City, State, Zip: " . $_POST['emp_citystatezip5'] . "\n";
$body = $body . "Salary: " . $_POST['emp_salary5'] . "\n";
$body = $body . "Contact: " . $_POST['emp_contact5'] . "\n";
$body = $body . "Reason Left: " . $_POST['emp_leaving_reason5'] . "\n";
$body = $body . "Employer Phone: " . $_POST['emp_phone5'] . "\n";
$body = $body . "Were you subject to the FMCSRs While Employed? " . ( $_POST['fmcsr5'] == "fmcsr_yes5" ? " Yes" : " No") . "\n";
$body = $body . "Was your job designated as a Safety-Sensitive Function in any dot-regulated mode subject to the Drug and Alchohol Testing Requirements of 49 CFR Part 40? " . ( $_POST['emp_safety5'] == "emp_safety5_yes" ? " Yes" : " No") . "\n";

$body = $body . "\n";
// --------------- EMPLOYER6 SECTION -----------------------------------------------------------------------------
$body = $body . "Employer Name: " . $_POST['emp_name6'] . "\n";
$body = $body . "From: " . $_POST['emp_from6'] . " To:" . $_POST['emp_to6'] . "\n";
$body = $body . "Employer Address: " . $_POST['emp_address6'] . "\n";
$body = $body . "Position: " . $_POST['emp_position6'] . "\n";
$body = $body . "City, State, Zip: " . $_POST['emp_citystatezip6'] . "\n";
$body = $body . "Salary: " . $_POST['emp_salary6'] . "\n";
$body = $body . "Contact: " . $_POST['emp_contact6'] . "\n";
$body = $body . "Reason Left: " . $_POST['emp_leaving_reason6'] . "\n";
$body = $body . "Employer Phone: " . $_POST['emp_phone6'] . "\n";
$body = $body . "Were you subject to the FMCSRs While Employed? " . ( $_POST['fmcsr6'] == "fmcsr_yes6" ? " Yes" : " No") . "\n";
$body = $body . "Was your job designated as a Safety-Sensitive Function in any dot-regulated mode subject to the Drug and Alchohol Testing Requirements of 49 CFR Part 40? " . ( $_POST['emp_safety6'] == "emp_safety6_yes" ? " Yes" : " No") . "\n";

$body = $body . "\n";
// --------------- EMPLOYER7 SECTION -----------------------------------------------------------------------------
$body = $body . "Employer Name: " . $_POST['emp_name7'] . "\n";
$body = $body . "From: " . $_POST['emp_from7'] . " To:" . $_POST['emp_to7'] . "\n";
$body = $body . "Employer Address: " . $_POST['emp_address7'] . "\n";
$body = $body . "Position: " . $_POST['emp_position7'] . "\n";
$body = $body . "City, State, Zip: " . $_POST['emp_citystatezip7'] . "\n";
$body = $body . "Salary: " . $_POST['emp_salary7'] . "\n";
$body = $body . "Contact: " . $_POST['emp_contact7'] . "\n";
$body = $body . "Reason Left: " . $_POST['emp_leaving_reason7'] . "\n";
$body = $body . "Employer Phone: " . $_POST['emp_phone7'] . "\n";
$body = $body . "Were you subject to the FMCSRs While Employed? " . ( $_POST['fmcsr7'] == "fmcsr_yes7" ? " Yes" : " No") . "\n";
$body = $body . "Was your job designated as a Safety-Sensitive Function in any dot-regulated mode subject to the Drug and Alchohol Testing Requirements of 49 CFR Part 40? " . ( $_POST['emp_safety7'] == "emp_safety7_yes" ? " Yes" : " No") . "\n";

$body = $body . "*Includes vehicles having a FVWR of 26,001 lbs. or more, vehicles designed to transport 16 or more passengers (including the driver), or any size vehicles used to transport hazardous materials in a quantity requiring placarding.\n
~The Federal Motor Carrier Safety Regulations (FMCSRs) apply to anyone operating a motor vehicle on a highway in interstate commerce to transport passengers or property when the vehicle: (1) weighs or has a GVWR of 10,001 punds or more, (2) is designed or used to transport more than 8 passengers (including the driver) OR (3) is of any size and is used to transport hazardous materials in a quantity requiring placarding\n";

$body = $body . "\n";
$body = $body . "ACCIDENT RECORD FOR PAST 3 YEARS OR MORE (ATTACH SHEET IF MORE SPACE IS NEEDED). IF NONE, WRITE NONE\n";

$body = $body . "Nature of Last Accident: " . $_POST['accident'] . "\n";
$body = $body . "            Fatailities: " . $_POST['fatalities'] . "\n";
$body = $body . "               Injuries: " . $_POST['injuries'] . "\n";
$body = $body . "        Hazardous Spill: " . $_POST['hazardousspill'] . "\n";

$body = $body . "\n";
$body = $body . "Nature of Next Previous: " . $_POST['accident2'] . "\n";
$body = $body . "            Fatailities: " . $_POST['fatalities2'] . "\n";
$body = $body . "               Injuries: " . $_POST['injuries2'] . "\n";
$body = $body . "        Hazardous Spill: " . $_POST['hazardousspill2'] . "\n";

$body = $body . "\n";
$body = $body . "Nature of Next Previous: " . $_POST['accident3'] . "\n";
$body = $body . "            Fatailities: " . $_POST['fatalities3'] . "\n";
$body = $body . "               Injuries: " . $_POST['injuries3'] . "\n";
$body = $body . "        Hazardous Spill: " . $_POST['hazardousspill3'] . "\n";

$body = $body . "\n";
$body = $body . "Traffic Location: " . $_POST['trafficloc'] . "\n";
$body = $body . "Traffic Date: " . $_POST['trafficdate'] . "\n";
$body = $body . "Traffic Charge: " . $_POST['trafficcharge'] . "\n";
$body = $body . "Traffic Penalty: " . $_POST['trafficpenalty'] . "\n";

$body = $body . "\n";
$body = $body . "Traffic Location: " . $_POST['trafficloc2'] . "\n";
$body = $body . "Traffic Date: " . $_POST['trafficdate2'] . "\n";
$body = $body . "Traffic Charge: " . $_POST['trafficcharge2'] . "\n";
$body = $body . "Traffic Penalty: " . $_POST['trafficpenalty2'] . "\n";

$body = $body . "\n";
$body = $body . "Traffic Location: " . $_POST['trafficloc3'] . "\n";
$body = $body . "Traffic Date: " . $_POST['trafficdate3'] . "\n";
$body = $body . "Traffic Charge: " . $_POST['trafficcharge3'] . "\n";
$body = $body . "Traffic Penalty: " . $_POST['trafficpenalty3'] . "\n";

$body = $body . "\n";
$body = $body . "Experience and Qualifications\n";
$body = $body . "       License State: " . $_POST['qualifystate'] . "\n";
$body = $body . "      License Number: " . $_POST['qualifylicense'] . "\n";
$body = $body . "        License Type: " . $_POST['qualifytype'] . "\n";
$body = $body . "  License Expiration: " . $_POST['qualifyexpiration'] . "\n";

$body = $body . "Have you ever been denied a license, permit or privilege to operate a motor vehicle? " . ($_POST['denied'] == "denied_yes" ? " Yes" : " No" ) . "\n";
$body = $body . "Has any license, permit or privilege ever been suspended or revoked? " . ($_POST['revoked'] == "revoked_yes" ? " Yes" : " No" ) . "\n";

$body = $body . "\n";
$body = $body . "Driving Experience\n ";
$body = $body . "       Straight Truck: " . ($_POST['straight'] == "straightvan" ? " Yes" : " No") . "\n";
$body = $body . "    Type of Equipment: " . " Van " . ($_POST['equip'] == "equipvan" ? " Yes" : " No") . "\n";
$body = $body . "                     : " . " Tank " . ($_POST['equip'] == "equiptank" ? " Yes" : " No") . "\n";
$body = $body . "                     : " . " Flat " . ($_POST['equip'] == "equipflat" ? " Yes" : " No") . "\n";
$body = $body . "                     : " . " Dump " . ($_POST['equip'] == "equipdump" ? " Yes" : " No") . "\n";
$body = $body . "                     : " . " Reefer " . ($_POST['equip'] == "equipreefer" ? " Yes" : " No") . "\n";
$body = $body . "   Experience From/To: " . $_POST['experiencetofrom'] . "\n";
$body = $body . "  Approx Num of Miles: " . $_POST['miles'] . "\n";

$body = $body . "\n";
$body = $body . " Tractor and SemiTrailer: " . ($_POST['tractor'] == "tractoryes" ? " Yes" : " No") . "\n";
$body = $body . "    Type of Equipment: " . " Van " . ($_POST['equip2'] == "equip2van" ? " Yes" : " No") . "\n";
$body = $body . "                     : " . " Tank " . ($_POST['equip2'] == "equip2tank" ? " Yes" : " No") . "\n";
$body = $body . "                     : " . " Flat " . ($_POST['equip2'] == "equip2flat" ? " Yes" : " No") . "\n";
$body = $body . "                     : " . " Dump " . ($_POST['equip2'] == "equip2dump" ? " Yes" : " No") . "\n";
$body = $body . "                     : " . " Reefer " . ($_POST['equip2'] == "equip2reefer" ? " Yes" : " No") . "\n";
$body = $body . "      Experience From/To: " . $_POST['experiencetofrom2'] . "\n";
$body = $body . "     Approx Num of Miles: " . $_POST['miles2'] . "\n";

$body = $body . "\n";
$body = $body . "    Tractor Two Trailers: " . ($_POST['twotrailers'] == "twotrailersyes" ? " Yes" : " No") . "\n";
$body = $body . "    Type of Equipment: " . " Van " . ($_POST['equip3'] == "equip3van" ? " Yes" : " No") . "\n";
$body = $body . "                     : " . " Tank " . ($_POST['equip3'] == "equip3tank" ? " Yes" : " No") . "\n";
$body = $body . "                     : " . " Flat " . ($_POST['equip3'] == "equip3flat" ? " Yes" : " No") . "\n";
$body = $body . "                     : " . " Dump " . ($_POST['equip3'] == "equip3dump" ? " Yes" : " No") . "\n";
$body = $body . "                     : " . " Reefer " . ($_POST['equip3'] == "equip3reefer" ? " Yes" : " No") . "\n";
$body = $body . "      Experience From/To: " . $_POST['experiencetofrom3'] . "\n";
$body = $body . "     Approx Num of Miles: " . $_POST['miles3'] . "\n";

$body = $body . "\n";
$body = $body . "  Tractor Three Trailers: " . ($_POST['threetrailers'] == "threetrailersyes" ? " Yes" : " No") . "\n";
$body = $body . "    Type of Equipment: " . " Van " . ($_POST['equip4'] == "equip4van" ? " Yes" : " No") . "\n";
$body = $body . "                     : " . " Tank " . ($_POST['equip4'] == "equip4tank" ? " Yes" : " No") . "\n";
$body = $body . "                     : " . " Flat " . ($_POST['equip4'] == "equip4flat" ? " Yes" : " No") . "\n";
$body = $body . "                     : " . " Dump " . ($_POST['equip4'] == "equip4dump" ? " Yes" : " No") . "\n";
$body = $body . "                     : " . " Reefer " . ($_POST['equip4'] == "equip4reefer" ? " Yes" : " No") . "\n";
$body = $body . "      Experience From/To: " . $_POST['experiencetofrom4'] . "\n";
$body = $body . "     Approx Num of Miles: " . $_POST['miles4'] . "\n";

$body = $body . "\n";
$body = $body . "Motor Coach School Bus 8+: " . ($_POST['school8'] == "school8yes" ? " Yes" : " No") . "\n";
$body = $body . "       Experience From/To: " . $_POST['experiencetofrom5'] . "\n";
$body = $body . "      Approx Num of Miles: " . $_POST['miles5'] . "\n";

$body = $body . "\n";
$body = $body . "Motor Coach School Bus 15+: " . ($_POST['school15'] == "scholl15yes" ? " Yes" : " No") . "\n";
$body = $body . "        Experience From/To: " . $_POST['experiencetofrom6'] . "\n";
$body = $body . "       Approx Num of Miles: " . $_POST['miles6'] . "\n";

$body = $body . "\n";
$body = $body . "Other Equipment: " . $_POST['otherequipment'] . "\n";
$body = $body . "List states operated in for last 5 years: " . $_POST['statesoperated'] . "\n";
$body = $body . "Show special Courses or training that will help you as a driver: " . $_POST['specialtraining'] . "\n";
$body = $body . "Which safe driving awards do you hold and from whom: " . $_POST['drivingawards'] . "\n";
$body = $body . "Show any trucking, transportation or other experience that may help in your work for this company: " . $_POST['othertruckingexperience'] . "\n";
$body = $body . "List course and training other than shown elsewhere in this application: " . $_POST['othertraining'] . "\n";
$body = $body . "List special equipment or technical materials you can work with (other than those already shown): " . $_POST['othermaterials'] . "\n";

$body = $body . "\n";
$body = $body . "\nEducation\n";

$body = $body . "Highest Grade Completed: ";

if ($_POST['grade'] == "grade1")
    $body = $body . " Grade 1\n";
if ($_POST['grade'] == "grade2")
    $body = $body . " Grade 2\n";
if ($_POST['grade'] == "grade3")
    $body = $body . " Grade 3\n";
if ($_POST['grade'] == "grade4")
    $body = $body . " Grade 4\n";
if ($_POST['grade'] == "grade5")
    $body = $body . " Grade 5\n";
if ($_POST['grade'] == "grade6")
    $body = $body . " Grade 6\n";
if ($_POST['grade'] == "grade7")
    $body = $body . " Grade 7\n";
if ($_POST['grade'] == "grade8")
    $body = $body . " Grade 8\n";

$body = $body . "\n";

$body = $body . "High School: ";

if ($_POST['highschool'] == "high1")
    $body = $body . " High 1\n";
if ($_POST['highschool'] == "high2")
    $body = $body . " High 2\n";
if ($_POST['highschool'] == "high3")
    $body = $body . " High 3\n";
if ($_POST['highschool'] == "high4")
    $body = $body . " High 4\n";

$body = $body . "\n";

$body = $body . "College: ";

if ($_POST['college'] == "college1")
    $body = $body . " College 1\n";
if ($_POST['college'] == "college2")
    $body = $body . " College 2\n";
if ($_POST['college'] == "college3")
    $body = $body . " College 3\n";
if ($_POST['college'] == "college4")
    $body = $body . " College 4\n";
$body = $body . "\n";

$body = $body . "Last school attended: " . $_POST['lastschool'] . "\n";
$body = $body . "This certifies that this application was completed by me, and that all entries on it and information in it are true and completed to the best of my knowlege.\n";
$body = $body . "Signature: " . $_POST['finalsignature'] . "\n";
$body = $body . "Date: " . $_POST['finaldate'] . "\n";


if (!isset($_POST['emailaddress'])) {
    $fromaddress = "job.application@blackhorsecarriers.com";
} else {
    $fromaddress = $_POST['emailaddress'];
}

if ($fromaddress == "") {
    $fromaddress = "job.application@blackhorsecarriers.com";
}

$message = & new Swift_Message($subject, $body);

$auto_message_body = "We have received your on-line application and appreciate your interest in Black Horse Carriers.  Depending on the driving position you are applying for, you will be contacted if your application meets our hiring requirements.  If you are applying in response to a specific driving position ad and you don't hear anything within ten (10) days please call 1-888-521-6700 for an update.
	\nThank You Again and Good Luck.";
$autoreply_message = & new Swift_Message("Application Received", $auto_message_body);


$excelbody = "";
$excelbody .= "<html>";
$excelbody .= "<body>";
$excelbody .= "<table>";

$code = "";

foreach ($_POST as $key => $value) {
    if ($key === "CurrentCity") {
        
    } elseif ($key === "CurrentZip") {
        
    } elseif ($key === "CurrentState") {
        
    } elseif ($key === "PreviousCity") {
        
    } elseif ($key === "PreviousZip") {
        
    } elseif ($key === "PreviousState") {
        
    } elseif ($key === "uploadedfile") {
        
    } elseif ($key === "MAX_FILE_SIZE") {
        
    } elseif ($key === "form_token") {
        
    } else {
        $excelbody .= "<tr>";
        $excelbody .= "    <td>";
        $excelbody .= $key;
        $excelbody .= "    </td>";
        $excelbody .= "    <td>";
        $excelbody .= $value;
        $excelbody .= "    </td>";
        $excelbody .= "</tr>";
        
        $code .= "<tr><td>" . $key . "</td><td>" .  "$" . "_POST" . "['" . $key . "']</td></tr>\n";
    }
}
$excelbody .= "<tr><td>CurrentCity</td><td>" . $_POST['CurrentCity'] . "</td></tr>";
        $code .= "<tr><td>" . 'CurrentCity' . "</td><td>" . "$" . "_POST" . "['" . 'CurrentCity' . "']</td></tr>\n";

$excelbody .= "<tr><td>CurrentState</td><td>" . $_POST['CurrentState'] . "</td></tr>";
        $code .= "<tr><td>" . 'CurrentState' . "</td><td>" . "$" . "_POST" . "['" . 'CurrentState' . "']</td></tr>\n";

$excelbody .= "<tr><td>CurrentZip</td><td>" . $_POST['CurrentZip'] . "</td></tr>";
        $code .= "<tr><td>" . 'CurrentZip' . "</td><td>" . "$" . "_POST" . "['" . 'CurrentZip' . "']</td></tr>\n";


$excelbody .= "<tr><td>PreviousCity</td><td>" . $_POST['PreviousCity'] . "</td></tr>";
        $code .= "<tr><td>" . 'PreviousCity' . "</td><td>" . "$" . "_POST" . "['" . 'PreviousCity' . "']</td></tr>\n";

        
$excelbody .= "<tr><td>PreviousState</td><td>" . $_POST['PreviousState'] . "</td></tr>";
        $code .= "<tr><td>" . 'PreviousState' . "</td><td>" . "$" . "_POST" . "['" . 'PreviousState' . "']</td></tr>\n";

$excelbody .= "<tr><td>PreviousZip</td><td>" . $_POST['PreviousZip'] . "</td></tr>";
        $code .= "<tr><td>" . 'PreviousZip' . "</td><td>" . "$" . "_POST" . "['" . 'PreviousZip' . "']</td></tr>\n";

        
$excelbody .= "<tr><td>upload filename</td><td>" . $_FILE['uploadedfile']['tmp_name'] . "</td></tr>";
        $code .= "<tr><td>" . 'uploadedfile' . "</td><td>" . "$" . "_POST" . "['" . 'uploadedfile' . "']" .  "['" . 'tmp_name' . "']</td></tr>\n";

$excelbody .= "<tr><td>form_token</td><td>" . $_POST['form_token'] . "</td></tr>";
        $code .= "<tr><td>" . 'form_token' . "</td><td>" . "$" . "_POST" . "['" . 'form_token'. "']</td></tr>\n";


$excelbody .= "</table>";
$excelbody .= "</body>";
$excelbody .= "</html>";
$excelbody .= "\n\n";

$message->attach(new Swift_Message_Part($body));

#$test = $_GET['test'] === 'true' ? true : false;
$test = true;

if ($test != true ) {
    $message->attach(new Swift_Message_Attachment(
                $excelbody, "application.xls", "application/vnd.ms-excel"));
}

#$message->attach(new Swift_Message_Attachment(
#                $code, "application_output.php", "text/plain"));


$file_path = false;
$file_name = false;
$file_type = false;

if (!empty($_FILES["uploadedfile"]["tmp_name"])) {
    if ($_FILES["uploadedfile"]["error"]) {
        echo("<p>File Upload failed...</p>");
        exit();
    }
    $file_path = $_FILES["uploadedfile"]["tmp_name"];
    $file_name = $_FILES["uploadedfile"]["name"];
    $file_type = $_FILES["uploadedfile"]["type"];

    if ($file_path && $file_name && $file_type) {
        $message->attach(new Swift_Message_Attachment(
                        new Swift_File($file_path), $file_name, $file_type));
        // good
    }
}

unset($_SESSION['form_token']);

if ($test == false) {
    if ($swift->send($message, $to, $fromaddress)) {
        // send a message back to the applicant
        #$swift->disconnect();
        #echo $fromaddress;
        #echo $to;
        #$swift =& new Swift(new Swift_Connection_NativeMail());
        #$swift =& new Swift(new Swift_Connection_SMTP("mx1.blackhorsecarriers.com"));

        $swift->send($autoreply_message, $fromaddress, $to);
        $swift->disconnect();

        header('Location: http://www.blackhorsecarriers.com/applicationsent.php');
    } else {
        $swift->disconnect();
        echo("<p>Word Message delivery failed...</p>");
    }
}
?>
