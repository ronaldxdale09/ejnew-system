<?php

if (!function_exists('sales_report_year')) {
    function sales_report_year(): int
    {
        $year = isset($_GET['year']) ? (int) $_GET['year'] : (int) date('Y');
        return $year > 2000 ? $year : (int) date('Y');
    }
}

if (!function_exists('sales_report_month_key')) {
    function sales_report_month_key(int $month): string
    {
        $key = date('M', mktime(0, 0, 0, $month, 10));
        return $key === 'Dec' ? 'Decem' : $key;
    }
}

if (!function_exists('sales_report_cell')) {
    function sales_report_cell($value): string
    {
        $num = (float) $value;
        return $num != 0 ? number_format($num, 0, '.', ',') : '-';
    }
}

if (!function_exists('sales_report_total_cell')) {
    function sales_report_total_cell($value): string
    {
        return '<b>' . number_format((float) $value, 0, '.', ',') . '</b>';
    }
}

if (!function_exists('sales_render_report_year_filter')) {
    function sales_render_report_year_filter(string $table, string $dateColumn = 'transaction_date'): void
    {
        global $con;
        $selectedYear = isset($_GET['year']) ? (int) $_GET['year'] : (int) date('Y');
        $col = preg_replace('/[^a-zA-Z0-9_]/', '', $dateColumn);
        ?>
        <div class="sales-toolbar">
            <div>
                <label for="yearFilter" class="form-label small text-muted mb-1">Report Year</label>
                <select id="yearFilter" class="form-select form-select-sm" style="min-width:120px;" onchange="salesReportYearFilter()">
                    <?php
                    $yearsQuery = mysqli_query($con, "SELECT DISTINCT YEAR($col) AS year FROM $table ORDER BY year DESC");
                    while ($yearsQuery && ($yearOption = mysqli_fetch_assoc($yearsQuery))) {
                        $y = (int) $yearOption['year'];
                        $selected = $y === $selectedYear ? 'selected' : '';
                        echo "<option value='$y' $selected>$y</option>";
                    }
                    ?>
                </select>
            </div>
            <p class="text-muted small mb-0 align-self-end">All amounts in Philippine Peso (₱)</p>
        </div>
        <script>
        function salesReportYearFilter() {
            var year = document.getElementById('yearFilter').value;
            var url = new URL(window.location.href);
            if (year) url.searchParams.set('year', year);
            else url.searchParams.delete('year');
            window.location.href = url.toString();
        }
        </script>
        <?php
    }
}
