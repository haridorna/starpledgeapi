<?php
$dir = dirname(__FILE__)."/";
$device = '7fc26608 0cd8e484 8626e3e5 a96699ff 9c6586d5 2d527a94 8211a81f 994475a5'; // My iphone deviceToken
$message="test message from srinath 9959968224";

$device=str_replace(" ", "", $device);
$apnsCert = $dir.'v4c.pem';
$passphrase='V4C@hyd1';
$deviceToken=$device;
$ctx = stream_context_create();
stream_context_set_option($ctx, 'ssl', 'local_cert', $apnsCert);
stream_context_set_option($ctx, 'ssl', 'passphrase', $passphrase);
//stream_context_set_option($ctx, 'ssl', 'cafile', 'aps_development.cer');

$fp = stream_socket_client('ssl://gateway.sandbox.push.apple.com:2195', 
    $err, 
    $errstr, 
    60, 
    STREAM_CLIENT_CONNECT|STREAM_CLIENT_PERSISTENT, 
    $ctx);

if (!$fp)
exit("Failed to connect amarnew: $err $errstr" . PHP_EOL);

echo 'Connected to APNS' . PHP_EOL;

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

?>