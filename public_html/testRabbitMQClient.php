<?php
#!/usr/bin/php

require_once('path.inc');
require_once('get_host_info.inc');
require_once('rabbitMQLib.inc');
require('myfunctions.php');

$client = new rabbitMQClient("testRabbitMQ.ini","testServer");
if (isset($argv[1]))
{
  $msg = $argv[1];
}
else
{
  $msg = "Should've dropped out";
  //$msg = "system('shutdown now')";
}

$request = array();
$request['type'] = "login";
$request['username'] = $_GET["username"];
$request['password'] = $_GET["password"];
$request['message'] = $msg;
$response = $client->send_request($request);
//$response = $client->publish($request);

//echo "request: ".PHP_EOL;
//print_r($request);
echo "\n\n";
//echo "client received response: ".PHP_EOL;
//print_r($response);
echo "\n\n";

$payload = json_encode($response);
echo $payload;
//echo $argv[0]." END".PHP_EOL;
