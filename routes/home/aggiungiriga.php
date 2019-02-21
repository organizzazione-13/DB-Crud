<?php

$db = new PDO ("mysql:host=192.168.245.1;dbname=dbcrud", 'root', '');

$sql = "INSERT INTO tblpersone(Nome, Cognome, DataNascita, Sesso, Reddito) VALUES(':Nome',':Cognome',:DataNascita,':Sesso',':Reddito')";
$stmt = $db->prepare($sql);

$nome=$_POST['nome'];
$cognome=$_POST['cognome'];
$dataNascita=$_POST['dataNascita'];
$sesso=$_POST['sesso'];
$reddito=$_POST['reddito'];

$stmt->bindParam(':nome', $nome, PDO::PARAM_STR);
$stmt->bindParam(':cognome', $cognome, PDO::PARAM_STR);
$stmt->bindParam(':dataNascita', $dataNascita, PDO::PARAM_INT);
$stmt->bindParam(':sesso', $sesso, PDO::PARAM_STR);
$stmt->bindParam(':reddito', $reddito, PDO::PARAM_STR);

$stmt->execute();

?>