document.addEventListener("DOMContentLoaded", function () {
    const charts = {
        weekly: null,
        monthly: null,
        yearly: null
    };

    // -----------------------------
    // Options communes pour les bar charts
    // -----------------------------
    const defaultOptions = {
        responsive: true,
        maintainAspectRatio: false,
        scales: {
            y: { beginAtZero: true, ticks: { precision: 0, stepSize: 1 } },
            x: { ticks: { autoSkip: false } }
        }
    };

    // -----------------------------
    // Fonction générique pour créer un chart
    // -----------------------------
    function createBarChart(canvas, labels, values, labelText, existingChartRef) {
        if (existingChartRef && existingChartRef.destroy) existingChartRef.destroy();

        return new Chart(canvas.getContext('2d'), {
            type: 'bar',
            data: {
                labels: labels,
                datasets: [{
                    label: labelText,
                    data: values,
                    backgroundColor: 'rgba(60,141,188,0.9)'
                }]
            },
            options: defaultOptions
        });
    }

    // -----------------------------
    // Graphique hebdomadaire
    // -----------------------------
    const weeklyCanvas = document.getElementById('weeklyBarChart');
    if (weeklyCanvas) {
        const initialWeeklyLabels = JSON.parse(weeklyCanvas.dataset.labels || "[]");
        const initialWeeklyValues = JSON.parse(weeklyCanvas.dataset.values || "[]");
        charts.weekly = createBarChart(weeklyCanvas, initialWeeklyLabels, initialWeeklyValues, 'Abonnements par jour');
    }

    document.getElementById('customDate')?.addEventListener('change', function () {
        const selectedDate = this.value;
        fetch(`/payment/chart/week?weekDate=${selectedDate}`, { headers: { 'X-Requested-With': 'XMLHttpRequest' } })
            .then(res => res.json())
            .then(data => {
                charts.weekly = createBarChart(weeklyCanvas, data.labels, data.values, 'Abonnements par jour', charts.weekly);
            });
    });

    // -----------------------------
    // Graphique mensuel
    // -----------------------------
    const monthlyCanvas = document.getElementById('subscriptionsByMonth');
    if (monthlyCanvas) {
        const initialMonthlyLabels = JSON.parse(monthlyCanvas.dataset.labels || "[]");
        const initialMonthlyValues = JSON.parse(monthlyCanvas.dataset.values || "[]");
        charts.monthly = createBarChart(monthlyCanvas, initialMonthlyLabels, initialMonthlyValues, 'Abonnements par mois');
    }

    document.getElementById('yearPicker')?.addEventListener('change', function () {
        const selectedYear = this.value;
        fetch(`/payment/chart/month?year=${selectedYear}`, { headers: { 'X-Requested-With': 'XMLHttpRequest' } })
            .then(res => res.json())
            .then(data => {
                charts.monthly = createBarChart(monthlyCanvas, data.labels, data.values, 'Abonnements par mois', charts.monthly);
            });
    });

    // -----------------------------
    // Graphique annuel
    // -----------------------------
    const yearlyCanvas = document.getElementById('subscriptionsByYear');
    const yearSelect = document.getElementById('yearFilter');

    function renderYearChart(year) {
        const allLabels = JSON.parse(yearlyCanvas.dataset.labels || "[]");
        const allValues = JSON.parse(yearlyCanvas.dataset.values || "[]");

        // Chercher l'index correspondant à l'année (parseInt pour éviter problème string/int)
        const index = allLabels.findIndex(l => parseInt(l) === parseInt(year));
        let filteredLabels = [];
        let filteredValues = [];

        if (index !== -1) {
            filteredLabels = [allLabels[index]];
            filteredValues = [allValues[index]];
        }

        charts.yearly = createBarChart(yearlyCanvas, filteredLabels, filteredValues, `Abonnements pour ${year}`, charts.yearly);
    }

    // Afficher par défaut l'année sélectionnée dans le select
    if (yearSelect) renderYearChart(yearSelect.value);

    // Mettre à jour le graphique lorsqu'on change l'année
    yearSelect?.addEventListener('change', function () {
        renderYearChart(this.value);
    });
});
