<?php
$dbh = new PDO('mysql:host=192.168.245.1;dbname=dbcrud', 'root', '');

if(!isset($_COOKIE['logged_user']))
    header("location: DB-CRUD/routes/login/index.php?err=Devi prima effettuare l'accesso");

$controlloUtente = $dbh->prepare('SELECT FKUsername FROM tblsessioni WHERE IdSessione = ?;');
$controlloUtente->execute([$_COOKIE['logged_user']]);
if(!$controlloUtente->fetch(PDO::FETCH_ASSOC))
    header("location: /DB-CRUD/routes/login/index.php?err=Sessione non valida");
$pag = $_GET['p'] ?? 1; // pagina attuale
$elemPerPag = $_GET['e'] ?? 10; // elementi per pagina
$decrescente = $_GET['decrescente'] ?? false;
unset($_GET['decrescente']);
$elemento = $_GET['elemento'] ?? 'none';
unset($_GET['elemento']);

$querySort = '';
switch($elemento)
{
    case 'nome':
        $querySort = "order by Nome";
        if($decrescente)
        {
            $querySort .= " desc";
        }
    break;
    case 'cognome':
        $querySort = "order by Cognome";
        if($decrescente)
        {
            $querySort .= " desc";
        }
    break;
    case 'dataNascita':
        $querySort = "order by DataNascita";
        if($decrescente)
        {
            $querySort .= " desc";
        }
    break;
    case 'sesso':
        $querySort = "order by Sesso";
        if($decrescente)
        {
            $querySort .= " desc";
        }
    break;
    case 'reddito':
        $querySort = "order by Reddito";
        if($decrescente)
        {
            $querySort .= " desc";
        }
    break;
    default:
    break;
}

$sth = $dbh->query("SELECT * FROM tblpersone ".$querySort.";");
$records = $sth->fetchAll(PDO::FETCH_ASSOC);

$pagMax = ceil(count($records)/ $elemPerPag);
if($pag > $pagMax) $pag = $pagMax;
if($pag < 1) $pag = 1;



$icone = [
    'alpha' => 'fa-sort-alpha',
    'numeric' => 'fa-sort-numeric',
    'amount' => 'fa-sort-amount'
];

?>
<!DOCTYPE html>
<html lang="it">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>C.R.U.D</title>
    <!--Inclusione delle librerie necessarie-->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS"
        crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr"
        crossorigin="anonymous">
    <link rel="stylesheet" href="stylesheets/main.css">
    <link href="https://fonts.googleapis.com/css?family=Raleway" rel="stylesheet"> <!-- modificato -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo"
        crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js" integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut"
        crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js" integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k"
        crossorigin="anonymous"></script>
</head>

<body class="default">
    <!--Creazione tabella superiore-->
    <div id="no-more-tables">
        <table class="table table-striped text-center table-sm">
            <thead class="table-bordered">
                <tr class="row">
                    <th class="col-2" scope="col">Nome<a href="index.php?elemento=nome&<?php if(!$decrescente) echo 'decrescente=true&'; echo http_build_query($_GET); ?>"><i id="sortNome" class="pointer sort ml-2 fas <?php echo ($elemento == 'nome' ? $icone['alpha'].($decrescente  ? '-up' : '-down') : 'fa-sort'); ?>"></i></th>
                    <th class="col-2" scope="col">Cognome<a href="index.php?elemento=cognome&<?php if(!$decrescente) echo 'decrescente=true&'; echo http_build_query($_GET); ?>"><i id="sortCognome" class="pointer sort ml-2 fas <?php echo ($elemento == 'cognome' ? $icone['alpha'].($decrescente  ? '-up' : '-down') : 'fa-sort'); ?>"></i></th>
                    <th class="col-2" scope="col">Nascita<a href="index.php?elemento=dataNascita&<?php if(!$decrescente) echo 'decrescente=true&'; echo http_build_query($_GET); ?>"><i id="sortNascita" class="pointer sort ml-2 fas <?php echo ($elemento == 'dataNascita' ? $icone['numeric'].($decrescente  ? '-up' : '-down') : 'fa-sort'); ?>"></i></th>
                    <th class="col-2" scope="col">Reddito<a href="index.php?elemento=reddito&<?php if(!$decrescente) echo 'decrescente=true&'; echo http_build_query($_GET); ?>"><i id="sortReddito" class="pointer sort ml-2 fas <?php echo ($elemento == 'reddito' ? $icone['numeric'].($decrescente  ? '-up' : '-down') : 'fa-sort'); ?>"></i></th>
                    <th class="col-2" scope="col">Sesso<a href="index.php?elemento=sesso&<?php if(!$decrescente) echo 'decrescente=true&'; echo http_build_query($_GET); ?>"><i id="sortSesso" class="pointer sort ml-2 fas <?php echo ($elemento == 'sesso' ? $icone['amount'].($decrescente ? '-up' : '-down') : 'fa-sort'); ?>"></i></th>
                    <th class="col-2" scope="col">Comandi</th>
                </tr>
            </thead>
            <tbody id="records">
                <?php
                $slice = array_slice($records, ($pag - 1) * $elemPerPag, $elemPerPag);

                foreach($slice as $record) {
                    echo '
<tr class="record row">
    <td class="col-2" data-title="Nome">'.$record['Nome'].'</td>
    <td class="col-2" data-title="Cognome">'.$record['Cognome'].'</td>
    <td class="col-2" data-title="Nascita">'.date_format(date_create_from_format('Ymd', str_pad($record['DataNascita'],8,"0", STR_PAD_LEFT)), 'd/m/Y').'</td>
    <td class="col-2" data-title="Reddito">'.$record['Reddito'].'</td>
    <td class="col-2" data-title="Sesso">'.$record['Sesso'].'</td>
    <td class="col-2" data-title="Comandi">
        <span data-toggle="modal" data-target="#entryForm" data-scopo="'.$record['Idpersona'].'">
            <button type="button" class="btn btn-outline-dark" data-toggle="tooltip" data-placement="left" title="Modifica"><i class="fas fa-edit"></i></button>
        </span>
        <span data-toggle="modal" data-target="#confermaEliminazione" data-scopo="'.$record['Idpersona'].'">
            <button type="button" class="btn btn-outline-danger" data-toggle="tooltip" data-placement="right" title="Elimina"><i class="fas fa-trash"></i></button>
        </span>
    </td>
</tr>
';
                }


                ?>
            </tbody>
        </table>
    </div>
    <!--Bottone per aggiunta di nuovi elementi nell'elenco-->
    <button id="addEntry" type="button" class="btn btn-outline-dark" data-toggle="modal" data-target="#entryForm"
        data-scopo="new"><i class="fas fa-plus"></i> </button>
    <!--  bottone del paginatore-->
    <button id="sortCollapsed" type="button" class="btn btn-outline-dark">
        <?php echo $pag; ?></button>
    <!--Istanziazione del paginatore-->
    <div id="sortExpanded">
        <a href="index.php?p=1&e=<?php echo $elemPerPag.'&'.http_build_query($_GET); ?>"><button type="button" id="firstPage" class="btn btn-outline-dark navigation">&laquo;</button></a>
        <a href="index.php?p=<?php echo ($pag > 1  ? $pag - 1 : 1); ?>&e=<?php echo $elemPerPag.'&'.http_build_query($_GET); ?>"><button type="button"
                id="previousPage" class="btn btn-outline-dark navigation expandedButton">&lt;</button></a>
        <?php
            for($i = $pag - 2; $i <= $pag + 2; $i++) {
                if($i != $pag && $i > 0 && $i <= $pagMax)
                    echo '<a href="index.php?p='.$i.'&e='.$elemPerPag.'&'.http_build_query($_GET).'"><button type="button" class="btn btn-outline-dark navigation expandedButton pageButton">'.$i.'</button></a>';
            }
        ?>
        <a href="index.php?p=<?php echo ($pag < $pagMax ? $pag + 1 : $pag); ?>&e=<?php echo $elemPerPag.'&'.http_build_query($_GET); ?>"><button
                type="button" id="nextPage" class="btn btn-outline-dark navigation expandedButton">&gt;</button></a>
        <a href="index.php?p=<?php echo $pagMax; ?>&e=<?php echo $elemPerPag.'&'.http_build_query($_GET); ?>"><button type="button" id="lastPage"
                class="btn btn-outline-dark navigation">&raquo;</button></a>
    </div>

    <!--Istanziazione research bar-->
    <div class="container h-100">
        <div class="d-flex justify-content-center h-100">
            <div class="searchbar">
                <input class="search_input" type="text" placeholder="Cerca...">
                <i class=" search_icon fas fa-search"></i>
            </div>
        </div>
    </div>

    <!--Apertura form modale che effettua i vari controlli sui campi-->
    <div class="modal fade" id="entryForm" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title container-fluid text-center" id="titoloModalForm">placeholder</h5>
                </div>
                <form id="formGestioneRighe" class="needs-validation" method="POST" novalidate>
                    <div class="modal-body" id="bodyModalForm">
                        <input type="hidden" class="form-control" id="scopo" name="scopo">
                        <input type="hidden" name="params" value='<?php echo http_build_query($_GET); ?>'>
                        <div class="form-group row justify-content-between">
                            <label class="col-3 col-form-label">Nome</label>
                            <div class="col-7">
                                <!--inserisce la textbox  e controlla che i campi non siano vuoti o con valori non accettabili -->
                                <input type="text" class="form-control" id="nome" name="nome" minlength="2" maxlength="45"
                                    pattern="[a-zA-Z .']+" required>
                                <div class="invalid-feedback">
                                    Inserisci un nome valido.
                                </div>
                            </div>
                        </div>
                        <div class="form-group row justify-content-between">
                            <label class="col-3 col-form-label">Cognome</label>
                            <div class="col-7">
                                <!--inserisce la textbox  e controlla che i campi non siano vuoti o con valori non accettabili -->
                                <input type="text" class="form-control" id="cognome" name="cognome" minlength="2"
                                    maxlength="45" pattern="[a-zA-Z .']+" required>
                                <div class="invalid-feedback">
                                    Inserisci un cognome valido.
                                </div>
                            </div>
                        </div>
                        <div class="form-group row justify-content-between">
                            <label class="col-3 col-form-label">Nascita</label>
                            <div class="col-7">
                                <input type="date" class="form-control" id="nascita" name="dataNascita" required>
                                <div class="invalid-feedback">
                                    Inserisci una data valida.
                                </div>
                            </div>
                        </div>
                        <div class="form-group row justify-content-between">
                            <label class="col-3 col-form-label">Reddito</label>
                            <div class="col-7">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">€</span>
                                    </div>
                                    <select class="form-control" id="reddito" name="reddito">
                                        <option value="10000">Fino a 10000</option>
                                        <option value="20000">10-25000</option>
                                        <option value="30000">25-40000</option>
                                        <option value="40000">Più di 40000</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="form-group row justify-content-between">
                            <label class="col-3 col-form-label">Sesso</label>
                            <div class="col-7">
                                <div class="input-group">
                                    <select class="form-control" id="sesso" name="sesso">
                                        <option value="M">Uomo</option>
                                        <option value="F">Donna</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary ml-auto" data-dismiss="modal">Chiudi</button>
                        <button type="submit" class="btn btn-primary mr-auto">Salva</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!--Apertura modulo conferma eliminazione elemento-->
    <div class="modal fade" id="confermaEliminazione" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title container-fluid text-center ">ATTENZIONE</h5>
                </div>
                <div class="modal-body">
                    Sicuro di voler eliminare questa riga?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
                    <form action="elimina_riga.php" method="POST">
                        <input id="rigaDaEliminare" type="hidden" name="id">
                        <input type="hidden" name="params" value='<?php echo http_build_query($_GET); ?>'>
                        <button type="submit" class="btn btn-danger delete">Sì</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src="js/main.js"></script>
</body>

</html>