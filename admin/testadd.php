<?php
session_start();
if (!isset($_SESSION[alogin])){
	header('location: login.php');
}
require("../app/database.php");
include("header.php");
?>
	<div class="jumbotron">
		<div class="container">
			<h2 class="display-4">Add a new test</h2>
		</div>
	</div>
<?
if($_POST[submit]=='Save' || strlen($_POST['subid'])>0 ){

	extract($_POST);
	
	mysqli_query($cn, "INSERT INTO mst_test(sub_id,test_name,total_que) VALUES ('$subid','$testname','$totque')") or die(mysqli_error());

	$success = "Test ". $testname ." added successfully.";
	
	if(isset($success)){
		echo "<div class='alert alert-success'>". $success ."</div>";
		unset($success);
	}
	unset($_POST);
}
?>
<script type="text/javascript">
function check() {
	mt=document.form1.testname.value;	
if (mt.length<1) {
alert("Please Enter Test Name");
document.form1.testname.focus();
return false;
}
tt=document.form1.totque.value;
if(tt.length<1) {
alert("Please Enter Total Question");
document.form1.totque.value;
return false;
}
return true;
}
</script>
<div class="container">
	<div class="card">
		<div class="card-body">
			<form name="form1" method="post" onSubmit="return check();">

			<select name="subid">
				<?php
					$rs = mysqli_query($cn, "SELECT * FROM mst_subject ORDER BY  sub_name");
		 		 	
		 		 	while($row = mysqli_fetch_array($rs)){
						if($row[0] == $subid){
							echo "<option value='$row[0]' selected>$row[1]</option>";
						}else{
							echo "<option value='$row[0]'>$row[1]</option>";
						}
					}
				?>
	      </select>
	    <div class="input-group mb-3">
          <div class="input-group-prepend">
            <span class="input-group-text" id="basic-addon1">Test Name</span>
          </div>
          <input type="text" class="form-control" placeholder="" aria-label="testname" aria-describedby="basic-addon1" name="testname" id="testname">
        </div>
        <div class="input-group mb-3">
          <div class="input-group-prepend">
            <span class="input-group-text" id="basic-addon1">Total Questions</span>
          </div>
          <input type="text" class="form-control" placeholder="" aria-label="totalQuestions" aria-describedby="basic-addon1" name="totque" name="totque">
        </div>
        

		<input type="submit" name="submit" value="Add" class="btn btn-primary">

		<!--
		<input name="testname" type="text" id="testname">
<input name="totque" type="text" id="totque">
<input type="submit" name="submit" value="Add" > -->
</form>
