<head>
<meta http-equiv="refresh" content="900;url=index.php" />
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

<link rel="stylesheet" type="text/css" href="css/style_task.css">

</head>
<title>Welcome to ToDo List</title>
<?php
session_start();
if(isset($_COOKIE['email']) and (isset($_COOKIE['password']) || isset($_SESSION['password'])) and isset($_COOKIE['name'])) {
$db = mysqli_connect('localhost', 'root', 'root', 'todolist');
if(!$db) {
die("Connection Failed ".mysqli_connect_error());
}
if(isset($_SESSION['welcome'])) {
$name=$_COOKIE['name'];
echo "<p id='msg1'>Welcome back $name</p>";
echo "<script>
	setTimeout(function() {
document.getElementById('msg1').className='welcome';
	},3000);
      </script>";
unset($_SESSION['welcome']);
}
$name = str_replace( array( '\'', '"', ',' , ';', '<', '>',' ','.','/'), '', $_COOKIE['name']);
$email = str_replace( array( '\'', '"', ',' , ';', '<', '>',' ','.','/',"@"), '', $_COOKIE['email']);
$tname = md5(substr($name,0,4).substr($email,4,12).md5($_COOKIE['password']));
$_SESSION['tname'] = $tname;
$sql = "DESC $tname";
if(!mysqli_query($db,$sql)) {
$sql = "CREATE TABLE $tname(id int(10) PRIMARY KEY UNIQUE AUTO_INCREMENT, task varchar(200))";
mysqli_query($db, $sql);
}

if (isset($_POST['submit'])) {
if (empty($_POST['task'])) {
$errors = "You must fill in the task";
}
else {

$task = $_POST['task'];
$query = "INSERT INTO $tname (task) VALUES ('$task')";
mysqli_query($db, $query);
header('location: welcome.php');
}
}
if (isset($_GET['del_task'])) { 
$id = $_GET['del_task'];
mysqli_query($db, "DELETE FROM $tname WHERE id=".$id);
$verify = mysqli_query($db, "SELECT * FROM tasks");
mysqli_query($db, "ALTER TABLE $tname AUTO_INCREMENT = 1");
}
if(isset($_GET['edit_task'])) {
$val = $_GET['edit_task'];
$id = substr($val,0,1);
$task_new = substr($val,2);
$result = mysqli_query($db, "SELECT task FROM $tname WHERE id=".$id);
if (mysqli_num_rows($result) > 0) {
$val=mysqli_fetch_array($result);
$task = $val['task'];
}
mysqli_query($db, "UPDATE $tname SET task='$task_new' WHERE id=".$id);
}
$tasks = mysqli_query($db, "SELECT * FROM $tname");
}
else {
header('location: index.php');
}
mysqli_close($db);
?>

<body>
<p id='msg' style="display:none;">Please enter some task</p>
<h2 align=center><font size=6px>Welcome</font> <div class="name"><?php echo $_COOKIE['name'] ?></div> </h2><br>
<a class="btn1" href=logout.php>Logout</a>
<a class="btn2" href=export.php><b>Export</b</a>
<a id="btn3" href=./<?php echo $_SESSION['tname']?>_data/<?php echo $_GET['download'] ?> download><span><i class="fa fa-download"></i></span></a>
<div class="heading">
<h2 style="font-style:'Hervetica';">ToDo List</h2>
</div>
<form class="form" method="post" action="welcome.php" >
<?php if (isset($errors)) { ?>
<p class="err"><?php echo $errors; ?></p>
<?php } ?>
<input type="text" name="task" placeholder="Enter Task Here.... " class="task_input">
<input type="submit" name="submit" value="Add Task" id="add_btn" class="add_btn">
</form>
<table>
	<thead>
		<tr>
			<th width=10% style="text-align:center;">S.No.</th>
			<th width=68%>Tasks</th>
			<th >Action</th>
		</tr>
	</thead>

	<tbody align=center>
		<?php $i = 1; while ($row = mysqli_fetch_array($tasks)) { ?>
			<tr>
				<td style="text-align:center;"> <?php echo $i; ?> </td>
				<td class="task" id="task<?php echo $row['id']; ?>"> <?php echo $row['task']; ?> </td>
				<td class="delete">
				<button id="edit_button<?php echo $row['id']; ?>" class="edit" onclick="edit_row(<?php echo $row['id']; ?>)"><i class="fa fa-edit"></i></button>
				<button style="display:none;" id="save_button<?php echo $row['id']; ?>" class="save" onclick="save_row(<?php echo $row['id']; ?>)"><i class="fa fa-save"></i></button>
				<button class="del" onclick="location.href='welcome.php?del_task=<?php echo $row['id'];?>';"><i class="fa fa-remove"></i></button> 
				</td>
			</tr>
		<?php $i++; } ?>	
	</tbody>
</table>

</body>
<?php
if(isset($_GET['download']) and isset($_COOKIE['email']) and (isset($_SESSION['password']) || isset($_COOKIE['password']))) {
echo "<script> 
	var x = document.getElementById('btn3');
	if(x.style.visibility = 'hidden') {
	x.style.visibility = 'visible';
	x.style.animation = 'fadein 300ms linear';
	}
      </script>";
}
?>
<script>
function edit_row(no)
{
 document.getElementById("edit_button"+no).style.display="none";
 document.getElementById("save_button"+no).style.display="inline-block";
 
 var name=document.getElementById("task"+no);

 var name_data=name.innerHTML;
 name.innerHTML="<input type='text' name='edit_t' class='edit_t' id='task_new"+no+"' value='"+name_data+"'>";
}
function save_row(no) {

var task = document.getElementById('task_new'+no).value;
task = task.trim();
if(task=='') {
if(document.getElementById('msg').style.display == "none") {
empty();
}
else if(document.getElementById('msg').style.display == "inline-block") { 
document.getElementById('msg').style.display = "none";
empty();
}
}
else {
document.getElementById("task"+no).innerHTML=task;
window.location.href = "welcome.php?edit_task="+no+"-"+task;
}}
function empty() {
document.getElementById('msg').className='';
document.getElementById('msg').style.display="inline-block";
setTimeout(function() {
document.getElementById('msg').className='empty';
	},3000);
}
</script>
