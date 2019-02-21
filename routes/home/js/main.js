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
    }
    $('#nome').val('');
    $('#cognome').val('');
    $('#nascita').val('');
    $('#reddito').val('Basso');
    $('#sesso').val('M');
    $('#nascita').val('1970-01-01');
    $('#scopo').val(id);
});

// Modifico la riga del modal dell'eliminazione
$('#confermaEliminazione').on('show.bs.modal', function (event) {
    var id = $(event.relatedTarget).data('scopo');
    $('#rigaDaEliminare').val(id);
});

$('.sort').click(function (evt) {
    $('.sort').removeClass(function (index, className) {
        return (className.match(/\bfa-\S+/g) || []).join(' ');
    });
    $('.sort').addClass('fa-sort');
    switch (evt.target.id) {
        case 'sortNome':
            $('#' + evt.target.id).removeClass('fa-sort');
            if ($('#' + evt.target.id).hasClass('selected')) {
                $('#' + evt.target.id).addClass('fa-sort-alpha-up');
                $('#' + evt.target.id).removeClass('selected');
                sort.invertito = true;
            } else {
                $('#' + evt.target.id).addClass('fa-sort-alpha-down');
                $('#' + evt.target.id).addClass('selected');
                sort.invertito = false;
            }
            sort.cosa = 'nome';
            updateRecords();
            break;
        case 'sortCognome':
            $('#' + evt.target.id).removeClass('fa-sort');
            if ($('#' + evt.target.id).hasClass('selected')) {
                $('#' + evt.target.id).addClass('fa-sort-alpha-up');
                $('#' + evt.target.id).removeClass('selected');
                sort.invertito = true;
            } else {
                $('#' + evt.target.id).addClass('fa-sort-alpha-down');
                $('#' + evt.target.id).addClass('selected');
                sort.invertito = false;
            }
            sort.cosa = 'cognome';
            updateRecords();
            break;
        case 'sortNascita':
            $('#' + evt.target.id).removeClass('fa-sort');
            if ($('#' + evt.target.id).hasClass('selected')) {
                $('#' + evt.target.id).addClass('fa-sort-numeric-up');
                $('#' + evt.target.id).removeClass('selected');
                sort.invertito = true;
            } else {
                $('#' + evt.target.id).addClass('fa-sort-numeric-down');
                $('#' + evt.target.id).addClass('selected');
                sort.invertito = false;
            }
            sort.cosa = 'nascita';
            updateRecords();
            break;
        case 'sortReddito':
            $('#' + evt.target.id).removeClass('fa-sort');
            if ($('#' + evt.target.id).hasClass('selected')) {
                $('#' + evt.target.id).addClass('fa-sort-numeric-up');
                $('#' + evt.target.id).removeClass('selected');
                sort.invertito = true;
            } else {
                $('#' + evt.target.id).addClass('fa-sort-numeric-down');
                $('#' + evt.target.id).addClass('selected');
                sort.invertito = false;
            }
            sort.cosa = 'reddito';
            updateRecords();
            break;
        case 'sortSesso':
            $('#' + evt.target.id).removeClass('fa-sort');
            if ($('#' + evt.target.id).hasClass('selected')) {
                $('#' + evt.target.id).addClass('fa-sort-amount-up');
                $('#' + evt.target.id).removeClass('selected');
                sort.invertito = true;
            } else {
                $('#' + evt.target.id).addClass('fa-sort-amount-down');
                $('#' + evt.target.id).addClass('selected');
                sort.invertito = false;
            }
            sort.cosa = 'sesso';
            updateRecords();
            break;
    }
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