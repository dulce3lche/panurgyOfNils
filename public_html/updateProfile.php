<?php

#!/usr/bin/php
require_once('path.inc');
require_once('get_host_info.inc');
require_once('rabbitMQLib.inc');
require('myfunctions.php');

session_start();
if(!isset($_SESSION['Verified']))
{
        header("Location: ./");
}
else {
        $client = new rabbitMQClient("testRabbitMQ.ini","testServer");

        $username = $_POST["username"];
	$pass = $_POST["password"];
	$email = $_POST["email"];
	$zip = $_POST["zip"];

        $request = array();
        $request['type'] = "updateData";
        $request['username'] = $username;
	$request['password'] = $pass;
	$request['email'] = $email;
	$request['zip'] = $zip;

        $response = $client->send_request($request);

	$status = print_r($response, true);

	if($status="success")
	{
		$_SESSION['status'] = "Profile Updated";
		header("Location: displayData.php");
	}
	else
	{
		$_SESSION['status'] = "Failed to update profile";
		header("Location: displayData.php");
	}
}
?>
