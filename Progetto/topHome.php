<!DOCTYPE html> 
<?php 
session_start();
if(!isset($_SESSION["id_utente"]))
	header("location: index.php");
?>
<html>
<head>
<title>Artisti si nasce</title>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
	<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
	<link href="img/icon.png" type="image/png" rel="icon">
	<link href="css/style.css" type="text/css" rel="stylesheet" />
	<script src="js/comon.js"></script>
</head>
<body>
	<div id="banner1">
	<div id="banner11">
		<img src="img/logo.png" alt="banner logo">
		<h1>Artisti si nasce</h1>
			<div id="menu">
				<button id="bottoneProfilo" type="button">Profilo</button> 
				<button id="bottoneHome" type="button">Home</button> 
				<a id="bottoneLogOut" href="logout.php">Log out</a>
			</div>
	</div>
	</div>
