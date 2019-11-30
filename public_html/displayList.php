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

        $username = $_SESSION["username"];

        $request = array();
        $request['type'] = "seeList";
        $request['username'] = $username;

        $response = $client->send_request($request);

	$items = count($response);
	$item = 0;
	while ($item<$items)
        {
		print_r($response[$item]);
		echo "<br>";
		$item++;
        }
}

?><!--
<!DOCTYPE html>
<meta charset="UTF-8">
<html>
<head>

<meta name="viewport" content="width=device-width, initial-scale=1.0">

<link rel="stylesheet"
href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
         integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>

<link rel="stylesheet" href="css/fmarket.css">
</head>
<body>
<div class="userinfo">
        	<form class="shopPrefForm" style="display: block;" action="updateList.php" method="post">
                <strong><u>Shopping Preferences</u></strong><br><br>
                <a href="displayList.php">Shopping List</a><br><br>
                <input type="checkbox" name="id1" value="1">Baked goods<br>
                <input type="checkbox" name="id2" value="2">Crafts and/or woodworking items<br>
                <input type="checkbox" name="id3" value="3">Eggs<br>
                <input type="checkbox" name="id4" value="4">Fresh and/or dried herbs<br>
                <input type="checkbox" name="id5" value="5">Honey<br>
                <input type="checkbox" name="id6" value="6">Maple syrup and/or maple products<br>
                <input type="checkbox" name="id7" value="7">Nuts<br>
                <input type="checkbox" name="id8" value="8">Poultry<br>
                <input type="checkbox" name="id9" value="9">Soap and/or body care products<br>
                <input type="checkbox" name="id10" value="10">Wine, beer, hard cider<br>
                <input type="checkbox" name="id11" value="11">Dry beans<br>
                <input type="checkbox" name="id12" value="12">Grains and or flour<br>
                <input type="checkbox" name="id13" value="13">Mushrooms<br>
                <input type="checkbox" name="id14" value="14">Tofu and or non-animal protein<br>
                <input type="checkbox" name="id15" value="15">Cheese and/or dairy products<br>
                <input type="checkbox" name="id16" value="16">Cut flowers<br>
                <input type="checkbox" name="id17" value="17">Fish and/or seafood<br>
                <input type="checkbox" name="id18" value="18">Fresh vegetables<br>
                <input type="checkbox" name="id19" value="19">Canned/Preserved Fruits<br>
                <input type="checkbox" name="id20" value="20">Meat<br>
		<input type="checkbox" name="id21" value="21">Plants<br>
                <input type="checkbox" name="id22" value="22">Prepared foods<br>
                <input type="checkbox" name="id23" value="23">Trees/shrubs<br>
                <input type="checkbox" name="id24" value="24">Coffee/Tea<br>
                <input type="checkbox" name="id25" value="25">Fresh Fruit<br>
                <input type="checkbox" name="id26" value="26">Juices<br>
                <input type="checkbox" name="id27" value="27">Pet Food<br>
                <input type="checkbox" name="id28" value="28">Harvested Forest Products<br><br>
        <button type="submit" class="button">Update</button>
        </form>
</div>
</body>
<br><br><br>

</html>
-->
