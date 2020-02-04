<?php include_once("db.php");?>
<?php
session_start();

if(isset($_GET["tbl"])){
	$return = prelevaArtisti($_GET["tbl"], "1");
	if($return!=-1){
		$json = json_encode($return);
		print $json;
	}
} else if(isset($_GET["lista"])){
	$return = prelevaArtisti($_GET["lista"], "0");
	if($return!=-1){
		$json = json_encode($return);
		print $json;
	}
}

function prelevaArtisti($tbl, $genereArtista) {
	try{
		$db = db_connect();
		$idUtente = $db->quote($_SESSION["id_utente"]);
		$ordina = null;
		if($genereArtista == "1"){
			$genereArtista = ">0";
			$ordina = "genere_artista";
		} else {
			$genereArtista = "=0";
			$ordina = "data DESC";
		}
		if($tbl=="0"){
			$query = "SELECT Artista
					FROM artista_utente JOIN artisti ON artista_utente.id_artista = artisti.id_artista
					WHERE genere_artista".$genereArtista." AND id_utente  = ".$idUtente."
					ORDER BY ".$ordina."
					LIMIT 8";
		} else {
			$query = "SELECT Artista
					FROM artista_utente JOIN artisti ON artista_utente.id_artista = artisti.id_artista
					WHERE genere_artista ".$genereArtista." AND id_utente  = ".$idUtente."
					ORDER BY ".$ordina;
		}
		$rows = $db->query($query);
		$listaArtisti = array();
		foreach($rows as $row){
			$array = array($row["Artista"]);
			array_push($listaArtisti, $row["Artista"]);
		}
		
		$query = "SELECT COUNT(*) AS numero_visti
				FROM artista_utente JOIN artisti ON artista_utente.id_artista = artisti.id_artista
				WHERE genere_artista".$genereArtista." AND id_utente  = ".$idUtente;
		$rows = $db->query($query);
		foreach($rows as $row){
			if($genereArtista == "=0" && $tbl=="0"){
				$statistiche = statisticheUtente();
				return array("listaArtisti"=>$listaArtisti, "numeroVisti"=>$row["numero_visti"], "ultimi_sei_mesi"=>$statistiche["ultimi_sei_mesi"], "ultimi_dodici_mesi"=>$statistiche["ultimi_dodici_mesi"]);
			} else {
				return array("listaArtisti"=>$listaArtisti, "numeroVisti"=>$row["numero_visti"]);
			}
		}
		
	}catch (PDOException $ex){
		return -1; // errore
	}
}

function statisticheUtente(){
	try{
		$db = db_connect();
		$idUtente = $db->quote($_SESSION["id_utente"]);
		$date = date('Y-m-d H:i:s', strtotime("-6 months"));
		$statistiche = null;
		
		$query = "SELECT COUNT(*) AS numero_visti
				FROM artista_utente
				WHERE genere_artista = 0 AND id_utente  = ".$idUtente." AND data > '".$date."'";
		
		$rows = $db->query($query);
		foreach($rows as $row){
			$statistiche = array("ultimi_sei_mesi"=>$row["numero_visti"]);
		}
		
		$date = date('Y-m-d H:i:s', strtotime("-12 months"));
		$query = "SELECT COUNT(*) AS numero_visti
				FROM artista_utente
				WHERE genere_artista = 0 AND id_utente  = ".$idUtente." AND data > '".$date."'";
		$rows = $db->query($query);
		foreach($rows as $row){
			$statistiche = array_merge($statistiche, array("ultimi_dodici_mesi"=>$row["numero_visti"]));
		}
		
		return $statistiche;
		
	}catch (PDOException $ex){
		return -1; // errore
	}
}




?>