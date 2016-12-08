<?php
// Put your device token here (without spaces):
// '7fc266080cd8e4848626e3e5a96699ff9c6586d52d527a948211a81f994475a5' vikram's device token
if(!is_array($_REQUEST['deviceToken'])){
    $deviceTokenArray = array($_REQUEST['deviceToken']);
}
else{$deviceTokenArray=$_REQUEST['deviceToken'];}
$distribution=TRUE;

foreach ($deviceTokenArray as $deviceToken)
{
  //  echo "device token ".$deviceToken.PHP_EOL;
// $deviceToken = $_REQUEST['deviceToken'];
// var_dump($deviceToken);exit;
// Put your private key's passphrase here:
//$passphrase = 'V4C@hyd1';
//$passphrase = 'privypass@123';
    $passphrase = 'PrivProduction@99';

// Put your alert message here:
$message = $_REQUEST['message'];
$dir = dirname(__FILE__)."/apnscerts/";
////////////////////////////////////////////////////////////////////////////////

$ctx = stream_context_create();
//stream_context_set_option($streamContext, $options);
if($distribution==TRUE)
{
// stream_context_set_option($ctx, 'ssl', 'local_cert', $dir.'production.pem');
stream_context_set_option($ctx, 'ssl', 'local_cert', $dir.'PushProd.pem');
stream_context_set_option($ctx, 'ssl', 'passphrase', $passphrase);
//stream_context_set_option($ctx, 'ssl', 'cafile', $dir.'apssr-production.pem');

// Open a connection to the APNS server
$fp = stream_socket_client(
	'ssl://gateway.push.apple.com:2195', $err,
	$errstr, 10, STREAM_CLIENT_CONNECT|STREAM_CLIENT_PERSISTENT, $ctx);
}
else{
// stream_context_set_option($ctx, 'ssl', 'local_cert', $dir.'privpass_dev.pem');
//
    //$passphrase = 'MtuitY_5432';
    $passphrase = 123456789;

// stream_context_set_option($ctx, 'ssl', 'local_cert', $dir.'privpass_dev.pem');
    stream_context_set_option($ctx, 'ssl', 'local_cert', $dir.'PushDev.pem');
    
stream_context_set_option($ctx, 'ssl', 'passphrase', $passphrase);
//stream_context_set_option($ctx, 'ssl', 'cafile', $dir.'appsr_development.pem');

// Open a connection to the APNS server
$fp = stream_socket_client(
	'ssl://gateway.sandbox.push.apple.com:2195', $err,
	$errstr, 10, STREAM_CLIENT_CONNECT|STREAM_CLIENT_PERSISTENT, $ctx);	
}

if (!$fp)
	exit("Failed to connect: $err $errstr" . PHP_EOL);

echo 'Connected to APNS' . PHP_EOL;

$html= isset( $_REQUEST['html'] ) ? $_REQUEST['html'] : "" ;
$title= isset( $_REQUEST['title'] ) ? $_REQUEST['title'] : "";
// Create the payload body
$body['aps'] = array(
	'alert' => $message,
	'title' => $title,
	'html'=>$html,
    'badge' => 1,
	"sound" => "chime.aiff"
	);

//adding extra parameters if available in request
if(isset($_POST['extra_parameters']) && count($_POST['extra_parameters']) > 0 ){
    foreach($_POST['extra_parameters'] as $key=>$value){
        $body[$key] = $value;
    }
}


// Encode the payload as JSON
$payload = json_encode($body);

// Build the binary notification
$msg = chr(0) . pack('n', 32) . pack('H*', $deviceToken) . pack('n', strlen($payload)) . $payload;

// Send it to the server
$result = fwrite($fp, $msg, strlen($msg));

if (!$result)
	echo 'Message not delivered' . PHP_EOL;
else
	echo 'Message successfully delivered' . PHP_EOL;

// Close the connection to the server
fclose($fp);
}
