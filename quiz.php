<?php 
session_start();	
if(isset($_SESSION[login])){
	session_start();
	include("app/database.php");
  
}else{
   header('location: index.php');
}

extract($_POST); extract($_GET); extract($_SESSION);	

	if(isset($subid) && isset($testid)){
		$_SESSION[sid]=$subid;
		$_SESSION[tid]=$testid;
		
		header("location:quiz.php");
	}
	if(!isset($_SESSION[sid]) || !isset($_SESSION[tid])){
		header("location: index.php");
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
	
	$query1 = mysqli_query($cn,"SELECT total_que FROM mst_test WHERE test_id = $tid"); 

	echo $query1;
	exit();

	$query = "SELECT * FROM mst_question";

	$rs = mysqli_query($cn, "SELECT * FROM mst_question WHERE test_id = $tid" ORDER BY rand() LIMIT ) or die(mysqli_error());
	if(!isset($_SESSION[qn])){
		$_SESSION[qn] = 0;
		mysqli_query($cn, "DELETE FROM mst_useranswer WHERE sess_id='" . session_id() ."'") or die(mysqli_error());
		$_SESSION[trueans] = 0;
	}else{	


		if($submit == 'Next Question' && isset($ans)){
			
			mysqli_data_seek($rs, $_SESSION[qn]);
			$row = mysqli_fetch_row($rs);	
			mysqli_query($cn,"INSERT INTO mst_useranswer(sess_id, test_id, que_des, ans1,ans2,ans3,ans4,true_ans,your_ans) VALUES ('".session_id()."', $tid,'$row[2]','$row[3]','$row[4]','$row[5]', '$row[6]','$row[7]','$ans')") or die(mysqli_error());
				

			if($ans == $row[7]){
					$_SESSION[trueans] = $_SESSION[trueans] + 1;
				}
		
			$_SESSION[qn]=$_SESSION[qn]+1;

		}else if($submit == 'Get Result' && isset($ans)){

			mysqli_data_seek($rs,$_SESSION[qn]);
			$row= mysqli_fetch_row($rs);	
			mysqli_query($cn,"INSERT INTO mst_useranswer(sess_id, test_id, que_des, ans1,ans2,ans3,ans4,true_ans,your_ans) VALUES ('".session_id()."', $tid,'$row[2]','$row[3]','$row[4]','$row[5]', '$row[6]','$row[7]','$ans')") or die(mysqli_error());
			
			if($ans == $row[7]){
				$_SESSION[trueans] = $_SESSION[trueans] + 1;
			}

			$_SESSION[qn] = $_SESSION[qn] + 1;
			$w = $_SESSION[qn] - $_SESSION[trueans];

			?>
			<div class="jumbotron jumbotron-fluid">
				<div class="container">
					<h1 class="display-4">Result</h1>		
			
			<table class="table">
			  <thead>
			    <tr>
			      <th scope="col">Total Question</th>
			      <th scope="col">Correct Answer</th>
			      <th scope="col">Wrong Answer</th>
			    </tr>
			  </thead>
			  <tbody>
			    <tr>
			      <th scope="row"><? echo $_SESSION[qn] ?></th>
			      <td><? echo $_SESSION[trueans] ?></td>
			      <td><? echo $w ?></td>
			    </tr>
			  </tbody>
			</table>

<?			
			mysqli_query($cn,"INSERT INTO mst_result(login,test_id,test_date,score) VALUES('$login',$tid,'".date("d/m/Y")."',$_SESSION[trueans])") or die(mysqli_error());
			
			echo "<a href='review.php' class='btn btn-primary'>Review Question</a>";
				

			unset($_SESSION[qn]);
			unset($_SESSION[sid]);
			unset($_SESSION[tid]);
			unset($_SESSION[trueans]);
			exit;
		}
	}


	$rs = mysql_query("SELECT * FROM mst_question WHERE test_id = $tid", $cn) or die(mysql_error());

	if($_SESSION[qn] > mysql_num_rows($rs) - 1){
		unset($_SESSION[qn]);
		echo "<h1>Some Error  Occured</h1>";
		
		session_destroy();
		echo "<a href='index.php'>Start Again</a>";

		exit;
	}


	mysql_data_seek($rs, $_SESSION[qn]);
	$row = mysql_fetch_row($rs);
	$n = $_SESSION[qn] + 1;
	?>
	<div class="container">
		<div class="row no-gutters">
			<div class="col-12">				
				<form name='myfm' method='post' action='quiz.php'>
				
				<h4><small>Question <? echo $n; echo ': </small>'; echo $row[2]; ?></h4>
					
				
				<ul class="list-group">
				  <li class="list-group-item"><input type='radio' name='ans' value='1'><? echo $row[3] ?></li>
				  <li class="list-group-item"><input type='radio' name='ans' value='2'><? echo $row[4] ?></li>
				  <li class="list-group-item"><input type='radio' name='ans' value='3'><? echo $row[5] ?></li>
				  <li class="list-group-item"><input type='radio' name='ans' value='4'><? echo $row[6] ?></li>
				</ul>
	<?

	if($_SESSION[qn] < mysql_num_rows($rs) - 1){
		echo "		<input type='submit' name='submit' value='Next Question' class='btn btn-primary'>
			
		</form>";
	}else{
		echo "		<input type='submit' name='submit' value='Get Result' class='btn btn-success'>
			
		</form>";
	}
?>
</body>
</html>