
<?php
session_start();
if(isset($_COOKIE['email']) and (isset($_COOKIE['password']) || isset($_SESSION['password']))) {
$db = mysqli_connect('localhost', 'root', 'root', 'todolist');
if(!$db) {
die("Connection Failed ".mysqli_connect_error());
}
$tname = $_SESSION['tname'];
$sql = "DESC $tname";
if(!mysqli_query($db, $sql)) {
echo "Database of ".$_COOKIE['name']." Not Found : ".mysqli_error($db);
}
else {
$name=substr($_COOKIE['name'],0,strpos($_COOKIE['name'],' '));
$filename = "ToDoList@".$name;
$_SESSION['file']=$filename;
$filepath = $_SERVER['DOCUMENT_ROOT'] . "/todolist/".$tname."_data/";
mkdir($_SERVER['DOCUMENT_ROOT'] . "/todolist/".$tname."_data/");
$fp = fopen($filepath.$filename.".txt","w");
chmod($fp, 0777);
$create = mysqli_query($db,"SELECT id,task FROM $tname");
$i=1;
while($row=mysqli_fetch_assoc($create)) {
fwrite($fp, $i.".");
fwrite($fp, "\t");
fwrite($fp, $row['task']);
fwrite($fp, "\n");
$i+=1;
}
fclose($fp);
header("location: welcome.php?download=$filename.txt");
}
}
else {
echo "Session Expired";
}
?>

