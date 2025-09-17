$(function () {
    // Mensuel Bar Chart
    const labels = JSON.parse(document.getElementById('barChart').dataset.labels);
    const values = JSON.parse(document.getElementById('barChart').dataset.values);

    const ctxBar = document.getElementById('barChart').getContext('2d');
    new Chart(ctxBar, {
        type: 'bar',
        data: {
            labels: labels,
            datasets: [{
                label: 'Nombre de clients par mois',
                data: values,
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
                        precision: 0
                    }
                }
            }
        }
    });

    const ctxWeekly = document.getElementById('weeklyBarChart').getContext('2d');
    let weeklyChart;

    function loadWeeklyChart(date = '') {
        fetch(`/dashboard/pers-session/chart?date=${date}`)
            .then(response => response.json())
            .then(result => {
                const labels = result.labels;
                const data = result.data.map(v => Number(v));

                const allZero = data.every(value => value === 0);

                let finalLabels, finalData, colors;

                if (allZero) {
                    finalLabels = ['Aucun client cette semaine'];
                    finalData = [0];
                    colors = ['#d3d3d3'];
                } else {
                    finalLabels = labels;
                    finalData = data;
                    colors = data.map(() => '#dc3545');
                }

                if (weeklyChart) {
                    weeklyChart.destroy();
                }

                weeklyChart = new Chart(ctxWeekly, {
                    type: 'bar',
                    data: {
                        labels: finalLabels,
                        datasets: [{
                            label: 'Nombre de clients',
                            data: finalData,
                            backgroundColor: colors
                        }]
                    },
                    options: {
                        maintainAspectRatio: false,
                        responsive: true,
                        scales: {
                            y: {
                                beginAtZero: true,
                                ticks: {
                                    stepSize: 1
                                }
                            }
                        },
                        plugins: {
                            tooltip: {
                                callbacks: {
                                    label: function (context) {
                                        const label = context.dataset.label || '';
                                        const value = context.parsed.y;
                                        return `${label}: ${value}`;
                                    }
                                }
                            },
                            legend: {
                                display: true,
                                labels: {
                                    generateLabels: function () {
                                        return [{
                                            text: 'Nombre de clients par semaine',
                                            fillStyle: '#dc3545',
                                            strokeStyle: '#dc3545',
                                            hidden: false,
                                            index: 0
                                        }];
                                    }
                                }
                            }
                        }
                    }
                });
            })
            .catch(err => console.error('Erreur fetch:', err));
    }

    loadWeeklyChart();

    function getWeekRange(dateString) {
        const date = new Date(dateString);
        if (isNaN(date)) return '';

        const day = date.getDay();
        const diffToMonday = day === 0 ? 6 : day - 1;

        const monday = new Date(date);
        monday.setDate(date.getDate() - diffToMonday);

        const sunday = new Date(monday);
        sunday.setDate(monday.getDate() + 6);

        const options = {day: '2-digit', month: '2-digit', year: 'numeric'};
        const mondayStr = monday.toLocaleDateString('fr-FR', options);
        const sundayStr = sunday.toLocaleDateString('fr-FR', options);

        return `${mondayStr} ➔ ${sundayStr}`;
    }

    $('#customDate').on('change', function () {
        const selectedDate = this.value;
        loadWeeklyChart(selectedDate);

        const rangeText = getWeekRange(selectedDate);
        $('#weekRange').text(rangeText);
    });

    // Prix mensuels
    const ctxPrice = document.getElementById('barChart1').getContext('2d');
    const pieLabels = JSON.parse(document.getElementById('barChart1').dataset.labels);
    const pieValues = JSON.parse(document.getElementById('barChart1').dataset.values);

    new Chart(ctxPrice, {
        type: 'bar',
        data: {
            labels: pieLabels,
            datasets: [{
                label: 'Total des prix (DNT)',
                data: pieValues,
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
                        callback: function (value) {
                            return value.toLocaleString('fr-FR', {minimumFractionDigits: 2}) + ' DNT';
                        }
                    }
                }
            },
            plugins: {
                tooltip: {
                    callbacks: {
                        label: function (context) {
                            const label = context.dataset.label || '';
                            const value = context.parsed.y || 0;
                            const formatted = value.toLocaleString('fr-FR', {minimumFractionDigits: 2});
                            return label + ': ' + formatted + ' DNT';
                        }
                    }
                }
            }
        }
    });
});
