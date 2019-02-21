// Appena la pagina si sarà caricata
$().ready(function () {
    $('#sortExpanded').css('display', 'none');
    $('#sortExpanded').css('opacity', 1);
});

// Controllo per i campi del form
$('.needs-validation').on('submit', function (event) {
    if ($('.needs-validation')[0].checkValidity() === false) {
        event.preventDefault();
        event.stopPropagation();
    } else {
        $('.needs-validation').submit();
        return;
    }
    $('.needs-validation')[0].classList.add('was-validated');
});

// Animazione bottone per aggiungere righe
$('#addEntry').hover(function () {
    $(this).html("Aggiungi una riga");
}, function () {
    $(this).html(`<i class="fas fa-plus"></i>`);
});

// Modifico il form in base al pulsante premuto per aprirlo
$('#entryForm').on('show.bs.modal', function (event) {
    var id = $(event.relatedTarget).data('scopo');
    console.log(id)
    if (id == 'new') { // Nuova riga
        $('.needs-validation')[0].classList.remove('was-validated');
        $('#formGestioneRighe').attr('action', 'aggiungi_riga.php');
        $('#titoloModalForm').text('Aggiungi nuova persona');
    } else { // Modifica riga
        $('#titoloModalForm').text('Modifica i dati inseriti');
        $('#formGestioneRighe').attr('action', 'modifica_riga.php');
    }
    $('#nome').val('');
    $('#cognome').val('');
    $('#nascita').val('');
    $('#reddito').val('10000');
    $('#sesso').val('M');
    $('#nascita').val('1970-01-01');
    $('#scopo').val(id);
});

// Modifico la riga del modal dell'eliminazione
$('#confermaEliminazione').on('show.bs.modal', function (event) {
    var id = $(event.relatedTarget).data('scopo');
    $('#rigaDaEliminare').val(id);
});

$('#sortCollapsed').mouseenter(function () {
    $('#sortCollapsed').css('display', 'none');
    $('#sortExpanded').css('display', 'block');
});

$('#sortExpanded').mouseleave(function () {
    $('#sortExpanded').css('display', 'none');
    $('#sortCollapsed').css('display', 'block');
});

$('.search_input').keyup(function () {
    search($(this).val());
});