<?php
session_start();
$filename=$_SESSION['file'].".txt";
$folder_path = $_SERVER['DOCUMENT_ROOT'] . "/todolist/".$_SESSION['tname']."_data";
$file_path = $folder_path."/".$filename;
unlink($file_path);
echo $folder_path;
rmdir($folder_path);
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
