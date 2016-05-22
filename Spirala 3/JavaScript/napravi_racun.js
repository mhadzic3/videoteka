function validirajUnosEmaila(boja){
	var txtEmail=document.getElementById("moj_email");
	
	if(validirajEmail(txtEmail) || txtEmail.value==""){
		txtEmail.style.backgroundColor="white";
	}
	else{
		txtEmail.style.backgroundColor=boja;
	}
}

function validirajUnosKorisnika(boja){
	var txtKorisnik=document.getElementById("korisnik");
	
	if(validirajKorisnickoIme(txtKorisnik) || txtKorisnik.value==""){
		txtKorisnik.style.backgroundColor="white";
	}
	else{
		txtKorisnik.style.backgroundColor=boja;
	}
}

function validirajUnosSifre(boja){
	var txtSifra=document.getElementById("sifra");
	
	if(validirajSifru(txtSifra) || txtSifra.value==""){
		txtSifra.style.backgroundColor="white";
	}
	else{
		txtSifra.style.backgroundColor=boja;
	}
}

function validirajEmail(txtEmail){
	var email_re=/^([a-z]+)(\S)*@(\S)+(\.com)$/ig;
	
	if(txtEmail.value.match(email_re)){
		return true;
	}
	else{
		return false;
	}
}

function validirajKorisnickoIme(txtKorisnik){	
	var korisnik_re1=/^([a-z]+)(\S)*$/ig;
	var korisnik_re2=/.{8,}/ig;
	
	if(txtKorisnik.value.match(korisnik_re1) && txtKorisnik.value.match(korisnik_re2)){
		return true;
	}
	else{
		return false;
	}
}

function validirajSifru(txtSifra){	
	var sifra_re1=/^\S*[a-z]+\S*$/g;
	var sifra_re2=/^\S*[A-Z]+\S*$/g;
	var sifra_re3=/^\S*\d+\S*$/g;
	var sifra_re4=/^\S*[^a-z\d\s]+\S*$/ig;
	var sifra_re5=/.{8,}/ig;
	
	if(txtSifra.value.match(sifra_re1) && txtSifra.value.match(sifra_re2) && txtSifra.value.match(sifra_re3) && 
	   txtSifra.value.match(sifra_re4) && txtSifra.value.match(sifra_re5)){
		return true;
	}
	else{
		return false;
	}
}

function provjeriSifru(txtSifra){
	var poljeSifra2=document.getElementById("sifra_ponovo");
	
	var txtSifra=document.getElementById("sifra").value;
	var txtSifra2=document.getElementById("sifra_ponovo").value;
	
	var duzina=txtSifra.length;
	var duzina2=txtSifra2.length;
		
	if((duzina>=duzina2 && txtSifra.substr(0,duzina2)==txtSifra2.substr(0,duzina2)) || txtSifra2==""){
		poljeSifra2.style.backgroundColor="white";
	}
	else{
		poljeSifra2.style.backgroundColor="red";
	}
	
}