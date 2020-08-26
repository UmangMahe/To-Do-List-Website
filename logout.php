<?php
session_start();
$filename=$_SESSION['file'].".txt";
$link = $_SERVER['DOCUMENT_ROOT'] . "/todolist/tmp_data/$filename";
unlink($link);
unset($_SESSION['password']);
setcookie('name',$name,time()-1,"/todolist");
unset($_SESSION['file']);
unset($_SESSION['email']);
unset($_SESSION['tname']);
if(!isset($_SESSION['rememberme'])) {
setcookie('email',$_POST['email'],time()-1,"/todolist");
}
setcookie('password',$_POST['pass'],time()-1,"/todolist");
session_destroy();
session_start();
$_SESSION['logout']=1;
header("location:index.php");

?>
