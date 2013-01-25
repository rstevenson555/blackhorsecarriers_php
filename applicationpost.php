<?php

function get_post_data($key) {
    if (!isset($_POST[$key])) 
        return "";
    $x = $_POST[$key];
    return $x;
}

function write_key_value($key,$value) {
     $str .= "<tr><td>" . $key . "</td><td>" . $value . "</td></tr>\n";
     return $str;
}

function make_string($value) {
    $str = "=&quot;" . $value . "&quot;";
    return $str;
}

//original Title Case script © John Gruber <daringfireball.net>
//javascript port © David Gouch <individed.com>
//PHP port of the above by Kroc Camen <camendesign.com>

function titleCase ($title) {
	//remove HTML, storing it for later
	//       HTML elements to ignore    | tags  | entities
	$regx = '/<(code|var)[^>]*>.*?<\/\1>|<[^>]+>|&\S+;/';
	preg_match_all ($regx, $title, $html, PREG_OFFSET_CAPTURE);
	$title = preg_replace ($regx, '', $title);
	
	//find each word (including punctuation attached)
	preg_match_all ('/[\w\p{L}&`\'‘’"“\.@:\/\{\(\[<>_]+-? */u', $title, $m1, PREG_OFFSET_CAPTURE);
	foreach ($m1[0] as &$m2) {
		//shorthand these- "match" and "index"
		list ($m, $i) = $m2;
		
		//correct offsets for multi-byte characters (`PREG_OFFSET_CAPTURE` returns *byte*-offset)
		//we fix this by recounting the text before the offset using multi-byte aware `strlen`
		$i = mb_strlen (substr ($title, 0, $i), 'UTF-8');
		
		//find words that should always be lowercase…
		//(never on the first word, and never if preceded by a colon)
		$m = $i>0 && mb_substr ($title, max (0, $i-2), 1, 'UTF-8') !== ':' && 
			!preg_match ('/[\x{2014}\x{2013}] ?/u', mb_substr ($title, max (0, $i-2), 2, 'UTF-8')) && 
			 preg_match ('/^(a(nd?|s|t)?|b(ut|y)|en|for|i[fn]|o[fnr]|t(he|o)|vs?\.?|via)[ \-]/i', $m)
		?	//…and convert them to lowercase
			mb_strtolower ($m, 'UTF-8')
			
		//else:	brackets and other wrappers
		: (	preg_match ('/[\'"_{(\[‘“]/u', mb_substr ($title, max (0, $i-1), 3, 'UTF-8'))
		?	//convert first letter within wrapper to uppercase
			mb_substr ($m, 0, 1, 'UTF-8').
			mb_strtoupper (mb_substr ($m, 1, 1, 'UTF-8'), 'UTF-8').
			mb_substr ($m, 2, mb_strlen ($m, 'UTF-8')-2, 'UTF-8')
			
		//else:	do not uppercase these cases
		: (	preg_match ('/[\])}]/', mb_substr ($title, max (0, $i-1), 3, 'UTF-8')) ||
			preg_match ('/[A-Z]+|&|\w+[._]\w+/u', mb_substr ($m, 1, mb_strlen ($m, 'UTF-8')-1, 'UTF-8'))
		?	$m
			//if all else fails, then no more fringe-cases; uppercase the word
		:	mb_strtoupper (mb_substr ($m, 0, 1, 'UTF-8'), 'UTF-8').
			mb_substr ($m, 1, mb_strlen ($m, 'UTF-8'), 'UTF-8')
		));
		
		//resplice the title with the change (`substr_replace` is not multi-byte aware)
		$title = mb_substr ($title, 0, $i, 'UTF-8').$m.
			 mb_substr ($title, $i+mb_strlen ($m, 'UTF-8'), mb_strlen ($title, 'UTF-8'), 'UTF-8')
		;
	}
	
	//restore the HTML
	foreach ($html[0] as &$tag) $title = substr_replace ($title, $tag[0], $tag[1], 0);
	return $title;
}

session_start();

// save all post variables into session
foreach ($_POST as $k => $v) {
    $value = $v;
    if ( strpos($k,'name')!=false) {
        $value = titleCase($v);
    }
    if ( strpos($k, 'address')!=false) {
        $value = titleCase($v);
    }
    if ( strpos($k, 'city')!=false) {
        $value = titleCase($v);
    }
    if ( strpos($k, 'explanation')!=false) {
        $value = titleCase($v);
    }
    if ( strpos($k, 'who_referredyou')!=false) {
        $value = titleCase($v);
    }
    if ( strpos($k, 'felony_reason')!=false) {
        $value = titleCase($v);
    }
    if ( strpos($k, 'reason_forleaving')!=false) {
        $value = titleCase($v);
    }
    if ( strpos($k, 'emp_position')!=false) {
        $value = titleCase($v);
    }
    if ( strpos($k, 'unable_explanation')!=false) {
        $value = titleCase($v);
    }
    if ( strpos($k, 'signature')!=false) {
        $value = titleCase($v);
    }
    if ( strpos($k, 'signature')!=false) {
        $value = titleCase($v);
    }
    if ( strpos($k, 'accident')!=false) {
        $value = titleCase($v);
    }
    if ( strpos($k, 'position_appliedfor')!=false) {
        $value = titleCase($v);
    }
    
    $_POST[$k] = $value;
    $_SESSION[$k] = $value;
}

require_once "lib/Swift.php";
require_once "lib/Swift/Connection/NativeMail.php"; //There are various connections to use
require_once "lib/Swift/Connection/SMTP.php"; //There are various connections to use
#$swift =& new Swift(new Swift_Connection_NativeMail());
$swift = & new Swift(new Swift_Connection_SMTP("mx1.blackhorsecarriers.com"));

#$to = "job.application@blackhorsecarriers.com";
$to = "terri@blackhorsecarriers.com";
//$to = "rstevenson555@comcast.net";
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

if ($_POST['terminal'] === "Select") {
    $_SESSION['ERROR'] = "Terminal is required, please press 'back' correct and resubmit your application";
    header('Location: http://www.blackhorsecarriers.com/applicationerror.php?error=' . $_SESSION['ERROR']);
    exit(0);
}

if ($_POST['CurrentState'] === "Select") {
    $_SESSION['ERROR'] = "Your home state is required, please press 'back' correct and resubmit your application";
    header('Location: http://www.blackhorsecarriers.com/applicationerror.php?error=' . $_SESSION['ERROR']);
    exit(0);
}

if ($_POST['qualifystate'] === "Select") {
    $_SESSION['ERROR'] = "License qualifying state is required, please press 'back' correct and resubmit your application";
    header('Location: http://www.blackhorsecarriers.com/applicationerror.php?error=' . $_SESSION['ERROR']);
    exit(0);
}

if ($_POST['qualifylicense'] == "") {
    $_SESSION['ERROR'] = "License is required, please press 'back' correct and resubmit your application";
    header('Location: http://www.blackhorsecarriers.com/applicationerror.php?error=' . $_SESSION['ERROR']);
    exit(0);
}
if ($_POST['qualifyexpiration'] == "") {
    $_SESSION['ERROR'] = "License expiration is required, please press 'back' correct and resubmit your application";
    header('Location: http://www.blackhorsecarriers.com/applicationerror.php?error=' . $_SESSION['ERROR']);
    exit(0);
}
if ($_POST['qualifytype'] == "") {
    $_SESSION['ERROR'] = "License type/class is required, please press 'back' correct and resubmit your application";
    header('Location: http://www.blackhorsecarriers.com/applicationerror.php?error=' . $_SESSION['ERROR']);
    exit(0);
}

if ($_POST['emp_name'] == "") {
    $_SESSION['ERROR'] = "Employee Name is required, please press 'back' correct and resubmit your application";
    header('Location: http://www.blackhorsecarriers.com/applicationerror.php?error=' . $_SESSION['ERROR']);
    exit(0);
}
if ($_POST['emp_address'] == "") {
    $_SESSION['ERROR'] = "Employee Address is required, please press 'back' correct and resubmit your application";
    header('Location: http://www.blackhorsecarriers.com/applicationerror.php?error=' . $_SESSION['ERROR']);
    exit(0);
}
if ($_POST['emp_citystatezip'] == "") {
    $_SESSION['ERROR'] = "Employee City, State, Zip are required, please press 'back' correct and resubmit your application";
    header('Location: http://www.blackhorsecarriers.com/applicationerror.php?error=' . $_SESSION['ERROR']);
    exit(0);
}
if ($_POST['emp_contact'] == "") {
    $_SESSION['ERROR'] = "Employee Contact is required, please press 'back' correct and resubmit your application";
    header('Location: http://www.blackhorsecarriers.com/applicationerror.php?error=' . $_SESSION['ERROR']);
    exit(0);
}
if ($_POST['emp_position'] == "") {
    $_SESSION['ERROR'] = "Employee Position is required, please press 'back' correct and resubmit your application";
    header('Location: http://www.blackhorsecarriers.com/applicationerror.php?error=' . $_SESSION['ERROR']);
    exit(0);
}
if ($_POST['emp_salary'] == "") {
    $_SESSION['ERROR'] = "Employee Salary is required, please press 'back' correct and resubmit your application";
    header('Location: http://www.blackhorsecarriers.com/applicationerror.php?error=' . $_SESSION['ERROR']);
    exit(0);
}
if ($_POST['emp_from'] == "") {
    $_SESSION['ERROR'] = "Employee From Date is required, please press 'back' correct and resubmit your application";
    header('Location: http://www.blackhorsecarriers.com/applicationerror.php?error=' . $_SESSION['ERROR']);
    exit(0);
}
if ($_POST['emp_to'] == "") {
    $_SESSION['ERROR'] = "Employee To Date is required, please press 'back' correct and resubmit your application";
    header('Location: http://www.blackhorsecarriers.com/applicationerror.php?error=' . $_SESSION['ERROR']);
    exit(0);
}
if ($_POST['emp_phone'] == "") {
    $_SESSION['ERROR'] = "Employee Phone # is required, please press 'back' correct and resubmit your application";
    header('Location: http://www.blackhorsecarriers.com/applicationerror.php?error=' . $_SESSION['ERROR']);
    exit(0);
}
if ($_POST['emp_leaving_reason'] == "") {
    $_SESSION['ERROR'] = "Employee Reason for Leaving is required, please press 'back' correct and resubmit your application";
    header('Location: http://www.blackhorsecarriers.com/applicationerror.php?error=' . $_SESSION['ERROR']);
    exit(0);
}
if ($_POST['lastschool'] == "") {
    $_SESSION['ERROR'] = "Last School attended is required, please press 'back' correct and resubmit your application";
    header('Location: http://www.blackhorsecarriers.com/applicationerror.php?error=' . $_SESSION['ERROR']);
    exit(0);
}
if ($_POST['highschool'] == "high0" && $_POST['college'] == 'college0') {
    $_SESSION['ERROR'] = "Highest grade completed is required, please press 'back' correct and resubmit your application";
    header('Location: http://www.blackhorsecarriers.com/applicationerror.php?error=' . $_SESSION['ERROR']);
    exit(0);
}

#if ($_POST['grade'] == "grade1") {
#    $_SESSION['ERROR'] = "Last School attended is required, please press 'back' correct and resubmit your application";
#    header('Location: http://www.blackhorsecarriers.com/applicationerror.php?error=' . $_SESSION['ERROR']);
#    exit(0);
#}
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

$excelbody .= write_key_value('Fname',get_post_data('Fname'));
$excelbody .= write_key_value('Lname',get_post_data('Lname'));
$excelbody .= write_key_value('dateof_application',get_post_data('dateof_application'));
$excelbody .= write_key_value('accept_signature',get_post_data('accept_signature'));
$excelbody .= write_key_value('accept_date',get_post_data('accept_date'));
$excelbody .= write_key_value('terminal',get_post_data('terminal'));
$excelbody .= write_key_value('date_of_application',get_post_data('date_of_application'));
$excelbody .= write_key_value('position_appliedfor',get_post_data('position_appliedfor'));
$excelbody .= write_key_value('timeapplied',get_post_data('timeapplied'));
$excelbody .= write_key_value('Name',get_post_data('Name'));
$excelbody .= write_key_value('SSN1',get_post_data('SSN1'));
$excelbody .= write_key_value('SSN2',get_post_data('SSN2'));
$excelbody .= write_key_value('SSN3',get_post_data('SSN3'));
$excelbody .= write_key_value('CurrentAddress',get_post_data('CurrentAddress'));
$excelbody .= write_key_value('PreviousAddress',get_post_data('PreviousAddress'));
$excelbody .= write_key_value('home_phone_number',get_post_data('home_phone_number'));
$excelbody .= write_key_value('cell_phone_number',get_post_data('cell_phone_number'));
$excelbody .= write_key_value('other_phone_number',get_post_data('other_phone_number'));
$excelbody .= write_key_value('usa',get_post_data('usa'));
$excelbody .= write_key_value('dob',get_post_data('dob'));
$excelbody .= write_key_value('DOBday',get_post_data('DOBday'));
$excelbody .= write_key_value('DOByear',get_post_data('DOByear'));
$excelbody .= write_key_value('thiscompany',get_post_data('thiscompany'));
$excelbody .= write_key_value('date_employment',get_post_data('date_employment'));
$excelbody .= write_key_value('to_employment',get_post_data('to_employment'));
$excelbody .= write_key_value('position_held',get_post_data('position_held'));
$excelbody .= write_key_value('reason_forleaving',get_post_data('reason_forleaving'));
$excelbody .= write_key_value('employed',get_post_data('employed'));
$excelbody .= write_key_value('longsinceleaving',get_post_data('longsinceleaving'));
$excelbody .= write_key_value('contact',get_post_data('contact'));
$excelbody .= write_key_value('who_referredyou',get_post_data('who_referredyou'));
$excelbody .= write_key_value('rate_payexpected',get_post_data('rate_payexpected'));
$excelbody .= write_key_value('felony',get_post_data('felony'));
$excelbody .= write_key_value('felony_reason',get_post_data('felony_reason'));
$excelbody .= write_key_value('start_date',get_post_data('start_date'));
$excelbody .= write_key_value('perform',get_post_data('perform'));
$excelbody .= write_key_value('unable_explaination',get_post_data('unable_explaination'));
$excelbody .= write_key_value('emp_name',get_post_data('emp_name'));
$excelbody .= write_key_value('emp_from',get_post_data('emp_from'));
$excelbody .= write_key_value('emp_to',get_post_data('emp_to'));
$excelbody .= write_key_value('emp_address',get_post_data('emp_address'));
$excelbody .= write_key_value('emp_position',get_post_data('emp_position'));
$excelbody .= write_key_value('emp_citystatezip',make_string(get_post_data('emp_citystatezip')));
$excelbody .= write_key_value('emp_salary',get_post_data('emp_salary'));
$excelbody .= write_key_value('emp_contact',get_post_data('emp_contact'));
$excelbody .= write_key_value('emp_leaving_reason',get_post_data('emp_leaving_reason'));
$excelbody .= write_key_value('emp_phone',get_post_data('emp_phone'));
$excelbody .= write_key_value('fmcsr',get_post_data('fmcsr'));
$excelbody .= write_key_value('emp_safety',get_post_data('emp_safety'));
$excelbody .= write_key_value('emp_name1',get_post_data('emp_name1'));
$excelbody .= write_key_value('emp_from1',get_post_data('emp_from1'));
$excelbody .= write_key_value('emp_to1',get_post_data('emp_to1'));
$excelbody .= write_key_value('emp_address1',get_post_data('emp_address1'));
$excelbody .= write_key_value('emp_position1',get_post_data('emp_position1'));
$excelbody .= write_key_value('emp_citystatezip1',make_string(get_post_data('emp_citystatezip1')));
$excelbody .= write_key_value('emp_salary1',get_post_data('emp_salary1'));
$excelbody .= write_key_value('emp_contact1',get_post_data('emp_contact1'));
$excelbody .= write_key_value('emp_leaving_reason1',get_post_data('emp_leaving_reason1'));
$excelbody .= write_key_value('emp_phone1',get_post_data('emp_phone1'));
$excelbody .= write_key_value('fmcsr1',get_post_data('fmcsr1'));
$excelbody .= write_key_value('emp_safety2',get_post_data('emp_safety2'));
$excelbody .= write_key_value('emp_name2',get_post_data('emp_name2'));
$excelbody .= write_key_value('emp_from2',get_post_data('emp_from2'));
$excelbody .= write_key_value('emp_to2',get_post_data('emp_to2'));
$excelbody .= write_key_value('emp_address2',get_post_data('emp_address2'));
$excelbody .= write_key_value('emp_position2',get_post_data('emp_position2'));
$excelbody .= write_key_value('emp_citystatezip2',make_string(get_post_data('emp_citystatezip2')));
$excelbody .= write_key_value('emp_salary2',get_post_data('emp_salary2'));
$excelbody .= write_key_value('emp_contact2',get_post_data('emp_contact2'));
$excelbody .= write_key_value('emp_leaving_reason2',get_post_data('emp_leaving_reason2'));
$excelbody .= write_key_value('emp_phone2',get_post_data('emp_phone2'));
$excelbody .= write_key_value('fmcsr2',get_post_data('fmcsr2'));
$excelbody .= write_key_value('emp_safety3',get_post_data('emp_safety3'));
$excelbody .= write_key_value('emp_name3',get_post_data('emp_name3'));
$excelbody .= write_key_value('emp_from3',get_post_data('emp_from3'));
$excelbody .= write_key_value('emp_to3',get_post_data('emp_to3'));
$excelbody .= write_key_value('emp_address3',get_post_data('emp_address3'));
$excelbody .= write_key_value('emp_position3',get_post_data('emp_position3'));
$excelbody .= write_key_value('emp_citystatezip3',make_string(get_post_data('emp_citystatezip3')));
$excelbody .= write_key_value('emp_salary3',get_post_data('emp_salary3'));
$excelbody .= write_key_value('emp_contact3',get_post_data('emp_contact3'));
$excelbody .= write_key_value('emp_leaving_reason3',get_post_data('emp_leaving_reason3'));
$excelbody .= write_key_value('emp_phone3',get_post_data('emp_phone3'));
$excelbody .= write_key_value('fmcsr3',get_post_data('fmcsr3'));
$excelbody .= write_key_value('emp_safety4',get_post_data('emp_safety4'));
$excelbody .= write_key_value('emp_name4',get_post_data('emp_name4'));
$excelbody .= write_key_value('emp_from4',get_post_data('emp_from4'));
$excelbody .= write_key_value('emp_to4',get_post_data('emp_to4'));
$excelbody .= write_key_value('emp_address4',get_post_data('emp_address4'));
$excelbody .= write_key_value('emp_position4',get_post_data('emp_position4'));
$excelbody .= write_key_value('emp_citystatezip4',make_string(get_post_data('emp_citystatezip4')));
$excelbody .= write_key_value('emp_salary4',get_post_data('emp_salary4'));
$excelbody .= write_key_value('emp_contact4',get_post_data('emp_contact4'));
$excelbody .= write_key_value('emp_leaving_reason4',get_post_data('emp_leaving_reason4'));
$excelbody .= write_key_value('emp_phone4',get_post_data('emp_phone4'));
$excelbody .= write_key_value('fmcsr4',get_post_data('fmcsr4'));
$excelbody .= write_key_value('emp_safety5',get_post_data('emp_safety5'));
$excelbody .= write_key_value('emp_name5',get_post_data('emp_name5'));
$excelbody .= write_key_value('emp_from5',get_post_data('emp_from5'));
$excelbody .= write_key_value('emp_to5',get_post_data('emp_to5'));
$excelbody .= write_key_value('emp_address5',get_post_data('emp_address5'));
$excelbody .= write_key_value('emp_position5',get_post_data('emp_position5'));
$excelbody .= write_key_value('emp_citystatezip5',make_string(get_post_data('emp_citystatezip5')));
$excelbody .= write_key_value('emp_salary5',get_post_data('emp_salary5'));
$excelbody .= write_key_value('emp_contact5',get_post_data('emp_contact5'));
$excelbody .= write_key_value('emp_leaving_reason5',get_post_data('emp_leaving_reason5'));
$excelbody .= write_key_value('emp_phone5',get_post_data('emp_phone5'));
$excelbody .= write_key_value('fmcsr5',get_post_data('fmcsr5'));
$excelbody .= write_key_value('emp_safety6',get_post_data('emp_safety6'));
$excelbody .= write_key_value('emp_name6',get_post_data('emp_name6'));
$excelbody .= write_key_value('emp_from6',get_post_data('emp_from6'));
$excelbody .= write_key_value('emp_to6',get_post_data('emp_to6'));
$excelbody .= write_key_value('emp_address6',get_post_data('emp_address6'));
$excelbody .= write_key_value('emp_position6',get_post_data('emp_position6'));
$excelbody .= write_key_value('emp_citystatezip6',make_string(get_post_data('emp_citystatezip6')));
$excelbody .= write_key_value('emp_salary6',get_post_data('emp_salary6'));
$excelbody .= write_key_value('emp_contact6',get_post_data('emp_contact6'));
$excelbody .= write_key_value('emp_leaving_reason6',get_post_data('emp_leaving_reason6'));
$excelbody .= write_key_value('emp_phone6',get_post_data('emp_phone6'));
$excelbody .= write_key_value('fmcsr6',get_post_data('fmcsr6'));
$excelbody .= write_key_value('cfr40',get_post_data('cfr40'));
$excelbody .= write_key_value('accident',get_post_data('accident'));
$excelbody .= write_key_value('fatalities',get_post_data('fatalities'));
$excelbody .= write_key_value('injuries',get_post_data('injuries'));
$excelbody .= write_key_value('hazardousspill',get_post_data('hazardousspill'));
$excelbody .= write_key_value('accident2',get_post_data('accident2'));
$excelbody .= write_key_value('fatalities2',get_post_data('fatalities2'));
$excelbody .= write_key_value('injuries2',get_post_data('injuries2'));
$excelbody .= write_key_value('hazardousspill2',get_post_data('hazardousspill2'));
$excelbody .= write_key_value('accident3',get_post_data('accident3'));
$excelbody .= write_key_value('fatalities3',get_post_data('fatalities3'));
$excelbody .= write_key_value('injuries3',get_post_data('injuries3'));
$excelbody .= write_key_value('hazardousspill3',get_post_data('hazardousspill3'));
$excelbody .= write_key_value('trafficloc',get_post_data('trafficloc'));
$excelbody .= write_key_value('trafficdate',get_post_data('trafficdate'));
$excelbody .= write_key_value('trafficcharge',get_post_data('trafficcharge'));
$excelbody .= write_key_value('trafficpenalty',get_post_data('trafficpenalty'));
$excelbody .= write_key_value('trafficloc2',get_post_data('trafficloc2'));
$excelbody .= write_key_value('trafficdate2',get_post_data('trafficdate2'));
$excelbody .= write_key_value('trafficcharge2',get_post_data('trafficcharge2'));
$excelbody .= write_key_value('trafficpenalty2',get_post_data('trafficpenalty2'));
$excelbody .= write_key_value('trafficloc3',get_post_data('trafficloc3'));
$excelbody .= write_key_value('trafficdate3',get_post_data('trafficdate3'));
$excelbody .= write_key_value('trafficcharge3',get_post_data('trafficcharge3'));
$excelbody .= write_key_value('trafficpenalty3',get_post_data('trafficpenalty3'));
$excelbody .= write_key_value('qualifystate',get_post_data('qualifystate'));
$excelbody .= write_key_value('qualifylicense',get_post_data('qualifylicense'));
$excelbody .= write_key_value('qualifytype',get_post_data('qualifytype'));
$excelbody .= write_key_value('qualifyexpiration',get_post_data('qualifyexpiration'));
$excelbody .= write_key_value('denied',get_post_data('denied'));
$excelbody .= write_key_value('revoked',get_post_data('revoked'));
$excelbody .= write_key_value('straight',get_post_data('straight'));
$excelbody .= write_key_value('equip',get_post_data('equip'));
$excelbody .= write_key_value('experiencefrom',get_post_data('experiencefrom'));
$excelbody .= write_key_value('experienceto',get_post_data('experienceto'));
$excelbody .= write_key_value('miles',get_post_data('miles'));
$excelbody .= write_key_value('tractor',get_post_data('tractor'));
$excelbody .= write_key_value('equip2',get_post_data('equip2'));
$excelbody .= write_key_value('experiencefrom2',get_post_data('experiencefrom2'));
$excelbody .= write_key_value('experienceto2',get_post_data('experienceto2'));
$excelbody .= write_key_value('miles2',get_post_data('miles2'));
$excelbody .= write_key_value('twotrailers',get_post_data('twotrailers'));
$excelbody .= write_key_value('equip3',get_post_data('equip3'));
$excelbody .= write_key_value('experiencefrom3',get_post_data('experiencefrom3'));
$excelbody .= write_key_value('experienceto3',get_post_data('experienceto3'));
$excelbody .= write_key_value('miles3',get_post_data('miles3'));
$excelbody .= write_key_value('threetrailers',get_post_data('threetrailers'));
$excelbody .= write_key_value('equip4',get_post_data('equip4'));
$excelbody .= write_key_value('experiencefrom4',get_post_data('experiencefrom4'));
$excelbody .= write_key_value('experienceto4',get_post_data('experienceto4'));
$excelbody .= write_key_value('miles4',get_post_data('miles4'));
$excelbody .= write_key_value('school8',get_post_data('school8'));
$excelbody .= write_key_value('experiencefrom5',get_post_data('experiencefrom5'));
$excelbody .= write_key_value('experienceto5',get_post_data('experienceto5'));
$excelbody .= write_key_value('miles5',get_post_data('miles5'));
$excelbody .= write_key_value('shool15',get_post_data('shool15'));
$excelbody .= write_key_value('experiencefrom6',get_post_data('experiencefrom6'));
$excelbody .= write_key_value('experienceto6',get_post_data('experienceto6'));
$excelbody .= write_key_value('miles6',get_post_data('miles6'));
$excelbody .= write_key_value('otherequipment',get_post_data('otherequipment'));
$excelbody .= write_key_value('experiencefrom7',get_post_data('experiencefrom7'));
$excelbody .= write_key_value('experienceto7',get_post_data('experienceto7'));
$excelbody .= write_key_value('miles7',get_post_data('miles7'));
$excelbody .= write_key_value('statesoperated',get_post_data('statesoperated'));
$excelbody .= write_key_value('specialtraining',get_post_data('specialtraining'));
$excelbody .= write_key_value('drivingawards',get_post_data('drivingawards'));
$excelbody .= write_key_value('othertruckingexperience',get_post_data('othertruckingexperience'));
$excelbody .= write_key_value('othertraining',get_post_data('othertraining'));
$excelbody .= write_key_value('othermaterials',get_post_data('othermaterials'));
$excelbody .= write_key_value('grade',get_post_data('grade'));
$excelbody .= write_key_value('highschool',get_post_data('highschool'));
$excelbody .= write_key_value('college',get_post_data('college'));
$excelbody .= write_key_value('lastschool',get_post_data('lastschool'));
$excelbody .= write_key_value('finalsignature',get_post_data('finalsignature'));
$excelbody .= write_key_value('finaldate',get_post_data('finaldate'));
$excelbody .= write_key_value('emailaddress',get_post_data('emailaddress'));
$excelbody .= write_key_value('submit',get_post_data('submit'));
$excelbody .= write_key_value('CurrentCity',get_post_data('CurrentCity'));
$excelbody .= write_key_value('CurrentState',get_post_data('CurrentState'));
$excelbody .= write_key_value('CurrentZip',make_string(get_post_data('CurrentZip')));
$excelbody .= write_key_value('PreviousCity',get_post_data('PreviousCity'));
$excelbody .= write_key_value('PreviousState',get_post_data('PreviousState'));
$excelbody .= write_key_value('PreviousZip',make_string(get_post_data('PreviousZip')));
$excelbody .= write_key_value('upload filename',get_post_data('upload filename'));
$excelbody .= write_key_value('form_token',get_post_data('form_token'));

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

        $code .= "<tr><td>" . $key . "</td><td>" . "$" . "_POST" . "['" . $key . "']</td></tr>\n";
    }
}
$code .= "<tr><td>" . 'CurrentCity' . "</td><td>" . "$" . "_POST" . "['" . 'CurrentCity' . "']</td></tr>\n";
$code .= "<tr><td>" . 'CurrentState' . "</td><td>" . "$" . "_POST" . "['" . 'CurrentState' . "']</td></tr>\n";
$code .= "<tr><td>" . 'CurrentZip' . "</td><td>" . "$" . "_POST" . "['" . 'CurrentZip' . "']</td></tr>\n";
$code .= "<tr><td>" . 'PreviousCity' . "</td><td>" . "$" . "_POST" . "['" . 'PreviousCity' . "']</td></tr>\n";
$code .= "<tr><td>" . 'PreviousState' . "</td><td>" . "$" . "_POST" . "['" . 'PreviousState' . "']</td></tr>\n";
$code .= "<tr><td>" . 'PreviousZip' . "</td><td>" . "$" . "_POST" . "['" . 'PreviousZip' . "']</td></tr>\n";
$code .= "<tr><td>" . 'uploadedfile' . "</td><td>" . "$" . "_POST" . "['" . 'uploadedfile' . "']" . "['" . 'tmp_name' . "']</td></tr>\n";
$code .= "<tr><td>" . 'form_token' . "</td><td>" . "$" . "_POST" . "['" . 'form_token' . "']</td></tr>\n";


$excelbody .= "</table>";
$excelbody .= "</body>";
$excelbody .= "</html>";
$excelbody .= "\n\n";

$message->attach(new Swift_Message_Part($body));

$test = $_GET['test'] === 'true' ? true : false;

if ($test != true) {
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
} else {
    echo $excelbody;
    #header('Location: http://www.blackhorsecarriers.com/applicationsent.php');
}
?>
