<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<HTML>
	<HEAD>
		<TITLE>Prijava</TITLE>
		<link rel="stylesheet" type="text/css" href="CSS/videoteka.css">
		<link rel="stylesheet" type="text/css" href="CSS/naslovnica.css">
		<META http-equiv="Content-Type" content="text/html; charset=utf-8">
		<script src="JavaScript/vrijeme_objava.js"></script>
		<script src="JavaScript/filter_objava.js"></script>
	</HEAD>
	<BODY>
		<h1>Dobro došli !!!</h1>
		<?php
			session_start();
		
			if(isset($_POST['prijava'])){
				if($_REQUEST['korisnik']!="" && $_REQUEST['sifra']!=""){
					$redovi=file("racuni.txt");
					
					foreach($redovi as $red){
						$podaci=explode(" ",$red);
						if($podaci[0]==$_REQUEST['korisnik'] && $podaci[1]==md5($_REQUEST['sifra'])){
							$_SESSION['korisnik']=$_REQUEST['korisnik'];
							$_SESSION['sifra']=$_REQUEST['sifra'];
							
							break;
						}
					}
				}
			}
					
			if(isset($_POST['odjava'])){
				session_unset();
			}
			
			if(isset($_SESSION['korisnik']) && isset($_SESSION['sifra'])){
				print "<div id=\"meni\">
							<ul>
								<li><a href=\"naslovnica.html\">Početna</a></li>
								<li><a href=\"korisnicki_racun.html\">Korisnički račun</a></li>
								<li><a href=\"tabela_zanrova.html\">Žanrovi</a></li>
								<li><a href=\"eksterni_linkovi.html\">Druge online videoteke</a></li>
								<li><a href=\"dodaj_novost.php\">Dodaj novost</a></li>
								<li>
									<form action=\"login.php\" method=\"post\">
										<input type=\"submit\" name=\"odjava\" value=\"Odjava\">
									</form>
								</li>
							</ul>
						</div>
						<div id=\"filter\">
							<ul>
								<li><a href=\"#\" onclick=\"prikaziSveNovosti()\">Sve novosti</a></li>
								<li><a href=\"#\" onclick=\"prikaziDanasnjeNovosti()\">Današnje novosti</a></li>
								<li><a href=\"#\" onclick=\"prikaziSedmicneNovosti()\">Novosti ove sedmice</a></li>
								<li><a href=\"#\" onclick=\"prikaziMjesecneNovosti()\">Novosti ovog mjeseca</a></li>
							</ul>
						</div>
						<div id=\"komentari\">
							<p>
								<img src=\"SLIKE/aquaman.jpg\" alt=\"SLIKE/aquaman.jpg\" width=\"300\" height=\"300\" title=\"Ovo je slika\">
								<span class=\"datum_objave\" style=\"display:none;\">04 03 2016 22:26:24</span>
								<span class=\"prikaz_datuma\"></span>
							</p >";
			}
			else{
				print "<form id=\"login\" action=\"login.php\" method=\"post\">
						<br>
						<label id=\"naslov\">Prijava na račun</label><br><br><br>
						<div class=\"kontrola\">
							<label for=\"korisnik\">Korisnik:</label>
							<br>
							<input class=\"txt\" type=\"text\" id=\"korisnik\" name=\"korisnik\">
						</div>
						<br>
						<div class=\"kontrola\">
							<label for=\"šifra\">Šifra:</label>
							<br>
							<input class=\"txt\" type=\"text\" id=\"sifra\" name=\"sifra\">
						</div>
						<br><br>
						<input type=\"submit\" value=\"Prijavi me\" id=\"dugmePrijava\" name=\"prijava\">
					</form>";
			}
		?>
	</BODY>
</HTML>