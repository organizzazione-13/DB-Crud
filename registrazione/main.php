
<?php

$hostname = "localhost";
    $dbname = "dbcrud";
    $user = "root";
    $pass = "";
$username = $_POST["username"] ;
$password = $_POST ["password"]; 
 
try {
    $db = new PDO ("mysql:host=$hostname;dbname=$dbname", $user, $pass,array(
        PDO::ATTR_PERSISTENT => true
    ));

    $sql = "INSERT INTO tbllogin('Username','Password') VALUES(:username,:password)";
    $stmt = $db->prepare($sql);
    $stmt->bindValue(':username', $username, PDO::PARAM_STR);
    $stmt->bindValue(':password', $password, PDO::PARAM_STR);

} catch (PDOException $e) {
    echo "Errore: " . $e->getMessage();
    die();
}

?>