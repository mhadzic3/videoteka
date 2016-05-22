window.setInterval(ispisiVremenaNovosti,100);

function ispisiVremenaNovosti(){
	var novosti=document.getElementsByClassName("prikaz_datuma");
	var datumi=document.getElementsByClassName("datum_objave");
	
	for(var i=0;i<datumi.length;i++){
		novosti[i].innerHTML=ispisiVrijemeNovosti(new Date(datumi[i].innerHTML));
	}
}

function ispisiVrijemeNovosti(datum){	// broj mjeseci od 0 do 11	
	var razlika=izracunajRazliku(datum);
	
	if(razlika=="GRESKA"){
		return "Greška u datumu objave!!! Datum veći od trenutnog datuma.";
	}
		
	var godine=razlika[0];
	var mjeseci=razlika[1];
	var dani=razlika[2];
	var sati=razlika[3];
	var minute=razlika[4];
	var sekunde=razlika[5];
	
	var ispis="Novost je objavljena prije ";
	
	if(godine!=0 || mjeseci>0){
		ispis=datum.toLocaleString();
	}
	else if(dani>=7){
		var sedmice=Math.floor(dani/7);
		ispis+=sedmice+" sedmice";	
	}
	else if(dani>0){
		ispis+=dani+" ";
		
		if(dani==1){
			ispis+="dan";
		}
		else{
			ispis+="dana";
		}
	}
	else if(sati>0){
		ispis+=sati+" ";
		
		var jedinice_sata=sati;
		if(Math.floor(sati/10)==2){
			jedinice_sata=sati%10;
		}
				
		if(jedinice_sata==1){
			ispis+="sat";
		}
		else if(jedinice_sata>0 && jedinice_sata<5){
			ispis+="sata";
		}
		else{
			ispis+="sati";
		}
	}
	else if(minute>0){
		ispis+=minute+" ";
		
		var jedinice_minuta=minute;
		if(Math.floor(minute/10)>=2){
			jedinice_minuta=minute%10;
		}
				
		if(jedinice_minuta>0 && jedinice_minuta<5){
			ispis+="minute";
		}
		else{
			ispis+="minuta";
		}
	}
	else{
		ispis="Novost je objavljena prije par sekundi"
	}
	
	return ispis;
}

function izracunajRazliku(datum){
	var trenutno=new Date();
	
	if(datum.getTime()>trenutno.getTime()){
		return "GRESKA";
	}
		
	var godine=trenutno.getFullYear()-datum.getFullYear();
	var mjeseci=trenutno.getMonth()-datum.getMonth();
	var dani=trenutno.getDate()-datum.getDate();
	var sati=trenutno.getHours()-datum.getHours();
	var minute=trenutno.getMinutes()-datum.getMinutes();
	var sekunde=trenutno.getSeconds()-datum.getSeconds();
	
	if(mjeseci<0){
		mjeseci+=12;
		godine-=1;
	}
	
	if(dani<0){
		if(trenutno.getMonth()==2){
			if(trenutno.getFullYear()%4==0){
				dani+=29;
			}
			else{
				dani+=28;
			}
		}
		else if(trenutno.getMonth()==4 ||trenutno.getMonth()==6 ||trenutno.getMonth()==9 ||trenutno.getMonth()==11){
			dani+=30;
		}
		else{
			dani+=31;
		}
		
		mjeseci-=1;
	}
	
	if(sati<0){
		sati+=24;
		dani-=1;
	}
	
	if(minute<0){
		minute+=60;
		sati-=1;
	}
	
	if(sekunde<0){
		sekunde+=60;
		minute-=1;
	}
	
	var razlika=[godine,mjeseci,dani,sati,minute,sekunde];
	
	return razlika;
}