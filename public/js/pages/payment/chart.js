document.addEventListener("DOMContentLoaded", function () {
    let monthlyChart, yearlyChart, weeklyChart;

    function renderBarChart(canvasId, labelText) {
        const canvas = document.getElementById(canvasId);
        if (!canvas) return;
        const labels = JSON.parse(canvas.dataset.labels || "[]");
        const values = JSON.parse(canvas.dataset.values || "[]");

        if (canvasId === 'subscriptionsByMonth' && monthlyChart) monthlyChart.destroy();
        if (canvasId === 'subscriptionsByYear' && yearlyChart) yearlyChart.destroy();

        const chartInstance = new Chart(canvas.getContext('2d'), {
            type: 'bar',
            data: {
                labels,
                datasets: [{ label: labelText, data: values, backgroundColor: 'rgba(60,141,188,0.9)' }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                scales: {
                    y: { beginAtZero: true, ticks: { precision: 0, stepSize: 1 } },
                    x: { ticks: { autoSkip: false } }
                }
            }
        });

        if (canvasId === 'subscriptionsByMonth') monthlyChart = chartInstance;
        if (canvasId === 'subscriptionsByYear') yearlyChart = chartInstance;
    }

    function renderWeeklyChart(labels, data) {
        const canvas = document.getElementById('weeklyBarChart');
        if (!canvas) return;

        if (weeklyChart) weeklyChart.destroy();
        weeklyChart = new Chart(canvas.getContext('2d'), {
            type: 'bar',
            data: { labels, datasets: [{ label: 'Abonnements par jour', data, backgroundColor: '#17a2b8' }] },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                scales: {
                    y: { beginAtZero: true, ticks: { stepSize: 1 } },
                    x: { ticks: { autoSkip: false } }
                },
                plugins: { legend: { display: true } }
            }
        });
    }

    renderBarChart("subscriptionsByMonth", "Abonnements par mois");
    renderBarChart("subscriptionsByYear", "Abonnements par année");
    renderWeeklyChart(
        JSON.parse(document.getElementById('weeklyBarChart').dataset.labels || "[]"),
        JSON.parse(document.getElementById('weeklyBarChart').dataset.values || "[]")
    );

    document.getElementById('customDate').addEventListener('change', function () {
        const selectedDate = this.value;
        fetch(`/payment/chart/week?weekDate=${selectedDate}`, { headers: { 'X-Requested-With': 'XMLHttpRequest' } })
            .then(res => res.json())
            .then(data => renderWeeklyChart(data.labels, data.values));
    });

    document.getElementById('yearPicker').addEventListener('change', function() {
        const selectedYear = this.value;
        fetch(`/payment/chart/month?year=${selectedYear}`, { headers: { 'X-Requested-With': 'XMLHttpRequest' } })
            .then(res => res.json())
            .then(data => {
                const canvas = document.getElementById('subscriptionsByMonth');
                canvas.dataset.labels = JSON.stringify(data.labels);
                canvas.dataset.values = JSON.stringify(data.values);
                renderBarChart('subscriptionsByMonth', 'Abonnements par mois');
            });
    });
});