<?php

$db = new PDO ("mysql:host=192.168.245.1;dbname=dbcrud", 'root', '');

$id=$_POST['id'];
// preparo la query
$query = "DELETE FROM tblpersone WHERE id = :id";
$stmt = $db->prepare($query);

// invio la query
$stmt->bindParam(':id', $id, PDO::PARAM_INT);
?>