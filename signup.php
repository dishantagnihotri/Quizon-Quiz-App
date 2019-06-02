<?php 
session_start();  
  include("app/database.php");
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
  
<script language="javascript">
function check()
{

 if(document.form1.lid.value=="")
  {
    alert("Plese Enter Login Id");
  document.form1.lid.focus();
  return false;
  }
 
 if(document.form1.pass.value=="")
  {
    alert("Plese Enter Your Password");
  document.form1.pass.focus();
  return false;
  } 
  if(document.form1.cpass.value=="")
  {
    alert("Plese Enter Confirm Password");
  document.form1.cpass.focus();
  return false;
  }
  if(document.form1.pass.value!=document.form1.cpass.value)
  {
    alert("Confirm Password does not matched");
  document.form1.cpass.focus();
  return false;
  }
  if(document.form1.name.value=="")
  {
    alert("Plese Enter Your Name");
  document.form1.name.focus();
  return false;
  }
  if(document.form1.address.value=="")
  {
    alert("Plese Enter Address");
  document.form1.address.focus();
  return false;
  }
  if(document.form1.city.value=="")
  {
    alert("Plese Enter City Name");
  document.form1.city.focus();
  return false;
  }
  if(document.form1.phone.value=="")
  {
    alert("Plese Enter Contact No");
  document.form1.phone.focus();
  return false;
  }
  if(document.form1.email.value=="")
  {
    alert("Plese Enter your Email Address");
  document.form1.email.focus();
  return false;
  }
  e=document.form1.email.value;
    f1=e.indexOf('@');
    f2=e.indexOf('@',f1+1);
    e1=e.indexOf('.');
    e2=e.indexOf('.',e1+1);
    n=e.length;

    if(!(f1>0 && f2==-1 && e1>0 && e2==-1 && f1!=e1+1 && e1!=f1+1 && f1!=n-1 && e1!=n-1))
    {
      alert("Please Enter valid Email");
      document.form1.email.focus();
      return false;
    }
  return true;
  }
  
</script>
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
       <?php isset($_SESSION[login])){  echo "Hi <a href='login.php'>Login</a>"; } ?>
    </span>
 
</nav>
</header>
<div class="container card">
  <div class="card-body">
        
      <form name="form1" method="post" action="signupuser.php" onSubmit="return check();">

        <div class="input-group mb-3">
          <div class="input-group-prepend">
            <span class="input-group-text" id="basic-addon1">Login Id</span>
          </div>
          <input type="text" class="form-control" placeholder="Login Id" aria-label="Login Id" aria-describedby="basic-addon1" name="lid">
        </div>
        <div class="input-group mb-3">
          <div class="input-group-prepend">
            <span class="input-group-text" id="basic-addon1">Password</span>
          </div>
          <input type="password" class="form-control" placeholder="" aria-label="Password" aria-describedby="basic-addon1" name="pass">
        </div>
        <div class="input-group mb-3">
          <div class="input-group-prepend">
            <span class="input-group-text" id="basic-addon1">Confirm password</span>
          </div>
          <input type="password" class="form-control" placeholder="" aria-label="Password" aria-describedby="basic-addon1" name="cpass" id="cpass">
        </div>
        <div class="input-group mb-3">
          <div class="input-group-prepend">
            <span class="input-group-text" id="basic-addon1">Full Name</span>
          </div>
          <input type="text" class="form-control" placeholder="" aria-label="name" aria-describedby="basic-addon1" id="name" name="name">
        </div>
        <div class="input-group mb-3">
          <div class="input-group-prepend">
            <span class="input-group-text" id="basic-addon1">Address</span>
          </div>
          <input type="text" class="form-control" placeholder="" aria-label="address" aria-describedby="basic-addon1" name="address" id="address">
        </div>
        <div class="input-group mb-3">
          <div class="input-group-prepend">
            <span class="input-group-text" id="basic-addon1">City</span>
          </div>
          <input type="text" class="form-control" placeholder="" aria-label="city" aria-describedby="basic-addon1" name="city" id="city">
        </div>
        <div class="input-group mb-3">
          <div class="input-group-prepend">
            <span class="input-group-text" id="basic-addon1">Phone</span>
          </div>
          <input type="text" class="form-control" placeholder="" aria-label="phone" aria-describedby="basic-addon1" name="phone" id="phone">
        </div>
        <div class="input-group mb-3">
          <div class="input-group-prepend">
            <span class="input-group-text" id="basic-addon1">Email</span>
          </div>
          <input type="text" class="form-control" placeholder="" aria-label="email" aria-describedby="basic-addon1" id="email" name="email">
        </div>

        <div class="input-group mb-3">
            
           <input type="submit" name="Submit" value="Signup" class="btn btn-primary">

        </div>





<!--

           <td><input type="text" name="lid"></td>
           <td><input type="password" name="pass"></td>
           <td><input name="cpass" type="password" id="cpass"></td>
           <td><input name="name" type="text" id="name"></td>
           <td><textarea name="address" id="address"></textarea></td>
           <td><input name="city" type="text" id="city"></td>
           <td><input name="phone" type="text" id="phone"></td>
           <td><input name="email" type="text" id="email"></td>
           <td><input type="submit" name="Submit" value="Signup">
           </td>
        -->
     </form>
   </div>
</div>
</body>
</html>
