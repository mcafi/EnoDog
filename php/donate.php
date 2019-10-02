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
            testa(4,$conn);
            if (isset($_POST["importo"]) && trim($_POST["importo"]) > 0){
                $data = date("Y-m-d");
                $query = "INSERT INTO donazioni(IdUtente, Somma, DataDonazione) VALUES ('" . $_SESSION["id"] . "', '" . trim($_POST["importo"]) . "', '" . $data . "')";
                $conn->query($query);
                echo '<div class="avviso alert alert-warning alert-dismissible fade show" role="alert">Grazie infinite per la tua donazione di ' . trim($_POST["importo"]) . '€!<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>';
            }
        ?>
            <div class="descrizione">
                Noi di EnoDog vogliamo fornire solo il meglio ai nostri clienti e i propri amici a quattro zampe, ma per potervi fornire sempre più prodotti a una qualità sempre maggiore, 
                abbiamo bisogno del tuo aiuto. Effettua ora una piccola donazione e aiuta il progetto.<br>
                Non solo vedrai il tuo nome in questa piccola "Hall of Fame", ma riceverai anche un piccolo sconto acquistando i nostri vini! (funzione che voglio mettere davvero)
            </div>
        <?php
            if (isset($_SESSION["id"])){
        ?>
        <div class="donazione">
            <form action="donate.php" method="post">
            <div class="input-group mb-3">
                <input type="text" name="importo" class="form-control" placeholder="Inserisci l'importo da donare (in euro)" aria-label="Inserisci l'importo da donare (in euro)" aria-describedby="button-addon2">
                    <div class="input-group-append">
                        <button class="btn btn-outline-danger" type="submit" id="button-addon2">Donaci</button>
                    </div>
                </div>
            </form>
        </div>
        <?php
            } else {
        ?>
                <div class="avviso alert alert-danger" role="alert">
                    Devi autenticarti se vuoi contribuire al progetto. <a href="login.php" class="alert-link">Clicca qui per effetuare il login</a>.
                </div>
        <?php
            }
        ?>
		<h2>Hall of Fame</h2>
        <div class="donators-cron">
			<div class="donators-cron-content donators-name">
                Donatore
            </div>
            
            <div class="donators-cron-content donators-number">
                Somma totale
            </div>
			<div class="donators-cron-content donators-number">
                Ultima Donazione
            </div>
        <?php
            $query = "SELECT SUM(Somma), Nome, Cognome, IdUser FROM donazioni INNER JOIN utenti ON IdUtente = IdUser GROUP BY IdUser ORDER BY SUM(Somma) DESC LIMIT 4";
            $result = $conn->query($query);
            $count = 0;
            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    $count++;
                    if ($count % 2 == 0){
                        $divclass = "";
                    } else {
                        $divclass = "donators-odd-content";
                    }
                    $name = $row["Nome"];
                    $surname = $row["Cognome"];
                    $donations = $row["SUM(Somma)"];
					$query = "SELECT DataDonazione FROM donazioni WHERE IdUtente = ".$row['IdUser']." GROUP BY IdUtente ORDER BY DataDonazione DESC LIMIT 1";
					$resu = $conn->query($query);
					$ro = $resu->fetch_assoc();
                    echo '<div class="donators-name ' . $divclass . '"><a style="color: white; font-weight: bold;" href="profile.php?id=' . $row["IdUser"] . '">' . $name . " " . $surname . '</a></div><div class="donators-number ' . $divclass . '">' . $donations . ' €</div><div class="donators-number ' . $divclass . '">' . $ro['DataDonazione'] . '</div>';
                }
            }
        ?>
        </div>
        <h2>Ecco la cronologia</h2>
        <div class="donators-cron">
            <div class="donators-name">
                Donatore
            </div>
            <div class="donators-number">
                Importo donato
            </div>
            <div class="donators-number">
                Data
            </div>
            <?php
            $query = "SELECT Nome, Cognome, Somma, DataDonazione, IdUser FROM donazioni INNER JOIN utenti ON IdUtente = IdUser ORDER BY DataDonazione,IdDonazione DESC";
            $result = $conn->query($query);
            $count = 0;
            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    $count++;
                    if ($count % 2 == 0){
                        $divclass = "";
                    } else {
                        $divclass = "donators-odd-content";
                    }
                    $name = $row["Nome"];
                    $surename = $row["Cognome"];
                    $donation = $row["Somma"];
                    $data = $row["DataDonazione"];
                    echo '<div class="donators-name ' . $divclass . '"><a style="color: white; font-weight: bold;" href="profile.php?id=' . $row["IdUser"] . '">' . $name . " " . $surename . '</a></div><div class="donators-number ' . $divclass . '">' . $donation . ' €</div><div class="donators-number ' . $divclass . '">' . $data . '</div>';
                }
            }
        ?>
        </div>

        <?php
			footer();
		?>
	</div>
	</body>
</html>