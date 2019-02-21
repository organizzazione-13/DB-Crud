<?php

$db = new PDO ("mysql:host=192.168.245.1;dbname=dbcrud", 'root', '');

$stmt = $db->prepare('INSERT INTO tblpersone(Nome, Cognome, DataNascita, Sesso, Reddito) VALUES(?,?,?,?,?);');

$stmt->execute([$_POST['nome'],$_POST['cognome'],$_POST['dataNascita'],$_POST['sesso'],$_POST['reddito']]);

?>