<?php include_once("db.php");?>
<?php

if (isset($_GET["testoRicerca"]) && isset($_GET["autoreArtista"])){
	$return = cercaArtisti($_GET["testoRicerca"]);
	if($return!=-1){
		$json = json_encode($return);
		print $json;
	}
	
} else if(isset($_GET["autoreArtista"])){
	$return = prelevaArtisti();
	if($return!=-1){
		$json = json_encode($return);
		print $json;
	}
} else {
	$return = prelevaMiglioriNovita();	
	if($return!=-1){
		$json = json_encode($return);
		print $json;
	}
}

function prelevaMiglioriNovita() {
		try{
		$db = db_connect();
		
		$query = "SELECT Artista
				FROM artisti JOIN (SELECT COUNT(*) AS voti, id_artista
								FROM voto
								GROUP BY id_artista)numero_voti ON artisti.id_artista = numero_voti.id_artista
				ORDER BY numero_voti.voti DESC, recensione_artista DESC
				LIMIT 5";
		$rows = $db->query($query);
		
		$miglioriArtisti = array();
		foreach($rows as $row){
			array_push($miglioriArtisti, $row["Artista"]);
		}
		
		$query = "SELECT Artista
				FROM artisti
				ORDER BY id_artista DESC
				LIMIT 5";
		$rows = $db->query($query);
		
		$nuoviArtisti = array();
		foreach($rows as $row){
			array_push($nuoviArtisti, $row["Artista"]);
		}
		
		return array("miglioriArtisti"=>$miglioriArtisti, "nuoviArtisti"=>$nuoviArtisti);
	} catch (PDOException $ex){
		return -2; // errore
	}
	
}

function cercaArtisti($testoRicerca) {
	try{
		$db = db_connect();
		$rows;
		$idArtisti;
		$queryNumArtisti;
		$prima;
		$dopo;
		$tipoOrdine;
		
		//si ricerca il codice della categoria indicata dall'utente
		$codiceTipo = prelevaIdCategoria($_GET["categoriaRicerca"]);
		
		if($_GET["backNext"]=="1"){
			$idArtisti = " < ".prelevaId($_GET["autoreArtista"]);
			$prima = "SELECT *
						FROM (";
			$dopo = " DESC
					LIMIT 6
					) artistiPagina
				ORDER BY id_artista";
		} else {
			$idArtisti = " > ".prelevaId($_GET["autoreArtista"]);
			$prima = "";
			$dopo = " LIMIT 6";
		}
		
		//è stato specificato sia un testo per la ricerca sia la categoria in cui effettuarla
		if($_GET["categoriaRicerca"]!="" && $_GET["testoRicerca"]!=""){
			$testoRicerca = $db->quote($testoRicerca);
			$query = $prima."SELECT * 
					FROM artisti
					WHERE id_artista ".$idArtisti." AND tipo_artista = ". $codiceTipo." AND MATCH (Artista) 
					AGAINST (".$testoRicerca." IN BOOLEAN MODE) 
					ORDER BY id_artista".$dopo;
			$rows = $db->query($query);
			$queryNumArtisti = "SELECT COUNT(*) AS numero_artisti
					FROM artisti
					WHERE id_artista ".$idArtisti." AND tipo_artista = ". $codiceTipo." AND MATCH (Artista) 
					AGAINST (".$testoRicerca." IN BOOLEAN MODE)";
		} 
		//è stata specificata solo la categoria
		else if($_GET["categoriaRicerca"]!=""){
			$query = $prima."SELECT * 
					FROM artisti
					WHERE id_artista ".$idArtisti." AND tipo_artista = ". $codiceTipo."
					ORDER BY id_artista".$dopo;
			$rows = $db->query($query);
			$queryNumArtisti = "SELECT COUNT(*) AS numero_artisti
					FROM artisti
					WHERE id_artista ".$idArtisti." AND tipo_artista = ". $codiceTipo;
		} 
		//è stata specificato solo il testo della ricerca
		else {
			$testoRicerca = $db->quote($testoRicerca);
			$query = $prima."SELECT * 
					FROM artisti
					WHERE id_artista ".$idArtisti." AND (MATCH (Artista) 
					AGAINST (".$testoRicerca." IN BOOLEAN MODE) OR MATCH (autore_artista) 
					AGAINST (".$testoRicerca." IN BOOLEAN MODE))
					ORDER BY id_artista".$dopo;
			$rows = $db->query($query);	
			$queryNumArtisti = "SELECT COUNT(*) AS numero_artisti
					FROM artisti
					WHERE id_artista ".$idArtisti." AND MATCH (Artista) 
					AGAINST (".$testoRicerca." IN BOOLEAN MODE) OR MATCH (autore_artista) 
					AGAINST (".$testoRicerca." IN BOOLEAN MODE)";
		}
	
		$numArtisti = numArtisti($queryNumArtisti);
		$listaArtisti = ritornaArtisti($rows);
			
		return array("listaArtisti"=>$listaArtisti, "numeroG"=>$numArtisti);
	}catch (PDOException $ex){
		return -1; // errore
	}
}

function prelevaIdCategoria($categoriaRicerca){
	$db = db_connect();
	$codiceTipo = -1;
	if($categoriaRicerca!=""){
		$categoriaRicerca = $db->quote($categoriaRicerca);
		$query1 = "SELECT codice_tipo
				FROM tipo_artista
				WHERE nome_tipo = ".$categoriaRicerca;
		$rows1 = $db->query($query1);
		foreach($rows1 as $row){
			$codiceTipo = $row["codice_tipo"];
		}
	}
	return $codiceTipo;
}

function ritornaArtisti($rows){
	$listaArtisti = array();
	foreach($rows as $row){
		$array = array("Artista"=>utf8_encode($row["Artista"]), "recensione_artista"=>utf8_encode($row["recensione_artista"]),
			"Discendenza"=>utf8_encode($row["Discendenza"]), "descrizione_artista"=>utf8_encode($row["descrizione_artista"]),
			"tipo_artista"=>utf8_encode($row["tipo_artista"]), "immagine_artista"=>utf8_encode($row["immagine_artista"]));
			array_push($listaArtisti, $array);
	}
	return $listaArtisti;
}

function prelevaId($autoreArtista){
	$db = db_connect();
	if($autoreArtista=="Nan"){
		$id_artista = 0;
	} else {
		$autoreArtista = $db->quote($autoreArtista);
		$query1 = "SELECT id_artista
					FROM artisti
					WHERE Artista=".$autoreArtista;
		$rows1 = $db->query($query1);
		$id_artista = null;
		foreach($rows1 as $row){
			$id_artista = $row["id_artista"];
		}
	}
	return $id_artista;
}

function numArtisti($query){
	$db = db_connect();
	$rows = $db->query($query);	
	foreach($rows as $row){
		return $row["numero_artisti"];
	}
}

function prelevaArtisti() {
	try{
		$db = db_connect();
		
		$id_artista = prelevaId($_GET["autoreArtista"]);
		
		if($_GET["backNext"]=="1"){
			$query = "SELECT *
				FROM (
						SELECT *
						FROM artisti
						WHERE id_artista<".$id_artista." 
						ORDER BY id_artista DESC
						LIMIT 6
					) artistiPagina
				ORDER BY id_artista";
			$rows = $db->query($query);
		} else {
			$id_artista = $db->quote($id_artista);
			$query = "SELECT *
				FROM artisti
				WHERE id_artista>".$id_artista." 
				ORDER BY id_artista 
				LIMIT 6";
			$rows = $db->query($query);
		}
		
		$listaArtisti = ritornaArtisti($rows);
		
		$query2 = "SELECT COUNT(*) AS `numero_artisti`
				FROM artisti";
		$rows2 = $db->query($query2);
		
		$numero_artisti = null;
		foreach($rows2 as $row){
			$numero_artisti = $row["numero_artisti"];
		}
		
		
		return array("listaArtisti"=>$listaArtisti, "numeroG"=>$numero_artisti);
	}catch (PDOException $ex){
		return -1; // errore
	}
}

?>