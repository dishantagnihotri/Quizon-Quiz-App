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
       <?php isset($_SESSION[login])){  echo "Hi ". $_SESSION[login] . " <a href='signout.php'>Signout</a>"; } ?>
    </span>
 
</nav>
</header>

<style type="text/css">
	.uppercase{
		text-transform: uppercase;
	}
</style>
<div class="jumbotron jumbotron-fluid">
	<div class="container">
		<?php
			extract($_GET);
			
			$rs1 = mysqli_query($cn, "SELECT * FROM mst_subject WHERE sub_id = $subid");
			$row1=mysqli_fetch_array($rs1);
			echo "<h1 class='uppercase'><b>$row1[1]</h1></b>";
			$rs = mysqli_query($cn, "SELECT * FROM mst_test WHERE sub_id = $subid");
			
			if(mysqli_num_rows($rs) < 1){
				echo "<b>No Quiz for this Subject</b>";
				exit;
			}
			echo "<h2>Select Quiz Type.</h2>";
			
			while($row = mysqli_fetch_row($rs)){
				echo "<a href='quiz.php?testid=$row[0]&subid=$subid' class='btn btn-primary'>$row[2]</a>";
			}
		?>
	</div>
</div>
</body>
</html>
