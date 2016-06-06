function prikaziKlase(klasa){
	var klase=document.getElementsByClassName(klasa);
	
	for(var i=0;i<klase.length;i++){
		if(klase[i].style.display=="none"){
			klase[i].style.display="block";
		}
		else{
			klase[i].style.display="none";
		}
	}
}