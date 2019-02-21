<?php

$dbh = new PDO ("mysql:host=192.168.245.1;dbname=dbcrud", 'root', '');

$sth = $dbh->prepare('DELETE FROM tblpersone WHERE Idpersona = ?');
$sth->execute([$_POST['id']]);

header("location: index.php?".$_POST['params']);