<?php
	extract($_POST);
	include("app/database.php");

	$rs = mysqli_query($cn, "SELECT * FROM mst_user WHERE login='$lid'");

	if (mysqli_num_rows($rs) > 0){
		echo "Login Id Already Exists. Please try again to signup";
		echo "<a href='signup.php' class='btn btn-primary'>Signup</a>";
		exit;
	}

	$query = "INSERT INTO mst_user(user_id,login,pass,username,address,city,phone,email) VALUES('$uid','$lid','$pass','$name','$address','$city','$phone','$email')";

	$rs = mysqli_query($cn, $query) or die("Something went wrong");

echo "Your Login ID  <b>$lid</b> Created Sucessfully";
echo "Please Login using your Login ID to take Quiz";
echo "<a href='index.php' class='btn btn-success'>Login</a>";
exit();
?>
