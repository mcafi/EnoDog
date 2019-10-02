<!DOCTYPE html>
<html lang="it">
	<?php 
			include'function.php';
	?>
	<head>
		
		<?php
			head("EnoDog","Venditore vini per cani","vino, cani");
		?>
		
	</head>
	<body>
	<div class="container-fluid" >
		<?php ob_start();
			session_start();
			$conn=connect();
			testa(3,$conn);
			if (!isset($_SESSION["id"])){
                echo '<div class="avviso alert alert-danger" role="alert">Non sei autenticato. <a href="login.php" class="alert-link">Clicca qui per effettuare il login</a>.</div>';
            }
			else{
		?>
		<div class="row" id="result">
			<?php 
				$query="SELECT * FROM tipologie where TipoProdotto LIKE '%".$_POST['searc']."%'";
				$w=mysqli_query($conn,$query);
				if(mysqli_num_rows($w)==1){
					$row=mysqli_fetch_assoc($w);
					header('location: vini.php?v='.$row['ID']);
				}else{
				$query="SELECT * FROM prodotti where Descrizione LIKE '%".$_POST['searc']."%' or Nome LIKE '%".$_POST['searc']."%'";
				$w=mysqli_query($conn,$query);
				while($row=mysqli_fetch_assoc($w)){
				?>
				<div class="card cartacquista">
					<img src="<?php echo $row['Immagine']; ?>" class="card-img-top" alt="...">
					<div class="card-body testoVini">
						<h6 class="card-title"><?php echo $row['Nome']; ?></h6>
						<p class="card-text"><?php echo $row['Descrizione']; ?></p>
						<form class="form-inline" id="<?php echo $row['IdProdotto']; ?>" onsubmit="return false">
							<div class="form-group Price">
								<input type="text" readonly class="form-control-plaintext " value="<?php echo $row['Prezzo']; ?> €/cad.">
							</div>
							<div class="form-group ">
								<input type="number" class="Num" name="num" min="1" max="10" value="1">
							</div>
							<button type="submit" class="btn btn-secondary add" onclick=" return addCart(<?php echo $row['IdProdotto']; ?>);">Aggiungi al carrello</button>
						</form>
					</div>
				</div>
				<?php
				}
			?>
		</div>
			<?php
				}
			}
			footer();
		?>
	</div>
	</body>
</html>
