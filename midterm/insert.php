<?php
$server="localhost";
$aunmae="root";
$apassword = "";
$db_name = "login_db";

$conn = mysqli_connect($server, $aunmae, $apassword, $db_name);
		

		$uname=($_POST['uname']);
		$password=($_POST['password']);
		$confirm=($_POST['cpass']);
		$email=($_POST['email']);
		$sql_u = "SELECT * FROM users WHERE user_name='$uname'";
  		$sql_e = "SELECT * FROM users WHERE email='$email'";
  		$res_u = mysqli_query($conn, $sql_u);
  		$res_e = mysqli_query($conn, $sql_e);

if(isset($_POST['reg'])){

	if (empty($uname)) {
		header("Location: register.php?error=User Name is required");
		exit();
	}else if(mysqli_num_rows($res_u) > 0){
		header("Location: register.php?error=Username already exists");	

	}else if(empty($password)){
		header("Location: register.php?error=Password is required");
		exit();

	}else if(empty($confirm)){
		header("Location: register.php?error=Confirming password is required");
		exit();
	}else if( strlen($password ) < 8 ) {
		header("Location: register.php?error=Password must be atleast 8 characters");
	  	exit();
	}else if( !preg_match("#[0-9]+#", $password ) ) {
		header("Location: register.php?error=Password must include at least one number!");
		exit();
	}else if( !preg_match("#[a-z]+#", $password ) ) {
		header("Location: register.php?error=Password must include at least one letter!");
		exit();
	}else if( !preg_match("#[A-Z]+#", $password ) ) {
		header("Location: register.php?error=Password must include at least one capital letter!");
		exit();
	}else if( !preg_match("#\W+#", $password ) ) {
		header("Location: register.php?error=Password must include at least one symbol!");
		exit();

	}else if($_POST['password'] !== $_POST['cpass']) {
	header("Location: register.php?error=Password and Confirm password should match!");
	exit();
	}else if(empty($email)){
		header("Location: register.php?error=Email Address is required");
    	exit();
    }else if(mysqli_num_rows($res_e) > 0){
		header("Location: register.php?error=Email Address already exists");		
		
	}else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
      	header("Location: register.php?error=Invalid email");
      	exit();
    }
    

	 else {		
		$query = "INSERT into users(user_name,password,email) VALUES('$uname', '$confirm', '$email')";
		
		$run = mysqli_query($conn,$query) or die(mysqli_error($conn));	

		if($run){
			header("Location:index.php");
		}
		else{
			echo "Form not submitted";
		}
	}
}


	
?>
