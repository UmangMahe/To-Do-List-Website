<?php
session_start();
$connect=mysqli_connect('localhost','root','root','todolist');
if(!$connect) {
die("Sign Up Failed: ".mysqli_connect_error());
}
$email=$_POST['email'];
$name=$_POST['fname'].' '.$_POST['lname'];
if(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
$_SESSION['invalid']=1;
header("location:signup.php");
exit();
}
$everify = "SELECT Email FROM Users WHERE Email='$email'";
$result = mysqli_query($connect,$everify);
if (mysqli_num_rows($result) > 0) {
$_SESSION['exist']=1;
header("location: signup.php");
exit();
}

$pass=$_POST['pass'];

$verify_table = "DESC Users";
if(!mysqli_query($connect, $verify_table)) {
$table_query = "CREATE TABLE Users(Name varchar(100), Email varchar(100), Password varchar(100))";
if(mysqli_query($connect, $table_query)) {
insertinVal();
}
else {
echo "Error ".mysqli_error($connect);
}
}
else {insertinVal();}

function insertinVal() {
global $name, $pass, $email, $connect;
$insert = "INSERT INTO Users(Name, Password, Email) VALUES ('$name','$pass','$email')";
if(mysqli_query($connect,$insert)) {
$_SESSION['success']=1;
setcookie('email',$_SESSION['email'],time()-1,"/");
setcookie('password',md5($_POST['pass']),time()-1,"/");
header("location:index.php");
}
else {
echo "Error ".mysqli_error($connect);
}
}



mysqli_close();

?>
