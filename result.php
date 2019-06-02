<?php 
session_start();	
if(isset($_SESSION[login])){
	session_start();
	include("app/database.php");
  
}else{
   header('location: index.php');
}
?>
<!DOCTYPE html>
<html>
<head>
	<title>quiz</title>
	<link rel="stylesheet" type="text/css" href="assests/css/bootstrap-reboot.css">
	<link rel="stylesheet" type="text/css" href="assests/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="assests/css/bootstrap-grid.css">
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
        <a class="nav-link" href="#">Quiz</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="#">Result</a>
      </li>
    </ul>
  </div>
  <span class="navbar-text">
       <?php if(isset($_SESSION[login])){ echo "Hi ". $_SESSION[login] . " <a href='signout.php'>Signout</a>"; } ?>
    </span>
 
</nav>
</header>
<?php
	extract($_SESSION);

	$rs = mysqli_query($cn,"SELECT t.test_name,t.total_que,r.test_date,r.score FROM mst_test t, mst_result r WHERE t.test_id=r.test_id and r.login='$login'") or die(mysqli_error());
?>
	<div class="jumbotron jumbotron-fluid">
		<div class="container">
			<h1 class="display-4">RESULTS</h1>
		</div>
	</div>
<?
	if(mysqli_num_rows($rs) < 1){
?>
	<div class="jumbotron jumbotron-fluid">
			<div class="container">
				<h1 class="display-4">You didn't give any test yet.</h1>
			</div>
	</div>
<?
		exit;
	}

	echo "<div class='container'>";
	echo "<table class='table'>
			<tr>
				<td><b>Test Name</b> <td> <b>Total</b>
				<br> <b>Question</b> <td> <b>Score</b>";
	while($row = mysqli_fetch_row($rs)){
		echo "<tr>
				<td><b>$row[0]</b> <td> <b class='color:blue'>$row[1]</b> <td><b class='color:red'> $row[3]</b>";
	}

	echo "</table></div>";
?>
</body>
</html>
