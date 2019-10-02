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
            if (!isset($_SESSION["id"])){
                echo '<div class="avviso alert alert-danger" role="alert">Non sei autenticato. <a href="login.php" class="alert-link">Clicca qui per effettuare il login</a>.</div>';
            } else {
                $query ="SELECT Ruolo FROM utenti WHERE IdUser ='" . $_SESSION["id"] . "'";
                $result = $conn->query($query);
                $row = $result->fetch_assoc();
                if ($row["Ruolo"] == 0){
                    echo '<div class="avviso alert alert-danger" role="alert">Errore: non sei amministratore del sito.</div>';
                } else {
                    if (isset($_GET["id"])){
                        echo "<h2>Modifica prodotto</h2>";
                        $query = "SELECT Nome, tipologie.TipoProdotto AS tipo, prodotti.Descrizione AS descr, Immagine, Prezzo, ID FROM prodotti INNER JOIN tipologie ON prodotti.TipoProdotto = ID WHERE IdProdotto = '" . $_GET["id"] . "'";
                        $result = $conn->query($query);
                        $row = $result->fetch_assoc();
        ?>
        <div class="products-form">
            <form action="admin.php" method="post">
                <div class="form-group row">
					<div class="col-sm-1">
                        <input type="text" name="id" readonly class="form-control-plaintext" placeholder="Id" value=" <?php echo $_GET["id"]; ?>" style="color:white;">
                    </div>
                    <div class="col-sm-auto">
                        <input type="text" name="name" class="form-control" placeholder="Nome" value="<?php echo $row['Nome']; ?>" required>
                    </div>
                    <div class="col-sm-auto">
                        <select class="form-control" name="type">
                            <option disabled>Scegli il tipo...</option>
                            <?php
                                $query ="SELECT ID, TipoProdotto FROM tipologie";
                                $res = $conn->query($query);
                                if ($res->num_rows > 0) {
                                    while($row2 = $res->fetch_assoc()) { 
                                        if($row2["ID"] == $row["ID"]){ 
                                            echo '<option selected value="' . $row2["ID"] . '">' . $row2["TipoProdotto"] . '</option>';
                                        } else {
                                            echo '<option value="' . $row2["ID"] . '">' . $row2["TipoProdotto"] . '</option>';
                                        }
                                    }
                                }
                            ?>
                        </select>
                    </div>
                    <div class="col">
                        <textarea type="text" name="desc" class="form-control" placeholder="Descrizione" rows="5" required><?php echo $row["descr"]; ?></textarea>
                    </div>
                    <div class="col-sm-auto">
                        <input type="text" name="price" class="form-control" placeholder="Prezzo" required value ="<?php echo $row["Prezzo"]; ?> ">
                    </div>
                    <div class="col-sm-auto">
                        <button type="submit" class="btn btn-success" name="submit" value="editprod">Modifica</button>
                    </div>
                    <div class="col-sm-auto">
                        <button class="btn btn-primary"><a href="admin.php" style="color: white;">Torna indietro</a></button>
                    </div>
                </div>
            </form>
        </div>
        <?php

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