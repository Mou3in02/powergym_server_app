$(function () {
    $('#pers_person_table').DataTable({
        'responsive': true,
        'lengthChange': false,
        'autoWidth': false,
        'buttons': ['copy', 'csv', 'excel', 'pdf', 'print', 'colvis'],
        language: {
            'processing': 'Traitement en cours...',
            'search': 'Rechercher&nbsp;:',
            'lengthMenu': 'Afficher _MENU_ éléments',
            'info': 'Affichage de l\'élément _START_ à _END_ sur _TOTAL_ éléments',
            'infoEmpty': 'Affichage de l\'élément 0 à 0 sur 0 élément',
            'infoFiltered': '(filtré de _MAX_ éléments au total)',
            'zeroRecords': 'Aucun élément à afficher',
            'emptyTable': 'Aucune donnée disponible dans le tableau',
            'paginate': {
                'first': 'Premier',
                'previous': 'Précédent',
                'next': 'Suivant',
                'last': 'Dernier',
            },
        },
        pageLength: 10,
    }).buttons().container().appendTo('#pers_person_table_wrapper .col-md-6:eq(0)');
});