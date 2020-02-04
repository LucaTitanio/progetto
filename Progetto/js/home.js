var numeroPagina;
var tipoGenere;
var cerca;

$(document).ready(function(){
	var numeroPagina = 1;
	mostraArtisti("0", "Nan", 1);
	mostraMigliori();
	
	$(".classificheArtisti ol li").click(function(event){
		var nomeArtista = $(this).text();
		location.href = 'schedaArtista.php?nomeArtista=' + nomeArtista;
	});
	
	$(".artista .scheda").click(function(event){
		var nomeArtista = $(this).parent().find("h2").text();
		location.href = 'schedaArtista.php?nomeArtista=' + nomeArtista;
	});
	
	$("#back").click(function(event){
		if(numeroPagina!=1){
			numeroPagina= numeroPagina-1;
			var div = $("#artisti .artista");
			if(cerca!="" || tipoGenere!="")
				mostraArtistiCercati(cerca, tipoGenere, "1", div.eq(0).find("h2").text(), numeroPagina)
			else 
				mostraArtisti("1", div.eq(0).find("h2").text(), numeroPagina);
		}
	});
	
	$("#next").click(function(event){
		var num = $("#scorriPagina p").text();
		var num = num[num.length-1];
		if(numeroPagina<num){
			var div = $("#artisti .artista");
			numeroPagina= numeroPagina+1;
			if(cerca!="" || tipoGenere!="")
				mostraArtistiCercati(cerca, tipoGenere, "0", div.eq(div.length-1).find("h2").text(), numeroPagina)
			else 
				mostraArtisti("0", div.eq(div.length-1).find("h2").text(), numeroPagina);
		}
	});
	
	$("#bottoneCerca").click(function(event){
		cerca = $("#cerca").val();
		tipoGenere = $("#tipoGenere").val();
		if(tipoGenere=="TutteLeCategorie"){
			tipoGenere="";
			if(cerca==""){
				numeroPagina = 1;
				mostraArtisti("0", "Nan", 1);
			}
		}
		numeroPagina = 1;
		if(cerca!="" || tipoGenere!=""){
			mostraArtistiCercati(cerca, tipoGenere, "0", "Nan", numeroPagina);
		}
	});
	
	
});

function mostraArtisti(backNext, autoreArtista, numeroPagina){
	$.ajax({
		url:"back-end/homep.php",
		method:"GET",
		data:{backNext:backNext, autoreArtista:autoreArtista},
		success:function(data){
			data = JSON.parse(data);
			inserisciArtisti(data, numeroPagina);
		},
		error: function(){
			alert("Si e' verificato un errore, riprovare piu' tardi.");
		}
	});
}

function mostraArtistiCercati(cerca, tipoGenere, backNext, autoreArtista, numeroPagina){
	$.ajax({
		url:"back-end/homep.php",
		method:"GET",
		data:{testoRicerca: cerca, categoriaRicerca: tipoGenere, backNext: backNext, autoreArtista: autoreArtista},
		success:function(data){
			data = JSON.parse(data);
			if(data.numeroG=="0")
				$("#erroreRicerca").html("Nessun risultato per la ricerca effettuata.");
			else
				$("#erroreRicerca").html("");
			inserisciArtisti(data, numeroPagina);
		},
		error: function(){
			alert("Si e' verificato un errore, riprovare piu' tardi.");
		}
	});
}

function mostraMigliori(){
	$.ajax({
		url:"back-end/homep.php",
		method:"GET",
		success:function(data){
			data = JSON.parse(data);
			var div = $(".classificheArtisti").eq(1).find("ol li");
			for(var i=0; i<data.miglioriArtisti.length; i++){
				div.eq(i).html(data.miglioriArtisti[i]);
			}
			if(data.miglioriArtisti.length<10){
				for(var ii=data.miglioriArtisti.length; ii<10; ii++){
					div.eq(ii).remove();
				}
			}
			
			var div1 = $(".classificheArtisti").eq(0).find("ol li");
			for(var i=0; i<data.nuoviArtisti.length; i++){
				div1.eq(i).html(data.nuoviArtisti[i]);
			}
			if(data.nuoviArtisti.length<10){
				for(var ii=data.nuoviArtisti.length; ii<10; ii++){
					div1.eq(ii).remove();
				}
			}
		},
		error: function(){
			alert("Si e' verificato un errore, riprovare piu' tardi.");
		}
	});
}

function inserisciArtisti(data, numeroPagina){
	var div = $("#artisti .artista");
	if(data.listaArtisti.length < 6) {
		for(var j=data.listaArtisti.length; j<div.length; j++){
			div.eq(j).remove();
		}
	}
						
	if(div.length < data.listaArtisti.length){
		for(var ii=0; ii<data.listaArtisti.length-div.length; ii++)
			$("#artisti").append("<div class='artista'><h2></h2><div class='recensione2'></div><div class='recensione1'></div><div class='immagine'></div><div class='trama'></div><input class='scheda' type='submit' value='Vai alla scheda artista'></div>");
		}
	$(".artista .scheda").click(function(event){
		var nomeArtista = $(this).parent().find("h2").text();
		location.href = 'schedaArtista.php?nomeArtista=' + nomeArtista;
	});
			
	var div = $("#artisti .artista");
	for(var i=0; i<data.listaArtisti.length; i++){
		div.eq(i).find("h2").html(data.listaArtisti[i].Artista);
		var r1 = data.listaArtisti[i].recensione_artista * 32;
		var r2 = 160 - r1;
		div.eq(i).find(".recensione1").css('background-image', 'url(img/star_1.png)');
		div.eq(i).find(".recensione2").css('width', r2+'px');
		div.eq(i).find(".recensione2").css('background-image', 'url(img/star_2.png)');
		div.eq(i).find(".recensione1").css('width', r1+'px');
		div.eq(i).find(".trama").html(data.listaArtisti[i].descrizione_artista.substring(0, 380) + ' ...');
		div.eq(i).find(".immagine").html("<img src='" + data.listaArtisti[i].immagine_artista + "' alt='" + data.listaArtisti[i].Artista + "' />");
	}

	var numPagina1 = parseInt(data.numeroG / 6);
	var resto = data.numeroG % 6;
	if(resto > 0){
		numPagina1 = numPagina1 + 1;
	}
			
	$("#scorriPagina p").html(numeroPagina + "-" + numPagina1);
	
}

