<?php
include('include/header.php');
include "include/navbar.php";



if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $id = preg_replace('~\D~', '', $id);

    $sql = "SELECT * FROM sales_cuplump_container WHERE container_id = $id";
    $result = $con->query($sql);

    if ($result->num_rows > 0) {
        // Output data of each row
        $record = $result->fetch_assoc();

        $container_no = isset($record['container_no']) ? $record['container_no'] : '';
        $date = isset($record['loading_date']) ? $record['loading_date'] : '';
        $remarks = isset($record['remarks']) ? $record['remarks'] : '';
        $recorded_by = isset($record['recorded_by']) ? $record['recorded_by'] : '';


        echo "
            <script>
                $(document).ready(function() {
                    $('#id').val('" . $id . "');
                    $('#container_no').val('" . $container_no . "');
                    $('#remarks').val('" . $remarks . "');
                    $('#date').val('" . $date . "');
                    $('#recorded_by').val('" . $recorded_by . "');

                  

                });
                </script>
            ";
    }
}


?>


<body>

    <br>
    <div class='main-content' style='min-height:100vh;'>
        <div class="container home-section h-100" style="max-width:95%;">
            <div class="page-wrapper">
                <div class="row">
                    <div class="col-sm-12">

                        <h2 class="page-title">
                            <b>
                                <font color="#0C0070">CUPLUMP </font>
                                <font color="#046D56"> CONTAINER </font>
                            </b>
                        </h2>

                        <br>

                        <div class="row">
                            <div class="col-12">
                                <div class="row">
                                    <div class="col-12">
                                        <button type="button" class="btn btn-secondary text-white vouchBtn"
                                            onclick="goBack()">
                                            <span class="fas fa-arrow-left"></span> Return
                                        </button>
                                        <button type="button" class="btn btn-dark text-white printBtn" id='printBtn'>
                                            <span class="fa fa-print"></span> Print
                                        </button>
                                        <button type="button" class="btn btn-dark text-white pdfBtn" id='pdftBtn'>
                                            <span class="fa fa-file"></span> PDF
                                        </button>
                                        <button type="button" class="btn btn-primary confirmSales"
                                            id="btnConfirmShipment"><span class="fas fa-check"></span> Complete</button>
                                    </div>
                                </div>

                                <br>

                                <div class="card">
                                    <div class="card-body">
                                        <h4>Container Information</h4>
                                        <hr>
                                        <form method='POST' id='transaction_form'>
                                            <div class="row">
                                                <div class="col-2">
                                                    <label style='font-size:15px' class="col-md-12">Ref No.</label>
                                                    <div class="input-group mb-3">
                                                        <input type="text" class="form-control" name='id' id='id'
                                                            readonly autocomplete='off' style="width: 100px;" />
                                                    </div>
                                                </div>
                                                <div class="col">
                                                    <label style='font-size:15px' class="col-md-12">Container
                                                        No.</label>
                                                    <div class="input-group mb-3">
                                                        <input type="text" class="form-control" name='container_no'
                                                            id='container_no' tabindex="7" autocomplete='off'
                                                            style="width: 100px;" />
                                                    </div>
                                                </div>
                                                <div class="col">
                                                    <label style='font-size:15px' class="col-md-12">Loading
                                                        Date</label>
                                                    <div class="col-md-12">
                                                        <input type="date" class='form-control' id="date"
                                                            value="<?php echo $today; ?>" name="date">
                                                    </div>
                                                </div>
                                                <div class="col">
                                                    <label style='font-size:15px' class="col-md-12">Remarks</label>
                                                    <div class="input-group mb-3">
                                                        <input type="text" class="form-control" name='remarks'
                                                            id='remarks' tabindex="7" autocomplete='off'
                                                            style="width: 100px;" />
                                                    </div>
                                                </div>
                                                <div class="col">
                                                    <label style='font-size:15px' class="col-md-12">Recorded by</label>
                                                    <div class="input-group mb-3">
                                                        <input type="text" class="form-control" name='recorded_by'
                                                            id='recorded_by' tabindex="7" autocomplete='off'
                                                            style="width: 100px;" />
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>

                                <br>

                                <div class="card">
                                    <div class="card-body d-flex justify-content-between align-items-center">
                                        <h4>Cuplump Inventory</h4>
                                        <button id="add-row-btn" class="btn btn-success">+ Add Inventory</button>
                                    </div>
                                    <div class="card-body">
                                        <div class="table-responsive">
                                            <table id="container-table"
                                                class="table table-bordered table-hover table-striped">
                                                <thead class="table text-center" style="font-size: 14px !important">
                                                    <tr>
                                                        <th scope="col">Supplier</th>
                                                        <th scope="col">Loading Weight</th>
                                                        <th scope="col">Cost Type</th>
                                                        <th scope="col">Cost (Wet)</th>
                                                        <th scope="col">Cost (Dry)</th>
                                                        <th scope="col">DRC</th>
                                                        <th scope="col">Cuplump Cost</th>
                                                        <th scope="col"></th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <td>
                                                            <input type="text" class="form-control">
                                                        </td>
                                                        <td class="number-cell">
                                                            <div class="input-group">
                                                                <input type="text" class="form-control"
                                                                    name="loading_reweight" autocomplete="off">
                                                                <span class="input-group-text"> kg</span>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <div class="input-group mb-3">
                                                                <select class="form-select" id="cost_type"
                                                                    name="cost_type" style="width: 100px;">
                                                                    <option>Select</option>
                                                                    <option value="DRY">Dry</option>
                                                                    <option value="WET">Wet</option>
                                                                </select>
                                                            </div>
                                                        </td>
                                                        <td class="number-cell">
                                                            <div class="input-group">
                                                                <span class="input-group-text">₱</span>
                                                                <input type="text" class="form-control"
                                                                    name="kilo_cost_wet" id="kilo_cost_wet" required>
                                                            </div>
                                                        </td>
                                                        <td class="number-cell">
                                                            <div class="input-group">
                                                                <span class="input-group-text">₱</span>
                                                                <input type="text" class="form-control"
                                                                    name="kilo_cost_dry" id="kilo_cost_dry" required>
                                                            </div>
                                                        </td>
                                                        <td class="number-cell">
                                                            <div class="input-group">
                                                                <input type="text" class="form-control" name="cost_drc"
                                                                    required>
                                                                <span class="input-group-text">%</span>
                                                            </div>
                                                        </td>
                                                        <td class="number-cell">
                                                            <div class="input-group">
                                                                <span class="input-group-text">₱</span>
                                                                <input type="text" class="form-control"
                                                                    name="total_cogs" readonly>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <button class="btn btn-danger"
                                                                data-bs-toggle="modal">x</button>
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                        <div class="row">
                                            <div class="col">
                                                <label style='font-size:15px' class="col-md-12">Total Cuplump
                                                    Weight</label>
                                                <div class="input-group mb-3">
                                                    <span class="input-group-text">₱</span>
                                                    <input type="text" class="form-control" name='ship_remarks'
                                                        id='ship_remarks' tabindex="7" autocomplete='off'
                                                        style="width: 100px;" readonly />
                                                </div>
                                            </div>
                                            <div class="col">
                                                <label style='font-size:15px' class="col-md-12">Total Cuplump
                                                    Cost</label>
                                                <div class="input-group mb-3">
                                                    <span class="input-group-text">₱</span>
                                                    <input type="text" class="form-control" name='ship_user'
                                                        id='ship_user' tabindex="7" autocomplete='off'
                                                        style="width: 100px;" readonly />
                                                </div>
                                            </div>
                                            <div class="col">
                                                <label style='font-size:15px' class="col-md-12">Average Cuplump
                                                    Cost</label>
                                                <div class="input-group mb-3">
                                                    <span class="input-group-text">₱</span>
                                                    <input type="text" class="form-control" name='ship_user'
                                                        id='ship_user' tabindex="7" autocomplete='off'
                                                        style="width: 100px;" readonly />
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
    <br>
</body>

<script>
  const costTypeSelect = document.getElementById('cost_type');
  const wetCostInput = document.getElementById('kilo_cost_wet');
  const dryCostInput = document.getElementById('kilo_cost_dry');

  costTypeSelect.addEventListener('input', function() {
    if (costTypeSelect.value === 'WET') {
        dryCostInput.disabled = true;
    } else {
      wetCostInput.disabled = true;
    }
  });
</script>