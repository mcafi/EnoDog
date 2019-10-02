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
			testa(5,$conn);
			?>
		<div class="row">
			<div class="col-1"></div>
			<div class="col-4">
				<h2>Login</h2>
				<form name='login' action='log.php' method='post'>
					<div class="form-group">
						<label for="exampleInputEmail1">Email</label>
						<input name="email" type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Email" required>
					</div>
					<div class="form-group">
						<label for="exampleInputPassword1">Password</label>
						<input name="password" type="password" class="form-control" id="exampleInputPassword1" placeholder="Password" required>
						<small id='emailHelp' class='form-text'><?php if(isset($_GET['errore'])) echo "Errore password o email errati";?></small>
					</div>
					
					<button type="submit" class="btn btn-secondary" onclick="" name="login" >Login</button>
				</form>
			</div>
			<div class="col-2" style="border-left:1px solid white; border-right:1px solid white;"></div>
			<div class="col-4">
				<h2>Registrazione</h2><br>
				<form name='registrazione' action='registrazione.php' method='post'>
					<div class="form-row">
						<div class="form-group col-md-6">
							  <input type="text" name="cognome" class="form-control" placeholder="Cognome" required>
						</div>
						<div class="form-group col-md-6">
							  <input type="text" name="nome" class="form-control" placeholder="Nome" required>
						</div>
					</div>
					<div class="form-group">
						<input name="email" id="email" type="email" class="form-control" onkeyup="contr(window.document.registrazione.email.value,1);"  placeholder="Email" required>
						<small class='pswHelp' id="emailHP" class='form-text'></small>
					</div>
					<div class="form-row">
						<div class="form-group has-danger col-md-6">
							  <input type="password" name="password" id="password" class="form-control" placeholder="Password" onkeyup="controllireg();" required>
							  <small class='pswHelp' id="pswHelp" class='form-text'></small>
						</div>
						<div class="form-group col-md-6">
							<input type="password"  name="rpsw" id="rippassword" class="form-control" placeholder="Ripeti password" onkeyup="psw(window.document.registrazione.password.value,window.document.registrazione.rpsw.value);" required>
							<small class="pswHelp" id="rippswHelp" class="form-text"></small>
						</div>
						
					</div>
					<div class="form-group">
						<input name="nickname" id="nickname" type="text" class="form-control"  placeholder="Nickname" onkeyup="contr(window.document.registrazione.nickname.value,0);" required>
						<small class='pswHelp' id="nickHelp" class='form-text'></small>
					</div>
					<div class="form-group">
						<label>Sesso</label>
						<select class="form-control" name="sesso">
							<option value="m">Maschio</option>
							<option value="f">Femmina</option>
						</select>
					</div>
					<div class="form-group">
						<label >Data Nascita</label>
						<input name="dataNascita" type="date" required >
					</div>
					<div class="form-group">
						<label ># Cani</label>
						<input type="number" name="cani" min="0">
					</div>
					<button type="submit" class="btn btn-secondary" onclick="return controlli();" name="registrazione" >Subscribe</button>
					<button type="reset" class="btn btn-secondary" onclick="" name="reset" >Reset</button>
				</form>
			</div>
			<div class="col-1"></div>
		</div>
			<?php
			footer();
		?>
	</div>
	</body>
</html>
