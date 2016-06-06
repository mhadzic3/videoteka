<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<HTML>
	<HEAD>
		<TITLE>Videoteka</TITLE>
		<link rel="stylesheet" type="text/css" href="CSS/videoteka.css">
		<link rel="stylesheet" type="text/css" href="CSS/naslovnica.css">
		<META http-equiv="Content-Type" content="text/html; charset=utf-8">
		<script src="JavaScript/vrijeme_objava.js"></script>
		<script src="JavaScript/filter_objava.js"></script>
		<script src="JavaScript/novosti.js"></script>
	</HEAD>
	<BODY>
		<h1>Dobro došli !!!</h1>
		
		<?php
			session_start();
			
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
				   
			print "<div id=\"filter\">
						<ul>
							<li><a href=\"#\" onclick=\"prikaziSveNovosti()\">Sve novosti</a></li>
							<li><a href=\"#\" onclick=\"prikaziDanasnjeNovosti()\">Današnje novosti</a></li>
							<li><a href=\"#\" onclick=\"prikaziSedmicneNovosti()\">Novosti ove sedmice</a></li>
							<li><a href=\"#\" onclick=\"prikaziMjesecneNovosti()\">Novosti ovog mjeseca</a></li>
							";
							
			if(isset($_SESSION['username']) && isset($_SESSION['password'])){
				print  	   "<li><input type=\"submit\" name=\"mojeNovosti\" id=\"mojeNovosti\" value=\"Moje novosti\"></li>";
			}
							
			print		"</ul>
				   </div>";
			print "</form>";
			
			// ispis novosti
						
			$veza = new PDO("mysql:dbname=wt8;host=localhost;charset=utf8", "wt8user", "wt8pass");
		    $veza->exec("set names utf8");
			
			$novosti = $veza->query("select id, naslov, tekst, otvorena, autor, UNIX_TIMESTAMP(vrijeme) vrijeme2 
									 from novosti 
									 where obrisano=0 
									 order by vrijeme desc");
			
			if(isset($_POST['mojeNovosti'])){
				$autor=$veza->query("select id from korisnici where username=\"".$_SESSION['username']."\"");
				$autor=$autor->fetchColumn(0);
				
				$novosti = $veza->query("select id, naslov, tekst, otvorena, autor, UNIX_TIMESTAMP(vrijeme) vrijeme2 
										 from novosti where obrisano=0 and autor=".$autor." order by vrijeme desc");
			}
			
			if (!$novosti) {
				  $greska = $veza->errorInfo();
				  print "SQL greška: " . $greska[2];
				  exit();
			}

			print "<form action=\"naslovnica.php\" method=\"post\">";
			
			foreach ($novosti as $novost) {
				$klasa=$novost['naslov']."-".$novost['id'];
				
				print "<div class=\"novost\">";
					print "<a href=\"javascript:prikaziKlase('".$klasa."')\">".$novost['naslov']."</a><br>";
					
					print "<span class=\"".$klasa."\" style=\"display:none;\">
								<p>".$novost['tekst']."</p>
						   </span>";
					
					$autor=$veza->query("select username from korisnici where id=".$novost['autor']);
					$autor=$autor->fetchColumn(0);
					
					print "<a href=\"#\">".$autor."</a>
						   <small> ".date("d.m.Y. (h:i)",$novost['vrijeme2'])."</small><br></br>";
					
					if($novost['otvorena']==1){
						$komentari=$veza->query("select * from komentari where novost=".$novost['id']." and komentar is null order by vrijeme asc");
						
						foreach($komentari as $komentar){
							$autor=$veza->query("select username from korisnici where id=".$komentar['autor']);
							$autor=$autor->fetchColumn(0);
							
							print "<span class=\"".$klasa."\" style=\"display:none;\">
										<p>".$komentar['tekst']."</p>
										<a href=\"#\">".$autor."</a>
										<small> ".date("d.m.Y. (h:i)",$komentar['vrijeme'])."</small><br></br>
								   </span>";
						}
						
						if(isset($_SESSION['username']) && isset($_SESSION['password'])){
							print "<span class=\"".$klasa."\" style=\"display:none;\">
										<input type=\"text\" style=\"width:250;\">
										<input type=\"button\" value=\"Komentariši\">
								   </span>";
						}
						else{
							print "<span class=\"".$klasa."\" style=\"display:none;\">
										<small>Za komentarisanje novosti se trebate prijaviti na račun.</small>
								   </span>";
						}
					}
					else{
						print "<span class=\"".$klasa."\" style=\"display:none;\">
									<small>Novost se ne može komentarisati.</small>
							   </span>";
					}
					
				print "</div>";
			}
			
			print "</form>";
			
		?>
	</BODY>
</HTML>