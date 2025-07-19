$(document).ready(() => {

    const persDatatable = new DataTable('#pers_person_datatable', {
        retrieve: true,
        language: {
            "processing": "Traitement en cours...",
            "search": "Rechercher&nbsp;:",
            "lengthMenu": "Afficher _MENU_ éléments",
            "info": "Affichage de l'élément _START_ à _END_ sur _TOTAL_ éléments",
            "infoEmpty": "Affichage de l'élément 0 à 0 sur 0 élément",
            "infoFiltered": "(filtré de _MAX_ éléments au total)",
            "zeroRecords": "Aucun élément à afficher",
            "emptyTable": "Aucune donnée disponible dans le tableau",
            "paginate": {
                "first": "Premier",
                "previous": "Précédent",
                "next": "Suivant",
                "last": "Dernier"
            }
        },
        pageLength: 10,
        responsive: true,
        // order: [[ 0, "asc" ]]
    });

});