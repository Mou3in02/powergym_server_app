$(document).ready(() => {

    $('#customDate').datepicker({
        format: "dd/mm/yyyy",
        todayBtn: "linked",
        clearBtn: true,
        language: "fr",
        daysOfWeekHighlighted: "0",
        todayHighlight: true,
        defaultViewDate: new Date()
    }).datepicker('setDate', new Date());

    new DataTable('#pers_access_datatable', {
        searching: false,
        retrieve: true,
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
        responsive: true,
    });

    $('#filterForm').submit((event) => {
        event.preventDefault();
        const eventTime = $('#eventTime').val();
        const customDate = $('#customDate').val();
        const name = $('#search_name').val();
        $.ajax({
            method: 'POST',
            url: '/dashboard/pers-access-v2/filter',
            contentType: 'application/json',
            data: JSON.stringify({
                customDate,
                eventTime,
                name: name.trim(),
            })
        }).done((response) => {
            const datatable = $('#pers_access_datatable').DataTable();
            if (response && Array.isArray(response)) {
                datatable.clear();
                const arrayData = response.map(item => [
                    item.name,
                    item.create_time,
                    item.event,
                    item.event_time
                ]);
                datatable.rows.add(arrayData);
                datatable.draw();
            }
        }).catch((error) => {
            throw new Error(error);
        })
    });

});