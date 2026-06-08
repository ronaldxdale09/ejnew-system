(function () {
    'use strict';

    function resizeChartsInPanel(panel) {
        if (!panel || typeof Chart === 'undefined') {
            return;
        }
        panel.querySelectorAll('canvas').forEach(function (canvas) {
            var chart = Chart.getChart(canvas);
            if (chart) {
                chart.resize();
            }
        });
    }

    function resizeActiveTabCharts() {
        var activePanel = document.querySelector('[data-adm-panel].active');
        if (!activePanel) {
            return;
        }
        window.requestAnimationFrame(function () {
            resizeChartsInPanel(activePanel);
        });
    }

    document.addEventListener('DOMContentLoaded', function () {
        if (!document.querySelector('.admin-page')) {
            return;
        }

        document.querySelectorAll('[data-adm-tab]').forEach(function (btn) {
            btn.addEventListener('click', function () {
                window.setTimeout(resizeActiveTabCharts, 60);
            });
        });

        window.addEventListener('resize', resizeActiveTabCharts);
        window.setTimeout(resizeActiveTabCharts, 120);
        window.admResizeActiveTabCharts = resizeActiveTabCharts;
    });
})();
