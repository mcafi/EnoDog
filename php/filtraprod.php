<?php
	session_start();

	include'function.php';
	$conn=connect();
	$query="SELECT * FROM prodotti ";
	if(isset($_GET['nome'])||isset($_GET['desc'])||isset($_GET['tipo']))$query.="where ";
	if(isset($_GET['nome'])&&$_GET['nome']!="")$query.="Nome LIKE '%".$_GET['nome']."%'";
	
	if(isset($_GET['tipo'])){
		if(isset($_GET['nome']))$query.=" and ";
		$query.="TipoProdotto='".$_GET['tipo']."'";
	}
	if(isset($_GET['desc'])&&$_GET['desc']!=""){
		if(isset($_GET['tipo'])||isset($_GET['nome']))$query.=" and ";
		$query.="Descrizione LIKE '%".$_GET['desc']."%'";
	}
	if(isset($_GET['order'])){
		$query.="ORDER BY ".$_GET['order'];
	}
	$w=mysqli_query($conn,$query);
	if(mysqli_num_rows($w)==0) echo "";
	else{
		while($row=mysqli_fetch_assoc($w)){?>
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
	}
	$conn->close();
?>
