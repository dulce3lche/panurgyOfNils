<?php

// test with local host ip, then sql database computer's ip 
// db = testStudent, user = testUser, pass = it490pass, table = students
// Should echo: Username: Bob - userid: 123 - password: pass 

$server = "192.168.43.24";
$user = "testUser";
$pass = "it490pass";
$db = "testStudent";

$conn = new mysqli ($server, $user, $pass, $db);

if ($conn->connect_error) {
	
	die( "Connection Failed: " . $conn->connect_error);
}

echo "Connected Successfully";


$sql = "SELECT username, userid, password FROM students";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
	
	while ($row = $result->fetch_assoc()) {
		
		echo "Username: " . $row["username"]. " - userid: " . $row["userid"]. " - password: " . $row["password"]." <br> ";
	}


   }

else {
	echo "No results";

     }

$conn->close();

?>
