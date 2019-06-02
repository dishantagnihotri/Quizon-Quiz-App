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
	<style type="text/css">
		.success{
			color: green;
			font-weight: bold;
		}
	</style>
	
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
extract($_POST);
extract($_SESSION);
if($submit=='Finish')
{
	mysqli_query($cn, "DELETE FROM mst_useranswer WHERE sess_id='" . session_id() ."'") or die(mysqli_error());
	unset($_SESSION[qn]);
	echo '<meta http-equiv="refresh" content="0; URL=index.php">';
	exit;
}
?>
<body>
<div class="jumbotron jumbotron-fluid">
	<div class="container">
		<h1 class="display-4">Review Test Questions</h1>
	</div>
</div> 
<?php
if(!isset($_SESSION[qn])){
		$_SESSION[qn]=0;
}else if($submit=='Next Question' )
{
	$_SESSION[qn]=$_SESSION[qn]+1;	
}

$rs = mysqli_query($cn,"SELECT * FROM mst_useranswer WHERE sess_id='" . session_id() ."'") or die(mysqli_error());
mysqli_data_seek($rs,$_SESSION[qn]);
$row= mysqli_fetch_row($rs);
echo "<div class='container'>"; 
echo "<form name='myfm' method='post' action='review.php'>";
echo "<ul class='list-group'>";
$n=$_SESSION[qn]+1;
echo "<h2><small>Question ".  $n .":</small> $row[2]</h2>";
echo "<li class='list-group-item ".($row[7]==1?'success':'na')."'>$row[3]</li>";
echo "<li class='list-group-item ".($row[7]==2?'success':'na')."'>$row[4]</li>";
echo "<li class='list-group-item ".($row[7]==3?'success':'na')."'>$row[5]</li>";
echo "<li class='list-group-item ".($row[7]==4?'success':'na')."'>$row[6]</li>";
if($_SESSION[qn]<mysqli_num_rows($rs)-1)
echo "<input type=submit name=submit value='Next Question' class='btn btn-primary'></form>";
else
echo "<input type=submit name=submit value='Finish' class='btn btn-primary'></form>";

echo "</div>";
?>
