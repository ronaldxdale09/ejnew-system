<?php 
   include('include/header.php');
   include "include/navbar.php";

?>

<style>
.number-cell {
    text-align: right;
}
</style>

<body>
    <link rel='stylesheet' href='css/statistic-card.css'>
    <div class='main-content' style='min-height:100vh;'>
        <div class="container home-section h-100" style="max-width:95%;">
            <div class="page-wrapper">
                <div class="row">
                    <div class="col-sm-12">

                        <h1 class="page-title">
                            <b>
                                <font color="#0C0070">Transfer</font>
                                <font color="#046D56"> Record (Dry Price) </font>
                            </b>
                        </h1>

                        <br>


                        <div class="container-fluid shadow p-3 mb-5 bg-white rounded">
                            <button type="button" class="btn btn-primary text-white" data-toggle="modal"
                                data-target="#createNew">CREATE TRANSFER</button>
                            <hr>
                            <div class="table-responsive">
                                <table class="table table-bordered table-hover table-striped" id='inventory-table'>
                                    <thead class="table-dark">
                                        <tr>

                                            <th scope="col">Status</th>
                                            <th scope="col"> ID</th>
                                            <th scope="col">Date</th>
                                            <th scope="col">Supplier</th>
                                            <th scope="col">Location</th>
                                            <th scope="col">Net Weight</th>
                                            <th scope="col">Price</th>
                                            <th scope="col">Cash Advance</th>
                                            <th scope="col">Recorded By</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $sql = "SELECT * FROM dry_price_transfer ORDER BY dry_id desc";
                                        $result = mysqli_query($con, $sql);
                                        if (mysqli_num_rows($result) > 0) {
                                            while($row = mysqli_fetch_assoc($result)) {

                                                $status = '';
                                                if ($row['planta_status'] == 1){
                                                    $status='EJN';
                                                }
                                                else {
                                                    $status='PLANTA';
                                                }

                                                echo "<tr>";
                                                echo "<td><span class=\"badge " . ($status === 'EJN' ? 'bg-success' : 'bg-warning') . "\">" . $status . "</span></td>";
                                                echo "<td>".$row['dry_id']."</td>";
                                                echo "<td>".date("M j, Y", strtotime($row['date']))."</td>";
                                                echo "<td>".$row['seller']."</td>";
                                                echo "<td>".$row['address']."</td>";
                                                echo "<td style='text-align: right'>" . number_format($row['net'], 2, '.', ',') . " kg</td>";
                                                echo "<td style='text-align: right'>₱ " . number_format($row['price'], 2, '.', ',') . "</td>";
                                                echo "<td style='text-align: right'>₱ " . number_format($row['cash_advance'], 0, '.', ',') . "</td>";                                                                                          
                                                echo "<td>".$row['recorded_by']."</td>";
                                                echo "<td>
                                                        <button type='button' class='btn btn-primary updateBtn'> <i class='fas fa-edit'></i> </button>
                                                        <button type='button' class='btn btn-danger deleteBtn'> <i class='fas fa-trash'></i> </button>
                                                    </td>";
                                            

                                                echo "</tr>";
                                            }
                                        } else {
                                            echo "<tr><td colspan='23'>No records found</td></tr>";
                                        }
                                        ?>
                                    </tbody>
                                </table>
                            </div>

                            <script>
                            $(document).ready(function() {
                                var table = $('#inventory-table').DataTable({
                                    "order": [
                                        [1, 'desc']
                                    ],
                                    "pageLength": -1,
                                    "dom": "<'row'<'col-sm-12 col-md-6'B><'col-sm-12 col-md-6'f>>" +
                                        "<'row'<'col-sm-12'tr>>" +
                                        "<'row'<'col-sm-12 col-md-5'><'col-sm-12 col-md-7'>>",
                                    "responsive": true,
                                    "buttons": [{
                                            extend: 'excelHtml5',
                                            text: 'Excel',
                                            exportOptions: {
                                                columns: ':visible'
                                            }
                                        },
                                        {
                                            extend: 'pdfHtml5',
                                            text: 'PDF',
                                            exportOptions: {
                                                columns: ':visible'
                                            }
                                        },
                                        {
                                            extend: 'print',
                                            text: 'Print',
                                            exportOptions: {
                                                columns: ':visible'
                                            }
                                        }
                                    ]
                                });
                            });
                            </script>


                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>



</body>

</html>

<?php 
$seller = "SELECT * FROM rubber_seller   where loc='$loc'";
$result = mysqli_query($con, $seller);
$sellerList = "";
while ($arr = mysqli_fetch_array($result)) {
    $sellerList .=
        '<option value="' .$arr["name"] .'">'.$arr["name"] ."</option>";
}  ?>

<!-- create Table Row -->
<div class="modal fade" id="createNew" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel"
    aria-hidden="true">
    <div class="modal-dialog  ">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"> EJN RUBBER | TRANSFER</h5>
            </div>
            <form method='POST' action='function/newDryReceiving.php'>

                <div class="modal-body">

                    <center>
                        <h5> Create New Cuplumps Transfer (Dry Price) </h5>

                        <hr>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="product_name" class="form-label">Date.</label>
                                    <input type="date" class="form-control" name="date"
                                        value="<?php echo date('Y-m-d'); ?>" required>

                                </div>
                            </div>
                            <div class="col-md-6">
                                <label for="product_name" class="form-label">Recorded By</label>
                                <input type="text" class="form-control" name="recorded_by" placeholder="Recorded By"
                                    value='JANE' required>
                            </div>
                        </div>


                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="col-md-12">Seller </label>
                                    <select class='select_seller col-md-10' name='name' id='name' required>
                                        <option disabled="disabled" value='' selected="selected">Select
                                            Seller
                                        </option>
                                        <?php echo $sellerList; ?>
                                    </select>

                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="col-md-12">Address</label>
                                    <div class="col-md-12">
                                        <input name="address" id="address" class="form-control" required>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </center>
                    <hr>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="product_name" class="form-label">Net Cuplumps Weight</label>
                                <input type="text" class="form-control" name="net" onkeypress="return CheckNumeric()"
                                    onkeyup="FormatCurrency(this)" required>

                            </div>
                        </div>
                        <div class="col-md-6">
                            <label for="product_name" class="form-label">Dry Price</label>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">₱</span>
                                </div>
                                <input type="text" class="form-control" id='price' name='price'
                                    onkeypress="return CheckNumeric()" onkeyup="FormatCurrency(this)" tabindex="8"
                                    autocomplete='off' />
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="mb-3">
                            <label for="product_name" class="form-label">Cash Advance</label>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">₱</span>
                                </div>
                                <input type="text" class="form-control" id='less' name='cash_advance'
                                    onkeypress="return CheckNumeric()" onkeyup="FormatCurrency(this)" tabindex="8"
                                    autocomplete='off' />
                            </div>
                        </div>
                    </div>


                </div>
                <div class="modal-footer">
                    <button type="submit" name='new' class="btn btn-success">Proceed</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>

                </div>
            </form>
        </div>
    </div>
</div>



<div class="modal fade" id="updateRecord" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel"
    aria-hidden="true">
    <div class="modal-dialog  ">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"> EJN RUBBER | TRANSFER</h5>
            </div>
            <form method='POST' action='function/newDryReceiving.php'>
                <input type="text" class="form-control" id="u_id" name='dry_id' hidden>
                <div class="modal-body">

                    <center>
                        <h5> Create New Cuplumps Transfer (Dry Price) </h5>

                        <hr>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="product_name" class="form-label">Date.</label>
                                    <input type="date" class="form-control" name="date" id='u_date'
                                        value="<?php echo date('Y-m-d'); ?>" required>

                                </div>
                            </div>
                            <div class="col-md-6">
                                <label for="product_name" class="form-label">Recorded By</label>
                                <input type="text" class="form-control" name="recorded_by" id='u_date'
                                    placeholder="Recorded By" value='JANE' required>
                            </div>
                        </div>


                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="col-md-12">Seller </label>
                                    <select class='select_seller col-md-10' name='name' id='u_supplier' required>
                                        <option disabled="disabled" value='' selected="selected">Select
                                            Seller
                                        </option>
                                        <?php echo $sellerList; ?>
                                    </select>

                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="col-md-12">Address</label>
                                    <div class="col-md-12">
                                        <input name="address" id="u_loc" class="form-control" required>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </center>
                    <hr>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="product_name" class="form-label">Net Cuplumps Weight</label>
                                <input type="text" class="form-control" name="net" id='u_net'
                                    onkeypress="return CheckNumeric()" onkeyup="FormatCurrency(this)" required>

                            </div>
                        </div>
                        <div class="col-md-6">
                            <label for="product_name" class="form-label">Dry Price</label>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">₱</span>
                                </div>
                                <input type="text" class="form-control" id='u_price' name='price'
                                    onkeypress="return CheckNumeric()" onkeyup="FormatCurrency(this)" tabindex="8"
                                    autocomplete='off' />
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="mb-3">
                            <label for="product_name" class="form-label">Cash Advance</label>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">₱</span>
                                </div>
                                <input type="text" class="form-control" id='u_less' name='cash_advance'
                                    onkeypress="return CheckNumeric()" onkeyup="FormatCurrency(this)" tabindex="8"
                                    autocomplete='off' />
                            </div>
                        </div>
                    </div>


                </div>
                <div class="modal-footer">
                    <button type="submit" name='update' class="btn btn-success">Update</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>

                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Confirm Delete</h5>
                <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method='POST' action='function/newDryReceiving.php'>
                <div class="modal-body">
                    <input type="text" class="form-control" id="d_id" name='dry_id' hidden>
                    <p class="text-center text-danger"><i class="fa fa-exclamation-triangle"
                            style="font-size: 2em;"></i>
                    </p>
                    <p class="text-center">Are you sure you want to delete this record?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-danger" name='delete'>Delete</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
$(function() {
    $(".select_seller").chosen({
        width: "100%", // forcing width of the select
        search_threshold: 10
    });

    // Assume your modal id is "myModal", replace "myModal" with your actual modal id
    $('#createNew').on('shown.bs.modal', function(e) {
        $(".select_seller").trigger("chosen:updated");
    })
});


$("#name").on("change", function() {
    fetchAddress($(this).val());
});


function fetchAddress(name) {
    // AJAX request for address
    $.post("include/fetch/fetchLocation.php", {
        name: name
    }, function(address) {
        // $("#address").html(address);
        $("#address").val(address);

    });
}

$('.updateBtn').click(function() {


    $tr = $(this).closest('tr');

    var data = $tr.children("td").map(function() {
        return $(this).text();
    }).get();
    $('#u_date').val(data[2]);
    $('#u_id').val(data[1]);
    $('#u_supplier').val(data[3]).trigger('chosen:updated');
    $('#u_loc').val(data[4]);
    $('#u_net').val(data[5].replace(/[^0-9\.]/g, ''));
    $('#u_price').val(data[6].replace(/[^0-9\.]/g, ''));
    $('#u_less').val(data[7].replace(/[^0-9\.]/g, ''));
    $('#u_recorded_by').val(data[8]);

    $('#updateRecord').modal('show');
});

$('.deleteBtn').click(function() {


    $tr = $(this).closest('tr');

    var data = $tr.children("td").map(function() {
        return $(this).text();
    }).get();

    $('#d_id').val(data[1]);


    $('#deleteModal').modal('show');
});
</script>