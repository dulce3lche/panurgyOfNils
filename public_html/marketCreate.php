<?php

#!/usr/bin/php

require_once('path.inc');
require_once('get_host_info.inc');
require_once('rabbitMQLib.inc');
require('myfunctions.php');

$client = new rabbitMQClient("testRabbitMQ.ini","testServer");

$username = $_POST["username"];
$pass = $_POST["password"];
$email = $_POST["email"];
$zip = $_POST["zip"];

$request = array();
$request['type'] = "addUser";
$request['username'] = $username;
$request['password'] = $pass;
$request['email'] = $email;
$request['zip'] = $zip;

$response = $client->send_request($request);

echo "client received respose: ".PHP_EOL;
$payload = json_encode($response);
echo $payload;
header("location: ./");
?>

