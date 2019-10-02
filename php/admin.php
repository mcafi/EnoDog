<!DOCTYPE html>
<html>
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
            testa(0,$conn);
            if (!isset($_SESSION["id"])){
                echo '<div class="avviso alert alert-danger" role="alert">Non sei autenticato. <a href="login.php" class="alert-link">Clicca qui per effettuare il login</a>.</div>';
            } else {
                $query ="SELECT Ruolo FROM utenti WHERE IdUser ='" . $_SESSION["id"] . "'";
                $result = $conn->query($query);
                $row = $result->fetch_assoc();
                if ($row["Ruolo"] == 0){
                    echo '<div class="avviso alert alert-danger" role="alert">Errore: non sei amministratore del sito.</div>';
                } else {
                    if (isset($_GET["delete"]) && ($_GET["delete"] == "true")){
                        if ($_GET["type"] == "prod"){
                            $query = "DELETE FROM prodotti WHERE IdProdotto = '" . $_GET["id"] . "'";
                            $conn->query($query);
                        } else if ($_GET["type"] == "user"){
                            if ($_GET["id"] != $_SESSION["id"]){
                                $query = "DELETE FROM utenti WHERE IdUser = '" . $_GET["id"] . "'";
                                $conn->query($query);
                            } else {
                                echo '<div class="avviso alert alert-danger" role="alert">Eh! Volevi cancellarti da solo!</div>';
                            }
                        }
                    }
                    if (isset($_GET["admin"]) && ($_GET["admin"] == "true")){
                        if ($_GET["id"] == $_SESSION["id"]){
                            echo '<div class="avviso alert alert-danger" role="alert">Solo un altro amministratore può modificarti i poteri!</div>';
                        } else {
                            if ($_GET["type"] == "grant"){
                                $query = "UPDATE utenti SET Ruolo = 1 WHERE IdUser='" . $_GET["id"] . "'";
                                $conn->query($query);
                            } if ($_GET["type"] == "revoke"){
                                $query = "UPDATE utenti SET Ruolo = 0 WHERE IdUser='" . $_GET["id"] . "'";
                                $conn->query($query);
                            }
                        }
                    }
                    if (isset($_POST["submit"]) && ($_POST["submit"] == "add")){
                        $nome=$_POST["name"];
						$nome = str_replace("'", "\'", $nome);
						$nome = str_replace('"', '\"', $nome);
						$price=$_POST["price"];
						$price = str_replace("'", "\'", $price);
						$price = str_replace('"', '\"', $price);
						$desc=$_POST["desc"];
						$desc = str_replace("'", "\'", $desc);
						$desc = str_replace('"', '\"', $desc);
						$query = "INSERT INTO prodotti(Nome, TipoProdotto, Descrizione, Immagine, Prezzo) VALUES ('" . $nome . "', '" . $_POST["type"] . "', '" . $desc . "', '../immagini/prodotti/predefinita.jpg', '" . $price. "')";
                        $conn->query($query);
                    }
                    if (isset($_POST["submit"]) && ($_POST["submit"] == "editprod")){
						$nome=$_POST["name"];
						$nome = str_replace("'", "\'", $nome);
						$nome = str_replace('"', '\"', $nome);
						$price=$_POST["price"];
						$price = str_replace("'", "\'", $price);
						$price = str_replace('"', '\"', $price);
						$desc=$_POST["desc"];
						$desc = str_replace("'", "\'", $desc);
						$desc = str_replace('"', '\"', $desc);
                        $query = "UPDATE prodotti SET Nome ='" . $nome . "', TipoProdotto='" . $_POST["type"] . "', Descrizione='" . $desc . "', Immagine='../immagini/prodotti/predefinita.jpg', Prezzo='" . $price . "' where IdProdotto='".$_POST["id"]."';";
						$conn->query($query);
                    }
        ?>
        <h1>Benvenuto nella pagina di amministrazione</h1>
        <h3>Gestione prodotti</h3>
        <h4>Filtra i risultati</h4>
            <form action="admin.php" method="post">
            <div class="form-group row">
                    <div class="col-sm-auto">
                        <input type="text" name="name" class="form-control" placeholder="Nome">
                    </div>
                    <div class="col-sm-auto">
                        <input type="text" name="desc" class="form-control" placeholder="Descrizione">
                    </div>
                    <div class="col-sm-auto">
                        <select class="form-control" name="type">
                            <option selected disabled>Scegli il tipo...</option>
                            <option value="0">Vini rossi</option>
                            <option value="1">Vini bianchi</option>
                            <option value="2">Vini rosa</option>
                            <option value="5">Tutti i vini</option>
                            <option value="3">Accessori</option>
                            <option value="4">Altro</option>
                        </select>
                    </div>
                    <div class="col-sm-auto">
                        <select class="form-control" name="order">
                            <option selected disabled>Ordina per...</option>
                            <option value="IdProdotto ASC">ID (ascendente)</option>
                            <option value="IdProdotto DESC">ID (discendente)</option>
                            <option value="Nome ASC">Nome</option>
                            <option value="Prezzo ASC">Prezzo (ascendente)</option>
                            <option value="Prezzo DESC">Prezzo (discendente)</option>
                        </select>
                    </div>
                    <div class="col-sm-auto">
                        <button type="submit" class="btn btn-success" name="submit" value="view">Filtra</button>
                    </div>
                </div>
            </form>
        <div class="products">
            <div class="product-title">
                #
            </div>
            <div class="product-title">
                Nome
            </div>
            <div class="product-title">
                Tipo prodotto
            </div>
            <div class="product-title">
                Descrizione
            </div>
            <div class="product-title">
                Immagine
            </div>
            <div class="product-title">
                Prezzo
            </div>
            <div class="product-title">
            </div> 
            <div class="product-title">
            </div>                
            <?php
            if (!isset($_POST["submit"]) || ($_POST["submit"] != "view")){
                $query = "SELECT IdProdotto, Nome, t.TipoProdotto as tipo, p.Descrizione as descr, Immagine, Prezzo FROM prodotti p INNER JOIN tipologie t ON p.TipoProdotto = t.ID ORDER BY IdProdotto ASC";
            } else {
                $where = "1";
                if (isset($_POST["order"]) && ($_POST["order"] != NULL)){
                    $orderby = $_POST["order"];
                } else {
                    $orderby = "IdProdotto ASC";
                }
                if (isset($_POST["name"]) && ($_POST["name"] != NULL)){
                    $where = $where . " AND Nome LIKE '%" . $_POST["name"] ."%'";
                }
                if (isset($_POST["desc"]) && ($_POST["desc"] != NULL)){
                    $where = $where . " AND p.Descrizione LIKE '%" . $_POST["desc"] . "%'";
                }
                if (isset($_POST["type"]) && ($_POST["type"] != NULL)){
                    if ($_POST["type"] != 5){
                        $where = $where . " AND p.TipoProdotto = " . trim($_POST["type"]);
                    } else {
                        $where = $where . " AND (p.TipoProdotto = 0 OR p.TipoProdotto = 1 OR p.TipoProdotto = 2)";
                    }
                }
                $query = "SELECT IdProdotto, Nome, t.TipoProdotto as tipo, p.Descrizione as descr, Immagine, Prezzo FROM prodotti p INNER JOIN tipologie t ON p.TipoProdotto = t.ID WHERE " . $where . " ORDER BY " . $orderby;
                // echo $query;
            }
            $result = $conn->query($query);
            $count = 0;
            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    $count++;
                    if ($count % 2 == 0){
                        $divclass = "product-even-content";
                    } else {
                        $divclass = "product-odd-content";
                    }
                    echo '<div class="product-content ' . $divclass . '">' . $row["IdProdotto"] . '</div>';
                    echo '<div class="product-content ' . $divclass . '">' . $row["Nome"] . '</div>';
                    echo '<div class="product-content ' . $divclass . '">' . $row["tipo"] . '</div>';
                    echo '<div class="product-content ' . $divclass . '">' . $row["descr"] . '</div>';
                    echo '<div class="product-content ' . $divclass . '"><img src="' . $row["Immagine"] . '" height="50" alt="Immagine di esempio"></div>';
                    echo '<div class="product-content ' . $divclass . '">' . $row["Prezzo"] . '</div>';
                    echo '<div class="product-content ' . $divclass . '"><img src="../immagini/delete.png" width="25" alt="Cancella" onclick="deleteproduct(' . $row["IdProdotto"] . ')" title="Rimuovi il prodotto" style="cursor:pointer;"></div>';
                    echo '<div class="product-content ' . $divclass . '"><a href="edit.php?type=prod&id=' . $row["IdProdotto"] . '"><img src="../immagini/edit.png" width="25" alt="Modifica" title="Modifica il prodotto" style="cursor:pointer;"></a></div>';
                }
            }
        ?>
        </div>
        <div class="products-form">
            <h4>Aggiungi un articolo</h4>
            <form action="admin.php" method="post">
                <div class="form-group row">
                    <div class="col-sm-auto">
                        <input type="text" name="name" class="form-control" placeholder="Nome" required>
                    </div>
                    <div class="col-sm-auto">
                        <select class="form-control" name="type">
                            <option selected disabled>Scegli il tipo...</option>
                            <?php
                                $query ="SELECT ID, TipoProdotto FROM tipologie";
                                $result = $conn->query($query);
                                if ($result->num_rows > 0) {
                                    while($row = $result->fetch_assoc()) { 
                                        echo '<option value="' . $row["ID"] . '">' . $row["TipoProdotto"] . '</option>';
                                    }
                                }
                            ?>
                        </select>
                    </div>
                    <div class="col-sm-auto">
                        <input type="text" name="desc" class="form-control" placeholder="Descrizione" required>
                    </div>
                    <div class="col-sm-auto">
                        <input type="text" name="price" class="form-control" placeholder="Prezzo" required>
                    </div>
                    <div class="col-sm-auto">
                        <button type="submit" class="btn btn-success" name="submit" value="add">Aggiungi articolo</button>
                    </div>
                </div>
            </form>
        </div>
        <h3>Gestione utenti</h3>

        <form action="admin.php" method="post">
            <div class="form-group row">
                    <div class="col-sm-auto">
                        <input type="text" name="name" class="form-control" placeholder="Username">
                    </div>
                    <div class="col-sm-auto">
                        <input type="text" name="email" class="form-control" placeholder="Indirizzo email">
                    </div>
                    <div class="col-sm-auto">
                        <select class="form-control" name="type">
                            <option selected disabled>Scegli il tipo...</option>
                            <option value="1">Amministratori</option>
                            <option value="0">Utenti normali</option>
                            <option value="2">Tutti</option>
                        </select>
                    </div>
                    <div class="col-sm-auto">
                        <select class="form-control" name="order">
                            <option selected disabled>Ordina per...</option>
                            <option value="IdUser ASC">ID (ascendente)</option>
                            <option value="IdUser DESC">ID (discendente)</option>
                            <option value="Nickname ASC">Username</option>
                            <option value="Email ASC">Indirizzo email</option>
                        </select>
                    </div>
                    <div class="col-sm-auto">
                        <button type="submit" class="btn btn-success" name="submit" value="users">Filtra</button>
                    </div>
                </div>
            </form>

        <div class="users">
            <div class="product-title">
                ID
            </div>
            <div class="product-title">
                Nome utente
            </div>
            <div class="product-title">
                Indirizzo email                
            </div>
            <div class="product-title">
                Ruolo
            </div>
            <div class="product-title">

            </div>
            <div class="product-title">

            </div>
            <?php
                if (!isset($_POST["submit"]) || ($_POST["submit"] != "users")){
                    $query = "SELECT IdUser, Nickname, Email, NomeRuolo, Ruolo FROM utenti INNER JOIN ruoli ON Ruolo = IdRuolo ORDER BY IdUser ASC";
                } else {
                    $where = "1";
                    if (isset($_POST["order"]) && ($_POST["order"] != NULL)){
                        $orderby = $_POST["order"];
                    } else {
                        $orderby = "IdUser ASC";
                    }
                    if (isset($_POST["name"]) && ($_POST["name"] != NULL)){
                        $where = $where . " AND Nickname LIKE '%" . $_POST["name"] ."%'";
                    }
                    if (isset($_POST["desc"]) && ($_POST["desc"] != NULL)){
                        $where = $where . " AND Email LIKE '%" . $_POST["email"] . "%'";
                    }
                    if (isset($_POST["type"]) && ($_POST["type"] != NULL)){
                        if ($_POST["type"] != 2){
                            $where = $where . " AND Ruolo = " . trim($_POST["type"]);
                        }
                    }
                    $query = "SELECT IdUser, Nickname, Email, NomeRuolo FROM utenti INNER JOIN ruoli ON Ruolo = IdRuolo WHERE " . $where . " ORDER BY " . $orderby;
                    // echo $query;
                }
                $result = $conn->query($query);
                $count = 0;
                if ($result->num_rows > 0) {
                    while($row = $result->fetch_assoc()) {
                        $count++;
                        if ($count % 2 == 0){
                            $divclass = "product-even-content";
                        } else {
                            $divclass = "product-odd-content";
                        }
                        echo '<div class="product-content ' . $divclass . '">' . $row["IdUser"] . '</div>';
                        echo '<div class="product-content ' . $divclass . '">' . $row["Nickname"] . '</div>';
                        echo '<div class="product-content ' . $divclass . '">' . $row["Email"] . '</div>';
                        echo '<div class="product-content ' . $divclass . '">' . $row["NomeRuolo"] . '</div>';
                        if ($row["IdUser"] != $_SESSION["id"]){
                            echo '<div class="product-content ' . $divclass . '"><img src="../immagini/remove.png" width="25" alt="Cancella" onclick="deleteuser(' . $row["IdUser"] . ')" title="Elimina l\'utente" style="cursor:pointer;"></div>';
                            if ($row["NomeRuolo"] == "Utente"){
                                echo '<div class="product-content ' . $divclass . '"><img src="../immagini/admin.png" width="25" alt="Admin" title="Eleggi l\' utente ad amministratore" onclick="grantAdmin(' . $row["IdUser"] . ",'" .  $row["Nickname"] . "'" . ');" style="cursor:pointer;"></div>';
                            } else {
                                echo '<div class="product-content ' . $divclass . '"><img src="../immagini/predefinita.png" width="25" alt="Revoke" onclick="revokeAdmin(' . $row["IdUser"] . ",'" .  $row["Nickname"] . "'" . ');" title="Revoca i permessi di amministrazione" style="cursor:pointer;"></div>';
                            }
                        } else {
                            echo '<div class="product-content ' . $divclass . '"></div>';
                            echo '<div class="product-content ' . $divclass . '"></div>';
                        }
                    }
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
