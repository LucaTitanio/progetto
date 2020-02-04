$(document).ready(function(){
	mostraTBL();
	mostraLista();
	
	$("#tbl .mostraTutti").click(function(event){
		if($("#tbl .mostraTutti").val() == "Mostra tutti ...")
			mostraTBLcompleta();
		else
			mostraTBL();
	});
	
	$("#artistiVisti .mostraTutti").click(function(event){
		if($("#artistiVisti .mostraTutti").val() == "Mostra tutti ...")
			mostraListaCompleta();
		else
			mostraLista();
	});
	
	$("#tbl #modificaTBL").click(function(event){
		location.href = 'tbl.php';
	});

});

//La funzione inserisce i nomi dei titoli della lista dell'utente
function mostraTBL(){
	$.ajax({
		url:"back-end/profiloUtente.php",
		method:"GET",
		data:{tbl:"0"},
		success:function(data){
			data = JSON.parse(data);
			var colonne = $("#tbl .colonne .colonna");
			if((data.listaArtisti.length)==0){
				colonne.eq(0).html("Non sono presenti artisti nella tua lista.")
				$("#tbl #modificaTBL").remove();
			}
			var n=4;
			var meta = 0;
			if((data.listaArtisti.length)<n){
				meta = data.listaArtisti.length;
			} else {
				meta = n;
			}
			
			colonne.eq(0).find("ol").remove();
			colonne.eq(1).find("ol").remove();
			colonne.eq(0).append("<ol></ol>");
			var meta1 = meta + 1;
			colonne.eq(1).append("<ol start="+meta1+"></ol>");
			
			for(var i=0; i<meta; i++){
				colonne.eq(0).find("ol").append("<li>"+ data.listaArtisti[i] +"</li>");
			}

			for(var ii=meta; ii<data.listaArtisti.length; ii++){
				colonne.eq(1).find("ol").append("<li>"+ data.listaArtisti[ii] +"</li>");
			}
			
			$("#tbl .mostraTutti").attr("value", "Mostra tutti ...");
			if(data.numeroG<9)
				$("#tbl .mostraTutti").remove();
			
			var statistiche = $("#statisticheUtente dl > dd");
			statistiche.eq(3).html(data.numeroG);
		},
		error: function(){
			alert("Si e' verificato un errore, riprovare piu' tardi.");
		}
	});
}

function mostraTBLcompleta(){
	$.ajax({
		url:"back-end/profiloUtente.php",
		method:"GET", 
		data:{tbl:"1"},
		success:function(data){
			data = JSON.parse(data);
			var colonne = $("#tbl .colonne .colonna");
			var meta= Math.floor((data.listaArtisti.length)/2);
			if((data.listaArtisti.length)%2>0)
				meta = meta+1;
			colonne.eq(0).find("ol").remove();
			colonne.eq(1).find("ol").remove();
			colonne.eq(0).append("<ol></ol>");
			var meta1 = meta + 1;
			colonne.eq(1).append("<ol start="+meta1+"></ol>");

			colonne = $("#tbl .colonne .colonna");
			
			for(var i=0; i<data.listaArtisti.length; i++){
				if(i<meta)
					colonne.eq(0).find("ol").append("<li>"+ data.listaArtisti[i] +"</li>");
				else
					colonne.eq(1).find("ol").append("<li>"+ data.listaArtisti[i] +"</li>");
			}
			
			$("#tbl .mostraTutti").attr("value", "Mostra meno ...");
		},
		error: function(){
			alert("Si e' verificato un errore, riprovare piu' tardi.");
		}
	});
}

function mostraLista(){
	$.ajax({
		url:"back-end/profiloUtente.php",
		method:"GET",
		data:{lista:"0"},
		success:function(data){
			data = JSON.parse(data);
			var colonne = $("#artistiVisti .colonne .colonna");
			if((data.listaArtisti.length)==0){
				colonne.eq(0).html("Non e' stato visto ancora nessun artista.")
			}
			var n=4;
			var meta = 0;
			if(data.listaArtisti.length<n){
				meta = data.listaArtisti.length;
			} else {
				meta = n;
			}
			
			colonne.eq(0).find("ul").remove();
			colonne.eq(1).find("ul").remove();
			colonne.eq(0).append("<ul></ul>");
			colonne.eq(1).append("<ul></ul>");
			
			for(var i=0; i<meta; i++){
				colonne.eq(0).find("ul").append("<li>"+ data.listaArtisti[i] +"</li>");
			}

			for(var ii=meta; ii<data.listaArtisti.length; ii++){
				colonne.eq(1).find("ul").append("<li>"+ data.listaArtisti[ii] +"</li>");
			}
			
			$("#artistiVisti .mostraTutti").attr("value", "Mostra tutti ...");
			if(data.numeroG<9)
				$("#artistiVisti .mostraTutti").remove();
			
			var statistiche = $("#statisticheUtente dl > dd");
			statistiche.eq(0).html(data.ultimi_sei_mesi);
			statistiche.eq(1).html(data.ultimi_dodici_mesi);
			statistiche.eq(2).html(data.numeroG);
		},
		error: function(){
			alert("Si e' verificato un errore, riprovare piu' tardi.");
		}
	});
}

function mostraListaCompleta(){
	$.ajax({
		url:"back-end/profiloUtente.php",
		method:"GET", 
		data:{lista:"1"},
		success:function(data){
			data = JSON.parse(data);
			var colonne = $("#artistiVisti .colonne .colonna");
			var meta= Math.floor((data.listaArtsti.length)/2);
			if((data.listaArtisti.length)%2>0)
				meta = meta+1;
			colonne.eq(0).find("ul").remove();
			colonne.eq(1).find("ul").remove();
			colonne.eq(0).append("<ul></ul>");
			colonne.eq(1).append("<ul></ul>");

			colonne = $("#artistiVisti .colonne .colonna");
			
			for(var i=0; i<data.listaArtisti.length; i++){
				if(i<meta)
					colonne.eq(0).find("ul").append("<li>"+ data.listaArtisti[i] +"</li>");
				else
					colonne.eq(1).find("ul").append("<li>"+ data.listaArtisti[i] +"</li>");
			}
			
			$("#artistiVisti .mostraTutti").attr("value", "Mostra meno ...");
		},
		error: function(){
			alert("Si e' verificato un errore, riprovare piu' tardi.");
		}
		
	});
}
