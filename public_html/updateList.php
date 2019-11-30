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
else
{
	$x=1;
	$items = array();
	while ($x<29)
	{
		if(isset($_POST["id".$x]))
 		{
			array_push($items, $x);
	      		$x++;
		}
		else
 		{
 			$x++;
 		}
	}

	$a = count($items);
	$b = 0;
	while ($b<$a)
	{
		echo $items[$b]; $b++;
		echo "\n";
	}


        $client = new rabbitMQClient("testRabbitMQ.ini","testServer");

	$username = $_SESSION['username'];

	$request = array();
	$request['type'] = "addList";
	$request['username'] = $username;
	$request['list'] = $items;

	$response = $client->send_request($request);

	if($actual > 0)
	{
		$status = "$actual Items added";
		header("Location: displayData.php");
	}
	else
	{
		$status = "Nothing was added";
		header("Location: displayData.php");
	}
	echo $status;
}
?>
