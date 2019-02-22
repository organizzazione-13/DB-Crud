<?php
$dbh = new PDO('mysql:host=192.168.245.1;dbname=dbcrud', 'root', '');

if(!isset($_COOKIE['logged_user']))
    header("location: ../login/index.php?err=Devi prima effettuare l'accesso");

$controlloUtente = $dbh->prepare('SELECT FKUsername FROM tblsessioni WHERE IdSessione = ?;');
$controlloUtente->execute([$_COOKIE['logged_user']]);
if(!$controlloUtente->fetch(PDO::FETCH_ASSOC))
    header("location: ../login/index.php?err=Sessione non valida");
?><!doctype html>
<html>

<head>
	<meta http-equiv="content-type" content="text/html; charset=utf-8" />

	<title>Tabella</title>

	<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs4-4.1.1/jq-3.3.1/moment-2.18.1/dt-1.10.18/b-1.5.4/r-2.2.2/sl-1.2.6/datatables.min.css">
	<link rel="stylesheet" type="text/css" href="css/generator-base.css">
	<link rel="stylesheet" type="text/css" href="css/editor.bootstrap4.min.css">

	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js"></script>
	<script type="text/javascript" charset="utf-8" src="js/datatables.min.js"></script>
	<script type="text/javascript" charset="utf-8" src="js/dataTables.editor.min.js"></script>
	<script type="text/javascript" charset="utf-8" src="js/editor.bootstrap4.min.js"></script>
	<script type="text/javascript" charset="utf-8" src="js/table.tblpersone.js"></script>
</head>

<body class="bootstrap4">
	<div class="container">

		<table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered" id="tblpersone" width="100%">
			<thead>
				<tr>
					<th>Nome</th>
					<th>Cognome</th>
					<th>Data di nascita</th>
					<th>Reddito</th>
					<th>Sesso</th>
				</tr>
			</thead>
		</table>

	</div>
</body>

</html>