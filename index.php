<html>
<head>
<link rel="stylesheet" type="text/css" href="css/style.css">
</head>
<title>PHP Project</title>
<br>
<body>
<h2>ToDo List</h2>
<div class="body1">
<h3 class="login">Login</h3>
<hr class=sep>
<br>
<form method="POST" action="verify.php">
<input type="text" placeholder="Enter Email Address" align="right" id="email" name="email" required>
<br><br> 
<input type="password" placeholder="Enter Password" id="pass" name="pass" required>
<br><br>
<label><font>Remember Me</font>
<input type="checkbox" name="rememberme" value="1" />
<span class="checkmark"></span>
</label>
<br><br>
<input class="btn lbtn" type="submit" name="login" value="LOGIN">   
<br><br>
<a href=signup.php>New User? Register here</a>
<hr class=sep1>
</form>
</div>
</body>
<?php
session_start();
if(isset($_SESSION['invpass'])) {
if(isset($_SESSION['email'])) {
$email=$_SESSION['email'];
echo "<script>
	document.getElementById('email').value='$email';
      </script>";
}
else {
echo "<script>
	document.getElementById('email').value='';
      </script>";
}
echo "<p id='details'>Login Failed! Incorrect Password</p>";
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
if(isset($_SESSION['logout'])) {
echo "<p id='logout'>Logout Successful</p>";
echo "<script>
	setTimeout(function() {
		document.getElementById('logout').className='logout';
	},3000);
      </script>";
}
if(isset($_SESSION['success'])) {
echo "<p id='success'>Account Created Successfully</p>";
echo "<script>
	setTimeout(function() {
		document.getElementById('success').className='success';
	},3000);
      </script>";
}
if(isset($_COOKIE['email']) || isset($_COOKIE['password'])) {
$email = $_COOKIE['email'];
$pass = $_COOKIE['password'];
echo "<script>
	document.getElementById('pass').value='$pass';
	document.getElementById('email').value='$email';
      </script>";
}
session_destroy();


?>
</html>
