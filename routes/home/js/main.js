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
        salvaForm();
        $('.needs-validation')[0].classList.remove('was-validated');
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
        $('#titoloModalForm').text('Aggiungi nuova persona');
    } else { // Modifica riga
        $('#titoloModalForm').text('Modifica i dati inseriti');
    }
    $('#bodyModalForm input').val('');
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

$('#firstPage').click(function () {
    updatePage(1);
});

$('#previousPage').click(function () {
    updatePage(page - 1)
})

$('#nextPage').click(function () {
    updatePage(page + 1);
});

$('#lastPage').click(function () {
    updatePage(Math.ceil(persone.length / resultsPerPage));
});

$('.search_input').keyup(function () {
    search($(this).val());
});

// Stampo le righe nella tabella
function updateRecords() {
    return;
    personePage = personeCercate.slice((page - 1) * resultsPerPage, page * resultsPerPage);
    sortBy(sort.cosa, sort.invertito);
    $('#records').html('');
    c = 0;
    for (let persona of personePage) {
        $('#records').append(`
        <tr class="record">
            <td data-title="Nome">${persona.nome}</td>
            <td data-title="Cognome">${persona.cognome}</td>
            <td data-title="Nascita">${persona.nascita}</td>
            <td data-title="Reddito">${persona.redditoNum()}</td>
            <td data-title="Sesso">${persona.sesso.charAt(0).toUpperCase() + persona.sesso.slice(1)}</td>
            <td data-title="Comandi">
                <span data-toggle="modal" data-target="#entryForm" data-scopo="${persone.indexOf(persona)}">
                    <button type="button" class="btn btn-outline-dark" data-toggle="tooltip" data-placement="left" title="Modifica"><i class="fas fa-edit"></i></button>
                </span>
                <span data-toggle="modal" data-target="#confermaEliminazione" data-scopo="${persone.indexOf(persona)}">
                    <button type="button" class="btn btn-outline-danger" data-toggle="tooltip" data-placement="right" title="Elimina"><i class="fas fa-trash"></i></button>
                </span>
            </td>
        </tr>
        `);
        c++;
    }
    $('[data-toggle="tooltip"]').tooltip();

}

// Rimuovo una riga dall'array di persone e stampo di nuovo la riga
function removeEntry(id) {
    persone.splice(id, 1);
    sortedPersone = persone;
    $($('.record')[id]).find('[data-toggle="tooltip"]').tooltip('hide');
    search();
}

// Aggiungo o modifico una riga 
function salvaForm() {
    var id = $('#scopo').val();
    if (id == 'new') {
        persone.push(new Persona($('#nome').val(), $('#cognome').val(), $('#nascita').val(), $('#reddito').val(), $('#sesso').val()));
    } else {
        persone[id] = new Persona($('#nome').val(), $('#cognome').val(), $('#nascita').val(), $('#reddito').val(), $('#sesso').val());
    }
    sortedPersone = persone;
    $('#entryForm').modal('toggle');
    search();
    return false; //EHI TU!
}

function sortBy(cosa, invertito) {
    if (cosa == 'nome') {
        personePage.sort(function (a, b) {
            if (a.nome.toLowerCase() < b.nome.toLowerCase()) {
                return -1;
            } else if (a.nome.toLowerCase() > b.nome.toLowerCase()) {
                return 1;
            } else {
                if (a.cognome.toLowerCase() < b.cognome.toLowerCase()) {
                    return -1;
                } else if (a.cognome.toLowerCase() > b.cognome.toLowerCase()) {
                    return 1;
                } else {
                    return 0;
                }
            }
        });
        if (invertito) {
            personePage.reverse();
        }
    }
    if (cosa == 'cognome') {
        personePage.sort(function (a, b) {
            if (a.cognome.toLowerCase() < b.cognome.toLowerCase()) {
                return -1;
            } else if (a.cognome.toLowerCase() > b.cognome.toLowerCase()) {
                return 1;
            } else {
                if (a.nome.toLowerCase() < b.nome.toLowerCase()) {
                    return -1;
                } else if (a.nome.toLowerCase() > b.nome.toLowerCase()) {
                    return 1;
                } else {
                    return 0;
                }
            }
        });
        if (invertito) {
            personePage.reverse();
        }
    }
    if (cosa == 'nascita') {
        personePage.sort(function (a, b) {
            var nascitaA = a.nascita.split('/');
            var nascitaB = b.nascita.split('/');
            if (parseInt(nascitaA[2]) < parseInt(nascitaB[2])) {
                console.log(parseInt(nascitaA[2]), "<", parseInt(nascitaB[2]), parseInt(nascitaA[2]) < parseInt(nascitaB[2]));
                return -1;
            } else if (parseInt(nascitaA[2]) > parseInt(nascitaB[2])) {
                console.log(parseInt(nascitaA[2]), ">", parseInt(nascitaB[2]), parseInt(nascitaA[2]) > parseInt(nascitaB[2]));
                return 1;
            } else {
                if (parseInt(nascitaA[1]) < parseInt(nascitaB[1])) {
                    return -1;
                } else if (parseInt(nascitaA[1]) > parseInt(nascitaB[1])) {
                    return 1;
                } else {
                    if (parseInt(nascitaA[0]) < parseInt(nascitaB[0])) {
                        return -1;
                    } else if (parseInt(nascitaA[0]) > parseInt(nascitaB[0])) {
                        return 1;
                    } else {
                        return 0;
                    }
                }
            }
        });
        if (invertito) {
            personePage.reverse();
        }
    }
    if (cosa == 'reddito') {
        personePage.sort(function (a, b) {
            if (a.redditoNum() < b.redditoNum()) {
                return -1;
            } else if (a.redditoNum() > b.redditoNum()) {
                return 1;
            } else {
                return 0;
            }
        });
        if (invertito) {
            personePage.reverse();
        }
    }
    if (cosa == 'sesso') {
        personePage.sort(function (a, b) {
            if (a.sessoNum() < b.sessoNum()) {
                return -1;
            } else if (a.sessoNum() > b.sessoNum()) {
                return 1;
            } else return 0;
        });
        if (invertito) {
            personePage.reverse();
        }
    }
}

function updatePage(newPage) {
    return;
    if (newPage < 1) {
        return;
    }
    if (newPage > Math.ceil(personeCercate.length / resultsPerPage) && personeCercate.length != 0) page = Math.ceil(personeCercate.length / resultsPerPage);
    else page = newPage;
    personePage = persone.slice((page - 1) * resultsPerPage, page * resultsPerPage);
    $('#sortCollapsed').text(page);
    $('#pageButtons').html('');
    for (i = page - 2; i < page + 3; i++) {
        if (i != page && i > 0 && i <= Math.ceil(personeCercate.length / resultsPerPage)) {
            $('#pageButtons').append(`<button type="button" class="btn btn-outline-dark navigation expandedButton pageButton">${i}</button>`);
        }
    }
    updateRecords();

    $('.pageButton').click(function () {
        updatePage($(this).text());
    });
}

function search(text = prevSearch) {
    prevSearch = text;
    personeCercate = [];
    text = text.trim();
    persone.forEach((el) => {
        if (el.nome.toLowerCase().includes(text.toLowerCase()) || el.cognome.toLowerCase().includes(text.toLowerCase()) || el.nascita.includes(text) || el.sesso.toLowerCase().includes(text.toLowerCase()) || el.redditoNum().includes(text)) {
            personeCercate.push(el);
        }
    });
    updatePage(page);
}