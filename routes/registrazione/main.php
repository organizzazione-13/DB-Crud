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
            header("location: /DB-CRUD/routes/home/index.php");
        break;
        default:
        echo "Errore: " . $err[2];
        die();
    }
} catch (Exception $e) {
    echo "Errore: " . $e->getMessage();
    die();
}
?>