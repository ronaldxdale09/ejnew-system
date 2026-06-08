(function () {
    'use strict';

    document.addEventListener('DOMContentLoaded', function () {
        var config = window.__salesReport || {};
        if (!config.chart) return;

        // Tab switching
        document.querySelectorAll('[data-sr-tab]').forEach(function (btn) {
            btn.addEventListener('click', function () {
                var target = btn.getAttribute('data-sr-tab');
                document.querySelectorAll('[data-sr-tab]').forEach(function (b) {
                    b.classList.toggle('active', b === btn);
                });
                document.querySelectorAll('[data-sr-panel]').forEach(function (panel) {
                    panel.classList.toggle('active', panel.getAttribute('data-sr-panel') === target);
                });
            });
        });

        var peso = function (v) {
            return new Intl.NumberFormat('en-PH', { style: 'currency', currency: 'PHP', maximumFractionDigits: 0 }).format(v || 0);
        };

        // Trend chart
        var trendEl = document.getElementById('srTrendChart');
        if (trendEl && typeof Chart !== 'undefined') {
            new Chart(trendEl.getContext('2d'), {
                type: 'bar',
                data: {
                    labels: config.chart.labels,
                    datasets: [
                        {
                            label: 'Net Sales',
                            data: config.chart.net_sales,
                            backgroundColor: 'rgba(26, 115, 79, 0.45)',
                            borderColor: 'rgba(26, 115, 79, 1)',
                            borderWidth: 1,
                            borderRadius: 4,
                            order: 2
                        },
                        {
                            type: 'line',
                            label: 'Gross Profit',
                            data: config.chart.gross_profit,
                            borderColor: '#b45309',
                            backgroundColor: 'rgba(180, 83, 9, 0.08)',
                            borderWidth: 2,
                            tension: 0.35,
                            fill: true,
                            order: 1,
                            pointRadius: 3
                        }
                    ]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    interaction: { mode: 'index', intersect: false },
                    plugins: {
                        legend: { position: 'top', labels: { boxWidth: 12, font: { size: 11 } } },
                        tooltip: {
                            callbacks: {
                                label: function (ctx) {
                                    return (ctx.dataset.label || '') + ': ' + peso(ctx.parsed.y);
                                }
                            }
                        }
                    },
                    scales: {
                        y: {
                            beginAtZero: true,
                            ticks: {
                                font: { size: 10 },
                                callback: function (v) {
                                    if (v >= 1e6) return '₱' + (v / 1e6).toFixed(1) + 'M';
                                    if (v >= 1e3) return '₱' + (v / 1e3).toFixed(0) + 'K';
                                    return '₱' + v;
                                }
                            }
                        },
                        x: { ticks: { font: { size: 10 } } }
                    }
                }
            });
        }

        // Cost doughnut
        var costEl = document.getElementById('srCostChart');
        if (costEl && typeof Chart !== 'undefined') {
            var split = config.chart.cost_split;
            new Chart(costEl.getContext('2d'), {
                type: 'doughnut',
                data: {
                    labels: ['COGS', 'Milling', 'Shipping', 'Gross Profit'],
                    datasets: [{
                        data: [split.cogs, split.milling, split.shipping, split.profit],
                        backgroundColor: ['#ef4444', '#f59e0b', '#3b82f6', '#1a734f'],
                        borderWidth: 0
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    cutout: '58%',
                    plugins: {
                        legend: { position: 'right', labels: { boxWidth: 10, font: { size: 11 } } },
                        tooltip: {
                            callbacks: {
                                label: function (ctx) {
                                    var total = ctx.dataset.data.reduce(function (a, b) { return a + b; }, 0);
                                    var pct = total ? ((ctx.raw / total) * 100).toFixed(1) : 0;
                                    return ctx.label + ': ' + peso(ctx.raw) + ' (' + pct + '%)';
                                }
                            }
                        }
                    }
                }
            });
        }

        // Export table CSV
        var exportBtn = document.getElementById('srExportCsv');
        if (exportBtn) {
            exportBtn.addEventListener('click', function () {
                var table = document.getElementById('srReportTable');
                if (!table) return;
                var rows = [];
                table.querySelectorAll('tr').forEach(function (tr) {
                    var cells = [];
                    tr.querySelectorAll('th, td').forEach(function (cell) {
                        cells.push('"' + cell.innerText.replace(/"/g, '""').trim() + '"');
                    });
                    rows.push(cells.join(','));
                });
                var blob = new Blob([rows.join('\n')], { type: 'text/csv;charset=utf-8;' });
                var link = document.createElement('a');
                link.href = URL.createObjectURL(blob);
                link.download = 'sales-report-' + (config.year || '') + '.csv';
                link.click();
            });
        }

        // Print report
        var printBtn = document.getElementById('srPrintReport');
        if (printBtn) {
            printBtn.addEventListener('click', function () {
                window.print();
            });
        }
    });
})();
