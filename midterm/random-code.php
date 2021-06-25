 <?php

 session_start();
 $server="localhost";
 $aunmae="root";
 $apassword = "";
 $db_name = "login_db";


 $conn = mysqli_connect($server, $aunmae, $apassword, $db_name);
    if(!isset($_SESSION["code_access"]) || $_SESSION["code_access"] !== true){
        header("location: login.php");
        exit;
    }

    else{
 date_default_timezone_set('Asia/Manila');

$_SESSION["codee"] = rand(100000,999999);


   		$currentDate = date('Y-m-d H:i:s');
        $currentDate_timestamp = strtotime($currentDate);
        $endDate_months = strtotime("+5 minutes", $currentDate_timestamp);
        $packageEndDate = date('Y-m-d H:i:s', $endDate_months);
            
        $_SESSION["current"] = $currentDate;
        $_SESSION["expired"] = $packageEndDate;

        $user_id = $_SESSION["id"];
        $codee = $_SESSION["codee"];

         $sql = "INSERT INTO authentication (user_id, A_code, Created_at, Expiration) VALUES('$user_id', '$codee', '$currentDate', '$packageEndDate')";

		
		$run = mysqli_query($conn,$sql) or die(mysqli_error($conn));

		if($run){
			echo $_SESSION["codee"]; 
		}
		else{
			echo "Not submitted";
		}

    }
	?>


<!DOCTYPE html>
<html>
<head>
   <title>For The Authentication Code</title>
</head>
<body>
    
      
               
 
</body>
</html>  