<?php 
  session_start();	
  if (isset($_SESSION[login])) {
    session_start();
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
        echo "Hi ". $_SESSION[login] . " <a href='signout.php'>Signout</a>"; 
      ?>
    </span>
  </nav>
</header>