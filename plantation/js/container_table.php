<script>
function fetch_data() {
    var container_id = $('#ref_no').val();
    $.ajax({
        url: "table/contaner_selectedList.php",
        method: "POST",
        data: {
            container_id: container_id,
        },
        dataType: "json",
        success: function(data) {
            $('#selected_inventory').html(data.output);
            $('#num_bales').val(data.total_bales); // Update the total number of bales

            $('#num_bales').val(data.total_bales.toLocaleString() + " pcs");

            // Format total weight with comma separators, then append " kg"
            $('#total_bale_weight').val(data.total_weight.toLocaleString() + " kg");

        }
    });
}
fetch_data();
</script>