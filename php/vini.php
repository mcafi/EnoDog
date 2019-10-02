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
		<?php
			session_start();
		
			$conn=connect();
			testa(2,$conn);
			
			$query="SELECT * FROM tipologie where ID='".$_GET['v']."' ";
			$w=mysqli_query($conn,$query);
			$row=mysqli_fetch_assoc($w);
			
			?>
			
			<div class="container" id="vini">
			<?php if(isset($_SESSION['id'])){?>
				<div class="row">
					<div class="col-5" id="imgVini">
						<img id="wine"src="../immagini/<?php if( $_GET['v']==0)echo "black";
													else if( $_GET['v']==2) echo "red";
													else if( $_GET['v']==1) echo "white";?>.jpg">
					</div>
					<div class="col-7">
						<h1><?php
							echo $row['TipoProdotto'];
						?></h1>
						<div class="row">
						<?php
							echo $row['Descrizione'];
						?>
						</div><br>
						<div class="row" id="acquista">
							<?php
								$query="SELECT * FROM prodotti where TipoProdotto='".$_GET['v']."' ";
								$w=mysqli_query($conn,$query);
								while($row=mysqli_fetch_assoc($w)){
									?>
									<div class="card carta" >
										<img src="<?php echo $row['Immagine']; ?>" class="card-img-top" alt="...">
										<div class="card-body bg-dark testoVini">
											<h6 class="card-title"><?php echo $row['Nome']; ?></h6>
											<p class="card-text"><?php 
												$desc = substr( $row['Descrizione'], 0, 210 );
												echo $desc;
												if(strlen($row['Descrizione'])>210)echo "..."; 
												
												?></p>
											<button class="btn btn-secondary " onclick=" return addCart(<?php echo $row['IdProdotto']; ?>);">Aggiungi al carrello</button>
										</div>
									</div><br>
									<?php
								}
							?>
							
						</div>
						<div class="row">
						
						</div>
					</div>
				</div>
			<?php }
				else{
					?>
					<div class="avviso alert alert-danger" role="alert">
						Devi autenticarti se vuoi vedere i nostri vini!! <a href="login.php" class="alert-link">Clicca qui per effetuare il login</a>.
					</div>
					<?php
				}
				?>
			</div>
			<?php
		
		
			footer();
			
		?>
	</div>
	</body>
</html>
