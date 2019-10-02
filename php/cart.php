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
            testa(6,$conn);
            //acquisti: IdProdotto, IdUtente, Quantita, Acquistato
			//prodotti: IdProdotto, Nome, TipoProdotto, Descrizione, Immagine, Prezzo
			//tipoligie: ID, TipoProdotto, Descrizione
            if (!isset($_SESSION["id"])){
                echo '<div class="alert alert-danger" role="alert">Errore: questa pagina è disponibile solo per gli utenti autenticati. <a href="login.php" class="alert-link">Effettua il login</a>.</div>';
            } else {
				if (isset($_GET["buy"]) && ($_GET["buy"] == "true")){
					$query = "UPDATE acquisti SET acquistato = 1 WHERE IdUtente='" . $_SESSION["id"] . "'";
					$conn->query($query);
					echo '<div class="alert alert-success" role="alert">Grazie infinite per i tuoi acquisti!</div>';
				} else {
					if (isset($_GET["remove"])){
						$query = "DELETE FROM acquisti WHERE IdUtente='" . $_SESSION["id"] . "' AND IdProdotto='" . $_GET["remove"] . "' AND Acquistato=0";
						$conn->query($query);
					}
				$query = "SELECT Quantita, Nome, Prezzo, t.TipoProdotto as tipo, Immagine, a.IdProdotto as id FROM acquisti a, prodotti p, tipologie t WHERE a.IdProdotto = p.IdProdotto AND p.TipoProdotto = t.ID AND a.IdUtente='" . $_SESSION["id"] . "' AND a.acquistato=0";
				// echo $query;
				$result = $conn->query($query);
				if ($result->num_rows > 0) {
					?>
					<h3>Il tuo carrello</h3>
					<div class="carrello">
					<?php
					while($row = $result->fetch_assoc()) {
					?>
						<div class="row">
							<div class="col">
								<img class="immagine-carrello" src="<?php echo $row['Immagine']; ?>" alt="Prodotto">
							</div>
							<div class="col carrello-content">
								<dl class="row">
									<dt class="col-sm-3">Nome:</dt>
									<dd class="col-sm-9"><?php echo $row["Nome"]; ?></dd>

									<dt class="col-sm-3">Tipo:</dt>
									<dd class="col-sm-9"><?php echo $row["tipo"]; ?></dd>

									<dt class="col-sm-3">Prezzo cad.</dt>
									<dd class="col-sm-9"><?php echo $row["Prezzo"] . "€"; ?></dd>
									
									<dt class="col-sm-3">Quantità:</dt>
									<dd class="col-sm-9"><?php echo $row["Quantita"]; ?></dd>

								</dl>
								<a href="cart.php?remove=<?php echo $row["id"]; ?>" class="btn btn-danger">Rimuovi dal carrello</a>
							</div>
						</div>
					<?php
					}
					$query = "SELECT Quantita, Prezzo FROM acquisti INNER JOIN prodotti ON acquisti.IdProdotto = prodotti.IdProdotto WHERE IdUtente='" . $_SESSION["id"] . "' AND acquistato=0";
					$result = $conn->query($query);
					$totale = 0;
					if ($result->num_rows > 0) {
						while($row = $result->fetch_assoc()) {
							$totale = $totale + ($row["Prezzo"] * $row["Quantita"]);
						}
					}
					?>
					<br>
					<p class="totale">Totale: <?php echo $totale; ?>€</p>  <a href="cart.php?buy=true" class="btn btn-success btn-lg">Procedi all'acquisto</a>
					<?php
					?>
					</div>
					<?php
				} else {
					echo '<div class="alert alert-success" role="alert">Il tuo carrello è vuoto. <a href="acquista.php" class="alert-link">Fai un po\' di spesa</a>.</div>';
				}
			}
		}
        ?>
        
        <?php
			footer();
		?>
	</div>
	</body>
</html>