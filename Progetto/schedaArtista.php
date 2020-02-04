<?php include("topHome.php");?>
<link href="css/styleTop.css" type="text/css" rel="stylesheet" />
<link href="css/styleScheda.css" type="text/css" rel="stylesheet" />
<script src="js/scheda.js" type="text/javascript"></script>
	<div id="finestraPrincipale">
		<div id="schedaGioco">
			<h2><?=$_REQUEST['nomeArtista']?></h2>
			<div id="descrizioneScheda">
				<div id="immagineScheda"></div>
			</div>	
		</div>
		<div id="infoArtista">
			<h2>Scheda artista</h2>
			<dl>
				<dt>Discendenza</dt>
				<dd></dd>
				<dt>Anno di nascita</dt>
				<dd></dd>
				<dt>Genere</dt>
				<dd></dd>
				<dt>Recensione utenti</dt>
				<dd></dd>
			</dl>
		</div>
		<div id="buttonArtista">
			<button id="artistaDaVedere" type="button">Aggiungi alla tua lista 'da vedere'</button><br>
			<button id="artistaVisto" type="button">Segna come visto</button><br>
			<div id="registrazione"></div>
			<p>256 voti</p>
			<div id="recensioneScheda">
				<div></div>
				<div></div>
				<div></div>
				<div></div>
				<div></div>
			</div>
		</div>
		<div id="finestraCommenti">
			<h2>I commenti degli utenti</h2>
				<div id="scriviCommento">
					<img src="img/user1.png" alt="bannerlogo">
					<textarea placeholder="Scrivi qui la tua recensione ..." rows="5"></textarea>
					<button id="buttonScrivi" type="submit">Scrivi</button><br>
				</div>			
				<div class="commento">
					<img src="img/user1.png" alt="bannerlogo">
					<div class="nomeUtente"></div><div class="dataCommento"></div>
					<div class="testoCommmento"></div>
				</div>
				<div class="commento">
					<img src="img/user1.png" alt="bannerlogo">
					<div class="nomeUtente"></div><div class="dataCommento"></div>
					<div class="testoCommmento"></div>
				</div>
				<div class="commento">
					<img src="img/user1.png" alt="bannerlogo">
					<div class="nomeUtente"></div><div class="dataCommento"></div>
					<div class="testoCommmento"></div>
				</div>
				<div class="commento">
					<img src="img/user1.png" alt="bannerlogo">
					<div class="nomeUtente"></div><div class="dataCommento"></div>
					<div class="testoCommmento"></div>
				</div>
				<div class="commento">
					<img src="img/user1.png" alt="bannerlogo">
					<div class="nomeUtente"></div><div class="dataCommento"></div>
					<div class="testoCommmento"></div>
				</div>
				<div class="commento">
					<img src="img/user1.png" alt="bannerlogo">
					<div class="nomeUtente"></div><div class="dataCommento"></div>
					<div class="testoCommmento"></div>
				</div>
		</div>
		<div id="scorriPagina">
			<div><button id="back" type="button"></button></div>
			<p>1-n</p>
			<div><button id="next" type="button"></button></div>
		</div>
	</div>
	
<?php include("bottom.php"); ?>