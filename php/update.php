<?php session_start();
	include'function.php';
	$conn=connect();
	$upload_percorso='../immagini/utenti/';
	$file_tmp=$_FILES['img']['tmp_name'];
	if($file_tmp=='')header("refresh:0;url=profile.php");
	$file_nome=$_SESSION['utente'].".jpg";
	move_uploaded_file($file_tmp,$upload_percorso.$file_nome);
	$sql="UPDATE utenti SET Immagine = '../immagini/utenti/".$file_nome."' where IdUser='".$_SESSION['id']."';";
	$conn->query($sql);
	header("refresh:0;url=profile.php");
?>
