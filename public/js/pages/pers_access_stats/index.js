$(document).ready(function () {

    $('#person_list').select2({
        placeholder: '-- Sélectionner --',
    });

    $('#weekDate').datepicker({
        format: "dd/mm/yyyy",
        todayBtn: "linked",
        clearBtn: true,
        language: "fr",
        daysOfWeekHighlighted: "0",
        todayHighlight: true,
        defaultViewDate: new Date()
    }).datepicker('setDate', new Date());

    const months = [
        'Janvier',
        'Février',
        'Mars',
        'Avril',
        'Mai',
        'Juin',
        'Juillet',
        'Août',
        'Septembre',
        'Octobre',
        'Novembre',
        'Décembre'
    ];
    const ctx = document.getElementById('yearly_bar_chart').getContext('2d');
    const yearlyChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: months,
            datasets: [{
                label: 'Nombre d’entrées par mois',
                data: [],
                backgroundColor: 'rgba(60,141,188,0.9)',
                borderColor: 'rgba(60,141,188,1)',
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: {
                        precision: 0,
                        beginAtZero: true
                    }
                },
                x: {
                    beginAtZero: true,
                    ticks: {
                        precision: 0,
                        beginAtZero: true
                    }
                }
            },
            plugins: {
                datalabels: {
                    color: '#000',
                    anchor: 'end',
                    align: 'top',
                    formatter: function (value) {
                        return value > 0 ? value : '';
                    },
                    font: {
                        weight: 'bold',
                        size: 12,
                    }
                }
            }
        }
    });

    $('#yearly_bar_chart_search').on('click', function () {
        const pinPers = $('#person_list').val();
        if (!pinPers) {
            return;
        }
        $(this).attr('disabled', true);
        $('#yearly_bar_chart_spinner').removeClass('invisible');
        $.ajax({
            method: 'GET',
            url: '/dashboard/pers-access-stats/yearly?pin=' + pinPers,
        }).done((response) => {
            yearlyChart.data.datasets[0].data = response;
            yearlyChart.update();
        }).catch((error) => {
            throw new Error(error);
        }).always(() => {
            $(this).attr('disabled', false);
            $('#yearly_bar_chart_spinner').addClass('invisible');
        });
    });

    const days = [
        "Lundi",
        "Mardi",
        "Mercredi",
        "Jeudi",
        "Vendredi",
        "Samedi",
        "Dimanche"
    ]
    const ctxWeekly = document.getElementById('weakly_bar_chart').getContext('2d');
    const weeklyChart = new Chart(ctxWeekly, {
        type: 'bar',
        data: {
            labels: days,
            datasets: [{
                label: 'Nombre de clients',
                data: [],
                backgroundColor: 'rgba(220,53,69,0.9)'
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: {
                        precision: 0,
                        beginAtZero: true
                    }
                },
                x: {
                    beginAtZero: true,
                    ticks: {
                        precision: 0,
                        beginAtZero: true
                    }
                }
            },
            plugins: {
                legend: {display: true}, datalabels: {
                    color: '#000',
                    anchor: 'end',
                    align: 'top',
                    formatter: function (value) {
                        return value > 0 ? value : '';
                    },
                    font: {
                        weight: 'bold',
                        size: 12,
                    }
                }
            }
        }
    });

    $('#weakly_bar_chart_search').on('click', function () {
        const weekDate = $('#weekDate').val();
        if (!weekDate) {
            $('#weekDate').trigger('focus');
            return;
        }
        $(this).attr('disabled', true);
        $('#weakly_bar_chart_spinner').removeClass('invisible');
        $.ajax({
            method: 'GET',
            url: '/dashboard/pers-access-stats/weekly?date=' + weekDate,
        }).done((response) => {
            weeklyChart.data.datasets[0].data = response.data;
            weeklyChart.update();
            $('#selected_week').text(response.weekRange);
        }).catch((error) => {
            throw new Error(error);
        }).always(() => {
            $(this).attr('disabled', false);
            $('#weakly_bar_chart_spinner').addClass('invisible');
        })
    });


    const ctxTotalMonthly = document.getElementById('monthly_bar_chart').getContext('2d');
    const totalMonthlyChart = new Chart(ctxTotalMonthly, {
        type: 'bar',
        data: {
            labels: months,
            datasets: [{
                label: 'Nombre de clients',
                data: [],
                backgroundColor: 'rgba(60,141,188,0.9)',
                borderColor: 'rgba(60,141,188,1)',
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: {stepSize: 1}
                },
                x: {
                    beginAtZero: true,
                    ticks: {
                        precision: 0,
                        beginAtZero: true
                    }
                }
            },
            plugins: {
                legend: {display: true},
                datalabels: {
                    color: '#000',
                    anchor: 'end',
                    align: 'top',
                    formatter: function (value) {
                        return value > 0 ? value : '';
                    },
                    font: {
                        weight: 'bold',
                        size: 12,
                    }
                }
            }
        }
    });

    $('#monthly_bar_chart_search').on('click', function () {
        const year = $('#year_list').val();
        if (!year) {
            $('#weekDate').trigger('focus');
            return;
        }
        $(this).attr('disabled', true);
        $('#monthly_bar_chart_spinner').removeClass('invisible');
        $.ajax({
            method: 'GET',
            url: '/dashboard/pers-access-stats/monthly?year=' + year,
        }).done((response) => {
            totalMonthlyChart.data.datasets[0].data = response;
            totalMonthlyChart.update();
        }).catch((error) => {
            throw new Error(error);
        }).always(() => {
            $(this).attr('disabled', false);
            $('#monthly_bar_chart_spinner').addClass('invisible');
        })
    });
});