<?php include("topHome.php");?>
<link href="css/styleTop.css" type="text/css" rel="stylesheet" />
<link href="css/styleHome.css" type="text/css" rel="stylesheet" />
<script src="js/home.js"></script>
	<div id="finestraPrincipale">
		<div id="finestraArtisti">
			<div id="barraCerca">
				<select id="tipoGenere">
					<option value="TutteLeCategorie">Tutte le categorie</option>
					<option value="Romanticismo">Romanticismo</option>
					<option value="Neoclassicismo">Neoclassicismo</option>
					<option value="Dada">Dada</option>
					<option value="Puntinismo">Puntinismo</option>
				</select> 
				<input id="cerca" type="text" name="cerca" placeholder="Cerca...">
				<input id="bottoneCerca" type="submit" value="">

			</div>
			<div id="erroreRicerca"></div>
			<div id="artisti">
				<div class="artista">
					<h2></h2>
					<div class="recensione2"></div>
					<div class="recensione1"></div>
					<div class="immagine"></div>
					<div class="trama"></div>
					<input class="scheda" type="button" value="Vai alla scheda artista">
				</div>
				<div class="artista">
					<h2></h2>
					<div class="recensione2"></div>
					<div class="recensione1"></div>
					<div class="immagine"></div>
					<div class="trama"></div>
					<input class="scheda" type="button" value="Vai alla scheda artista">
				</div>
				<div class="artista">
					<h2></h2>
					<div class="recensione2"></div>
					<div class="recensione1"></div>
					<div class="immagine"></div>
					<div class="trama"></div>
					<input class="scheda" type="button" value="Vai alla scheda artista">
				</div>
				<div class="artista">
					<h2></h2>
					<div class="recensione2"></div>
					<div class="recensione1"></div>
					<div class="immagine"></div>
					<div class="trama"></div>
					<input class="scheda" type="button" value="Vai alla scheda artista">
				</div>

				<div class="artista">
					<h2></h2>
					<div class="recensione2"></div>
					<div class="recensione1"></div>
					<div class="immagine"></div>
					<div class="trama"></div>
					<input class="scheda" type="button" value="Vai alla scheda artista">
				</div>
				<div class="artista">
					<h2></h2>
					<div class="recensione2"></div>
					<div class="recensione1"></div>
					<div class="immagine"></div>
					<div class="trama"></div>
					<input class="scheda" type="button" value="Vai alla scheda artista">
				</div>
			</div>
			<div id="scorriPagina">
				<div><button id="back" type="button"></button></div>
				<p>1-56</p>
				<div><button id="next" type="button"></button></div>
			</div>
		</div>
		<div id="classificheArtisti">
		<div class="classificheArtisti">
			<h2>Novità</h2>
			<ol>
				<li></li>
				<li></li>
				<li></li>
				<li></li>
				<li></li>
			</ol>
		</div>
		<div class="classificheArtisti">
			<h2>Artisti più popolari</h2>
			<ol>
				<li></li>
				<li></li>
				<li></li>
				<li></li>
				<li></li>
			</ol>
		</div>
		</div>
	</div>
	
<?php include("bottom.php"); ?>