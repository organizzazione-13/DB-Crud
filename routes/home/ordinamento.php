<?php
$db = new PDO ("mysql:host=192.168.245.1;dbname=dbcrud", 'root', '');

$ordinamento=$_GET['elemento'];
$decrescente=$_GET['decrescente']

switch($ordinamento)
{
    case 'nome':
    $query = "SELECT * FROM dbcrud.tblpersone order by Nome";
    if($ordinamento)
    {
        $query = "SELECT * FROM dbcrud.tblpersone order by Nome desc";
    }
    break;
    case 'cognome':
    $query = "SELECT * FROM dbcrud.tblpersone order by Cognome";
    if($ordinamento)
    {
        $query = "SELECT * FROM dbcrud.tblpersone order by Cognome desc";
    }
    break;
    case 'dataNascita':
    $query = "SELECT * FROM dbcrud.tblpersone order by DataNascita";
    if($ordinamento)
    {
        $query = "SELECT * FROM dbcrud.tblpersone order by DataNAsciat desc";
    }
    break;
    case 'sesso':
    $query = "SELECT * FROM dbcrud.tblpersone order by Sesso";
    if($ordinamento)
    {
        $query = "SELECT * FROM dbcrud.tblpersone order by Sessp desc";
    }
    break;
    case 'reddito':
    $query = "SELECT * FROM dbcrud.tblpersone order by Reddito";
    if($ordinamento)
    {
        $query = "SELECT * FROM dbcrud.tblpersone order by Reddito desc";
    }
    break;

    default:
    break;
}


?>