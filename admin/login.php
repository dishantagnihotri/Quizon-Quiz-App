<?php 
session_start();  
if(isset($_SESSION[alogin])){
   header('location: index.php');
}
include("../app/database.php");

extract($_POST);
if(isset($submit)){
	
	$rs = mysqli_query($cn, "SELECT * FROM mst_admin WHERE loginid='$loginid' AND pass='$pass'") or die(mysqli_error());
	
	if(mysqli_num_rows($rs) < 1){
		$error = "Invalid User Name or Password";
?>
		<div class="alert alert-danger">
			<p><?php echo $error; ?></p>
		</div>
<?php	
		unset($error);	

	}else{

 		$_SESSION[alogin] = "true";

//	echo $_SESSION[alogin];/
//	print('reached');
//	exit();
	
		header('location: index.php');	
	}
}
?>
<!DOCTYPE html>
<html>
<head>
  <title>quiz</title>
  <link rel="stylesheet" type="text/css" href="../assests/css/bootstrap-reboot.css">
  <link rel="stylesheet" type="text/css" href="../assests/css/bootstrap.min.css">
  <link rel="stylesheet" type="text/css" href="../assests/css/bootstrap-grid.css">
</head>
<body>
  
<header> 

<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <a class="navbar-brand" href="#">Quiz</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarNav">
    <ul class="navbar-nav">
      <li class="nav-item active">
        <a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="subadd.php">Subject Add</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="testadd.php">Test Add</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="test.php">All Test</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="questionadd.php">Question Add</a>
      </li>
    </ul>
  </div>
  <span class="navbar-text">
       <?php if(isset($_SESSION[alogin])){ echo "Hi Admin, <a href='signout.php'>Signout</a>"; }
       		 else { echo "Login"; } 
        ?>
    </span>
 
</nav>
</header>

<div class="card container">
	<div class="card-body">
		<h2>Admin Login</h2>
		<form name="form1" method="post" action="">
    		<div class="input-group mb-3">
			  <div class="input-group-prepend">
			    <span class="input-group-text" id="basic-addon1">Login Id</span>
			  </div>
			  <input type="text" class="form-control" placeholder="" aria-label="Login Id" aria-describedby="basic-addon1" name="loginid" id="loginid">
			</div>
			<div class="input-group mb-3">
			  <div class="input-group-prepend">
			    <span class="input-group-text" id="basic-addon1">Password</span>
			  </div>
			  <input type="password" class="form-control" placeholder="" aria-label="Password" aria-describedby="basic-addon1" name="pass" id="pass">
			</div>
    		
    		<!--<input name="loginid" type="text" id="loginid">
    		<input name="pass" type="password" id="pass"> -->	 
    	<input name="submit" type="submit" id="submit" value="Login" class="btn btn-primary">
		</form>
	</div>
</div>