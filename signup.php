<html>
<head>
<link rel="stylesheet" type="text/css" href="css/style.css">
</head>
<title>Register - To Do List</title>
<br>
<body>
<div class="body1">
<h3>Sign Up</h3>
<hr class="sep">
<br>
<form method="POST" action="register.php">
<input type="text" placeholder="First Name" id="fname" name="fname" required>
<br><br> 
<input type="text" placeholder="Last Name" id="lname" name="lname" >
<br><br> 
<input type="text" placeholder="Email Address" id="email" name="email" required>
<br><br> 
<input type="password" placeholder="Enter Password" id="pass" name="pass" required>
<br><br>
<input class="btn lbtn" type="submit" name="register" value="REGISTER">     
<br><br>
</form>
</div>
</body>
<?php
session_start();
if(isset($_SESSION['details'])) {
if(isset($_SESSION['email'])) {
$email=$_SESSION['email'];
echo "<script>
	document.getElementById('email').value='$email';
      </script>";
unset($_SESSION['email']);
}
else {
echo "<script>
	document.getElementById('email').value='';
      </script>";
}
echo "<p id='details'>Login Failed! Account Doesn't Exist</p>";
echo "<script>
	setTimeout(function() {
document.getElementById('details').className='details';
	},3000);
      </script>";
}
if(isset($_SESSION['invalid'])) {
echo "<p id='invalid_email'>Invalid Email</p>";
echo "<script>
	setTimeout(function() {
document.getElementById('invalid_email').className='invalid_email';
	},3000);
      </script>";
}
else if(isset($_SESSION['exist'])) {
echo "<p id='exist_email'>Email Already Exist. Please Log In</p>";
echo "<script>
	setTimeout(function() {
document.getElementById('exist_email').className='exist_email';
	},3000);
      </script>";
}
session_destroy();
?>
</html>
