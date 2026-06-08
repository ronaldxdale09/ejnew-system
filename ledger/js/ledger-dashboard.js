(function () {
    'use strict';

    document.addEventListener('DOMContentLoaded', function () {
        var cfg = window.__ledgerDashboard;
        if (!cfg || typeof Chart === 'undefined') return;

        var peso = function (v) {
            return new Intl.NumberFormat('en-PH', { style: 'currency', currency: 'PHP', maximumFractionDigits: 0 }).format(v || 0);
        };

        var green = 'rgba(26, 115, 79, 0.75)';
        var blue = 'rgba(59, 130, 246, 0.75)';
        var gold = 'rgba(180, 83, 9, 0.75)';
        var purple = 'rgba(124, 58, 237, 0.75)';

        function barChart(id, datasets, stacked) {
            var el = document.getElementById(id);
            if (!el) return;
            new Chart(el.getContext('2d'), {
                type: 'bar',
                data: { labels: cfg.month_labels, datasets: datasets },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: { position: 'top', labels: { boxWidth: 12, font: { size: 11 } } },
                        tooltip: { callbacks: { label: function (c) { return c.dataset.label + ': ' + peso(c.parsed.y); } } }
                    },
                    scales: {
                        x: { stacked: !!stacked, grid: { display: false }, ticks: { font: { size: 10 } } },
                        y: {
                            stacked: !!stacked,
                            beginAtZero: true,
                            ticks: {
                                font: { size: 10 },
                                callback: function (v) {
                                    if (v >= 1e6) return '₱' + (v / 1e6).toFixed(1) + 'M';
                                    if (v >= 1e3) return '₱' + (v / 1e3).toFixed(0) + 'K';
                                    return '₱' + v;
                                }
                            }
                        }
                    }
                }
            });
        }

        function doughnut(id, labels, values, title) {
            var el = document.getElementById(id);
            if (!el || !labels.length) return;
            new Chart(el.getContext('2d'), {
                type: 'doughnut',
                data: {
                    labels: labels,
                    datasets: [{
                        data: values,
                        backgroundColor: ['#1a734f','#3b82f6','#b45309','#7c3aed','#dc2626','#0891b2','#ca8a04','#64748b'],
                        borderWidth: 0
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    cutout: '55%',
                    plugins: {
                        legend: { position: 'right', labels: { boxWidth: 10, font: { size: 10 } } },
                        tooltip: { callbacks: { label: function (c) { return c.label + ': ' + peso(c.raw); } } }
                    }
                }
            });
        }

        barChart('dashFinanceChart', [
            { label: 'Expenses', data: cfg.expenses, backgroundColor: green, borderRadius: 4 },
            { label: 'Purchases', data: cfg.purchases, backgroundColor: blue, borderRadius: 4 }
        ]);

        barChart('dashTopperChart', [
            { label: 'Maloong', data: cfg.maloong, backgroundColor: gold, borderRadius: 4 },
            { label: 'Buahan', data: cfg.buahan, backgroundColor: purple, borderRadius: 4 }
        ]);

        doughnut('dashExpenseCatChart', cfg.expense_cat_labels, cfg.expense_cat_values);
        doughnut('dashPurchaseCatChart', cfg.purchase_cat_labels, cfg.purchase_cat_values);
        doughnut('dashCaChart', cfg.ca_labels, cfg.ca_values);
    });
})();
