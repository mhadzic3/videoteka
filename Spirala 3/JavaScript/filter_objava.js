function prikaziSveNovosti(){
	var novosti=document.getElementById("komentari").children;
	
	for(var i=0;i<novosti.length;i++){
		novosti[i].style.display="block";
	}
}

function prikaziDanasnjeNovosti(){
	var novosti=document.getElementById("komentari").children;
	var trenutno=new Date();
	
	for(var i=0;i<novosti.length;i++){
		var datum=new Date(novosti[i].getElementsByClassName("datum_objave")[0].innerHTML);
		
		if(trenutno.getFullYear()==datum.getFullYear() && trenutno.getMonth()==datum.getMonth() && trenutno.getDate()==datum.getDate()){
			novosti[i].style.display="block";
		}
		else{
			novosti[i].style.display="none";
		}
	}
}

function prikaziSedmicneNovosti(){
	var novosti=document.getElementById("komentari").children;
	
	for(var i=0;i<novosti.length;i++){
		var datum=new Date(novosti[i].getElementsByClassName("datum_objave")[0].innerHTML);
		var trenutno=new Date();
		
		var razlika=izracunajRazliku(datum);
		if(razlika=="GRESKA"){
			novosti[i].style.display="none";
			continue;
		}
		
		var godine=razlika[0];
		var mjeseci=razlika[1];
		var dani=razlika[2];
		
		if(dani<7 && (trenutno.getDay()==0 || trenutno.getDay()-dani>0)){	// sedmica pocinje od ponedjeljka
			novosti[i].style.display="block";
		}
		else{
			novosti[i].style.display="none";
		}
	}	
}

function prikaziMjesecneNovosti(){
	var novosti=document.getElementById("komentari").children;
	var trenutno=new Date();
	
	for(var i=0;i<novosti.length;i++){
		var datum=new Date(novosti[i].getElementsByClassName("datum_objave")[0].innerHTML);
		
		var razlika=izracunajRazliku(datum);
		if(razlika=="GRESKA"){
			novosti[i].style.display="none";
			continue;
		}
		
		if(trenutno.getFullYear()==datum.getFullYear() && trenutno.getMonth()==datum.getMonth()){
			novosti[i].style.display="block";
		}
		else{
			novosti[i].style.display="none";
		}
	}
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
