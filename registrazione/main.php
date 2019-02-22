<?php
try {
    $dbh = new PDO ("mysql:host=192.168.245.1;dbname=dbcrud", 'root', '');

    $ith = $dbh->prepare('INSERT INTO tbllogin VALUES(?, md5(?));');
    $ith->execute([$_POST['username'], $_POST['password']]);
    $err = $ith->errorInfo();
    switch($err[0]) {
        case 0000:
            $idSessione = bin2hex(random_bytes(32));
            setcookie('logged_user', $idSessione, time() + (86400 * 30), "/");
            $idh = $dbh->prepare('INSERT INTO tblsessioni VALUES(?, ?);');
            $idh->execute([$_POST['username'], $idSessione]);
            header("location: ../home/index.php");
        break;
        default:
            header("location: index.php?err=C'è stato un errore, riprova");
    }
} catch (Exception $e) {
    header("location: index.php?err=".$e->getMessage());
}
?>