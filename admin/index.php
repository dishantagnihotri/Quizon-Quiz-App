<?php
session_start();  

if(isset($_SESSION[alogin])){
  include("../app/database.php");
}else{
   header('location: login.php');
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

<div class="jumbotron jumbotron-fluid">
	<div class="container">
		<h1 class="display-4">Welcome to Admistrative Area</h1>
		
		<a href="subadd.php" class="btn btn-primary">Add Subject</a>
		<a href="testadd.php" class="btn btn-secondary">Add Test</a>
		<a href="questionadd.php" class="btn btn-primary">Add Question </a>


</body>
</html>
