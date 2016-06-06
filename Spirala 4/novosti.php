<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<HTML>
	<HEAD>
		<TITLE>Novosti</TITLE>
		<link rel="stylesheet" type="text/css" href="CSS/videoteka.css">
		<META http-equiv="Content-Type" content="text/html; charset=utf-8">
		<script src="JavaScript/novosti.js"></script>
	</HEAD>
	<BODY>
		<h1>Novosti</h1>
		
		<?php
			session_start();
			
			if(isset($_POST['izmjeni_otvorenost'])){
				$veza = new PDO("mysql:dbname=wt8;host=localhost;charset=utf8", "wt8user", "wt8pass");
				$veza->exec("set names utf8");
				
				$novost=$_POST['novost_id'];
				
				$otvorena=$veza->query("select otvorena from novosti where id=".$novost);
				$otvorena=$otvorena->fetchColumn(0);
				
				if($otvorena==0){
					$otvorena=1;
				}
				else{
					$otvorena=0;
				}
				
				$veza->exec("update novosti set otvorena=".$otvorena." where id=".$novost);
			}
			
			// ispis menija
			print "<form action=\"naslovnica.php\" method=\"post\">";
			print "<div id=\"meni\">
						<ul>
							<li><a href=\"naslovnica.php\">Početna</a></li>
							<li><a href=\"tabela_zanrova.php\">Žanrovi</a></li>
							<li><a href=\"eksterni_linkovi.php\">Druge online videoteke</a></li>
							";
							
			if(isset($_SESSION['username']) && isset($_SESSION['password'])){
				print  	   "<li><a href=\"dodaj_novost.php\">Unos novosti</a></li>
						   ";
				if($_SESSION['username']=="admin" && $_SESSION['password']=="admin"){
					print  "<li><a href=\"novosti.php\">Novosti</a></li>
						   ";
				}
			}
			
			print 			"<li><a href=\"korisnicki_racun.php\">Korisnički račun</a></li>	
						</ul>
				   </div>";

			print "</form>";
			
			// ispis novosti
						
			$veza = new PDO("mysql:dbname=wt8;host=localhost;charset=utf8", "wt8user", "wt8pass");
		    $veza->exec("set names utf8");
			
			$novosti = $veza->query("select id, naslov, tekst, otvorena, autor, UNIX_TIMESTAMP(vrijeme) vrijeme2 
									 from novosti 
									 where obrisano=0 
									 order by vrijeme desc");
			
			if (!$novosti) {
				  $greska = $veza->errorInfo();
				  print "SQL greška: " . $greska[2];
				  exit();
			}
			
			foreach ($novosti as $novost) {	
				$autor=$veza->query("select username from korisnici where id=".$novost['autor']);
				$autor=$autor->fetchColumn(0);
				
				print "<p>".$novost['naslov']."</p>
						<p>".$novost['tekst']."</p>
						<small>".$autor." - ".date("d.m.Y. (h:i)",$novost['vrijeme2'])."</small>
							<form action=\"novosti.php\" method=\"post\">";
				if($novost['otvorena']==1){
					print "<p>DA</p>";
				}		
				else{
					print "<p>NE</p>";
				}
				print  "<input type=\"hidden\" name=\"novost_id\" value=".$novost['id'].">
						<input type=\"submit\" name=\"izmjeni_otvorenost\" value=\"Izmjeni\">
						</form><br>";
						
			}
			
		?>
	</BODY>
</HTML>