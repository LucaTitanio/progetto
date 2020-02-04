<?php include("topHome.php");?>
<link href="css/styleTop.css" type="text/css" rel="stylesheet" />
<link href="css/styleTbl.css" type="text/css" rel="stylesheet" />
<script src="js/tbl.js"></script>
	<div id="finestraPrincipale">
		<div id="tbl">
			<h2>Modifica la lista 'da vedere' </h2>
			<div id="istruzioni">
				<p>Per eliminare un artista dalla lista trascinalo su <img src='img/trash.png' alt='cestino' />.</p>
				<p>Per segnare un artista come 'visto' trascinarlo su <img src='img/visto.png' alt='cestino' />.</p>
				<p>Per cambiare l'ordine degli artisti spostare nella lista il nome e rilasciarlo quando è nella posizione desiderata.</p>
			</div>
			<div id="numerazione"></div>
				<div id="colonna">
					<ul>
					
					</ul>
				</div>
			<div id="modifiche">
				<div id="cestino"><img src='img/trash.png' alt='cestino' /></div>
				<div id="visto"><img src='img/visto.png' alt='artista visto' /></div>
				<input id="modificaTBL" type="button" value="Salva le modifiche">
				<div id="esitoModifiche"></div>
			</div>
		</div>
	</div>
<?php include("bottom.php"); ?>