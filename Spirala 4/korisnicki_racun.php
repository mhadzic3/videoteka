<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<HTML>
	<HEAD>
		<TITLE>Prijava na korisnički račun</TITLE>
		<link rel="stylesheet" type="text/css" href="CSS/videoteka.css">
		<link rel="stylesheet" type="text/css" href="CSS/korisnicki_racun.css">
		<META http-equiv="Content-Type" content="text/html; charset=utf-8">
		<script src="JavaScript/napravi_racun.js"></script>
	</HEAD>
	<BODY>
		<h1>Prijava na korisnički račun</h1>
		
		<?php
			session_start();
			
			if(isset($_POST['dugmePrijava'])){
				
				$veza = new PDO("mysql:dbname=wt8;host=localhost;charset=utf8", "wt8user", "wt8pass");
				$veza->exec("set names utf8");
				
				$username=$_REQUEST['korisnik'];
				$password=$_REQUEST['sifra'];
								
				$rezultat=$veza->prepare("select count(*) from korisnici where username=? and password=?");
				$rezultat->execute(array($username, $password));
				
				if($rezultat->fetchColumn(0)==1){					
					$_SESSION['username']=$username;
					$_SESSION['password']=$password;
					
					header("Location: naslovnica.php");
				}
			}
			
			if(isset($_POST['dugmeOdjava'])){
				session_unset();
				header("Location: naslovnica.php");
			}
			
			if(isset($_POST['dugmePromjena'])){
				$veza = new PDO("mysql:dbname=wt8;host=localhost;charset=utf8", "wt8user", "wt8pass");
				$veza->exec("set names utf8");
				
				$password=$_REQUEST['novaSifra1'];
								
				$rezultat=$veza->exec("update korisnici set password=\"".$password."\" where username=\"".$_SESSION['username']."\"");
				
				$_SESSION['password']=$password;
			}
			
			print "<div id=\"meni\">
						<ul>
							<li><a href=\"naslovnica.php\">Početna</a></li>
							<li><a href=\"tabela_zanrova.php\">Žanrovi</a></li>
							<li><a href=\"eksterni_linkovi.php\">Druge online videoteke</a></li>
							";
							
			if(isset($_SESSION['username']) && isset($_SESSION['password'])){
				print  	   "<li><a href=\"dodaj_novost.php\">Unos novosti</a></li>
						   ";
			}
			
			print 			"<li><a href=\"korisnicki_racun.php\">Korisnički račun</a></li>	
						</ul>
				   </div>";
			
			$naslov="Prijava na račun";
			
			print "<form id=\"login\" action=\"korisnicki_racun.php\" method=\"post\">
						<label id=\"naslov\">Korisnički račun</label><br><br><br>";
			
			if(isset($_SESSION['username']) && isset($_SESSION['password'])){
				print  "<div class=\"kontrola\">
							<label for=\"staraSifra\">Unesite staru šifru:</label>
							<br>
							<input class=\"txt\" type=\"text\" id=\"staraSifra\" name=\"staraSifra\" 
							 oninput=\"provjeriSifru2('".$_SESSION['password']."', 'staraSifra')\">
						</div>
						<br>
						
						<div class=\"kontrola\">
							<label for=\"novaSifra1\">Unesite novu šifru:</label>
							<br>
							<input class=\"txt\" type=\"text\" id=\"novaSifra1\" name=\"novaSifra1\" 
							 oninput=\"validirajUnosSifre('orange', 'novaSifra1')\" onchange=\"validirajUnosSifre('red', 'novaSifra1')\">
						</div>
						<br>
						
						<div class=\"kontrola\">
							<label for=\"novaSifra2\">Ponovite novu šifru:</label>
							<br>
							<input class=\"txt\" type=\"text\" id=\"novaSifra2\" name=\"novaSifra2\" 
							 oninput=\"provjeriSifru('novaSifra1', 'novaSifra2')\">
						</div>
						
						<br><br>
						<input type=\"submit\" value=\"Promijeni šifru\" id=\"dugmePromjena\" name=\"dugmePromjena\">
						
						<br><br>
						<input type=\"submit\" value=\"Odjavi me\" id=\"dugmeOdjava\" name=\"dugmeOdjava\">";
			}
			else{
				print  "<div class=\"kontrola\">
							<label for=\"korisnik\">Korisnik:</label>
							<br>
							<input class=\"txt\" type=\"text\" id=\"korisnik\" name=\"korisnik\">
						</div>
						<br>
						
						<div class=\"kontrola\">
							<label for=\"sifra\">Šifra:</label>
							<br>
							<input class=\"txt\" type=\"text\" id=\"sifra\" name=\"sifra\">
						</div>
						
						<br><br>
						<input type=\"submit\" value=\"Prijavi me\" id=\"dugmePrijava\" name=\"dugmePrijava\">
						
						<br><br>
						<input type=\"button\" value=\"Napravi račun\" id=\"dugmeRegistracija\" onclick=\"window.location.href='napravi_racun.php'\">";
			}
						
			print	  "</form>";
		?>
		
		
	</BODY>
</HTML>