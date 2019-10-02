<?php session_start();

	include'function.php';
	$conn=connect();
	$nickname=$_REQUEST["email"];
	$nickname = str_replace("'", "\'", $nickname);
	$nickname = str_replace('"', '\"', $nickname);
	$psw=$_REQUEST["password"];
	$psw = str_replace("'", "\'", $psw);
	$psw = str_replace('"', '\"', $psw);
	$query="SELECT IdUser,Nickname FROM utenti where Email='".$nickname."' and Password='".$psw."'";
	$w=mysqli_query($conn,$query);
	if(mysqli_num_rows($w)==0)header("refresh:0;url=login.php?errore=1");
	else{
		$row=mysqli_fetch_assoc($w);
		$_SESSION['utente']= $row['Nickname'];
		$_SESSION['id']= $row['IdUser'];
		header("refresh:0;url=profile.php");
	}
	$conn->close();
?>
