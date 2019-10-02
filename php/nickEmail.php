<?php session_start();

	include'function.php';
	$conn=connect();
	$a=$_GET["var"];
	$b=$_GET["tipo"];
	$query="";
	if($b==0)$query="SELECT IdUser FROM utenti where Nickname='".$a."'";
	else $query="SELECT IdUser FROM utenti where Email='".$a."'";
	$w=mysqli_query($conn,$query);
	if(mysqli_num_rows($w)==0)echo "1";
	else echo "0";
	$conn->close();
?>
