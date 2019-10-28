<?php

$contentType = isset($_SERVER["CONTENT_TYPE"]) ? trim($_SERVER["CONTENT_TYPE"]) : '';

if ($contentType === "application/json") {
  //Receive the RAW post data.
  $content = trim(file_get_contents("php://input"));

  $request = json_decode($content, true);

  //If json_decode failed, the JSON is invalid.
  if(! is_array($request)) {

  } else {
    // Send error back to user.
  }
}



// an email address that will be in the From field of the email.
$from = 'Demo contact form <dispatch@resourceaircharter.com>';
// an email address that will receive the email with the output of the form
$sendTo = 'Demo contact form <dispatch@resourceaircharter.com>';
// subject of the email
$subject = 'New message from quote form';
// message that will be displayed when everything is OK :)
$okMessage = 'Contact form successfully submitted. We will get back to you soon!';
// If something goes wrong, we will display this message.
$errorMessage = 'There was an error while submitting the form. Please try again later';

// if you are not debugging and don't need error reporting, turn this off by error_reporting(0);
error_reporting(E_ALL & ~E_NOTICE);

$payload = array();
try
{

    // if(count($_POST) == 0) throw new \Exception('Form is empty');
            
    $emailText = "You have a new message from your quote form\n=============================\n";

    foreach ($request as $formElementName => $value) {
        // If the field exists in the $fields array, include it in the email 
        $payload[$formElementName] = "$value\n";
        $emailText .= "\n".$formElementName.": ".$value;
    }

    // All the neccessary headers for the email.
    $headers = array('Content-Type: text/plain; charset="UTF-8";',
        'From: ' . $from,
        'Reply-To: ' . $from,
        'Return-Path: ' . $from,
    );
    
    // Send email
    mail($sendTo, $subject, $emailText, implode("\n", $headers));

    $responseArray = array('type' => 'success', 'message' => "Sent Email!");
}
catch (\Exception $e)
{
    $responseArray = array('type' => 'danger', 'message' => $e->getMessage());
}

$encoded = json_encode($responseArray);

header('Content-Type: application/json');

echo $encoded;

?>