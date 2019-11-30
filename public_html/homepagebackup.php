<?php

session_start();
if(isset($_SESSION['Verified']))
{
	$username = $_SESSION['username'];
	$sidval = session_id();
}
?>

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
<nav class="navbar">
	<div class="nav-links">
		<ul>
			<a id="logo" href="">Market Hub |</a>
			<li><a class="active" href="">Home</a></li>
			<li><a href="">Forums</a></li>
			<li><a href="">Find</a></li>
			<?php if (!isset($_SESSION['Verified'])){?>
                        	<li><a href="marketCreate.html" style="float:right">Register</a></li>
				<li><a href="marketLogin.html" style="float:right">Login</a></li>
			<?php } else {?>
        			<a href="marketLogout.php" style="float:right">Logout</a>
				<a href="displayData.php" style="float:right"><?php echo $username; ?></a>
			<?php }?>
		</ul>
	</div>
</nav>

<br><br><br>

</body>

<nav class="botnavbar"></nav>
</html>
