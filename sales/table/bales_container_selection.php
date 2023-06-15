<?php
include "../function/db.php";
$output = '';

$shipment_id = $_POST['shipment_id'];

$result  = mysqli_query($con, "SELECT *,container_record.container_id as con_id  from container_record 
LEFT JOIN container_bales_selection ON container_bales_selection.container_id =  container_record.container_id 
  GROUP BY container_record.container_id");

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
        switch ($row['status']) {
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
                <button type="button" class="btn btn-warning btn-sm addProduct" data-status="' . $row["status"] . '">
                    <i class="fas fa-plus"></i>
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


<script>
    $(document).ready(function() {


        $('.addProduct').on('click', function() {


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
                var quantity = data[3];
                var kilo_bale = data[4];
                var num_bales = data[5];
                var total_weight = data[6];
                var remarks = data[7];

                console.log("container_id:", container_id);
                console.log("shipment_id:", shipment_id);
                console.log("van_no:", van_no);
                console.log("date:", date);
                console.log("quantity:", quantity);
                console.log("kilo_bale:", kilo_bale);
                console.log("num_bales:", num_bales);
                console.log("total_weight:", total_weight);
                console.log("remarks:", remarks);
                $.ajax({
                    method: "POST",
                    url: "table/button/bales_add_container.php",
                    data: {
                        container_id: container_id,
                        shipment_id: shipment_id,
                        van_no: van_no,
                        quantity: quantity,
                        kilo_bale: kilo_bale,
                        num_bales: num_bales,
                        total_weight: total_weight,
                        remarks: remarks

                    },
                    success: function(data) {
                        console.log('success');
                        console.log(data);
                        fetch_container_list();
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
</script>