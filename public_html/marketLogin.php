<?php
#!/usr/bin/php

require_once('path.inc');
require_once('get_host_info.inc');
require_once('rabbitMQLib.inc');
require('myfunctions.php');

session_start();
if(isset($_SESSION['Verified']))
{
	header("Location: homepage.php");
}
else
{
	$client = new rabbitMQClient("testRabbitMQ.ini","testServer");

        $username = $_POST["username"];
        $pass = $_POST["password"];

        $request = array();
        $request['type'] = "doLogin";
        $request['username'] = $username;
        $request['password'] = $pass;

        $response = $client->send_request($request);

        if($response < 1)
	{
                echo "Failed";
                header("refresh: 5; url = marketLogin.html");
                exit();
        }
        else
        {
		echo "Successfully logged in, redirecting...";
                $sidval = session_id();
                $_SESSION['username'] = $username;
                $_SESSION["Verified"] = true;
                /*echo "\n";
                echo $username;
                echo $sidval;*/
		header("refresh: 5; url = homepage.php");
                exit();
        }
}
?>
