<script>
function fetch_cost_weight() {

    $.ajax({
        url: "table/bales-sales-table.php",
        method: "POST",
        data: {
            sales_id: <?php echo $id ?>,

        },
        success: function(data) {
            $('#cost_weight_table').html(data);
            // Update the hidden input fields
            // $('#hidden_cuplumps_total_cost').val($('#cuplumps_total_cost').val());
            // $('#hidden_cuplumps_total_weight').val($('#cuplumps_total_weight').val());
            // $('#hidden_cuplumps_average_per_kilo').val($('#cuplumps_average_per_kilo').val());
        }
    });
}
fetch_cost_weight();
</script>