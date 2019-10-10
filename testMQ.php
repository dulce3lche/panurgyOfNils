#!/usr/bin/php
<?php
require_once('path.inc');
require_once('get_host_info.inc');
require_once('rabbitMQLib.inc');

function doLogin($username,$password)
{
    $server = "192.168.43.24";
    $user = "testUser";
    $pass = "it490pass";
    $db = "testStudent";
    $conn = new mysqli ($server, $user, $pass, $db);
 
     if ($conn->connect_error) { die( "Connection Failed: " . $conn->connect_error);    }
	 
     echo "Connected Successfully \n";
     echo $username;
     echo "\n";
     echo $password;
	 
     $sql = "SELECT * FROM students where username='$username' and password = '$password'";
	 ($t = mysqli_query ($db , $sql)) or die (mysqli_error($db));
	 $num = mysqli_num_rows($t);
	 
	   if($num == 0)
		{
			return false;
		}
		else{
			return true;
		};
	 

    /* if ($result->num_rows > 0) {

	while ($row = $result->fetch_assoc()) {
		if($row["username"] = $username)
		{	
	        echo "Username confirmed";
		echo "\n";
		}
		
		if($row["password"] = $password)
		{ echo "\n";
                  echo "Password confirmed";
		} */
	//"Username: " . $row["username"]. " - userid: " . $row["userid"]. " - password: " . $row["password"];

}


function requestProcessor($request)
{
  echo "received request".PHP_EOL;
  var_dump($request);
  if(!isset($request['type']))
  {
    return "ERROR: unsupported message type";
  }
  switch ($request['type'])
  {
    case "login":
      return doLogin($request['username'],$request['password']);
    case "validate_session":
      return doValidate($request['sessionId']);
  }
  return array("returnCode" => '0', 'message'=>"Server received request and processed");
}

$server = new rabbitMQServer("testRabbitMQ.ini","testServer");

echo "testRabbitMQServer BEGIN".PHP_EOL;
$server->process_requests('requestProcessor');
echo "testRabbitMQServer END".PHP_EOL;
exit();
?>

