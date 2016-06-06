<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<HTML>
	<HEAD>
		<TITLE>Napravi korisnički račun</TITLE>
		<link rel="stylesheet" type="text/css" href="CSS/videoteka.css">
		<link rel="stylesheet" type="text/css" href="CSS/napravi_racun.css">
		<META http-equiv="Content-Type" content="text/html; charset=utf-8">
		<script src="JavaScript/napravi_racun.js"></script>
	</HEAD>
	<BODY>
		<h1>Napravi korisnički račun</h1>
		
		<?php
			if(isset($_POST['dugmeRegistracija'])){
				$korisnik=$_POST['korisnik'];
				$sifra1=$_POST['sifra1'];
				$sifra2=$_POST['sifra2'];
				
				$veza = new PDO("mysql:dbname=wt8;host=localhost;charset=utf8", "wt8user", "wt8pass");
				$veza->exec("set names utf8");
				
				$rezultat=$veza->exec("insert into korisnici set username=\"".$korisnik."\", password=\"".$sifra1."\"");
			}
		?>
		
		<div id="meni">
			<ul>
				<li><a href="naslovnica.php">Početna</a></li>
				<li><a href="korisnicki_racun.php">Korisnički račun</a></li>
				<li><a href="tabela_zanrova.php">Žanrovi</a></li>
				<li><a href="eksterni_linkovi.php">Druge online videoteke</a></li>
			</ul>
		</div>
		
		<form id="korisnickiRacun" action="napravi_racun.php" method="post">
			<label id="naslov">Registracija korisničkog računa</label><br><br><br>
			
			<div class="kontrola">
				<label for="korisnik">Korisničko ime:</label>
				<br>
				<input class="txt" type="text" id="korisnik" name="korisnik" 
				 oninput="validirajUnosKorisnika('orange', 'korisnik')" onchange="validirajUnosKorisnika('red', 'korisnik')">
			</div>
			<br>
			
			<div class="kontrola">
				<label for="sifra1">Korisnička šifra:</label>
				<br>
				<input class="txt" type="text" id="sifra1" name="sifra1" 
				 oninput="validirajUnosSifre('orange', 'sifra1')" onchange="validirajUnosSifre('red', 'sifra1')">
			</div>
			<br>
			
			<div class="kontrola">
				<label for="sifra2">Ponovi šifru:</label>
				<br>
				<input class="txt" type="text" id="sifra2" name="sifra2" oninput="provjeriSifru('sifra1', 'sifra2')">
			</div>
			
			<br><br>
			<input type="submit" value="Napravi račun" id="dugmeRegistracija" name="dugmeRegistracija">
		</form>
	</BODY>
</HTML>