<!DOCTYPE html>
<html>
	<?php 
			include'function.php';
	?>
	<head>
		
		<?php
			head("EnoDog","Venditore vini per cani","vino, cani");
		?>
		<script>
            $(document).ready(function(){
                $("#profileedit").hide();
                $("#edit").click(function(){
                    $("#profileedit").show();
                    $("#profileview").hide();
                }); 
                $("#back").click(function(){
                    $("#profileedit").hide();
                    $("#profileview").show();
                })
            });
        </script>
	</head>
	<body>
	<div class="container-fluid" >
		<?php
			session_start();
			$conn=connect();
            testa(6,$conn);
            if (!isset($_SESSION["id"])){
                echo '<div class="alert alert-danger" role="alert">Errore: questa pagina è disponibile solo per gli utenti autenticati. <a href="login.php" class="alert-link">Effettua il login</a>.</div>';
            }else {
                if (isset($_POST["submit"])){
                    if ($_POST["submit"] == "profile"){
                        $query = "UPDATE utenti SET Nome = '" . $_POST["name"] . "', Cognome = '" . $_POST["surename"] . "', Descrizione = '" . $_POST["bio"] . "', DataNascita = '" . $_POST["datanascita"] . "', Sesso ='" . $_POST["sesso"] . "', Cani = '" . $_POST["cani"] . "' WHERE IdUser = '" . $_SESSION["id"] . "'";
                        $conn->query($query);
                        echo '<div class="alert alert-success" role="alert">Modifiche effettuate con successo!</div>';
                    } else if ($_POST["submit"] == "pass"){
                        $query = "UPDATE utenti SET Password = '" . $_POST["password"] . "' WHERE IdUser ='" . $_SESSION["id"] . "'";
                        $conn->query($query);
                        echo '<div class="alert alert-success" role="alert">Password modificata con successo!</div>';
                    }
                }
                $query = "SELECT Nome, Cognome, Nickname, Email, Password, Immagine, Descrizione, DataNascita, Sesso, Cani FROM utenti WHERE IdUser = '" . $_SESSION["id"] . "'";
                $result = $conn->query($query);
                $row = $result->fetch_assoc();
        ?>
        <?php
            if (isset($_GET["id"]) && ($_GET["id"] != $_SESSION["id"])){
                $query = "SELECT Nome, Cognome, Nickname, Immagine, Descrizione, Sesso, Cani FROM utenti WHERE IdUser = '" . $_GET["id"] . "'";
                $result = $conn->query($query);
                $row = $result->fetch_assoc();
        ?>
            <div id="profileview" class="profile">
            <h2>Il profilo di <?php echo $row["Nome"] . " " . $row["Cognome"]; ?></h2>
            <img class="propic" src="<?php echo $row["Immagine"]; ?>" alt="Immagine di profilo" height="140px" width="auto">
            <dl class="row">
                <dt class="col-sm-3">Nome</dt>
                <dd class="col-sm-9"><?php echo $row["Nome"]; ?></dd>

                <dt class="col-sm-3">Cognome</dt>
                <dd class="col-sm-9"><?php echo $row["Cognome"]; ?></dd>

                <dt class="col-sm-3">Username</dt>
                <dd class="col-sm-9"><?php echo $row["Nickname"]; ?></dd>
                
                <dt class="col-sm-3">Bio</dt>
                <dd class="col-sm-9"><?php
                    if (!isset($row["Descrizione"]) || $row["Descrizione"] == ""){
                        echo "<i>nessuna bio inserita</i>";
                    } else {
                        echo $row["Descrizione"];
                    }
                ?></dd>

                <?php
                    if ($row["Sesso"] != NULL){
                        ?>
                        <dt class="col-sm-3">Sesso</dt>
                        <dd class="col-sm-9"><?php if($row["Sesso"] == "M"){ echo "Uomo";} else { echo "Donna"; } ?></dd>
                        <?php
                    }
                ?>

                <dt class="col-sm-3">Numero di cani</dt>
                <dd class="col-sm-9"><?php echo $row["Cani"]; ?></dd>

                </dl>
            </div>
        <?php

            } else {                
                $query = "SELECT Nome, Cognome, Nickname, Email, Password, Immagine, Descrizione, DataNascita, Sesso, Cani FROM utenti WHERE IdUser = '" . $_SESSION["id"] . "'";
                $result = $conn->query($query);
                $row = $result->fetch_assoc();
        ?>

        <div id="profileview" class="profile">
            <h2>Il tuo profilo</h2>
            <img class="propic" src="<?php echo $row["Immagine"]; ?>" alt="Immagine di profilo" height="140">
            <dl class="row">
                <dt class="col-sm-3">Nome</dt>
                <dd class="col-sm-9"><?php echo $row["Nome"]; ?></dd>

                <dt class="col-sm-3">Cognome</dt>
                <dd class="col-sm-9"><?php echo $row["Cognome"]; ?></dd>

                <dt class="col-sm-3">Indirizzo email</dt>
                <dd class="col-sm-9"><?php echo $row["Email"]; ?></dd>

                <dt class="col-sm-3">Username</dt>
                <dd class="col-sm-9"><?php echo $row["Nickname"]; ?></dd>
                
                <dt class="col-sm-3">Bio</dt>
                <dd class="col-sm-9"><?php
                    if (!isset($row["Descrizione"]) || $row["Descrizione"] == ""){
                        echo "<i>nessuna bio inserita</i>";
                    } else {
                        echo $row["Descrizione"];
                    }
                ?></dd>

                <?php
                    if ($row["DataNascita"] != "0000-00-00"){
                        ?>
                        <dt class="col-sm-3">Data di nascita</dt>
                        <dd class="col-sm-9"><?php echo $row["DataNascita"]; ?></dd>
                        <?php
                    }
                ?>

                <?php
                    if ($row["Sesso"] != NULL){
                        ?>
                        <dt class="col-sm-3">Sesso</dt>
                        <dd class="col-sm-9"><?php if($row["Sesso"] == "M"){ echo "Uomo";} else { echo "Donna"; } ?></dd>
                        <?php
                    }
                ?>

                <dt class="col-sm-3">Numero di cani</dt>
                <dd class="col-sm-9"><?php echo $row["Cani"]; ?></dd>

                </dl>

                <button type="button" class="btn btn-outline-light" id="edit">Modifica il tuo profilo</button>
            </div>
            <div id="profileedit" class="profile">
                <h2>Modifica profilo</h2>
                <form action="profile.php" method="post">
                    <div class="form-group row">
                        <label for="staticName" class="col-sm-3 col-form-label">Nome</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" id="staticName" name="name" value="<?php echo $row["Nome"]; ?>">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="staticSurename" class="col-sm-3 col-form-label">Cognome</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" id="staticSurename" name="surename" value="<?php echo $row["Cognome"]; ?>">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="staticEmail" class="col-sm-3 col-form-label">Email</label>
                        <div class="col-sm-9">
                            <input type="text" disabled class="form-control-plaintext" id="staticEmail" value="<?php echo $row["Email"]; ?>">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="staticUsr" class="col-sm-3 col-form-label">Username</label>
                        <div class="col-sm-9">
                            <input type="text" disabled class="form-control-plaintext" id="staticUsr" value="<?php echo $row["Nickname"]; ?>">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="staticBio" class="col-sm-3 col-form-label">Bio</label>
                        <div class="col-sm-9">
                            <textarea class="form-control" id="staticBio" name="bio"><?php echo $row["Descrizione"]; ?></textarea>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="staticDate" class="col-sm-3 col-form-label">Data di nascita</label>
                        <div class="col-sm-9">
                            <input type="date" class="form-control" id="staticDate" name="datanascita" value="<?php echo $row["DataNascita"]; ?>">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="staticSex" class="col-sm-3 col-form-label">Sesso</label>
                        <div class="col-sm-9">
                            <select id="staticSex" class="form-control" name="sesso">
                                <option disabled>Scegli</option>
                                <option value="M" <?php if($row["Sesso"] == "M"){ echo "selected"; } ?>>Uomo</option>
                                <option value="F" <?php if($row["Sesso"] == "F"){ echo "selected"; } ?>>Donna</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="staticDogs" class="col-sm-3 col-form-label">Numero di cani</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" id="staticDogs" name="cani" value="<?php echo $row["Cani"]; ?>">
                        </div>
                    </div>
                    <button type="submit" class="btn btn-outline-success" name="submit" value="profile">Salva le modifiche</button>
                </form><br>
				<form action="update.php" method="post" enctype="multipart/form-data" name="upload_immagine"><input name="img" type="file" /><input type="submit" name="carica" value="Carica" /></form>
                <br>
                <form action="profile.php" method="post">
                    <div class="form-group row">
                        <label for="oldPass" class="col-sm-3 col-form-label">Vecchia password</label>
                        <div class="col-sm-9">
                            <input type="password" class="form-control" id="oldPass" placeholder="Vecchia password">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="newPass1" class="col-sm-3 col-form-label">Nuova password</label>
                        <div class="col-sm-9">
                            <input type="password" class="form-control" id="newPass1" placeholder="Nuova password">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="newPass2" class="col-sm-3 col-form-label">Conferma la nuova password</label>
                        <div class="col-sm-9">
                            <input type="password" class="form-control" id="newPass2" name="password" placeholder="Nuova password">
                        </div>
                    </div>
                    <button type="submit" class="btn btn-outline-danger" name="submit" value="pass">Modifica la password</button>
                </form>
                <br>
                <button type="button" class="btn btn-outline-primary" id="back">Torna indietro</button>
            </div>
        <?php
            }
            }
			footer();
		?>
	</div>
	</body>
</html>