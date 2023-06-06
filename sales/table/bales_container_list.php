<?php
include "../function/db.php";
$output = '';

$result  = mysqli_query($con, "SELECT *,container_record.container_id as con_id  from container_record 
LEFT JOIN container_bales_selection ON container_bales_selection.container_id =  container_record.container_id "); 

$total_cost = 0.0;
$total_weight = 0.0;
$total_bales = 0.0;
$cost_per_kilo = 0.0;

$output .= '
    <table class="table table-bordered table-hover table-striped"
        id="recording_table-receiving">
        <thead class="table-dark text-center" style="font-size: 14px !important">
            <tr>
                <th scope="col">Ref No.</th>
                <th scope="col">Container No.</th>
                <th scope="col">Van No.</th>
                <th scope="col">Withdrawal Date</th>
                <th scope="col">Quality</th>
                <th scope="col">Kilo per Bale</th>
                <th scope="col">No. of Bales</th>
                <th scope="col">Total Weight</th>
                <th scope="col" hidden>Bale Cost</th>
                <th scope="col">Remarks</th>
                <th scope="col">Recorded</th>
                <th scope="col">Status</th>
                <th scope="col">Action</th>
            </tr>
        </thead>';

if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_array($result)) {
        $status_color = '';
        switch($row['status']){
            case "Draft":
                $status_color = 'bg-info';
                break;
            case "In Progress":
                $status_color = 'bg-warning';
                break;
            case "Awaiting Shipment":
                $status_color = 'bg-success';
                break;
            case "Released":
                $status_color = 'bg-primary';
                break;
        }

        $output .= '
        <tr>
            <td>' . $row["con_id"] . '</td>
            <td>' . $row["container_no"] . '</td>
            <td>' . $row["van_no"] . '</td>
            <td>' . $row["withdrawal_date"] . '</td>
            <td>' . $row["quality"] . '</td>
            <td class="number-cell">' . $row["kilo_bale"] . ' kg</td>
            <td class="number-cell">' . number_format($row["num_bales"], 0, ".", ",") . ' pcs</td>
            <td class="number-cell">' . number_format($row["total_bale_weight"], 0, ".", ",") . ' kg</td>
            <td>' . $row["remarks"] . '</td>
            <td>' . $row["recorded_by"] . '</td>
            <td><span class="badge ' . $status_color . '">' . $row["status"] . '</span></td>
            <td class="text-center">
                <button type="button" class="btn btn-success btn-sm btnViewRecord" data-status="' . $row["status"] . '">
                    <i class="fas fa-book"></i>
                </button>
            </td>
    </tr>
        ';
    }
} else {
    $output .= '<tr>
     <td colspan="4">Nothings in the cart</td>
 </tr>';
}

$output .= '</table>';

echo $output;

?>

<!-- 
<script>
$(document).ready(function() {


    $('.addProduct').on('click', function() {


        $tr = $(this).closest('tr');
        var data = $tr.children("td").map(function() {
            return $(this).text();
        }).get();

        $tr.each(function() {
            var quantity = $(this).find(".keyvalue input").val();
            var inputBales = parseFloat($(this).find("input[name='bales_num[]']").val().replace(
                /,/g, ''));
            console.log(quantity);



            var bales_id = data[0];

            var sales_id = <?php echo $sales_id ?>;


            console.log(sales_id)

            console.log(bales_id)
            $.ajax({
                method: "POST",
                url: "table/button/bales_add_inventory.php",
                data: {
                    bales_id: bales_id,
                    sales_id: sales_id,
                    input_bales_number: inputBales
                },
                success: function(data) {
                    console.log('success');
                    console.log(data);
                    fetch_cost_weight();

                    Swal.fire({
                        position: 'center',
                        icon: 'success',
                        title: 'Inventory Added!',
                        showConfirmButton: false,
                        timer: 1000
                    })
                }
            });
        });


    });


});
</script> -->