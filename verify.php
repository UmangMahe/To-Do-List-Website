<?php
function rememberme($email,$name) {
if(isset($_POST['rememberme'])) {
$_SESSION['rememberme']=1;
setcookie('email',$email,time()+60+60*24,"/todolist");
setcookie('password',$_POST['pass'],time()+60+60*24,"/todolist");
setcookie('name',$name,time()+60+60*24,"/todolist");
}
else {
setcookie('email',$email,false,"/todolist");
setcookie('password',$_POST['pass'],time()-1,"/todolist");
$_SESSION['password']=$_POST['pass'];
setcookie('name',$name,false,"/todolist");
}
}
session_start();
if($_COOKIE['email']==$_POST['email'] and $_COOKIE['password']==$_POST['pass'] and isset($_COOKIE['name'])) {
$_SESSION['welcome']=1;
rememberme($_COOKIE['email'],$_COOKIE['name']);
header("location: welcome.php");
}
else {
setcookie('name',$name,time()-1,"/todolist");
setcookie('email',$_POST['email'],time()-1,"/todolist");
setcookie('password',$_POST['pass'],time()-1,"/todolist");
}
$connect=mysqli_connect('localhost','root','root','todolist');
if(!$connect) {
die("Connection Failed <br> ".mysqli_connect_error());
}
$email=$_POST['email'];
if(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
$_SESSION['invalid']=1;
setcookie('password',$_POST['pass'],time()-1,"/todolist");
unset($_SESSION['password']);
setcookie('email',$email,time()-1,"/todolist");
header("location: index.php");
exit();
}
$password=$_POST['pass'];

$verify = "SELECT Name,Email,Password FROM Users WHERE Email='$email' && Password='$password'";
$result = mysqli_query($connect,$verify);

if (mysqli_num_rows($result) > 0) {
$info=mysqli_fetch_assoc($result);
$email=$info['Email'];
$name=$info['Name'];
rememberme($email,$name);
header("location:welcome.php");
}
else {
setcookie('email',$email,time()-1,"/todolist");
setcookie('password',$_POST['pass'],time()-1,"/todolist");
setcookie('name',$name,time()-1,"/todolist");
unset($_SESSION['password']);
$verify = "SELECT Password FROM Users WHERE Email='$email'";
$result = mysqli_query($connect,$verify);
if (mysqli_num_rows($result) > 0) {
$info=mysqli_fetch_assoc($result);
if($password!=$info['Password']) {
$_SESSION['email']=$email;
$_SESSION['invpass']=1;
header("location:index.php");
}
}
else {
$_SESSION['details']=1;
setcookie('email',$email,time()-1,"/todolist");
$_SESSION['email']=$email;
header("location:signup.php");
}
}
mysqli_close();
?>
