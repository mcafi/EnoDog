<?php
	session_start();
	include'function.php';
	$conn=connect();
	$nickname=$_REQUEST["nickname"];
	$nickname = str_replace("'", "\'", $nickname);
	$nickname = str_replace('"', '\"', $nickname);
	$nickname=strtolower($nickname);
	$Nome=$_REQUEST["nome"];
	$Nome = str_replace("'", "\'", $Nome);
	$Nome = str_replace('"', '\"', $Nome);
	$Cognome=$_REQUEST["cognome"];
	$Cognome = str_replace("'", "\'", $Cognome);
	$Cognome = str_replace('"', '\"', $Cognome);
	$email=$_REQUEST["email"];
	$email = str_replace("'", "\'", $email);
	$email = str_replace('"', '\"', $email);
	$psw=$_REQUEST["password"];
	$psw = str_replace("'", "\'", $psw);
	$psw = str_replace('"', '\"', $psw);
	$sesso=$_REQUEST["sesso"];
	$cani=$_REQUEST["cani"];
	$data=$_REQUEST["dataNascita"];
	
	$sql = "INSERT INTO utenti (Nome,Cognome,Nickname,Password,Email,DataNascita,Sesso,Cani) VALUES ('".$Nome."','".$Cognome."','".$nickname."','".$psw."','".$email."','".$data."','".$sesso."','".$cani."')";
	if ($conn->query($sql) === TRUE) {
		$query="SELECT IdUser,Nickname FROM utenti where Email='".$email."' and Password='".$psw."'";
		$w=mysqli_query($conn,$query);
		$row=mysqli_fetch_assoc($w);
		$_SESSION['utente']= $row['Nickname'];
		$_SESSION['id']= $row['IdUser'];
		header("refresh:0;url=profile.php");
	}
	$conn->close();
?>
