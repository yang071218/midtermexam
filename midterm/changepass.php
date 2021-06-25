<?php
session_start();
$dbhost = "localhost";
$dbuser = "root";
$dbpass = "";
$dbname = "login_db";

$conn = mysqli_connect($dbhost,$dbuser,$dbpass,$dbname);

if($_SERVER['REQUEST_METHOD'] == "POST")
{ 

  $pwd = $_POST['newpass'];
  $cpwd = $_POST['confirmpass'];
  

  
  if(empty( $pwd)){
      header("Location: changepass.php?error= New password is required");
      exit();

    }else if(empty($cpwd)){
      header("Location: changepass.php?error=Confirming password is required");
      exit();

    } else if(!empty($pwd) && !empty($cpwd))
      {
        if( strlen($pwd ) < 8 ) {
          header("Location: changepass.php?error=Password must be atleast 8 characters");
            exit();
        }else if( !preg_match("#[0-9]+#",  $pwd ) ) {
          header("Location: changepass.php?error=Password must include at least one number!");
          exit();
        }else if( !preg_match("#[a-z]+#",  $pwd) ) {
          header("Location: changepass.php?error=Password must include at least one small letter!");
          exit();
        }else if( !preg_match("#[A-Z]+#",  $pwd ) ) {
          header("Location: changepass.php?error=Password must include at least one capital letter!");
          exit();
        }else if( !preg_match("#\W+#", $pwd )) {
          header("Location: changepass.php?error=Password must include at least one symbol!");
          exit();

        }else if($_POST['newpass'] !== $_POST['confirmpass']) {
        header("Location: changepass.php?error=Password and Confirm password should match!");
          exit();
          
        }else{

        	$em=$_SESSION['email'];

        	// echo $em;
        	$query_pass="UPDATE users set password='$cpwd' where email='$em'";
          $sql4 = "INSERT INTO event(userid, activity) VALUES ('$id','$act' )";

   			  $run2 = mysqli_query($conn,$query_pass) or die(mysqli_error($conn));
         



   			if ($run2){
              header("Location: index.php");
   			}
   		}
   	}
   }



?>




<!DOCTYPE html>
<html>
<head>
   <title>Change Password</title>
   <link rel="stylesheet" type="text/css" href="s.css"> 
</head>
<body>
    

	<form action="" method="post">
		<img src="userimage.png">
		<h2>Change Password</h2>
		<?php if (isset($_GET['error'])) { ?>
			<p class="error"><?php echo $_GET['error']; ?></p>
		<?php } ?>
		<label>New Password </label>
		<input type="password" name="newpass" placeholder="Enter your New Password"><br>
		<label>Confirm Password </label>
		<input type="password" name="confirmpass" placeholder="Confirm your Password"><br>

		
		<button type="submit" name="submit3" class="login">Submit</button>
	</form>




               
 
</body>
</html>  