<?php include("topHome.php");?>
<link href="css/styleTop.css" type="text/css" rel="stylesheet" />
<link href="css/styleProfilo.css" type="text/css" rel="stylesheet" />
<script src="js/profiloUtente.js"></script>
	<div id="finestraPrincipale">
		<div id="statisticheUtente">
			<h2>Statistiche utente</h2>
			<dl>
				<dt>Artisti visti negli ultimi sei mesi: </dt>
				<dd></dd>
				<dt>Artisti visti nell' ultimo anno:</dt>
				<dd></dd>
			</dl>
		</div>
		<div id="tbl">
			<h2>La tua Lista</h2>
			<div class="colonne">
				<div class="colonna">
					<ol>
					
					</ol>
				</div>
				<div class="colonna">
					<ol start="">
					
					</ol>
				</div>
			</div>
			<input class="mostraTutti" type="button" value="Mostra tutti ...">
			<input id="modificaTBL" type="button" value="Modifica la tua lista">
		</div>
		<div id="artistiVisti">
			<h2>Artisti Studiati</h2>
			<div class="colonne">
				<div class="colonna">
					<ul>

					</ul>
				</div>
				<div class="colonna">
					<ul>

					</ul>
				</div>
			</div>
			<input class="mostraTutti" type="button" value="Mostra tutti ...">
		</div>
	</div>
<?php include("bottom.php"); ?>