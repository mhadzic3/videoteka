<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<HTML>
	<HEAD>
		<TITLE>Dodavanje novosti</TITLE>
		<link rel="stylesheet" type="text/css" href="CSS/videoteka.css">
		<link rel="stylesheet" type="text/css" href="CSS/napravi_racun.css">
		<META http-equiv="Content-Type" content="text/html; charset=utf-8">
		<script src="JavaScript/napravi_racun.js"></script>
	</HEAD>
	<BODY>
		<?php
			if(isset($_POST['dodaj'])){
				if($_REQUEST['naziv_slike']!="" && $_REQUEST['tekst_novosti']!="")
				$slika=$_POST['naziv_slike'];
				$tekst=$_POST['tekst_novosti'];
				$noviRed=$slika.",".$tekst."\n";
				file_put_contents("novosti.csv",$noviRed,FILE_APPEND);
			}
		?>
		<h1>Dodaj novost</h1>
		<div id="meni">
			<ul>
				<li><a href="naslovnica.html">Početna</a></li>
				<li><a href="korisnicki_racun.html">Korisnički račun</a></li>
				<li><a href="tabela_zanrova.html">Žanrovi</a></li>
				<li><a href="eksterni_linkovi.html">Druge online videoteke</a></li>
			</ul>
		</div>
		<form id="login" action="dodaj_novost.php" method="post">
			<br>
			<label id="naslov">Dodavanje novosti</label><br><br><br>
			
			<div class="kontrola">
				<label for="moj_email">Unesite naziv slike:</label>
				<br>
				<input class="txt" type="text" name="naziv_slike" id="moj_email">
			</div>
			<br>
			
			<div class="kontrola">
				<label for="korisnik">Tekst:</label>
				<br>
				<input class="txt" type="text" name="tekst_novosti" id="korisnik">
			</div>
			<br>
			
			<br>
			<input type="submit" value="Dodaj novost" id="dugmeRegistracija" name="dodaj">
		</form>
	</BODY>
</HTML>