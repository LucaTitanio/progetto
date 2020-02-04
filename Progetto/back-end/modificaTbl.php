<?php include_once("db.php");?>
<?php
session_start();

if(isset($_POST["genereArtista"]) && isset($_POST["nomeArtista"])){
	$return = registraArtista($_POST["genereArtista"], $_POST["nomeArtista"]);
	if($return!=-1){
		$json = json_encode($return);
		print $json;
	}
} else if((file_get_contents('php://input')!=null)){
	$return = salvaModifiche();
	if($return!=-1){
		$json = json_encode($return);
		print $json;
	}
} 

function getIdArtista($nomeArtista){
	$db = db_connect();
	$nomeArtista = $db->quote($nomeArtista);
	$query = "SELECT id_artista
			FROM artisti
			WHERE Artista=".$nomeArtista;
	$rows = $db->query($query);
	foreach($rows as $row){
		return $row["id_artista"];
	}
	return -1;
}

function registraArtista($genereArtista, $nomeArtista) {
	try{
		$db = db_connect();
		$idArtista = getIdArtista($nomeArtista);
		$idUtente = $db->quote($_SESSION["id_utente"]);
		$res = false;
		
		if($genereArtista == "1"){ //si aggiunge l'artista alla lista dell'utente
			$query1 = "SELECT MAX(genere_artista) AS contatore
						FROM artista_utente
						WHERE id_utente = ".$idUtente;
			$rows = $db->query($query1);
			$contatore = -1;
			foreach($rows as $row){
				$contatore = $row["contatore"];
			}
			if($contatore==-1){
				$contatore=1;
			}
			$contatore= $contatore + 1;
			$query = "INSERT INTO artista_utente (id_artista, id_utente, genere_artista, data)
						VALUES ('".$idArtista."', ".$idUtente.", '".$contatore."', '".date('Y-m-d H:i:s')."')";
			$res = $db->exec($query);
		
		} else { //si aggiunge l'artista alla lista degli artisti visti dell'utente
			$query1 = "SELECT genere_artista
						FROM artista_utente
						WHERE id_utente = ".$idUtente." AND id_artista=".$idArtista;
			$rows = $db->query($query1);
			$genere_artista = -1;
			foreach($rows as $row){
				$genere_artista = $row["genere_artista"];
			}
			
			if($genere_artista == -1){
				$query = "INSERT INTO artista_utente (id_artista, id_utente, genere_artista, data)
							VALUES ('".$idArtista."', ".$idUtente.", '0', '".date('Y-m-d H:i:s')."')";
				$res = $db->exec($query);
			} else {
				$query = "UPDATE artista_utente 
						SET genere_artista=0
						WHERE id_utente=".$idUtente." AND id_artista=".$idArtista;
				$res = $db->exec($query);
			}
		}
		
		if($res){
			return array("esito_inserimento"=>"1");
		} else {
			return array("esito_inserimento"=>"0");
		}
	}catch (PDOException $ex){
		return -1; // errore
	}
}

function salvaModifiche(){
	$artisti = json_decode(file_get_contents('php://input'), true);

	$db = db_connect();
	$idUtente = $db->quote($_SESSION["id_utente"]);
	
	//si eliminano gli artisti dalla tbl dell'utente
	for($j=0; $j<count($artisti["artistiDaEliminare"]); $j++){
		$num = $j + 1;
		$autoreArtista = $db->quote($artisti["artistiDaEliminare"][$j]);
		$query = "DELETE FROM artista_utente 
					WHERE id_utente=".$idUtente." AND id_artista=(SELECT id_artista
																FROM artisti
																WHERE Artista=".$autoreArtista.")";
		$res = $db->exec($query);
	}
	
	//si registrano gli artisti giochi nella lista
	for($ii=0; $ii<count($artisti["artistiVisti"]); $ii++){
		$autoreArtista = $db->quote($artisti["artistiVisti"][$ii]);
		$query = "UPDATE artista_utente 
					SET genere_artista='0', data='".date('Y-m-d H:i:s')."'
					WHERE id_utente=".$idUtente." AND id_artista=(SELECT id_artista
																FROM artisti
																WHERE Artista=".$autoreArtista.")";
		$res = $db->exec($query);
	}
		
	//si modifica l'ordine degli artisti nella lista
	for($i=0; $i<count($artisti["artistiTbl"]); $i++){
		$num = $i + 1;
		$autoreArtista = $db->quote($artisti["artistiTbl"][$i]);
		$query = "UPDATE artista_utente 
					SET genere_artista='".$num."' 
					WHERE id_utente=".$idUtente." AND id_artista=(SELECT id_artista
																FROM artisti
																WHERE Artista=".$autoreArtista.")";
		$res = $db->exec($query);
	}	
	
	return array("esito_modifica"=>"1");
}

?>