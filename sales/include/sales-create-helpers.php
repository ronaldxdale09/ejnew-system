<?php
/**
 * Defaults for sales module INSERT operations.
 * Ensures NOT NULL columns without DB defaults are always populated on create.
 */

if (!function_exists('sales_esc')) {
    function sales_esc(mysqli $con, $value): string
    {
        return mysqli_real_escape_string($con, (string) ($value ?? ''));
    }
}

if (!function_exists('sales_create_defaults')) {
    function sales_create_defaults(string $table): array
    {
        $today = date('Y-m-d');

        static $defaults = [
            'sales_cuplump_shipment' => [
                'status' => 'In Progress',
                'type' => '',
                'particular' => '',
                'destination' => '',
                'source' => '',
                'vessel' => '',
                'bill_lading' => '',
                'remarks' => '',
                'recorded_by' => '',
                'freight' => 0,
                'loading_unloading' => 0,
                'processing_fee' => 0,
                'trucking_expense' => 0,
                'cranage_fee' => 0,
                'miscellaneous' => 0,
                'total_shipping_expense' => 0,
                'no_containers' => 0,
                'ship_cost_container' => 0,
                'total_cuplump_weight' => 0,
            ],
            'bale_shipment_record' => [
                'status' => 'In Progress',
                'type' => '',
                'particular' => '',
                'destination' => '',
                'source' => '',
                'vessel' => '',
                'bill_lading' => '',
                'remarks' => '',
                'recorded_by' => '',
                'freight' => 0,
                'loading_unloading' => 0,
                'processing_fee' => 0,
                'trucking_expense' => 0,
                'cranage_fee' => 0,
                'miscellaneous' => 0,
                'total_shipping_expense' => 0,
                'no_containers' => 0,
                'ship_cost_container' => 0,
                'total_num_bales' => 0,
                'total_bale_weight' => 0,
                'total_bale_cost' => 0,
            ],
            'bales_sales_record' => [
                'status' => 'In Progress',
                'sale_contract' => '',
                'purchase_contract' => '',
                'buyer_name' => '',
                'sale_type' => '',
                'contract_quality' => '',
                'contract_quantity' => 0,
                'contract_kiloPerBale' => '',
                'contract_container_num' => 0,
                'contract_price' => 0,
                'shipping_date' => '',
                'source' => '',
                'destination' => '',
                'currency' => 'USD',
                'no_containers' => 0,
                'total_num_bales' => 0,
                'total_bale_weight' => 0,
                'total_bale_cost' => 0,
                'total_bale_prod_cost' => 0,
                'total_ship_expense' => 0,
                'overall_ave_cost_kilo' => 0,
                'total_sales' => 0,
                'tax_rate' => 0,
                'tax_amount' => 0,
                'amount_paid' => 0,
                'unpaid_balance' => 0,
                'sales_proceed' => 0,
                'overall_cost' => 0,
                'gross_profit' => 0,
                'recorded_by' => '',
                'remarks' => '',
                'total_milling_cost' => 0,
            ],
            'sales_cuplump_record' => [
                'status' => 'In Progress',
                'sale_contract' => '',
                'purchase_contract' => '',
                'buyer_name' => '',
                'sale_type' => '',
                'contract_price' => 0,
                'source' => '',
                'destination' => '',
                'currency' => 'USD',
                'no_containers' => 0,
                'total_cuplump_weight' => 0,
                'total_cuplump_cost' => 0,
                'total_ship_expense' => 0,
                'overall_ave_cost_kilo' => 0,
                'total_sales' => 0,
                'tax_rate' => 0,
                'tax_amount' => 0,
                'amount_paid' => 0,
                'unpaid_balance' => 0,
                'sales_proceed' => 0,
                'overall_cost' => 0,
                'gross_profit' => 0,
                'recorded_by' => '',
                'remarks' => '',
            ],
            'cuplump_container' => [
                'status' => 'In Progress',
                'van_no' => '',
                'location' => '',
                'remarks' => '',
                'recorded_by' => '',
                'total_cuplump_weight' => 0,
                'cuplump_selling_weight' => 0,
                'total_cuplump_cost' => 0,
                'ave_cuplump_cost' => 0,
                'ship_exp' => 0,
            ],
        ];

        $row = $defaults[$table] ?? [];
        if (isset($defaults[$table]) && in_array($table, ['sales_cuplump_shipment', 'bale_shipment_record'], true)) {
            $row['ship_date'] = $today;
        }
        if ($table === 'cuplump_container') {
            $row['loading_date'] = $today;
        }
        if ($table === 'bales_sales_record' || $table === 'sales_cuplump_record') {
            $row['transaction_date'] = $today;
        }

        return $row;
    }
}

if (!function_exists('sales_build_insert_sql')) {
    /**
     * @param array<string, scalar|null> $fields
     */
    function sales_build_insert_sql(mysqli $con, string $table, array $fields): string
    {
        $merged = array_merge(sales_create_defaults($table), $fields);
        $columns = [];
        $values = [];

        foreach ($merged as $column => $value) {
            $columns[] = '`' . str_replace('`', '', $column) . '`';
            if (is_int($value) || is_float($value)) {
                $values[] = (string) $value;
            } else {
                $values[] = "'" . sales_esc($con, $value) . "'";
            }
        }

        return 'INSERT INTO `' . str_replace('`', '', $table) . '` (' . implode(', ', $columns) . ') VALUES (' . implode(', ', $values) . ')';
    }
}

if (!function_exists('sales_run_insert')) {
    /**
     * @param array<string, scalar|null> $fields
     * @return int|false insert id or false
     */
    function sales_run_insert(mysqli $con, string $table, array $fields)
    {
        $sql = sales_build_insert_sql($con, $table, $fields);
        if (!mysqli_query($con, $sql)) {
            return false;
        }

        return (int) mysqli_insert_id($con);
    }
}
