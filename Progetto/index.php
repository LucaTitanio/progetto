<?php include("top.php"); ?>

	<form method="post" id="modulo_login">
		<fieldset>
			<p id="l">Login</p>
			<p>Username:
				<input id="username" type="text" name="name" maxlength="16">
			</p>
			<p>Password:
				<input id="password" type="password" name="password" maxlength="30">
			</p>
			<p id="error"></p>
			<input id="bottone_login" type="submit" value="Log in">
			<p><a href="registrazione.php">Se non hai un account, Clicca QUI!.</a></p>
		</fieldset>
	</form>

<?php include("bottom.php"); ?>