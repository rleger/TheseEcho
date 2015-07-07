// IE Fix
if ( ! window.location.origin) {
  window.location.origin = window.location.protocol + "//" + window.location.hostname + (window.location.port ? ':' + window.location.port: '');
}

// Survey start button (scroll down)
$(document).on('click', '.start-btn', function (e){
    var $anchor = $(this);

    $('html, body').stop().animate({
        scrollTop: $($anchor.attr('href')).offset().top
    }, 1500,'easeInOutExpo');

    e.preventDefault();
});

// Download table as excel document
$(document).on('click', '.btn-excel-download', function (e){
    $this = $(this);
    var target = $this.attr('data-excel-download-target-id');
    var title = $this.attr('data-excel-download-title');

    tableToExcel(target, title);

    e.preventDefault();
});

// Initializing
$(document).on('ready', function (e){
    $('.first-focus').focus();

    // Initializing dataTables plugin
    $('#allAnswers').DataTable({
        ordering: true,
        pageLength: 50,
        scrollX: true,
        language: {
            "sProcessing":     "Traitement en cours...",
            "sSearch":         "Rechercher&nbsp;:",
            "sLengthMenu":     "Afficher _MENU_ &eacute;l&eacute;ments",
            "sInfo":           "Affichage de l'&eacute;lement _START_ &agrave; _END_ sur _TOTAL_ &eacute;l&eacute;ments",
            "sInfoEmpty":      "Affichage de l'&eacute;lement 0 &agrave; 0 sur 0 &eacute;l&eacute;ments",
            "sInfoFiltered":   "(filtr&eacute; de _MAX_ &eacute;l&eacute;ments au total)",
            "sInfoPostFix":    "",
            "sLoadingRecords": "Chargement en cours...",
            "sZeroRecords":    "Aucun &eacute;l&eacute;ment &agrave; afficher",
            "sEmptyTable":     "Aucune donn&eacute;e disponible dans le tableau",
            "oPaginate": {
                "sFirst":      "Premier",
                "sPrevious":   "Pr&eacute;c&eacute;dent",
                "sNext":       "Suivant",
                "sLast":       "Dernier"
            },
            "oAria": {
                "sSortAscending":  ": activer pour trier la colonne par ordre croissant",
                "sSortDescending": ": activer pour trier la colonne par ordre d&eacute;croissant"
            }
        }
    });
});
