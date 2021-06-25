<!DOCTYPE html>
<html>
<head>
	<title>Registration</title>
	<link rel="stylesheet" type="text/css" href="des.css"> 
</head>
<body>
<form action="insert.php" method="post">
		<img src="pencil.png">
		<h2>Registration</h2>
		   <?php if (isset($_GET['error'])) { ?>
			<p class="error"><?php echo $_GET['error']; ?></p>
			<?php } ?>
		<label>Username</label>
		<input type="text" name="uname"  placeholder="Enter your Username"  ><br>

		<label>Password</label>
		<input type="password" name="password" placeholder="Enter your Password" ><br>

		<label> Confirm Password</label>
		<input type="password" name="cpass" placeholder="Confirm Password" ><br>

		<label>Email Address</label>
		<input type="text" name="email" placeholder="Enter your email address"><br>

		<button type="submit" name="reg">Register</button>
		
</body>
</html>