

<!DOCTYPE html>
<?php
session_start();
$dbhost = "localhost";
$dbuser = "root";
$dbpass = "";
$dbname = "login_db";

$conn3 = mysqli_connect($dbhost ,$dbuser,$dbpass,$dbname);

if(isset($_POST['submit2']))
{ 
        $myemail = $_POST['email2'];
        
		$query_email= "SELECT * FROM users WHERE email='$myemail'" ;
		$exist_em = mysqli_query($conn3, $query_email);

		$resultmails = mysqli_query($conn3, $query_email);

		if (empty($myemail)){
				header("Location: forgot.php?error=Enter your vefied email");
						exit();

		}else if (!filter_var($myemail, FILTER_VALIDATE_EMAIL)) {
       header("Location: forgot.php?error=Invalid email");
        exit();

        }else if(mysqli_num_rows($exist_em) < 1 ){
			header("Location: forgot.php?error=Email Address Doesn't exists");		
			exit();	

		}else if(mysqli_num_rows($resultmails) === 1) {

			$row3 = mysqli_fetch_assoc($resultmails);
			 $_SESSION['email'] = $row3['email'];
			if($row3['email'] === $myemail){

					header("Location: changepass.php");
                 
		           	
		       			}
					}
				}

		?>
<html>
<head>
	<title>Forgot Password</title>
	<link rel="stylesheet" type="text/css" href="s.css"> 
</head>
<body>
	<form action="" method="post">
		<img src="userimage.png">
		<h2>Email Verification</h2>
		<?php if (isset($_GET['error'])) { ?>
			<p class="error"><?php echo $_GET['error']; ?></p>
		<?php } ?>
		<label>Registered Email</label>
		<input type="text" name="email2" placeholder="Enter your Registered Email"><br>

		
		<button type="submit" name="submit2" class="login">Submit</button>
	</form>



</body>
</html>	