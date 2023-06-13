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
                                            id="btnConfirmContainer"><span class="fas fa-check"></span>
                                            Complete</button>
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

                                                </tbody>
                                            </table>
                                        </div>

                                        <div class="row">
                                            <div class="col">
                                                <label style='font-size:15px' class="col-md-12">Total Cuplump
                                                    Weight</label>
                                                <div class="input-group mb-3">
                                                    <span class="input-group-text">₱</span>
                                                    <input type="text" class="form-control" name='total-cuplump-weight'
                                                        id='total-cuplump-weight' tabindex="7" autocomplete='off'
                                                        style="width: 100px;" readonly />
                                                </div>
                                            </div>
                                            <div class="col">
                                                <label style='font-size:15px' class="col-md-12">Total Cuplump
                                                    Cost</label>
                                                <div class="input-group mb-3">
                                                    <span class="input-group-text">₱</span>
                                                    <input type="text" class="form-control" name='total-cuplump-cost'
                                                        id='total-cuplump-cost' tabindex="7" autocomplete='off'
                                                        style="width: 100px;" readonly />
                                                </div>
                                            </div>
                                            <div class="col">
                                                <label style='font-size:15px' class="col-md-12">Average Cuplump
                                                    Cost</label>
                                                <div class="input-group mb-3">
                                                    <span class="input-group-text">₱</span>
                                                    <input type="text" class="form-control" name='average-cuplump-cost'
                                                        id='average-cuplump-cost' tabindex="7" autocomplete='off'
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
    <br>
</body>

<td class="number-cell">
    <div class="input-group">
        <span class="input-group-text">₱</span>
        <input type="text" class="form-control" name="wet_cost" id="wet_cost" required>
    </div>
</td>
<td class="number-cell">
    <div class="input-group">
        <span class="input-group-text">₱</span>
        <input type="text" class="form-control" name="dry_cost" id="dry_cost" required>
    </div>
</td>


<script>
const costTypeSelects = document.querySelectorAll('.cost_type');
const totalCuplumpWeightInput = document.getElementById('total-cuplump-weight'); //total cuplump weight
const totalCuplumpCostInput = document.getElementById('total-cuplump-cost'); //total cuplump cost
const averageCuplumpCostInput = document.getElementById('average-cuplump-cost'); //average cuplump cost


function setupCostTypeSelectListener(element) {
    element.addEventListener('input', function() {
        const row = element.closest('tr');

        const wetCostInput = row.querySelector('.wet_cost');
        const dryCostInput = row.querySelector('.dry_cost');
        const drcInput = row.querySelector('.drc');
        const loadingWeightInput = row.querySelector('[name="loading_weight"]');
        const cuplumpCostInput = row.querySelector('.cuplump_cost');

        function updateCuplumpCost() {
            const costType = element.value;
            const loadingWeight = parseFloat(loadingWeightInput.value);

            if (costType === 'WET') {
                const wetCost = parseFloat(wetCostInput.value);
                const cuplumpCost = wetCost * loadingWeight;
                if (!isNaN(cuplumpCost)) {
                    cuplumpCostInput.value = cuplumpCost.toFixed(2);
                } else {
                    cuplumpCostInput.value = '';
                }
            } else if (costType === 'DRY') {
                const dryCost = parseFloat(dryCostInput.value);
                const drc = parseFloat(drcInput.value);
                const cuplumpCost = (dryCost * loadingWeight * drc);
                if (!isNaN(cuplumpCost)) {
                    cuplumpCostInput.value = cuplumpCost.toFixed(2);
                } else {
                    cuplumpCostInput.value = '';
                }
            } else {
                cuplumpCostInput.value = '';
            }

            updateTotalCuplumpWeight();
            updateTotalCuplumpCost();
            updateAverageCuplumpCost();
        }

        if (element.value === 'WET') {
            wetCostInput.disabled = false;
            dryCostInput.disabled = true;
            drcInput.disabled = true;
            wetCostInput.addEventListener('input', updateCuplumpCost);
            loadingWeightInput.addEventListener('input', updateCuplumpCost);
            updateCuplumpCost();
        } else if (element.value === 'DRY') {
            wetCostInput.disabled = true;
            dryCostInput.disabled = false;
            drcInput.disabled = false;
            wetCostInput.removeEventListener('input', updateCuplumpCost);
            loadingWeightInput.addEventListener('input', updateCuplumpCost);
            dryCostInput.addEventListener('input', updateCuplumpCost);
            drcInput.addEventListener('input', updateCuplumpCost);
            updateCuplumpCost();
        } else {
            wetCostInput.disabled = true;
            dryCostInput.disabled = true;
            drcInput.disabled = true;
            wetCostInput.removeEventListener('input', updateCuplumpCost);
            loadingWeightInput.removeEventListener('input', updateCuplumpCost);
            dryCostInput.removeEventListener('input', updateCuplumpCost);
            drcInput.removeEventListener('input', updateCuplumpCost);
            cuplumpCostInput.value = '';
            updateTotalCuplumpWeight();
            updateTotalCuplumpCost();
            updateAverageCuplumpCost();
        }
    });
}

function updateTotalCuplumpWeight() {
    const rows = document.querySelectorAll('#container-table tbody tr');
    let totalWeight = 0;
    rows.forEach(function(row) {
        const loadingWeightInput = row.querySelector('[name="loading_weight"]');
        const loadingWeight = parseFloat(loadingWeightInput.value);
        if (!isNaN(loadingWeight)) {
            totalWeight += loadingWeight;
        }
    });
    totalCuplumpWeightInput.value = totalWeight.toFixed(2);
}

function updateTotalCuplumpCost() {
    const rows = document.querySelectorAll('#container-table tbody tr');
    let totalCost = 0;
    rows.forEach(function(row) {
        const cuplumpCostInput = row.querySelector('.cuplump_cost');
        const cuplumpCost = parseFloat(cuplumpCostInput.value);
        if (!isNaN(cuplumpCost)) {
            totalCost += cuplumpCost;
        }
    });
    totalCuplumpCostInput.value = totalCost.toFixed(2);
}

function updateAverageCuplumpCost() {
    const rows = document.querySelectorAll('#container-table tbody tr');
    let totalWeight = 0;
    let totalCost = 0;

    rows.forEach(function(row) {
        const loadingWeightInput = row.querySelector('[name="loading_weight"]');
        const cuplumpCostInput = row.querySelector('.cuplump_cost');
        const loadingWeight = parseFloat(loadingWeightInput.value);
        const cuplumpCost = parseFloat(cuplumpCostInput.value);

        if (!isNaN(loadingWeight)) {
            totalWeight += loadingWeight;
        }

        if (!isNaN(cuplumpCost)) {
            totalCost += cuplumpCost;
        }
    });

    const rowCount = rows.length;
    const average = (totalWeight + totalCost) / 2;

    if (!isNaN(average) && rowCount > 0) {
        averageCuplumpCostInput.value = average.toFixed(2);
    } else {
        averageCuplumpCostInput.value = '';
    }
}



costTypeSelects.forEach(function(select) {
    setupCostTypeSelectListener(select);
});

const addRowButton = document.getElementById('add-row-btn');
const tbody = document.querySelector('#container-table tbody');
let rowCount = 0; //from 1 to 0

addRowButton.addEventListener('click', function() {
    const newRow = document.createElement('tr');
    rowCount++;
    newRow.setAttribute('data-row-id', rowCount); //store the identifier for each row
    newRow.innerHTML = `
    <td>
        <input type="text" class="form-control" name="supplier">
    </td>
    <td class="number-cell">
        <div class="input-group">
            <input type="text" class="form-control" name="loading_weight" autocomplete="off">
            <span class="input-group-text"> kg</span>
        </div>
    </td>
    <td>
        <div class="input-group mb-3">
            <select class="form-select cost_type" style="width: 100px;" name="cost_type">
                <option>Select</option>
                <option value="DRY">Dry</option>
                <option value="WET">Wet</option>
            </select>
        </div>
    </td>
    <td class="number-cell">
        <div class="input-group">
            <span class="input-group-text">₱</span>
            <input type="text" class="form-control wet_cost" name="wet_cost" required>
        </div>
    </td>
    <td class="number-cell">
        <div class="input-group">
            <span class="input-group-text">₱</span>
            <input type="text" class="form-control dry_cost" name="dry_cost" required>
        </div>
    </td>
    <td class="number-cell">
        <div class="input-group">
            <input type="text" class="form-control drc" name="drc" required>
            <span class="input-group-text">%</span>
        </div>
    </td>
    <td class="number-cell">
        <div class="input-group">
            <span class="input-group-text">₱</span>
            <input type="text" class="form-control cuplump_cost" name="cuplump_cost" readonly>
        </div>
    </td>
    <td>
        <button class="btn btn-danger delete-row-btn" data-bs-toggle="modal">x</button>
    </td>
`;

    tbody.appendChild(newRow);


    const costTypeSelect = newRow.querySelector('.cost_type');
    setupCostTypeSelectListener(costTypeSelect);
});

tbody.addEventListener('click', function(event) {
    if (event.target.classList.contains('delete-row-btn')) {
        const row = event.target.closest('tr');
        row.remove();
    }
});

// Initialize the total cuplump weight, cost, and average cost
updateTotalCuplumpWeight();
updateTotalCuplumpCost();
updateAverageCuplumpCost();

function logAllRowValues() {
    const rows = document.querySelectorAll('#container-table tbody tr');
    rows.forEach(function(row) {
        const rowId = row.getAttribute('data-row-id');
        const identifier = row.querySelector(`input[name="identifier-${rowId}"]`).value;
        const inputs = row.querySelectorAll('input.form-control');
        const rowData = {
            rowId: rowId,
            identifier: identifier,
            values: {}
        };
        inputs.forEach(function(input) {
            const inputName = input.getAttribute('name');
            const inputValue = input.value;
            rowData.values[inputName] = inputValue;
        });
        console.log(rowData);
    });
}
</script>

<script>
// Add an event listener to the "btnConfirmContainer" button
document.getElementById("btnConfirmContainer").addEventListener("click", function() {
    // Retrieve the values to be saved
    var totalCuplumpWeight = document.getElementById("total-cuplump-weight").value;
    var totalCuplumpCost = document.getElementById("total-cuplump-cost").value;
    var averageCuplumpCost = document.getElementById("average-cuplump-cost").value;
    var cuplumpId = document.getElementById("id").value; // Get the cuplump ID from the hidden input field

    // Retrieve the data from each row
    var rows = document.querySelectorAll('#container-table tbody tr');
    var rowData = [];
    rows.forEach(function(row) {
        var supplier = row.querySelector('.supplier').value;
        var loadingWeight = row.querySelector('.loading_weight').value;
        var costType = row.querySelector('.cost_type').value;
        var wetCost = row.querySelector('.wet_cost').value;
        var dryCost = row.querySelector('.dry_cost').value;
        var drc = row.querySelector('.drc').value;
        var cuplumpCost = row.querySelector('.cuplump_cost').value;

        var rowValues = {
            supplier: supplier,
            loading_weight: loadingWeight,
            cost_type: costType,
            wet_cost: wetCost,
            dry_cost: dryCost,
            drc: drc,
            cuplump_cost: cuplumpCost
        };
        rowData.push(rowValues);
    });

    // Make an AJAX request to save the values in the database
    var xhr = new XMLHttpRequest();
    xhr.open("POST", "function/cuplump_inventory.php", true);
    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    xhr.onreadystatechange = function() {
        if (xhr.readyState === 4 && xhr.status === 200) {
            // Handle the response if needed
            console.log(xhr.responseText);
        }
    };

    // Create a data object to send as parameters
    var data = new FormData();
    data.append("total_cuplump_weight", totalCuplumpWeight);
    data.append("total_cuplump_cost", totalCuplumpCost);
    data.append("average_cuplump_cost", averageCuplumpCost);
    data.append("cuplump_id", cuplumpId);
    data.append("rows", JSON.stringify(rowData)); // Include the row data in the request

    xhr.send(data);
});
</script>


<!-- working saving the totals -->
<!-- <script>
// Add an event listener to the "btnConfirmContainer" button
document.getElementById("btnConfirmContainer").addEventListener("click", function() {
    // Retrieve the values to be saved
    var totalCuplumpWeight = document.getElementById("total-cuplump-weight").value;
    var totalCuplumpCost = document.getElementById("total-cuplump-cost").value;
    var averageCuplumpCost = document.getElementById("average-cuplump-cost").value;
    var cuplumpId = document.getElementById("id").value; // Get the cuplump ID from the hidden input field

    // Make an AJAX request to save the values in the database
    var xhr = new XMLHttpRequest();
    xhr.open("POST", "function/cuplump_inventory.php", true);
    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    xhr.onreadystatechange = function() {
        if (xhr.readyState === 4 && xhr.status === 200) {
            // Handle the response if needed
            console.log(xhr.responseText);
        }
    };
    xhr.send(
        "total_cuplump_weight=" + totalCuplumpWeight +
        "&total_cuplump_cost=" + totalCuplumpCost +
        "&ave_cuplump_cost=" + averageCuplumpCost +
        "&cuplump_id=" + cuplumpId // Include the cuplump ID in the request
    );
});


####working saving it to the database

include('db.php');


if (isset($_POST['total_cuplump_weight'], $_POST['total_cuplump_cost'], $_POST['ave_cuplump_cost'], $_POST['cuplump_id'])) {
    $totalWeight = $_POST['total_cuplump_weight'];
    $totalCost = $_POST['total_cuplump_cost'];
    $averageCost = $_POST['ave_cuplump_cost'];
    $cuplumpId = $_POST['cuplump_id'];

    // Check if the cuplump ID already exists in the database
    $query = "SELECT * FROM sales_cuplump_container WHERE container_id = $cuplumpId";
    $result = mysqli_query($con, $query);

    if ($result) {
        if (mysqli_num_rows($result) > 0) {
            // A record with the cuplump ID already exists, update the totals
            $query = "UPDATE sales_cuplump_container SET total_cuplump_weight = '$totalWeight', total_cuplump_cost = '$totalCost', ave_cuplump_cost = '$averageCost' WHERE container_id = $cuplumpId";
            $updateResult = mysqli_query($con, $query);

            if ($updateResult) {
                header("Location: ../cuplump_shipment_record.php?id=$lastId");
                $_SESSION['contract'] = "successful";
                exit();
            } else {
                echo "ERROR: Could not execute query: $query. " . mysqli_error($con);
            }
        } else {
            // No record with the cuplump ID found, insert a new record
            $query = "INSERT INTO sales_cuplump_container (container_id, total_cuplump_weight, total_cuplump_cost, ave_cuplump_cost) 
                      VALUES ('$cuplumpId', '$totalWeight', '$totalCost', '$averageCost')";
            $insertResult = mysqli_query($con, $query);

            if ($insertResult) {
                echo "No record found";
            } else {
                echo "ERROR: Could not execute query: $query. " . mysqli_error($con);
            }
        }
    } else {
        echo "ERROR: Could not execute query: $query. " . mysqli_error($con);
    }
}





</script> -->