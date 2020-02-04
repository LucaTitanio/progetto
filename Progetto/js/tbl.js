$(document).ready(function(){
	mostraTBLcompleta();
	var artistiDaEliminare = [];
	var artistiVisti = [];
	
	$('ul').sortable({
    });

    $('#cestino').droppable({
        drop: function (event, ui) {
			$(ui.draggable).remove();
			aggiornaNumerazione();
			artistiDaEliminare.push($(ui.draggable).text());
		},
		hoverClass: 'hovering',
		tolerance: 'pointer'
    });
	
	$('#visto').droppable({
        drop: function (event, ui) {
			$(ui.draggable).remove();
			aggiornaNumerazione();
			artistiVisti.push($(ui.draggable).text());
		},
		hoverClass: 'hovering',
		tolerance: 'pointer'
    });
	
	$("#tbl #modificaTBL").click(function(event){
		var li = $("#tbl #colonna ul li");
			var artistiTbl = [];
		for(var i=0; i<li.length; i++){
			artistiTbl.push(li.eq(i).text());
		}
			
		var artisti = {artistiTbl: artistiTbl, artistiDaEliminare: artistiDaEliminare, artistiVisti: artistiVisti};
		$.ajax({
		url:"back-end/modificaTbl.php",
		method:"POST", 
		contentType: "application/json",
		data: JSON.stringify(artisti),
		success:function(data){
			if(data.length!=0){
				data = JSON.parse(data);
				if(data.esito_modifica == "1"){
					$("#esitoModifiche").html("Modifiche salvate");
				}
				setTimeout(
				function(){
					$("#esitoModifiche").html("");
				}, 1500
				);
			}		
			},
			error: function(){
				alert("Si e' verificato un errore, riprovare piu' tardi.");
			}
		});
	});

});

function aggiornaNumerazione(){
	var numerazione = $("#tbl #numerazione");
	var num = $("#tbl #numerazione").text();
	num = num.split(".");
	var t = $("#tbl #numerazione").text().replace(num[num.length-2]+ ".", "");
	$("#tbl #numerazione").html(t);
}

function mostraTBLcompleta(){
	$.ajax({
		url:"back-end/profiloUtente.php",
		method:"GET", 
		data:{tbl:"1"},
		success:function(data){
			data = JSON.parse(data);
			var colonne = $("#tbl #colonna");
			var num = $("#tbl #numerazione");
			for(var i=0; i<data.listaArtisti.length; i++){
				colonne.find("ul").append("<li>"+ data.listaArtisti[i] +"</li>");
				num.append((i+1)+".\n");
			}	
		},
		error: function(){
			alert("Si e' verificato un errore, riprovare piu' tardi.");
		}
	});
}
