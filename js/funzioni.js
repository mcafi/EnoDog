function init() {
	window.addEventListener('scroll', function(){			
		var distanceY = window.pageYOffset || document.documentElement.scrollTop;
		var bm = document.getElementById('bm');
		var nav = document.getElementById('menu');
		var larghezza = $(window).width();
		var height = 105;
		
		if (distanceY > height) {
			nav.className="navbar fixed-top navbar-expand-lg navbar-dark ";
			if ((larghezza<1000)&&(bm.getAttribute("aria-expanded")=="true")) {
				nav.style.height="500px";
			}
			else{
				nav.style.height="10%";
			}
		}
		else{
			nav.className="navbar navbar-expand-lg navbar-dark ";
			
		}
		
    });
}
function res(){
	var distanceY = window.pageYOffset || document.documentElement.scrollTop;
		var nav = document.getElementById('menu');
		var bm = document.getElementById('bm');
		var car = document.getElementById('car');
		
		var larghezza = $(window).width();
		var height = 105;
		if ((larghezza<1000)&&(bm.getAttribute("aria-expanded")=="false")) {
			nav.style.height="500px";
			car.style.margin="0 auto";
			bm.style.marginRight="45%";
		}
		else{
			bm.style.marginRight="initial";
			nav.style.height="10%";
			car.style.margin="0";
		}
}
function menu(){
	window.addEventListener('resize',function (){
		var distanceY = window.pageYOffset || document.documentElement.scrollTop;
		var nav = document.getElementById('menu');
		var bm = document.getElementById('bm');
		var larghezza = $(window).width();
		var height = 105;
		if ((larghezza<970)&&(bm.getAttribute("aria-expanded")=="true")) {
			nav.style.height="500px";
		}
		else{
			nav.style.height="10%";
		}
	});
}

function search(a){
	if(a)document.getElementById('searc').style.width="50%";
	else document.getElementById('searc').style.width="30%";
	return true;
}

function controlli(){
	var b=window.document.registrazione.password.value;
	var c=window.document.registrazione.rpsw.value;
	var a=window.document.registrazione.email.value;
	var d=window.document.registrazione.nickname.value;

	
	if(controllireg()&&psw(b,c)&&!(email.className=="form-control is-invalid")&&!(nickname.className=="form-control is-invalid"))return true;
	else {
		window.scrollTo(0,50);
		return false;
	}
	
}

function logout(){
	var xmlhttp = new XMLHttpRequest();
			xmlhttp.onreadystatechange = function() {
				if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
						var resultNome=xmlhttp.responseText;
						
					}
				};
				xmlhttp.open("GET", "logout.php", true);
				xmlhttp.send();
}

function contr(a,b){
	var xmlhttp = new XMLHttpRequest();
			xmlhttp.onreadystatechange = function() {
				if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
						var resultNome=xmlhttp.responseText;
						resultNome = Number(resultNome);
						if(resultNome==0){
							if(b==0){
								var nav = document.getElementById('nickname');
								var pswHelp = document.getElementById('nickHelp');
								nav.className="form-control is-invalid";
								pswHelp.innerHTML="nickname già utilizzato";
							}
							else {
								var nav = document.getElementById('email');
								var pswHelp = document.getElementById('emailHP');
								nav.className="form-control is-invalid";
								pswHelp.innerHTML="email già utilizzata";
							}
							return false;
						}
						else{
							if(b==0){
								var nav = document.getElementById('nickname');
								var pswHelp = document.getElementById('nickHelp');
								nav.className="form-control";
								pswHelp.innerHTML="";
							}
							else {
								var nav = document.getElementById('email');
								var pswHelp = document.getElementById('emailHP');
								nav.className="form-control";
								pswHelp.innerHTML="";
							}
						}
						return true;
						
					}
				};
				xmlhttp.open("GET", "nickEmail.php?var="+a+"&tipo="+b, true);
				xmlhttp.send();
}

function m(pwd){
	var s=pwd;
	var l=s.length;
	for(var i=0;i<l;i++){
		if((s.charCodeAt(i)>64) && (s.charCodeAt(i)<91))return true;
	}
	return false;
}
function s(pwd){
	var s=pwd;
	var l=s.length;
	for(var i=0;i<l;i++){
		if((s.charCodeAt(i)>32) && (s.charCodeAt(i)<47))return true;
	}
	return false;	
}

function n(pwd){
	var s=pwd;
	var l=s.length;
	for(var i=0;i<l;i++){
		if((s.charCodeAt(i)>47) && (s.charCodeAt(i)<58))return true;
	}
	return false;
}

function psw(b,c){
	if(b!=c){
		var nav = document.getElementById('rippassword');
		var pswHelp = document.getElementById('rippswHelp');
		nav.className="form-control is-invalid";
		pswHelp.innerHTML="password diverse";
		return false;
	}
	else{
		var nav = document.getElementById('rippassword');
		var pswHelp = document.getElementById('rippswHelp');
		nav.className="form-control";
		pswHelp.innerHTML="";
	}
	return true;
}

function controllireg(){
	
	var b=window.document.registrazione.password.value;
	var c=window.document.registrazione.rpsw.value;
	var d=window.document.registrazione.email.value;
	
	if(((b.length)<8)||((b.length)>16)){
		var nav = document.getElementById('password');
		var pswHelp = document.getElementById('pswHelp');
		nav.className="form-control is-invalid";
		pswHelp.innerHTML="la password deve essere tra 8 e 16 caratteri";
		return false;
	}
	else{
		var nav = document.getElementById('password');
		var pswHelp = document.getElementById('pswHelp');
		nav.className="form-control";
		pswHelp.innerHTML="";
	}	
	var controlli=0;
	if(m(b)){
		controlli++;
	}
	if(n(b)){
		controlli++;
	}
	if(s(b)){
		controlli++;
	}
	if(controlli<2){
		var nav = document.getElementById('password');
		var pswHelp = document.getElementById('pswHelp');
		nav.className="form-control is-invalid";
		pswHelp.innerHTML="la password deve contenere almeno due tra una maiuscola, un numero e un carattere speciale";
		return false;
	}
	else{
		var nav = document.getElementById('password');
		var pswHelp = document.getElementById('pswHelp');
		nav.className="form-control";
		pswHelp.innerHTML="";
	}
	return true;
}


function filtra(){
	var nome=window.document.filtraprod.name.value;
	var descrizione=window.document.filtraprod.desc.value;
	var order=window.document.filtraprod.order.value;
	var tipo=window.document.filtraprod.type.value;
	if((order==-1)&&(tipo==-1)&&(nome=="")&&(descrizione==""))return false;
	var indirizzo="filtraprod.php?";
	if(order!=-1)indirizzo+="order="+order+"&&";
	if(tipo!=-1)indirizzo+="tipo="+tipo+"&&";
	if(nome!="")indirizzo+="nome="+nome+"&&";
	if(descrizione!="")indirizzo+="desc="+descrizione;
	var xmlhttp = new XMLHttpRequest();
			xmlhttp.onreadystatechange = function() {
				if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
						var resultNome=xmlhttp.responseText;
						var res = document.getElementById('result');
						res.innerHTML=resultNome;
						return false;
					}
				};
				xmlhttp.open("GET", indirizzo, true);
				xmlhttp.send();
				return false;
}


function addCart(Id){
	
	if (document.getElementById(Id)!= null){
		 var n=document.getElementById(Id).elements["num"].value;
	}else{
		 var n=1;
	}
	var xmlhttp = new XMLHttpRequest();
			xmlhttp.onreadystatechange = function() {
				if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
						var resultNome=xmlhttp.responseText;
						document.getElementById('carrello').innerHTML=resultNome;
					}
				};
				xmlhttp.open("GET", "addCart.php?Id="+Id+"&&num="+n, true);
				xmlhttp.send();
}


function deleteproduct(id){
	var r = confirm("Vuoi cacellare il prodotto con id " + id + "?");
	if (r == true){
		window.location.replace("admin.php?delete=true&type=prod&id=" + id);
	}
}
function deleteuser(id){
	var r = confirm("Vuoi eliminare l'utente con id " + id + "?");
	if (r == true){
		window.location.replace("admin.php?delete=true&type=user&id=" + id);
	}
}
function grantAdmin(id, user){
	var r = confirm("Eleggere ad amministratore " + user + "?");
	if (r == true){
		window.location.replace("admin.php?admin=true&type=grant&id=" + id);
	}
}
function revokeAdmin(id, user){
	var r = confirm("Vuoi revocare i permessi di amministratore a " + user + "?");
	if (r == true){
		window.location.replace("admin.php?admin=true&type=revoke&id=" + id);
	}
}