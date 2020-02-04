<?php include("top.php"); ?>

	<form method="post" id="modulo_login">
		<fieldset>
			<p id="l">Modulo di registrazione</p>
			<p>Username:
				<input id="username" type="text" name="name" maxlength="40">
			</p>
			<p>Email:
				<input id="email" type="text" name="name" maxlength="60">
			</p>
			<p>Password:
				<input id="password1" type="password" name="password" maxlength="30" placeholder="minimo 6 caratteri">
			</p>
			<p>Inserisci di nuovo la password:
				<input id="password2" type="password" name="password2" maxlength="30" placeholder="minimo 6 caratteri">
			</p>
			<p id="error"></p>
			<input id="bottone_registra" type="submit" value="Registrati">
		</fieldset>
	</form>

<?php include("bottom.php"); ?>