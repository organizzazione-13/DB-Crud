<?php
$dbh = new PDO('mysql:host=192.168.245.1;dbname=dbcrud', 'root', '');

if(
    !isset($_POST['username']) ||
    $_POST['username'] == '' ||
    !isset($_POST['password']) ||
    $_POST['password'] == '') {
        header("location: index.php?err=Inserisci tutti i dati");
        exit;
    }

$sth = $dbh->prepare('SELECT *
FROM tbllogin
WHERE `Username` = ? AND `Password` = md5(?);');
$sth->execute([$_POST['username'], $_POST['password']]);

$res = $sth->fetch(PDO::FETCH_ASSOC);

if(!empty($res)) {
    // esiste
    $idSessione = bin2hex(random_bytes(32));
    setcookie('logged_user', $idSessione, time() + (86400 * 30), "/");
    $idh = $dbh->prepare('INSERT INTO tblsessioni VALUES(?, ?);');
    $idh->execute([$_POST['username'], $idSessione]);
    header("location: ../home/index.php");

}
else {
    //non esiste
    header("location: index.php?err=Dati non corretti");
}
// var_dump($res);