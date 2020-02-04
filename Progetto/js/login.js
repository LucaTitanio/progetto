$(document).ready(function(){
	$("#bottone_login").click(function(event){
		event.preventDefault();
		// si recuperano i dati inseriti nei campi password e username
		var username = $('#username').val();
		var password = $('#password').val();
		
		if(password.includes(" ") || username.includes(" ")){
			username = username.replace(/[" "]/g, "");
			password = username.replace(/[" "]/g, "");
		}
		// Se i campi 'username' e 'password' sono mancanti, viene segnalato all'utente un'errore.
		if(username == "" || password == ""){
			$("#error").html("Devi riempire tutti i campi per fare il login."); 
		}
		if(username != "" && password != ""){
			//Invio le variabili al database
			$.ajax({
				url:"back-end/login.php",
				method:"POST",
				data:{username:username, password:password},
				success:function(data){
					data = JSON.parse(data);
					data = data.esito;
					//Se il risultato ha dato esito positivo (credenziali valide), si viene reindirizzati alla home
					if(data == "1"){
						window.location.replace("http://localhost/progetto/home.php");
					} else if(data == "0"){
						$("#error").html("Password o username non corretti.");
					} else if(data == "-2"){
						$("#error").html("E' stato riscontrato un errore, riprova piu' tardi.");
					}
				},
				error: function(){
					alert("Si e' verificato un errore, riprovare piu' tardi.");
				}
			});
		}	
	});
	
	$("p").focusin(function(){
        $("#error").html("");
    });
	
	// funzione sul bottone 'registrati'.
	$("#bottone_registra").click(function(event){
		event.preventDefault();
		
		var username1 = $('#username').val();
		var email = $('#email').val();
		var password1 = $('#password1').val();
		var password2 = $('#password2').val();
		
		username1 = username1.replace(/[" "]/g, "");
		email = email.replace(/[" "]/g, "");
		password1 = password1.replace(/[" "]/g, "");
		password2 = password2.replace(/[" "]/g, "");
		
		var myRegEx = /^[A-z0-9\.\+_-]+@[A-z0-9\._-]+\.[A-z]{2,6}$/;
		
		if(username == "" || email == "" || password1 == "" || password2 == ""){
			$("#error").html("Devi riempire tutti i campi per registrarti.");
		} else if(password1.length<6){
			$("#error").html("La password deve avere almeno 6 caratteri.");
		} else if(password1 != "" && password2 != "" && password1 != password2){
			$("#error").html("Le password inserite non sono uguali.");
		}else if(!myRegEx.test(email)){										//Eseguo il test per vedere se l'email ha caratteri non validi.
			$("#error").html("Indirizzo email non valido.");
		} else {
			//Invio i dati per la registrazione al database.
			$.ajax({
				url:"back-end/login.php",
				method:"POST",
				data:{username:username1, email:email, password:password1},
				success:function(data){
					data = JSON.parse(data);
					data = data.esito;
					//Se la registrazione ÃÂ¨ andata a buon fine, si viene reindirizzati alla home
					if(data == "1"){
						window.location.replace("http://localhost/progetto/home.php");
					} else if(data == "0"){
						$("#error").html("Username gia' esistente.");
					} else if(data == "2"){
						$("#error").html("Email gia'  in uso.");
					}
				},
				error: function(){
					alert("Si e' verificato un errore, riprovare piu' tardi.");
				}
			});
		}	
	});
	
});
