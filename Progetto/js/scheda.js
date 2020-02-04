var numStelle = 0;
//var numCommenti;

$(document).ready(function(){
	var numeroPagina = 1;
	var recensione = $("#recensioneScheda > div");
	var nomeArtista = $("#schedaArtista h2").text();
	mostraInformazioniArtista(nomeArtista);
	mostraCommenti(1, nomeArtista);
	
	//seleziona le stelle della recensione fino alla stella n, dove n rappresenta 
	//la stella su cui l'utente ha posato il mouse
	recensione.mouseover(function(){
		var y=-1;
		for(var i=0; i<recensione.length; i++){
			if(($("#recensioneScheda > div").eq(i)).is($(this)[0]))
				y = i;
		}
		if(y!=-1){
			for(var ii=0; ii<y+1; ii++){
				recensione.eq(ii).css('background-image', 'url(img/star_1.png)');
			}
			for(var j=y+1; j<5; j++){
				recensione.eq(j).css('background-image', 'url(img/star_2.png)');
			}
		}
	});
	
	//quando il mouse esce da #recensioneScheda le stelline vengono riportate al numero originario se
	//non e' stata espressa una recensione con un click
	recensione.mouseout(function(){
		for(var ii=0; ii<numStelle; ii++){
			recensione.eq(ii).css('background-image', 'url(img/star_1.png)');
		}
		for(var j=numStelle; j<5; j++){
			recensione.eq(j).css('background-image', 'url(img/star_2.png)');
		}
		
	});
	
	//quando l'utente clicca su una stellina ne viene individuato il voto corrispondente
	recensione.click(function(){
		var y=-1;
		for(var i=0; i<recensione.length; i++){
			if(($("#recensioneScheda > div").eq(i)).is($(this)[0]))
				y = i+1;
		}
		numStelle = y;
		$.ajax({
		url:"back-end/scheda.php",
		method:"POST",
		data:{votoUtente:numStelle},
		success:function(data){
			data = JSON.parse(data);
			var numeroV = $("#buttonArtista p").text();
			var numeroVoti = numeroV.split(" ");
			var numeroVoti = numeroVoti[0];
			$("#buttonArtista p").html("Grazie!");
			setTimeout(
				function(){
					if(data.esito_voto=="1"){
						$("#buttonArtista p").html(parseInt(numeroVoti) + 1 + " voti");
					} else {
						$("#buttonArtista p").html(numeroV);
					}
					
				}, 1000
			);
		},
		error: function(){
			alert("Si e' verificato un errore, riprovare piu' tardi.");
		}
		});
	});
	
	$("#artistaDaVedere").click(function(event){
		registraArtista(1);
	});
	
function registraArtista(genereArtista){
	var nomeArtista = $("#schedaArtista h2").text();
	var s = null;
	if(genereArtista == 1)
		s = "nella lista";
	else
		s = " negli artisti visti";
	
	$.ajax({
		url:"back-end/modificaTbl.php",
		method:"POST",
		data:{genereArtista:genereArtista, nomeArtista:nomeArtista},
		success:function(data){
			data = JSON.parse(data);
			var registrazione = $("#registrazione");
			if(data.esito_inserimento=="1"){
				$("#registrazione").html("Artista inserito " + s);
			} else {
				$("#registrazione").html("Artista gia'  inserito " + s);
			}
			setTimeout(
				function(){
					$("#registrazione").html("");
				}, 1500
			);			
			},
			error: function(){
				alert("Si e' verificato un errore, riprovare piu' tardi.");
			} 
		});
	
}
	
	$("#artistaVisto").click(function(event){
		registraArtista(0);
	});
	
	$("#back").click(function(event){
		if(numeroPagina!=1){
			numeroPagina= numeroPagina-1;
			var nomeArtista = $("#schedaArtista h2").text();
			mostraCommenti(numeroPagina, nomeArtista);
		}
	});
	
	$("#next").click(function(event){
		var num = $("#scorriPagina p").text();
		var num = num[num.length-1];
		if(numeroPagina<num){
			numeroPagina= numeroPagina+1;
			var nomeArtista = $("#schedaArtista h2").text();
			mostraCommenti(numeroPagina, nomeArtista);
		}
	});
	
	$("#buttonScrivi").click(function(event){
		var testoCommento = $("#scriviCommento textarea").val();
		if(testoCommento != ""){
			var data = new Date();
			var dd = data.getDate();
			var mm = data.getMonth()+1;
			var yyyy = data.getFullYear();
			if(dd<10) dd = '0'+dd;
			if(mm<10) mm = '0'+mm;
			var data1 = yyyy + '-' + mm + '-' + dd + " " + data.getHours() + ":" + data.getMinutes() + ":" + data.getSeconds();
			inserisciCommento(testoCommento, data1);
		}
	});
});

function inserisciCommento(testoCommento, dataCommento){
	$.ajax({
		url:"back-end/scheda.php",
		method:"POST",
		data:{testoCommento:testoCommento, dataCommento:dataCommento},
		success:function(data){
			data = JSON.parse(data);
			if(data.numero_commenti!="0"){
				numeroPagina = 1;
				var nomeArtista = $("#schedaArtista h2").text();
				mostraCommenti(numeroPagina, nomeArtista);
				$("#scriviCommento textarea").val("");
			}
		},
		error: function(){
			alert("Si e' verificato un errore, riprovare piu' tardi.");
		} 
	});
}

function mostraInformazioniArtista(nomeArtista){
	$.ajax({
		url:"back-end/scheda.php",
		method:"POST",
		data:{nomeArtista:nomeArtista},
		success:function(data){
			data = JSON.parse(data);
			$("#descrizioneScheda").append(data.descrizione_artista);
			$("#buttonArtista p").html(data.numero_voti + " voti");
			var recensione = $("#recensioneScheda > div");
			numStelle = data.recensione_artista;
			for(var i=0; i<data.recensione_artista; i++){
				recensione.eq(i).css('background-image', 'url(img/star_1.png)');
			}
			var infoArtista = $("#infoArtista dl > dd");
			infoArtista[0].append(data.autore_artista);
			infoArtista[1].append(data.anno_nascita);
			infoArtista[2].append(data.tipo_artista);
			infoArtista[3].append(data.recensione_artista+"/5");
			$("#immagineScheda").html("<img src='" + data.immagine_artista + "' alt='" + data.Artista + "' />");
		},
		error: function(){
			alert("Si e' verificato un errore, riprovare piu' tardi.");
		}
	});
}

function mostraCommenti(numeroPagina, nomeArtista){
	$.ajax({
		url:"back-end/scheda.php",
		method:"POST",
		data:{numeroPagina:numeroPagina, nomeArtista:nomeArtista},
		success:function(data){
			data = JSON.parse(data);
			var commenti = $("#finestraCommenti .commento");
			
			if(data.listaCommenti.length<6){
				for(var j=data.listaCommenti.length; j<commenti.length; j++){
					commenti.eq(j).remove();
				}
			}
			
			if(commenti.length < data.listaCommenti.length){
				for(var ii=0; ii<data.listaCommenti.length-commenti.length; ii++)
					$("#finestraCommenti").append("<div class='commento'><img src='img/user1.png' alt='userimg'><div class='nomeUtente'=></div><div class='dataCommento'></div><div class='testoCommmento'></div></div>");
			}
			
			commenti = $("#finestraCommenti .commento");
			for(var i=0; i<data.listaCommenti.length; i++){
				commenti.eq(i).find(".nomeUtente").html(data.listaCommenti[i].nome_utente);
				commenti.eq(i).find(".testoCommmento").html(data.listaCommenti[i].testo_commento);
				var dataCommento = data.listaCommenti[i].data_commento.split("-");
				commenti.eq(i).find(".dataCommento").html(dataCommento[2].substring(0, 2)+"/" + dataCommento[1] + "/" + dataCommento[0]);
			}
				
			if(data.numeroCommenti==0){
				$("#finestraCommenti").append("<p>Non ci sono commenti per questo artista.</p>");
				$("#scorriPagina p").html(numeroPagina + "-1");
			
			} else {
				if(data.numeroCommenti==1){ 
					$("#finestraCommenti p").remove();
				}
				var numPagina1 = parseInt(data.numeroCommenti / 6);
				var resto = data.numeroCommenti % 6;
				if(resto > 0){
					numPagina1 = numPagina1 + 1;
				}
				$("#scorriPagina p").html(numeroPagina + "-" + numPagina1);
			}
		},
		error: function(){
			alert("Si e' verificato un errore, riprovare piu' tardi.");
		}
	});
}