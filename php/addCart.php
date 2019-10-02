<?php
	session_start();

	include'function.php';
	$conn=connect();
	$n=$_GET['num'];
	$id=$_GET['Id'];
	$query="SELECT * FROM acquisti where IdUtente='".$_SESSION['id']."' and IdProdotto='".$id."' ;";
	$w=mysqli_query($conn,$query);
	if(mysqli_num_rows($w)!=0){
		$row=mysqli_fetch_assoc($w);
		$n=$n+$row['Quantita'];
		$query="UPDATE acquisti SET Quantita=".$n." where IdUtente='".$_SESSION['id']."' and IdProdotto='".$id."' ;";
		$w=mysqli_query($conn,$query);
	}
	else{
		$query="INSERT INTO acquisti(IdProdotto,IdUtente,Quantita) VALUES ('".$id."','".$_SESSION['id']."',".$n.");";
		$w=mysqli_query($conn,$query);
	}
	$query="SELECT SUM(Quantita) FROM acquisti where IdUtente='".$_SESSION['id']."' and Acquistato=0 ;";
	$w=mysqli_query($conn,$query);
	$row=mysqli_fetch_assoc($w);
	echo $row['SUM(Quantita)'];
	$conn->close();
?>
