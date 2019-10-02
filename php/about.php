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
			testa(1,$conn);
		?>
		
		<div class="container" onclick="search(false);">
			<div class="row" id="about">
				<div class="col"><img src="../immagini/enrico.jpg" /></div>
				<div class="col"><img src="../immagini/cafi.jpg" /></div>
				<div class="w-100"></div>
				<div class="col" style="font-size: 130%;">Enrico Porcile</div>
				<div class="col" style="font-size: 130%;">Matteo Carniglia</div>
			</div>
		</div>
		
		<?php
			
			
			
			
			footer();
		?>
	</div>
	</body>
</html>