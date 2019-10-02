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
			testa(3,$conn);
			if (!isset($_SESSION["id"])){
                echo '<div class="avviso alert alert-danger" role="alert">Non sei autenticato. <a href="login.php" class="alert-link">Clicca qui per effettuare il login</a>.</div>';
            }
			else{
		?>
		<h4>Filtra i risultati</h4>
            <form action="" name="filtraprod" method="post" onsubmit="return false">
            <div class="form-group row">
                    <div class="col-sm-auto">
                        <input type="text" name="name" class="form-control" placeholder="Nome">
                    </div>
                    <div class="col-sm-auto">
                        <input type="text" name="desc" class="form-control" placeholder="Descrizione">
                    </div>
                    <div class="col-sm-auto">
                        <select class="form-control" name="type">
                            <option selected value="-1">Tutti i vini</option>
                            <option value="0">Vini rossi</option>
                            <option value="1">Vini bianchi</option>
                            <option value="2">Vini rosa</option>
                            <option value="3">Accessori</option>
                        </select>
                    </div>
                    <div class="col-sm-auto">
                        <select class="form-control" name="order">
                            <option selected value="-1">Ordina per...</option>
                            <option value="Nome">Nome</option>
                            <option value="Prezzo asc">Prezzo (ascendente)</option>
                            <option value="Prezzo desc">Prezzo (discendente)</option>
                        </select>
                    </div>
                    <div class="col-sm-auto">
                        <button type="submit" class="btn btn-outline-success" name="submit" value="view" onclick="filtra();" >Filtra</button>
                    </div>
                </div>
            </form>
		
		<div class="row" id="result">
			<?php
				$query="SELECT * FROM prodotti";
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
			footer();
		?>
	</div>
	</body>
</html>
