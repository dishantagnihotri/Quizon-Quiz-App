<?php
	session_start();

	if (!isset($_SESSION[alogin])) {
		header("location: login.php");
		exit();
	}
	session_start();
	require("../app/database.php");
	include("header.php");
?>
<?php
	extract($_POST);

	if ($submit == 'submit' || strlen($subname) > 0 ) {
		$rs = mysqli_query($cn, "SELECT * FROM mst_subject WHERE sub_name = '$subname'");
		
		if (mysqli_num_rows($rs) > 0) {
			$error = 'Subject Already Exists. Try to add different or add test in existing one.';
			if (isset($error)) {
				echo "<div class='alert alert-danger'>". $error ."</div>";	
			}
			unset($error);
		} else {
			$success = "Subject  <b>" . $subname . "</b> Added Successfully";
			if (isset($success)) {
				echo "<div class='alert alert-success'>". $success ."</div>";
			}
			unset($success);
			mysqli_query($cn, "INSERT INTO mst_subject(sub_name) VALUES ('$subname')") or die(mysqli_error());
		}
	}
?>

<script type="text/javascript">
	function check() {
		mt = document.form1.subname.value;
		if (mt.length < 1) {
			alert("Please Enter Subject Name");
			document.form1.subname.focus();
			return false;
		}
		return true;
	}
</script>

<div class="container">
	<div class="card">
		<div class="card-body">
			<h4>Add a Subject</h4>	
			<form name="form1" method="post" onSubmit="return check();">
				 <div class="input-group mb-3">
						<div class="input-group-prepend">
							<span class="input-group-text" id="basic-addon1">Subject Name</span>
						</div>
						<input type="text" class="form-control" placeholder="" aria-label="Subject Name" aria-describedby="basic-addon1" name="subname" id="subname">
				</div>

				<!--        <input name="subname" type="text" id="subname"> -->
			  <input type="submit" name="submit" value="Add" class="btn btn-primary">
			</form>
		</div>
	</div>
</div>
