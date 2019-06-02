<?php 
  session_start();	
  if (isset($_SESSION[login])) {
    include("app/database.php");
  } else {
    header('location: index.php');
  }
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
        if (isset($_SESSION[login])) {  
          echo "Hi ". $_SESSION[login] . " <a href='signout.php'>Signout</a>"; 
        } 
      ?>
    </span>
  </nav>
</header>

<div class="row jumbotron-fluid no-gutters jumbotron">
	<div class="container">
		<h2 class="display-4">Select Subject to give quiz.</h2>
		<div class="lead">
			<?php
				$rs = mysqli_query($cn, "SELECT * FROM mst_subject");
				while ($row = mysqli_fetch_row($rs)) {
					echo "<a href='showtest.php?subid=$row[0]' class='btn btn-primary' style='margin-right: 10px;'>$row[1]</a>";
				}
			?>
		</div>
	</div>
</div>
</body>
</html>
