<script>
function fetch_cost_weight() {

    $.ajax({
        url: "table/wSales_cost_weight.php",
        method: "POST",
        data: {
            sales_id: <?php echo $id ?>,

        },
        success: function(data) {
            $('#cost_weight_table').html(data);
        }
    });
}
fetch_cost_weight();
</script>