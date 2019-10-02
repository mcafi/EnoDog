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
			testa(0,$conn);
			body($conn);
			footer();
		?>
	</div>
	</body>
</html>
