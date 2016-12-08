<?php

$dir = dirname(__FILE__)."/";
$device = '7fc26608 0cd8e484 8626e3e5 a96699ff 9c6586d5 2d527a94 8211a81f 994475a5'; // My iphone deviceToken
$message="hello this is a test message";

$device=str_replace(" ", "", $device);
$apnsCert = 'Vote4Cash.pem';

$message = 'Hello';
$badge = 3;
$sound = 'default';
$development = true;

$payload = array();
$payload['aps'] = array('alert' => $message, 'badge' => intval($badge), 'sound' => $sound);
$payload = json_encode($payload);

$apns_url = NULL;
$apns_cert = NULL;
$apns_port = 2195;

if($development)
{
	$apns_url = 'gateway.sandbox.push.apple.com';
	$apns_cert = $dir.$apnsCert;
}
else
{
	$apns_url = 'gateway.push.apple.com';
	$apns_cert = $dir.$apnsCert;
}

$stream_context = stream_context_create();
stream_context_set_option($stream_context, 'ssl', 'local_cert', $apns_cert);

$apns = stream_socket_client('ssl://' . $apns_url . ':' . $apns_port, $error, $error_string, 2, STREAM_CLIENT_CONNECT, $stream_context);

//	You will need to put your device tokens into the $device_tokens array yourself
$device_tokens = array(0=>$device);

foreach($device_tokens as $device_token)
{
	$apns_message = chr(0) . chr(0) . chr(32) . pack('H*', str_replace(' ', '', $device_token)) . chr(0) . chr(strlen($payload)) . $payload;
	fwrite($apns, $apns_message);
}

@socket_close($apns);
@fclose($apns);

/*
 * 
 * second code
 */

/*
$ctx = stream_context_create();
stream_context_set_option($ctx, 'ssl', 'local_cert', $apnsCert);
$fp = stream_socket_client('ssl://gateway.sandbox.push.apple.com:2195', 
    $err, 
    $errstr, 
    600, 
    STREAM_CLIENT_CONNECT|STREAM_CLIENT_PERSISTENT, 
    $ctx);

//if (!$fp)
//exit("Failed to connect amarnew: $err $errstr" . PHP_EOL);

//echo 'Connected to APNS' . PHP_EOL;

// Create the payload body
$body['aps'] = array(
    'badge' => +1,
    'alert' => $message,
    'sound' => 'default'
);

$payload = json_encode($body);

// Build the binary notification
$msg = chr(0) . pack('n', 32) . pack('H*', $deviceToken) . pack('n', strlen($payload)) . $payload;

// Send it to the server
$result = fwrite($fp, $msg, strlen($msg));

if (!$result)
    echo 'Message not delivered' . PHP_EOL;
else
    echo 'Message successfully delivered amar'.$message. PHP_EOL;

// Close the connection to the server
fclose($fp);
*/

/*
$serverId=1;
$name="Vote 4 Cash";
$payload['aps'] = array('alert' => 'This is the alert text', 'badge' => 1, 'sound' => 'default');
//com.vote4cash.vote4cashApplication
$payload['server'] = array('serverId' => $serverId, 'name' => $name);
$output = json_encode($payload);
$payload = json_encode($payload);
$apnsCert = 'Vote4Cash.pem';
$streamContext = stream_context_create();
stream_context_set_option($streamContext, 'ssl', 'local_cert', $apnsPass);
//stream_context_set_option($streamContext, 'ssl', 'passphrase', $passphrase);

$apns = stream_socket_client('ssl://gateway.sandbox.push.apple.com:2195', $error, $errorString, 2, STREAM_CLIENT_CONNECT, $streamContext);
// remove sandbox when you are making it live
$apnsMessage = chr(0) . chr(0) . chr(32) . pack('H*', str_replace(' ', '', $device)) . chr(0) . chr(strlen($payload)) . $payload;
fwrite($apns, $apnsMessage);

//socket_close($apns); seems to be wrong here ...
fclose($apns);
echo $output;
*/
?>