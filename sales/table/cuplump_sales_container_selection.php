<?php
include('../../function/db.php');
$output = '';

$sales_id = $_POST['sales_id'];

$result  = mysqli_query($con, "SELECT *,sales_cuplump_container.container_id as con_id from sales_cuplump_container 
LEFT JOIN bales_container_selection ON bales_container_selection.container_id =  sales_cuplump_container.container_id 
where sales_cuplump_container.status ='Shipped Out'
  GROUP BY sales_cuplump_container.container_id");

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
        id="recording_table-receiving">
        <thead class="table-dark text-center" style="font-size: 14px !important">
            <tr>
                <th scope="col">ID.</th>
                <th scope="col">Van No.</th>
                <th scope="col" >Loading Date</th>
                <th scope="col">Total Weight</th>
                <th scope="col">Shipping Exp.</th>
                <th scope="col">Total Cuplump Cost</th>
                <th scope="col">Average Cost</th>
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
            <td >' .  date("F j, Y", strtotime($row["loading_date"])) . '</td>
            <td class="nowrap number-cell">' . number_format($row["total_cuplump_weight"], 0, ".", ",") . ' kg</td>

            <td class="nowrap number-cell" >₱ ' . number_format($row["ship_exp"], 2, ".", ",") . ' </td>
            <td class="nowrap number-cell" >₱ ' . number_format($row["total_cuplump_cost"] + $row["ship_exp"], 2, ".", ",") . ' </td>
            <td class="nowrap number-cell" >₱ ' . number_format($row["ave_cuplump_cost"], 2, ".", ",") . ' </td>
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
                var sales_id = <?php echo $sales_id ?>;

                var van_no = data[1];
                var date = data[2];
                var total_weight = data[3];
                var ship_exp = data[4];
                var total_cost = data[5];
                var ave_cost = data[6];

                $.ajax({
                    method: "POST",
                    url: "table/button/cuplump_sales_add_container.php",
                    data: {
                        container_id: container_id,
                        sales_id: sales_id,
                        van_no: van_no,
                        total_weight: total_weight,
                        ship_exp: ship_exp,
                        total_cost:total_cost,
                        ave_cost:ave_cost

                    },
                    success: function(data) {
                        console.log('success');
                        console.log(data);
                        fetch_container();
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