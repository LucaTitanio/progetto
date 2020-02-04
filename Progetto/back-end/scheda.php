<?php include_once("db.php");?>
<?php
session_start();

if (isset($_POST["votoUtente"])){
	$return = inserisciVotoUtente($_POST["votoUtente"]);
	$json = json_encode($return);
	print $json;
	
} else if(isset($_POST["numeroPagina"]) && $_POST["nomeArtista"]){
	$return = prelevaCommenti($_POST["numeroPagina"], $_POST["nomeArtista"]);
	if($return!=-1){
		$json = json_encode($return);
		print $json;
	}
} else if(isset($_POST["nomeArtista"])){
	$return = prelevaInformazioniArtista($_POST["nomeArtista"]);
	if($return!=-1){
		$json = json_encode($return);
		print $json;
	}
} else if(isset($_POST["testoCommento"]) && isset($_POST["dataCommento"])){
	$return = inserisciCommento($_POST["testoCommento"], $_POST["dataCommento"]);	
	if($return!=-1){
		$json = json_encode($return);
		print $json;
	}	
}

function inserisciVotoUtente($votoUtente) {
	try{
		$db = db_connect();
		$idArtista = $db->quote($_SESSION["id_artista"]);
		$idUtente = $db->quote($_SESSION["id_utente"]);
		//si inserisce la votazione utente
		$query = "INSERT INTO voto (id_utente, id_artista, voto) 
			VALUES (".$idUtente.", ".$idArtista.", ".$votoUtente.")";
		$res = $db->exec($query);
		if($res){
			$query2 = "UPDATE artisti SET recensione_artista = (SELECT AVG(voto) FROM voto WHERE id_artista=".$idArtista.") WHERE id_artista=".$idArtista;
		$res2 = $db->exec($query2);
			return array("esito_voto"=>"1");
		} else {
			$query = "UPDATE voto SET voto=".$votoUtente." WHERE id_utente=".$idUtente." AND id_artista=".$idArtista;
			$res1 = $db->exec($query);
			$query2 = "UPDATE artisti SET recensione_artista = (SELECT AVG(voto) FROM voto WHERE id_artista=".$idArtista.") WHERE id_artista=".$idArtista;
		$res2 = $db->exec($query2);
			return array("esito_voto"=>"0");
		}
		
		$query2 = "UPDATE artisti SET recensione_artista = (SELECT AVG(voto) FROM voto WHERE id_artista=".$idArtista.") WHERE id_artista=".$idArtista;
		$res2 = $db->exec($query2);
		
		
	}catch (PDOException $ex){
		return -1; // errore
	}
}

function inserisciCommento($testoCommento, $dataCommento) {
	try{
		$db = db_connect();
		$idArtista = $db->quote($_SESSION["id_artista"]);
		$idUtente = $db->quote($_SESSION["id_utente"]);
		$testoCommento = htmlspecialchars($testoCommento);
		
		$testo_Commento = $db->quote($testoCommento);
		$data_Commento = $db->quote($dataCommento);
		//si inserisce il commento utente
		$query = "INSERT INTO commento (id_utente, id_artista, testo_commento, data_commento) VALUES (".$idUtente.", ".$idArtista.", ".$testo_Commento.", ".$data_Commento.")";
		$res = $db->exec($query);
		if($res){
			return array("numero_commenti"=>"1", "nomeUtente"=>$_SESSION["username"]);
		} else {
			return array("numero_commenti"=>"0", "nomeUtente"=>$_SESSION["username"]);
		}
		
	}catch (PDOException $ex){
		return -1; // errore
	}
}

function prelevaInformazioniArtista($nomeArtista) {
	try{
		$db = db_connect();
		$nomeArtista=$db->quote($nomeArtista);
		$query = "SELECT *
				FROM artisti JOIN tipo_artista ON tipo_artista = codice_tipo
				WHERE Artista=".$nomeArtista;
		$rows = $db->query($query);
		$array = null;
		$tipo_artista = null;
		$id_artista = null;
		
		foreach($rows as $row){
			$array = array("Artista"=>utf8_encode($row["Artista"]), "recensione_artista"=>utf8_encode($row["recensione_artista"]),
				"autore_artista"=>utf8_encode($row["autore_artista"]), "descrizione_artista"=>utf8_encode($row["descrizione_artista"]),
				"anno_nascita"=>utf8_encode($row["anno_nascita"]), "immagine_artista"=>utf8_encode($row["immagine_artista"]),
				"tipo_artista"=>utf8_encode($row["nome_tipo"]));
			$id_artista = $row["id_artista"];
			$_SESSION["id_artista"] = $id_artista;
			$tipo_artista = $row["tipo_artista"];
		}
		
		$id_artista=$db->quote($id_artista);
		$query = "SELECT COUNT(voto) AS numero_voti
				FROM voto
				WHERE id_artista = ".$id_artista;
		$rows = $db->query($query);
		foreach($rows as $row){
			$array += array("numero_voti"=>$row["numero_voti"]);
		}
		
		return $array;
		
	}catch (PDOException $ex){
		return -1; // errore
	}
}

function getIdArtista($nomeArtista){
	$db = db_connect();
	$nomeArtista = $db->quote($nomeArtista);
	$query = "SELECT id_artista
			FROM artisti
			WHERE titolo_artista=".$nomeArtista;
	$rows = $db->query($query);
	foreach($rows as $row){
		return $row["id_artista"];
	}
	return -1;
}

function prelevaCommenti($numeroPagina, $nomeArtista) {
	try{
		$db = db_connect();
		$idArtista = $db->quote(getIdArtista($nomeArtista));

		$query = "SELECT username, testo_commento, data_commento 
				FROM commento JOIN utente ON commento.id_utente = utente.id_utente
				WHERE id_artista=".$idArtista."
				ORDER BY data_commento DESC";
		$rows = $db->query($query);
		$numRighe=$rows->rowCount();	
		
		if($numeroPagina == 1){
			$primo = 1;
			$ultimo = 6;
		} else {
			$primo = (($numeroPagina - 1) * 6) + 1;
			$ultimo = $numeroPagina * 6;
		}
	
		$i=0;
		$listaCommenti = array();
		foreach($rows as $row){
			$i = $i + 1;
			if(($primo<= $i) && ($i<= ($ultimo))){
				$array = array("nome_utente"=>$row["username"], "data_commento"=>$row["data_commento"], "testo_commento"=>$row["testo_commento"]);
				array_push($listaCommenti, $array);
				if(sizeof($listaCommenti)==6){
					return array("listaCommenti"=>$listaCommenti, "numeroCommenti"=>$numRighe);
				}
			}
		}
	
		return array("listaCommenti"=>$listaCommenti, "numeroCommenti"=>$numRighe);
	}catch (PDOException $ex){
		return -1; // errore
	}		
}

?>