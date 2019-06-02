<?php
	session_start();
	require("../app/database.php");
	include("header.php");

	extract($_POST);

	if (!isset($_SESSION[alogin])){
		header('location: login.php');
	}
	?>
		<div class="jumbotron">
			<div class="container">
				<h2 class="display-4">Add a new Question</h2>
			</div>
		</div>
	<?
		if($_POST[submit]=='Save' || strlen($_POST['testid']) > 0 ){
			extract($_POST);

			mysqli_query($cn, "INSERT INTO mst_question(test_id,que_desc,ans1,ans2,ans3,ans4,true_ans) VALUES ('$testid','$addque','$ans1','$ans2','$ans3','$ans4','$anstrue')") or die(mysqli_error());
			$success = "Question Added Successfully";
			if(isset($success)){
				echo "<div class='alert alert-success'>". $success ."</div>";
				unset($success);
			}
			
			unset($_POST);
		}
	?>
<script type="text/javascript">
	function check() {
	mt=document.form1.addque.value;
	if (mt.length<1) {
	alert("Please Enter Question");
	document.form1.addque.focus();
	return false;
	}
	a1=document.form1.ans1.value;
	if(a1.length<1) {
	alert("Please Enter Answer1");
	document.form1.ans1.focus();
	return false;
	}
	a2=document.form1.ans2.value;
	if(a1.length<1) {
	alert("Please Enter Answer2");
	document.form1.ans2.focus();
	return false;
	}
	a3=document.form1.ans3.value;
	if(a3.length<1) {
	alert("Please Enter Answer3");
	document.form1.ans3.focus();
	return false;
	}
	a4=document.form1.ans4.value;
	if(a4.length<1) {
	alert("Please Enter Answer4");
	document.form1.ans4.focus();
	return false;
	}
	at=document.form1.anstrue.value;
	if(at.length<1) {
	alert("Please Enter True Answer");
	document.form1.anstrue.focus();
	return false;
	}
	return true;
	}
</script>

<div class="container">
	<div class="card">
		<div class="card-body"> 
			<form name="form1" method="post" onSubmit="return check();">
				
				<select name="testid">
				<?php
					$rs = mysqli_query($cn, "SELECT * FROM mst_test ORDER By test_name");
				
					while($row = mysqli_fetch_array($rs)){
						if($row[0] == $testid){
							echo "<option value='$row[0]' selected>$row[2]</option>";
						}else{
							echo "<option value='$row[0]'>$row[2]</option>";
						}
					}
				?>
      			</select>
				
				<textarea name="addque" cols="60" rows="2" id="addque"></textarea>
				<input name="ans1" type="text" id="ans1" size="85" maxlength="85">
				<input name="ans2" type="text" id="ans2" size="85" maxlength="85">
				<input name="ans3" type="text" id="ans3" size="85" maxlength="85">
				<input name="ans4" type="text" id="ans4" size="85" maxlength="85">
				<input name="anstrue" type="text" id="anstrue" size="50" maxlength="50">
				<input type="submit" name="submit" value="Add" class="btn btn-primary">
			</form>

		</div>
	</div>
</div>