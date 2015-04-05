<?php
/* Send an SMS using Twilio. */

// Set test harness
$testing = $_REQUEST["testing"];
if($testing == 1){
    echo "This is a 'test harness' for experimenting with Twilio's API.<br>";
}

// Set authorization
$auth = $_REQUEST["auth"];
if($auth == 1){
	echo "We are using live (trial) credentials.<br>";
}elseif($auth == 0){
	echo "We are using test credentials.<br>";
}

// Include the Twilio-PHP library from http://twilio.com/docs/libraries
require "twilio-php-master/Services/Twilio.php";

// Set AccountSid and AuthToken
if($auth){
	//--- Real credentials ---\\
	$AccountSid = "ACc0bd4f32fff60c6a11705741ae149859";
	$AuthToken = "c08c129207776608a90df19a23bd8eab";
}else{
	//--- Test credentials and numbers ---\\
	$AccountSid = "ACcd3693035127a10d792e2289a20a8680";
	$AuthToken = "0a52951d19e575d8bc9a1bc1494f58fe";
}

// Get the number and message submitted via the HTML form
$fromNumber = "+12096663246";
$toNumber = "+1" . $_REQUEST["number"];
$message = $_REQUEST["message"];

// Use the following set-up for the test harness
if ($testing){
	if($auth){
		$auth_msg = "trial account credentials";
    	$fromNumber = "+12096663246";
		$toNumber = "+12096400415";
	}else{
		$auth_msg = "testing credentials";

		$fromNumber = "+15005550001"; // Invalid (EC: 21212)
		$fromNumber = "+15005550007"; // Not owned by account or not SMS-capable (EC: 21606)
		$fromNumber = "+15005550008"; // Full SMS queue (EC: 21611)
		$fromNumber = "+15005550006"; // Valid (NO EC)

		$toNumber = "+15005550001"; // Invalid (EC: 21211)
		$toNumber = "+15005550002"; // Cannot route (EC: 21612)
		$toNumber = "+15005550003"; // No international SMS permissions (EC: 21408)
		$toNumber = "+15005550004"; // Blacklisted (EC: 21610)
		$toNumber = "+15005550009"; // Not SMS-capable (EC: 21614)
		$toNumber = "+15005550005"; // Valid (EC: input-dependent)
	}

	date_default_timezone_set("US/Eastern");
    $message = "This is a test using " . $auth_msg . ".<br>Time is " . date('h:i.s');
}

// Quick check on the values of the variables
//echo "from: $fromNumber<br>to: $toNumber<br>message: $message<br>";

// Create a new Twilio Rest Client and send a SMS
try{
	$client = new Services_Twilio($AccountSid, $AuthToken);
    $sms = $client->account->messages->sendMessage($fromNumber, $toNumber, $message);

    // Display a confirmation message
    echo "<br>An SMS message was sent to $toNumber.<br><br>";
}catch (Exception $e){
	// Display a failure message
    echo "<br>The message was not sent!<br><br>";
}
