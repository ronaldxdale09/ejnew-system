<?php
include('../../function/db.php');
$shipment_id = $_POST['shipment_id'];
$number_container = 0;
$output = '';
$van_no = 0;
$result  = mysqli_query($con, "SELECT * from sales_cuplump_shipment_container where shipment_id='$shipment_id' ");
// $total_bales = 0;
// $total_weight = 0;
// $number_container = 0;
$output .= '
<div class="table-responsive">
<table class="table table-bordered table-hover table-striped" id="container_table">
           <thead class="table-dark" style="font-size: 12px !important" >
           <tr>
                                                        <th scope="col">Container ID.</th>
                                                        <th scope="col">Container No.</th>
                                                        <th scope="col">Loading Date</th>
                                                        <th scope="col">Total Weight</th>
                                                        <th scope="col">Ave Cost</th>
                                                        <th scope="col">Total Cost</th>
                                                        <th scope="col"></th>
       </tr>
           </thead>';

if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_array($result)) {
        $number_container++;
        $output .= '
        <tr>
            <td>' . $row["container_id"] . '</td>
            <td>' . $row["van_no"] . '</td>
            <td>' . $row["loading_date"] . '</td>
            <td>' . number_format($row["total_weight"], 2) . ' kg</td>
            <td>₱ ' . number_format($row["total_cost"], 2) . ' </td>
            <td>₱ ' . number_format($row["ave_cost"], 2) . ' </td>
            <td><button type="button" id="removeContainer" class="btn btn-danger btn-sm removeContainer"><i
            class="fa fa-trash"></i></button> </td>
        </tr>
        ';
    }
} else {
    $output .= '<tr>
     <td colspan="4">Nothings in the cart</td>
 </tr>';
}

$output .= '</table>
</div>
<hr>

<script>
document.getElementById("number_container").value = "' . $number_container . '";
</script>


';

echo $output;

?>



<script>
    $(document).ready(function() {


        $('.removeContainer').on('click', function() {


            $tr = $(this).closest('tr');
            var data = $tr.children("td").map(function() {
                return $(this).text();
            }).get();

            $tr.each(function() {
                ;


                var container_id = data[0];
                var shipment_id = <?php echo $shipment_id ?>;

                $.ajax({
                    method: "POST",
                    url: "table/button/cuplump_remove_inventory.php",
                    data: {
                        container_id: container_id,
                        shipment_id: shipment_id,


                    },
                    success: function(data) {
                        console.log('success');
                        console.log(data);
                        fetch_container_list();
                        computeTotals();
                        calculateShippingExpenses()
                        Swal.fire({
                            position: 'center',
                            icon: 'info',
                            title: 'Container Removed!',
                            showConfirmButton: false,
                            timer: 1000
                        })
                    }
                });
            });


        });

        function computeTotals() {
            let totalWeight = 0;
            let totalCost = 0;
            let totalAvgCost = 0;
            let totalContainers = 0;

            const table = document.getElementById('container_table');
            const rows = table.getElementsByTagName('tr');

            for (let i = 1; i < rows.length; i++) {
                const cells = rows[i].getElementsByTagName('td');
                if (cells.length > 0) {
                    const weight = parseFloat(cells[3].innerText.replace(/,/g, ''));
                    const cost = parseFloat(cells[4].innerText.replace(/₱/g, '').replace(/,/g, ''));
                    const avgCost = parseFloat(cells[5].innerText.replace(/₱/g, '').replace(/,/g, ''));
                    totalWeight += weight;
                    totalCost += cost;
                    totalAvgCost += avgCost;
                    totalContainers++;
                }
            }

            const averageCost = totalContainers === 0 ? 0 : totalAvgCost / totalContainers;

            document.getElementById('total-cuplump-weight').value = totalWeight.toLocaleString(undefined, {
                minimumFractionDigits: 2,
                maximumFractionDigits: 2
            });
            document.getElementById('total-cuplump-cost').value = totalCost.toLocaleString(undefined, {
                minimumFractionDigits: 2,
                maximumFractionDigits: 2
            });
            document.getElementById('average-cuplump-cost').value = averageCost.toLocaleString(undefined, {
                minimumFractionDigits: 2,
                maximumFractionDigits: 2
            });
        }

        computeTotals();



    });
</script>