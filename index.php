<?php 
  session_start();	
  include("app/database.php"); 
?>
<!DOCTYPE html>
<html>
<head>
	<title>Quizon Quiz Application</title>
	<link rel="stylesheet" type="text/css" href="assests/css/bootstrap-reboot.css">
	<link rel="stylesheet" type="text/css" href="assests/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="assests/css/bootstrap-grid.css">
</head>
<body>
<header> 
  <nav class="navbar navbar-expand-lg navbar-light bg-light">
    <a class="navbar-brand" href="#">Quizon</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav">
        <li class="nav-item active">
          <a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">Quiz</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">Result</a>
        </li>
      </ul>
    </div>
    <span class="navbar-text">
      <?php 
        if (isset($_SESSION['login'])) { 
          echo "Hi ". $_SESSION[login] . " <a href='signout.php'>Signout</a>"; 
        } 
      ?>
    </span>
  </nav>
</header>
<?php
  extract($_POST);
	if (isset($submit)) {
		$rs = mysqli_query($cn,"SELECT * FROM mst_user WHERE login = '$loginid' AND pass = '$pass'")  or die(mysqli_error());
		
		if (mysqli_num_rows($rs) < 1) {
			$found = "Not found";
		} else {
			$_SESSION[login] = $loginid;
		}
	}
	if (isset($_SESSION[login])) {
?>
  <div class="jumbotron jumbotron-fluid">
    <div class="container">
      <h1 class="display-4">Welcome to Online Exam</h1>
      <p class="lead"><a href="sublist.php" class="btn btn-primary">Subject for Quiz </a>
          <a href="result.php" class="btn btn-secondary">Result </a></p>
    </div>
  </div>
<?php   
	exit;
  }
?>
  <div class="container card">
	  <div class="card-body"> 
<?php
    if (isset($found)) {
      echo '<div class="alert alert-danger" role="alert">';
      echo "Invalid User! Check username or Password again!</div>";
    }
?>
    <form name="form1" method="post" action="">   
      <div class="input-group mb-3">
        <div class="input-group-prepend">
          <span class="input-group-text" id="basic-addon1">Login Id</span>
        </div>
        <input type="text" class="form-control" placeholder="Login Id" aria-label="Login Id" aria-describedby="basic-addon1" name="loginid" id="loginid2">
      </div>
      <div class="input-group mb-3">
        <div class="input-group-prepend">
          <span class="input-group-text" id="basic-addon1">Password</span>
        </div>
        <input type="password" class="form-control" placeholder="Password" aria-label="Login Id" aria-describedby="basic-addon1" name="pass" id="pass2">
      </div>
      <input name="submit" type="submit" id="submit" value="Login" class="btn btn-primary"> 
      <!--
        <input name="loginid" type="text" id="loginid2" placeholder="Enter Login">
        <input name="pass" type="password" id="pass2" placeholder="Enter Pass">
      -->
    </form>
     <a href="signup.php">Signup</a>
</body>
</html>
