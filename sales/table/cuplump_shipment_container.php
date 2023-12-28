<?php
include('../../function/db.php');

$shipment_id = $_POST['shipment_id'];

$output = '';
$van_no = 0;
$result  = mysqli_query($con, "SELECT * from cuplump_container where status='Awaiting Shipment' ");
// $total_bales = 0;
// $total_weight = 0;
// $number_container = 0;
$output .= '
<table class="table table-bordered table-hover table-striped" id="recording_table-receiving">
           <thead class="table-dark" style="font-size: 12px !important" >
           <tr>
                                                        <th scope="col">Container ID.</th>
                                                        <th scope="col">Container No.</th>
                                                        <th scope="col">Loading Date</th>
                                                        <th scope="col">Total Weight</th>
                                                        <th scope="col">Ave Cost</th>
                                                        <th scope="col">Total Cost</th>
                                                        <th scope="col">Remarks</th>
                                                        <th scope="col">Recorded by</th>
                                                        <th scope="col"></th>
       </tr>
           </thead>';

if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_array($result)) {

        $output .= '
        <tr>
            <td>' . $row["container_id"] . '</td>
            <td>' . $row["van_no"] . '</td>
            <td>' . $row["loading_date"] . '</td>
            <td>' . number_format($row["total_cuplump_weight"], 2) . ' kg</td>
            <td>₱ ' . number_format($row["ave_cuplump_cost"], 2) . ' </td>
            <td>₱ ' . number_format($row["total_cuplump_cost"], 2) . ' </td>
            <td>' . $row["remarks"] . '</td>
            <td>' . $row["recorded_by"] . '</td>
            <td><button type="button" id="addCuplump" class="btn btn-warning btn-sm addCuplump"><i
            class="fa fa-plus"></i></button> </td>
        </tr>
        ';
    }
} else {
    $output .= '<tr>
     <td colspan="4">No data available</td>
 </tr>';
}

$output .= '</table>
<hr>
   


';

echo $output;

?>


<script>
    $(document).ready(function() {



        $('.addCuplump').on('click', function() {


            $tr = $(this).closest('tr');
            var data = $tr.children("td").map(function() {
                return $(this).text();
            }).get();

            $tr.each(function() {
                ;


                var container_id = data[0];
                var shipment_id = <?php echo $shipment_id ?>;

                var van_no = data[1];
                var date = data[2];
                var total_weight = data[3];
                var ave_cost = data[4];
                var total_cost = data[5];

         
                $.ajax({
                    method: "POST",
                    url: "table/button/cuplump_add_container.php",
                    data: {
                        container_id: container_id,
                        date: date,
                        shipment_id: shipment_id,
                        van_no: van_no,
                        total_weight: total_weight,
                        ave_cost: ave_cost,
                        total_cost: total_cost

                    },
                    success: function(data) {
                        console.log('success');
                        console.log(data);
                        fetch_container_list();
                        calculateShippingExpenses()
                        Swal.fire({
                            position: 'center',
                            icon: 'success',
                            title: 'Container Added!',
                            showConfirmButton: false,
                            timer: 1000
                        })
                    }
                });
            });


        });



    });
</script>