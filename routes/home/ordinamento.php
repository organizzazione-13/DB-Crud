<?php
$db = new PDO ("mysql:host=192.168.245.1;dbname=dbcrud", 'root', '');

$ordinamento=$_GET['elemento'];
$decrescente=$_GET['decrescente'];

switch($ordinamento)
{
    case 'nome':
        $query = "order by Nome";
        if($ordinamento)
        {
            $query .= "order by Nome desc";
        }
    break;
    case 'cognome':
        $query = "order by Cognome";
        if($ordinamento)
        {
            $query .= "order by Cognome desc";
        }
    break;
    case 'dataNascita':
        $query = "order by DataNascita";
        if($ordinamento)
        {
            $query .= "order by DataNAsciat desc";
        }
    break;
    case 'sesso':
        $query = "order by Sesso";
        if($ordinamento)
        {
            $query .= "order by Sessp desc";
        }
    break;
    case 'reddito':
        $query = "order by Reddito";
        if($ordinamento)
        {
            $query .= "order by Reddito desc";
        }
    break;
    default:
    break;
}
?>