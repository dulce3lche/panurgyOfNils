<?php

session_start();

echo "TEST";

if (!isset($_SESSION['Verified']))
{
	echo "<a href=\"marketLogin.html\">Login</a>";
	echo "<a href=\"marketCreate.html\">Register</a>";
}
else
{
        echo "<a href=\"marketLogout.php\">Logout</a>";
}

?>
