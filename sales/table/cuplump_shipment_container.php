<?php
include "../function/db.php";
$output = '';
$van_no = 0;
$result  = mysqli_query($con, "SELECT * from sales_cuplump_container ");
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
                                                        <th scope="col">Cuplump Cost</th>
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
            <td>' . $row["total_cuplump_weight"] . ' </td>
            <td>' . $row["total_cuplump_cost"] . ' PCS</td>
            <td>' . $row["remarks"] . '</td>
            <td>' . $row["recorded_by"] . '</td>
            <td><button type="button" id="addCuplump" class="btn btn-danger btn-sm addCuplump"><i
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
                var container_cuplump_id = <?php echo $container_cuplump_id ?>;

                $.ajax({
                    method: "POST",
                    url: "table/button/cuplump_remove_inventory.php",
                    data: {
                        container_id: container_id,
                        container_cuplump_id: container_cuplump_id,


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