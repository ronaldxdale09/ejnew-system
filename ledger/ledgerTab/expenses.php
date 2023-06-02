<style>

</style>

<?php 

$sql = "SELECT * FROM ledger_expenses ";
$res = mysqli_query($con, $sql);
$category='';
while($array = mysqli_fetch_array($res))
{
$category .= '
<option value="'.$array["category"].'">'.$array["category"].'</option>';
}

?>
<div class="row">

    <div class="col">
        <div class="stat-card">
            <div class="stat-card__content">
                <p class="text-uppercase mb-1 text-muted">EXPENSES TODAY ( <?php echo date("F j, Y") ; ?>)</p>
                <h2><i class="text-danger font-weight-bold mr-1"></i>
                    ₱ <?php echo number_format(empty($expense_today['total']) ? 0 : $expense_today['total']); ?>

                </h2>
                <div>

                </div>
            </div>
            <div class="stat-card__icon stat-card__icon--success">
                <div class="stat-card__icon-circle">
                    <i class="fa fa-money" aria-hidden="true"></i>
                </div>
            </div>
        </div>
    </div>
    <div class="col">

        <div class="stat-card">
            <div class="stat-card__content">

                <p class="text-uppercase mb-1 text-muted">EXPENSES THIS MONTH ( <?php echo date("F ") ; ?>)</p>
                <h2><i class="text-danger font-weight-bold mr-1"></i>
                    ₱
                    <?php echo number_format(empty($expense_month['month_total']) ? 0 : $expense_month['month_total']); ?>

                </h2>



            </div>
            <div class="stat-card__icon stat-card__icon--danger">
                <div class="stat-card__icon-circle">
                    <i class="fa fa-money" aria-hidden="true"></i>
                </div>
            </div>
        </div>
    </div>
    <div class="col">


        <div class="stat-card">
            <div class="stat-card__content">
                <p class="text-uppercase mb-1 text-muted">EXPENSES THIS YEAR (<?php echo date("Y ") ; ?>)</p>
                <h2><i class="text-danger font-weight-bold mr-1"></i>
                    ₱ <?php echo number_format(empty($expense_year['year_total']) ? 0 : $expense_year['year_total']); ?>
                </h2>

            </div>
            <div class="stat-card__icon stat-card__icon--warning">
                <div class="stat-card__icon-circle">
                    <i class="fa fa-money" aria-hidden="true"></i>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row" style="white-space: nowrap; overflow: auto; display: flex; align-items: center;">
    <div class="col-sm-4" style="flex: 0 0 auto;">
        <button type="button" class="btn btn-success text-white" data-toggle="modal" data-target="#addExpense">
            <i class="fa fa-plus" aria-hidden="true"></i> ADD EXPENSE
        </button>
        <button type="button" class="btn btn-dark text-white" data-toggle="modal" data-target="#categoryModal">
            <i class="fa fa-book" aria-hidden="true"></i> CATEGORY
        </button>
    </div>
    <div class="col-sm-2" style="flex: 0 0 auto;"> <br>
        <select class='form-select' name='category' id='category_filter'>
            <option disabled="disabled" selected>Select Category </option>
            <option value=''>All</option>
            <?php echo $category?>
            <!--PHP echo-->
        </select>
    </div>
    <div class="col-sm-6" style="flex: 0 0 auto;">
        <div id="datatable_filter">
            <label>From: <input type="text" class='form-control' id="min" name="min"></label>
            <label>To: <input type="text" class='form-control' id="max" name="max"></label>
            <button class='btn btn-primary' id="today">Today</button>
            <button class='btn btn-secondary' id="this-week">This Week</button>
            <button class='btn btn-dark' id="this-month">This Month</button>
        </div>
    </div>
</div>



<hr>
<?php
                $date = isset($_GET['date']) ? $_GET['date'] : date('Y-m-d'); // set $date to the requested date or today's date in yyyy-mm-dd format
                $results = mysqli_query($con, "SELECT * FROM ledger_expenses  ORDER BY id DESC");
                ?>
<!-- expenses table -->
<div class="table-responsive">
    <table class="table" id="expenses_table">
        <thead class="table-dark">
            <tr>
                <th scope="col">DATE</th>
                <th scope="col">PARTICULARS</th>
                <th scope="col">VOC#</th>
                <th scope="col">CATEGORY</th>
                <th scope="col">Expense Type</th>
                <th scope="col">AMOUNT</th>
                <th scope="col">REMARKS</th>
                <th scope="col">ACTION</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($row = mysqli_fetch_array($results)) { ?>
            <tr>
                <td>
                    <?php 
                        $date = new DateTime($row['date']);
                        echo $date->format('F j, Y'); // Outputs date as "May 14, 2023"
                    ?>
                </td>
                <td>
                    <?php echo $row['particulars'] ?>
                </td>
                <td>
                    <?php echo $row['voucher_no'] ?>
                </td>
                <td>
                    <?php echo $row['category'] ?>
                </td>
                <td>
                    <?php echo $row['type_expense'] ?>
                </td>
                <td>₱
                    <?php echo number_format($row['amount']) ?>
                </td>
                <td>
                    <?php echo $row['remarks'] ?>
                </td>
                <td>
                    <button type="button" class="btn btn-secondary text-white btnPressUpdate"
                        data-id="<?php echo $row['id'] ?>" data-voucher_no="<?php echo $row['voucher_no'] ?>"
                        data-particulars="<?php echo $row['particulars'] ?>" data-date="<?php echo $row['date'] ?>"
                        data-type="<?php echo $row['type_expense'] ?>" data-amount="<?php echo $row['amount'] ?>"
                        data-description="<?php echo $row['description'] ?>"
                        data-mode_transact="<?php echo $row['mode_transact'] ?>"
                        data-category="<?php echo $row['category'] ?>"
                        data-date_payment="<?php echo $row['date_payment'] ?>"
                        data-location="<?php echo $row['location'] ?>">
                        <span class="fa fa-edit"></span>
                    </button>
                    <button type="button" class="btn btn-danger text-white btnExpenseDelete"
                    
                    data-id="<?php echo $row['id'] ?>">
                        <span class="fa fa-trash"></span>
                    </button>
                </td>
            </tr>
            <?php } ?>
        </tbody>
        <tfoot>
            <th></th>
            <th></th>
            <th></th>
            <th></th>
            <th></th>
            <th></th>
        </tfoot>
    </table>

</div>




<script>
$('#addExpense').on('shown.bs.modal', function() {
    $('.ex_category', this).chosen();
});

$(document).ready(function() {


    $('.btnPressUpdate').on('click', function() {
        var id = $(this).attr('data-id');
        var voucher = $(this).attr('data-voucher_no');
        var date = $(this).attr('data-date');
        var type = $(this).attr('data-type');
        var amount = $(this).attr('data-amount');
        var description = $(this).attr('data-description');
        var particulars = $(this).attr('data-particulars');
        var category = $(this).attr('data-category'); // Added this line
        var mode_transact = $(this).attr('data-mode_transact');
        var date_payment = $(this).attr('data-date_payment');
        var location = $(this).attr('data-location');

        $('#update_id').val(id);
        $('#u_date_transaction').val(date);
        $('#u_date_payment').val(date_payment);
        $('#u_location').val(location);
        $('#u_voucher').val(voucher);
        $('#u_type').val(type);
        $('#u_particular').val(particulars);
        $('#u_category').val(category); // Added this line
        $('#u_mode_transaction').val(mode_transact);
        $('#u_amount').val(amount);
        $('#u_remarks').val(description);
        $('#updateExpense').modal('show');
    });

    $('.btnExpenseDelete').on('click', function() {
        var del_id = $(this).data('id');


        $('#del_id').val(del_id);

        $('#removeExpenseModal').modal('show');
    });





    $.fn.dataTable.ext.search.push(
        function(settings, data, dataIndex) {
            var min = $('#min').datepicker("getDate");
            var max = $('#max').datepicker("getDate");
            var startDate = new Date(data[0]);

            if (min == null && max == null) return true;
            if (min == null && startDate <= max) return true;
            if (max == null && startDate >= min) return true;
            if (startDate <= max && startDate >= min) return true;
            return false;
        }
    );




    var table = $('#expenses_table').DataTable({
        dom: '<"top"<"left-col"B><"center-col"f>>lrtip',
        "pageLength": 50,

        order: [
            [0, 'desc']
        ],
        buttons: [{
                extend: 'excelHtml5',
                footer: true,
                exportOptions: {
                    columns: [0, 1, 2, 3, 4, 5]
                }
            },
            {
                extend: 'pdfHtml5',
                footer: true,
                exportOptions: {
                    columns: [0, 1, 2, 3, 4, 5]
                }
            },
            {
                extend: 'print',
                footer: true,
                exportOptions: {
                    columns: [0, 1, 2, 3, 4, 5]
                }
            }
        ],
        drawCallback: function() {
            var api = this.api();
            var sum = 0;
            var formated = 0;
            //to show first th
            $(api.column(4).footer()).html('Total');


            sum = api.column(5, {
                page: 'current'
            }).data().sum();

            //to format this sum
            formated = parseFloat(sum).toLocaleString(undefined, {
                minimumFractionDigits: 2
            });
            $(api.column(5).footer()).html(formated);


        },
    });

    $("#min").datepicker({
        onSelect: function() {
            table.draw();
        },
        changeMonth: true,
        changeYear: true
    });
    $("#max").datepicker({
        onSelect: function() {
            table.draw();
        },
        changeMonth: true,
        changeYear: true
    });

    // Event listener to the two range filtering inputs to redraw on input
    $('#min, #max').change(function() {
        table.draw();
    });

    // Quick date filters
    $('#today').on('click', function() {
        var today = new Date();
        $('#min, #max').datepicker('setDate', today);
        table.draw();
    });

    $('#this-week').on('click', function() {
        var today = new Date();
        var firstDayOfWeek = new Date(today.getFullYear(), today.getMonth(), today.getDate() - today
            .getDay());
        $('#min').datepicker('setDate', firstDayOfWeek);
        $('#max').datepicker('setDate', today);
        table.draw();
    });

    $('#this-month').on('click', function() {
        var today = new Date();
        var firstDayOfMonth = new Date(today.getFullYear(), today.getMonth(), 1);
        $('#min').datepicker('setDate', firstDayOfMonth);
        $('#max').datepicker('setDate', today);
        table.draw();
    });

    $('#category_filter').on('change', function() {
        var tosearch = this.value;
        table.search(tosearch).draw();
    });


});
</script>