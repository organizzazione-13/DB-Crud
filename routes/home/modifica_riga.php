<?php
$dbh = new PDO ("mysql:host=192.168.245.1;dbname=dbcrud", 'root', '');

$sth = $dbh->prepare('UPDATE tblpersone SET Nome=?, Cognome=?, DataNascita=?, Sesso=?, Reddito=? WHERE Idpersona = ? ;');

$sth->execute([$_POST['nome'],$_POST['cognome'],date_format(date_create_from_format('Y-m-d', $_POST['dataNascita']), 'Ymd'),$_POST['sesso'],$_POST['reddito'], $_POST['scopo']]);

header("location: index.php?".$_POST['params']);
?>