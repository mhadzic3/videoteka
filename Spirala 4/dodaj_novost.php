<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<HTML>
	<HEAD>
		<TITLE>Dodavanje novosti</TITLE>
		<link rel="stylesheet" type="text/css" href="CSS/videoteka.css">
		<link rel="stylesheet" type="text/css" href="CSS/dodaj_novost.css">
		<META http-equiv="Content-Type" content="text/html; charset=utf-8">
	</HEAD>
	<BODY>
		<h1>Dodaj novost</h1>
		
		<?php
			session_start();
		
			if(isset($_POST['dugmeNovost']) && $_REQUEST['naslov_novosti']!="" && $_REQUEST['tekst_novosti']!=""){
				$naslov=$_POST['naslov_novosti'];
				$tekst=$_POST['tekst_novosti'];
				
				$otvorena=0;
				if(isset($_POST['novost_otvorena'])){
					$otvorena=$_POST['novost_otvorena'];
				}
				
				$veza = new PDO("mysql:dbname=wt8;host=localhost;charset=utf8", "wt8user", "wt8pass");
				$veza->exec("set names utf8");
				
				$autori=$veza->query("select id from korisnici where username=\"".$_SESSION['username']."\"");
				
				$autor=0;
					
				foreach($autori as $logovani){
					$autor=$logovani['id'];
					break;
				}
								
				$rezultat=$veza->exec("insert into novosti set naslov=\"".$naslov."\", tekst=\"".$tekst."\", otvorena=".$otvorena.", autor=".$autor."");
				
				$_REQUEST['naslov_novosti']="";
				$_REQUEST['tekst_novosti']="";
				
				print $_REQUEST['naslov_novosti']." ".$_REQUEST['tekst_novosti'];
			}
		?>
	
		<div id="meni">
			<ul>
				<li><a href="naslovnica.php">Početna</a></li>
				<li><a href="tabela_zanrova.php">Žanrovi</a></li>
				<li><a href="eksterni_linkovi.php">Druge online videoteke</a></li>
				<li><a href="korisnicki_racun.php">Korisnički račun</a></li>
			</ul>
		</div>
		
		<form id="dodajNovost" action="dodaj_novost.php" method="post">
			<label id="naslov">Dodavanje novosti</label><br><br><br>
			
			<div class="kontrola">
				<label for="naslov_novosti">Unesite naslov novosti:</label>
				<br>
				<input class="txt" type="text" name="naslov_novosti" id="naslov_novosti">
			</div>
			<br>
			
			<div class="kontrola">
				<label for="tekst_novosti">Tekst novosti:</label>
				<br>
				<textarea rows=10 class="txt" name="tekst_novosti" id="tekst_novosti"></textarea>
			</div>
			<br>
			
			<div class="kontrola">
				<input type="checkbox" name="novost_otvorena" value=1> Novost otvorena za komentare
			</div>
			<br>
			
			<br>
			<input type="submit" value="Dodaj novost" id="dugmeNovost" name="dugmeNovost">
		</form>
	</BODY>
</HTML>