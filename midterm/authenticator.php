<?php 

session_start(); 
 $server="localhost";
 $aunmae="root";
 $apassword = "";
 $db_name = "login_db";
 $conn2 = mysqli_connect($server, $aunmae, $apassword, $db_name);


 





date_default_timezone_set('Asia/Manila');
$currentDate = date('Y-m-d H:i:s');



if(isset($_POST['sub']))
{ 
    if(empty(trim($_POST["codebox"]))){
        header("Location: index.php?error=Please Enter A Code in the Authenticator");
		exit();
    } else{ 

        
        $codebox = $_POST['codebox'];
        $id = $_SESSION['id'];
        $act = "Login";
        
		$sql_code = "SELECT * FROM authentication WHERE A_code='$codebox'";
		$result2 = mysqli_query($conn2, $sql_code);

		$sql3 = "SELECT Expiration FROM authentication where A_code='$codebox'";
        $result3 = mysqli_query($conn2, $sql3);
        
        $sql4 = "INSERT INTO event(userid, activity) VALUES ('$id','$act' )";
        
       

		

		if(mysqli_num_rows($result2) === 1) {
			$row2 = mysqli_fetch_assoc($result2);
			if($row2['A_code'] === $codebox){
				if (mysqli_num_rows($result3) === 1){
					 $row3 = mysqli_fetch_assoc($result3);
                	if(($row3["Expiration"]) > ($currentDate)){
	                	$result4 = mysqli_query($conn2, $sql4) or die(mysqli_error($conn2));
				            if($result4){
							header("Location: home.php");	
							}
							else{
							echo "Event recorder crash";
							}

                    
				}else{
					header("Location: authenticator.php?error=Expired Code");
					exit();
				}
			}
		}else{
			header("Location: authenticator.php?error=Incorrect Code");
			exit();
		}
       }else{
			header("Location: authenticator.php?error=Incorrect Code ");
			exit();
		}
        
     

       
          
    }
    
    
}
?>








<!DOCTYPE html>
<html>
<head>
	<title>Authenticator</title>
	<link rel="stylesheet" type="text/css" href="s.css"> 
</head>
<body>



	
<!-- Trigger/Open The Modal -->
				<button id="myBtn">Click Here to Authenticate</button>
				<!-- The Modal -->
				<form action="" method="POST" class="form2">
				<div id="myModal" class="modal">

				  <!-- Modal content -->
				  <div class="modal-content">
				    <span class="close">&times;</span>
				    <h4>Authentication Code</h4>
				    <?php if (isset($_GET['error'])) { ?>
			<p class="error"><?php echo $_GET['error']; ?></p>
						<?php } ?>
				    <input type="text" name="codebox" class="authenbox" placeholder="Type here the Authentication Code">
				    <button name="sub">Submit</button>
				  </div>

				</div>
				</form>

				<a href="random-code.php" style="color: red;" target="_blank" >GET CODE</a>



<script>
	// Get the modal
var modal = document.getElementById("myModal");

// Get the button that opens the modal
var btn = document.getElementById("myBtn");

// Get the <span> element that closes the modal
var span = document.getElementsByClassName("close")[0];

// When the user clicks the button, open the modal 
btn.onclick = function() {
  modal.style.display = "block";
}

// When the user clicks on <span> (x), close the modal
span.onclick = function() {
  modal.style.display = "none";
}

// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
  if (event.target == modal) {
    modal.style.display = "none";
  }
}
</script>


</body>
</html>	