<?php
include('../../function/db.php');
$output = '';

$sales_id = $_POST['sales_id'];

$result  = mysqli_query($con, "SELECT *,bales_container_record.container_id as con_id,bales_container_record.num_bales as total_bales  from bales_container_record 
LEFT JOIN bales_container_selection ON bales_container_selection.container_id =  bales_container_record.container_id 
where bales_container_record.status ='Shipped Out'
  GROUP BY bales_container_record.container_id");

$total_cost = 0.0;
$total_weight = 0.0;
$total_bales = 0.0;
$cost_per_kilo = 0.0;

$output .= '

<style>
.nowrap {
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
}
</style>
    <table class="table table-bordered table-hover table-striped"
        id="cotaniner-selection">
        <thead class="table-dark text-center" style="font-size: 14px !important">
            <tr>
                <th scope="col">ID.</th>
                <th scope="col">Van No.</th>
                <th scope="col" hidden>Withdrawal Date</th>
                <th scope="col">Quality</th>
                <th scope="col">Kilo per Bale</th>
                <th scope="col">No. of Bales</th>
                <th scope="col">Total Weight</th>
                <th scope="col">Bale Cost</th>
                <th scope="col">Milling Cost</th>
                <th scope="col" hidden>Bale Cost</th>
                <th scope="col" hidden>Milling Cost</th>
                <th scope="col">Shipping Exp.</th>
                <th scope="col">Remarks</th>
                <th scope="col">Action</th>
            </tr>
        </thead>';

if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_array($result)) {
        $status_color = '';
        switch ($row['status']) {
            case "Shipped Out":
                $status_color = 'bg-dark';
                break;
        }

        $output .= '
        <tr>
            <td class="nowrap">' . $row["con_id"] . '</td>
            <td class="nowrap">' . $row["van_no"] . '</td>
            <td hidden>' .  date("F j, Y", strtotime($row["withdrawal_date"])) . '</td>
            <td class="nowrap">' . $row["quality"] . '</td>
            <td class="nowrap number-cell">' . $row["kilo_bale"] . ' kg</td>
            <td class="nowrap number-cell">' . number_format($row["total_bales"], 0, ".", ",") . ' pcs</td>
            <td class="nowrap number-cell">' . number_format($row["total_bale_weight"], 0, ".", ",") . ' kg</td>
            <td class="nowrap number-cell" >₱ ' . number_format($row["total_bale_cost"], 2, ".", ",") . ' </td>
            <td class="nowrap number-cell" >₱ ' . number_format($row["total_milling_cost"], 2, ".", ",") . ' </td>
            <td class="nowrap number-cell" hidden>≈ ₱ ' . number_format($row["average_kilo_cost"] - ($row["total_milling_cost"] / $row["total_bale_weight"]), 2, ".", ",") . ' </td>
            <td class="nowrap number-cell" hidden>₱ ' . number_format($row["total_milling_cost"] / $row["total_bale_weight"], 2, ".", ",") . ' </td>
            <td class="nowrap number-cell" >₱ ' . number_format($row["shipping_expense"], 2, ".", ",") . ' </td>
            <td class="nowrap">' . $row["remarks"] . '</td>
         
            <td class="nowrap text-center">
                <button type="button" class="btn btn-warning btn-sm addProduct" data-status="' . $row["status"] . '">
                    <i class="fas fa-plus"></i>
                </button>
            </td>
        </tr>
        ';
    }
} else {
    $output .= '<tr>
     <td colspan="4">No data available</td>
 </tr>';
}

$output .= '</table>';

echo $output;

?>


<script>
    $(document).ready(function() {

        var table = $('#cotaniner-selection').DataTable({
            "order": [
                [0, 'desc']
            ],
            "pageLength": -1,
            "dom": "<'row'<'col-sm-12 col-md-6'B><'col-sm-12 col-md-6'f>>" +
                "<'row'<'col-sm-12'tr>>" +
                "<'row'<'col-sm-12 col-md-5'><'col-sm-12 col-md-7'>>",
            "responsive": true,

        });

        $('.addProduct').on('click', function() {


            $tr = $(this).closest('tr');
            var data = $tr.children("td").map(function() {
                return $(this).text();
            }).get();

            $tr.each(function() {
                ;


                var container_id = data[0];
                var sales_id = <?php echo $sales_id ?>;

                var van_no = data[1];
                var date = data[2];
                var quantity = data[3];
                var kilo_bale = data[4];
                var num_bales = data[5];
                var total_weight = data[6];

                var total_bale_cost = data[7];
                var total_milling_cost = data[8];


                var ship_exp = data[11];
                var remarks = data[12];

                console.log("container_id:", container_id);
                console.log("sales_id:", sales_id);
                console.log("van_no:", van_no);
                console.log("date:", date);
                console.log("quantity:", quantity);
                console.log("kilo_bale:", kilo_bale);
                console.log("num_bales:", num_bales);
                console.log("total_weight:", total_weight);
                console.log("Shipping Exp:", ship_exp);
                console.log("remarks:", remarks);
                $.ajax({
                    method: "POST",
                    url: "table/button/bales_sales_add_container.php",
                    data: {
                        container_id: container_id,
                        sales_id: sales_id,
                        van_no: van_no,
                        quantity: quantity,
                        kilo_bale: kilo_bale,
                        num_bales: num_bales,
                        total_weight: total_weight,
                        ship_exp: ship_exp,
                        total_bale_cost: total_bale_cost,
                        total_milling_cost: total_milling_cost,
                        remarks: remarks

                    },
                    success: function(data) {
                        console.log('success');
                        console.log(data);
                        fetch_container();
                        changeGrossProfitColor();
                        computeGrossSales();
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