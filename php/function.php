<?php
	function connect(){
		$servername = "localhost";
		$username = "S4316259";
		$password = "IngInf2018";
		$dbname = "S4316259";
		$conn = new mysqli($servername, $username, $password, $dbname);
		if ($conn->connect_error) {
			die("Connection failed: " . $conn->connect_error);
		}
		return $conn;
	}
	
	function head($title,$description,$keywords){?>
		<title><?php echo $title; ?></title>
		<meta charset="utf-8" />
		<meta name="description" content="<?php echo $description; ?>">
		<meta name="keywords" content="<?php echo $keywords; ?>">
		<link rel="icon" href="../immagini/favicon.png" type="image/png" />
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">
		<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js" integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut" crossorigin="anonymous"></script>
		<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js" integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k" crossorigin="anonymous"></script>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
		<link href="../css/style.css" rel="stylesheet" type="text/css" />
		<script src="../js/funzioni.js"></script>
		<script>
		
			window.onload = init();
			window.onload = menu();
		</script>
	<?php	
	}
	function testa($selezionato,$conn){
		?>
		<header class="row justify-content-between">
			<div class="col-6" >
			    <img src="../immagini/logo.png" class="img-fluid"  alt="Responsive image">
			</div>
			<div class="col-6" id="search-area">
				<form class="form-inline"  id="search-form"  name="sea" action="search.php" method="post">
					<input class="form-control " id="searc" name="searc" onmouseover="search(true);" onclick="search(true);" type="search" placeholder="Search" aria-label="Search" required>&nbsp;&nbsp;
					<button class="btn btn-secondary" type="submit" id="searchbtn">Search</button>
				</form>
			</div>
		</header>
		<nav class="navbar navbar-expand-lg navbar-dark " id="menu" onclick="search(false);">
			  <a class="navbar-brand" href="index.php">
					<img src="../immagini/logopiccolo.png" width="50" height="50" alt="">
				</a>
			  <button class="navbar-toggler" id="bm" onclick="res();" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
				<span class="navbar-toggler-icon"></span>
			  </button>
			  <div class="collapse navbar-collapse" id="navbarNavDropdown">
				<ul class="navbar-nav" >
				  <li class="nav-item <?php if($selezionato==0) echo"active";?>">
					<a class="nav-link" href="index.php">Home </a>
				  </li>
				  <li class="nav-item <?php if($selezionato==1) echo"active";?>">
					<a class="nav-link" href="about.php">About</a>
				  </li>
				  
				  <li class="nav-item dropdown <?php if($selezionato==2) echo"active";?>">
					<a class="nav-link dropdown-toggle <?php if(!(isset($_SESSION['utente']))) echo "disabled"; ?>" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
					  Vini
					</a>
					<div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink" id="dropdown">
					  <a class="dropdown-item ddlink" href="vini.php?v=1">Bianco</a>
					  <a class="dropdown-item ddlink" href="vini.php?v=2">Rosè</a>
					  <a class="dropdown-item ddlink" href="vini.php?v=0">Rosso</a>
					</div>
				  </li>
				  <li class="nav-item <?php if($selezionato==3) echo"active";?>">
					<a class="nav-link <?php if(!(isset($_SESSION['utente']))) echo "disabled"; ?>" href="acquista.php">Acquista</a>
				  </li>
				  <li class="nav-item <?php if($selezionato==4) echo"active";?>">
					<a class="nav-link" href="donate.php">Donaci</a>
				  </li>
				  <?php if(!(isset($_SESSION['utente']))){
							echo" <li class='nav-item "; 
							if($selezionato==5) echo"active'";
							else echo "'";
							echo "><a class='nav-link' href='login.php'>Login/Subscribe</a>
							</li>";
						}?>
					<?php if((isset($_SESSION['utente']))){
							$query="SELECT * FROM utenti where IdUser='".$_SESSION['id']."' ";
							$w=mysqli_query($conn,$query);
							$row=mysqli_fetch_assoc($w);
							echo "<li class='nav-item "; if($selezionato==6) echo"active'"; else echo"'";
							echo "><a class='nav-link' href='profile.php'><img src='".$row['Immagine']."' width='30' height='30' alt=''>Ciao ".$row['Nome']."</a></li>";
							
							if($row['Ruolo']==1){
								echo "<li class='nav-item'> <a class='nav-link' href='admin.php' alt='admin'><img src='../immagini/ingr.png'  width='30' height='30'></a></li>";
							}
							echo "<li class='nav-item'> <a class='nav-link' href='' alt='logout'><img src='../immagini/logout.png' onclick='logout();'  width='30' height='30'></a></li>";
							
					}?>
				</ul>
			  </div>
			  <?php if((isset($_SESSION['utente']))){?>
					  <div class='row' id="car">
						  <div class='col'>
								<img src='../immagini/carrello.png' width='40' height='40' alt=''>
						  </div>
						  <div id='carrello'>
							<?php echo "
							<span>";
							$query="SELECT SUM(Quantita) FROM acquisti where IdUtente='".$_SESSION['id']."' and Acquistato=0 ;";
							$w=mysqli_query($conn,$query);
							$row=mysqli_fetch_assoc($w);
							echo $row['SUM(Quantita)']."</span>
						  </div>
					  </div>";
			  }?>
		</nav>
		<?php
	}
	function body($conn){
		
					$quer = "SELECT Descrizione FROM tipologie LIMIT 3;";
					$w=mysqli_query($conn,$quer);
					
		?>
		<div class="row" onclick="search(false);">
			
			<div class="col">
				<img src="../immagini/dog.jpg" class="img-fluid" id="canevino" alt="Responsive image">
			</div>
		</div>
		<div class="row" onclick="search(false);">
			
			<div class="col">
				<div><img src="../immagini/black.jpg" class="image" alt="Responsive image"></div>
				<?php 
				$row=mysqli_fetch_assoc($w);
				echo "<p>".$row['Descrizione']."</p>";?>
			</div>
			
			<div class="col">
				<img src="../immagini/white.jpg" class="image" alt="Responsive image">
				<?php 
				$row=mysqli_fetch_assoc($w);
				echo "<p>".$row['Descrizione']."</p>";?>
			</div>
			
			<div class="col">
				<img src="../immagini/red.jpg" class="image" alt="Responsive image">
				<?php 
				$row=mysqli_fetch_assoc($w);
				echo "<p>".$row['Descrizione']."</p>";?>
			</div>
		</div>
	<?php
	}
	function footer(){
		?>
		<hr>
		
		
		<div class="container" onclick="search(false);">
			<footer>
				<div class="row" id="footer">
					<div class="col" ><p class="foot"><b>Scopri e Acquista</b></p></div>
					<div class="col"><p class="foot"><b>Info su Enodog</b></p></div>
					<div class="col"><p class="foot"><b>Profilo</b></p></div>
					<div class="col"><p class="foot"><b>Social network</b></p></div>
					<div class="w-100"></div>
					<div class="col">
						<ul class="li">
							<li  class="link" ><a href="about.php">About</a></li>
							<li class="link"><a href="vini.php?v=0">Vini Rossi</a></li>
							<li class="link"><a href="vini.php?v=1">Vini Bianchi</a></li>
							<li class="link"><a href="vini.php?v=2">Vini Rosè</a></li>
							<li class="link"><a href="acquista.php">Acquista</a></li>
							<li class="link"><a href="donate.php">Donaci</a></li>
						</ul>
					</div>
					<div class="col">
						<ul class="li">
							<li class="">Tel. 010 8534788</li>
							<li class="">Via Opera pia 32/23</li>
							<li class="">Fax. 010 8534788</li>
							<li class="">Email enodog@gmail.com</li>
						</ul>
					</div>
					<div class="col">
						<ul class="li">
							<li class="link"><a href="profile.php">Profilo</a></li>
							<li class="link"><a href="" onclick="logout();">Logout</a></li>
						</ul>
					</div>
					<div class="col" id="sf">
						<a href="http://www.facebook.com"><img class="social" src="../immagini/facebook.png" alt="Facebook"></a>
						<a href="http://www.instagram.com"><img class="social" src="../immagini/instagram.png" alt="Instagram"></a><br>
						<a href="http://www.linkedin.com"><img class="social" src="../immagini/linkedin.png" alt="LinkedIn"></a>
						<a href="http://www.twitter.com"><img class="social" src="../immagini/twitter.png" alt="Twitter"></a>
					</div>
				</div>
			</footer>
		</div>
		
		
		
		
		
		<?php
		
	}
?>