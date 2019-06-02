 <?php 
    	echo "Hi ". $_SESSION[login]; 
	
	if (isset($_SESSION[login])) {
		echo "<a href='index.php'>Home</a> | <a href='signout.php'>Signout</a>";
	} else {
		header('location: index.php');
	}	
?>