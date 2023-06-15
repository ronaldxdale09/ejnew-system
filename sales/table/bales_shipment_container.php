<?php
include "../function/db.php";
$output = '';
$shipment_id = $_POST['shipment_id'];

$result  = mysqli_query($con, "SELECT * from bales_shipment_container ");
$total_bales = 0;
$total_weight = 0;
$number_container = 0;
$output .= '
<table class="table table-bordered table-hover table-striped" id="recording_table-receiving">
           <thead class="table-dark" style="font-size: 12px !important" >
           <tr>
           <th>ID</th>
           <th scope="col">Van No.</th>
           <th scope="col">Bale Quality</th>
           <th scope="col">Kilo per Bale</th>
           <th scope="col">No. of Bales</th>
           <th scope="col">Total Weight</th>
           <th scope="col">Remarks</th>
    
           <th ></th>
       </tr>
           </thead>';

if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_array($result)) {
        $total_bales +=  preg_replace("/[^0-9\.]/", "", $row['num_bales']);
        $total_weight += $row["total_weight"];
        $number_container ++;
        $output .= '
        <tr>
            <td>' . $row["container_id"] . '</td>
            <td>' . $row["van_no"] . '</td>
            <td>' . $row["bale_quality"] . '</td>
            <td>' . $row["kilo_bale"] . ' </td>
            <td>' . $row["num_bales"] . ' PCS</td>
            <td>' . $row["total_weight"] . '</td>
            <td>' . $row["remarks"] . '</td>
            <td><button type="button" id="addProduct" class="btn btn-danger btn-sm addProduct"><i
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
<hr>
    <div class="row">
        <div class="col">
            <label style="font-size:15px;font-weight:bold" class="col-md-12">No. of
                Bales</label>
            <div class="input-group mb-3">
                <input type="text" class="form-control" name="total_num_bales" id="total_kilo" tabindex="7" autocomplete="off"  value="'.number_format($total_bales).'" style="width: 100px;" readonly>
                <span class="input-group-text"> pcs</span>
            </div>
        </div>
        <div class="col">
            <label style="font-size:15px;font-weight:bold" class="col-md-12">Total
                Bale Weight</label>
            <div class="input-group mb-3">
                <input type="text" class="form-control" name="total_bale_weight" id="total_kilo" tabindex="7" autocomplete="off" style="width: 100px;"  value="'.number_format($total_weight).'" readonly>
                <span class="input-group-text"> kg</span>
            </div>
        </div>
    </div>

    <script>
    document.getElementById("number_container").value = "'.$number_container.'";

    </script>


';

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

                $.ajax({
                    method: "POST",
                    url: "table/button/bales_remove_container.php",
                    data: {
                        container_id: container_id,
                        shipment_id: shipment_id,


                    },
                    success: function(data) {
                        console.log('success');
                        console.log(data);
                        fetch_container_list();
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


    });
</script>