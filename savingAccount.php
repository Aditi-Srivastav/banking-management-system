<?php
	$conn = new mysqli('localhost','root','','banking_system');
	// if($conn)
	
	// 	echo "connection successful";
	// }
	// else
	// {
	// 		die("Connection Failed : ". $conn->connect_error);
	// 		echo"error";
	// }	

	$name = $_POST['name'];
	$father_name = $_POST['father_name'];
    $gender = $_POST['gender'];
    $phone = $_POST['phone'];
	$dob = $_POST['dob'];
    $occupation = $_POST['occupation'];
    $pancard = $_POST['pancard'];
	$aadhar = $_POST['aadhar'];
    $address = $_POST['address'];
	$marital_status = $_POST['marital_status'];
	$username = $_POST['username'];
	$password = $_POST['password'];
	$email = $_POST['email'];
	$money = $_POST['money'];
	$timestamp = date("Y-m-d H:i:s");
	session_start();
	$_SESSION['aname']=$name;
	$hashed_password = password_hash($password,PASSWORD_DEFAULT);
    
	$query = "INSERT INTO `account` VALUES (NULL,'$name','$father_name','$gender','$phone','$dob','$occupation','$pancard','$aadhar','$address','$marital_status','$username','$hashed_password','$email','$money','$timestamp')";
	$data = mysqli_query($conn,$query);

	if($data)
	{
		?>
			<script>
				alert("Record submitted succesfully");
			 </script> 
		<?php
	}
	//echo "Welcome ".$_SESSION["aname"]." your account has been opened for further detail go to the page";
	
	
//session_start();  // Ensure session is started

if (isset($_SESSION["aname"])) {
  echo "Welcome " . $_SESSION["aname"] . ", your account has been opened! For further details, go to the <a href=\"login.html\">Login Page</a> page.";
} else {
  echo "Your session has not been started yet. Please log in to access your account details.";
}

	
    // echo "<script> window.location.href='login.html';</script>";
	
    
?>

