<?php
include('include/header.php');
include "include/navbar.php";


$id = '';
if (isset($_GET['id'])) {
    $id = filter_var($_GET['id']);
}


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

                        <h2 class="page-title">
                            <b>
                                <font color="#0C0070">CUPLUMP </font>
                                <font color="#046D56">SALE </font>
                            </b>
                        </h2>

                        <br>

                        <div class="row">
                            <div class="col-12">
                                <div class="row">
                                    <div class="col-12">
                                        <button type="button" class="btn btn-primary confirmSales" id="someButton">Confirm Sales</button>
                                        <button type="button" class="btn btn-dark text-white receiptBtn" id='receiptBtn'>
                                            <span class="fa fa-print"></span> Print Receipt </button>
                                        <button type="button" class="btn btn-secondary text-white vouchBtn" id='vouchBtn'>
                                            <span class="fa fa-print"></span> Print Voucher </button>

                                    </div>

                                </div>

                                <br>

                                <div class="card">
                                    <div class="card-body">
                                        <h4>Sale Contract</h4>
                                        <hr>

                                        <div class="row">
                                          
                                            <div class="col">
                                                <label style='font-size:15px' class="col-md-12">EN Sale Contract
                                                </label>
                                                <div class="input-group mb-3">
                                                    <input type="text" class="form-control" name='en_sale_contract_no' id='en_sale_contract_no' value='' readonly autocomplete='off' style="width: 100px;">
                                                </div>
                                            </div>

                                            <div class="col">
                                                <label style='font-size:15px' class="col-md-12">Buyer Purchase Contract
                                                </label>
                                                <div class="input-group mb-3">
                                                    <input type="text" class="form-control" name='buyer_purchase_contract_no' id='buyer_purchase_contract_no' value='' style="width: 100px;" />
                                                </div>
                                            </div>

                                            <div class="col">
                                                <label style='font-size:15px' class="col-md-12">Type</label>
                                                <div class="input-group mb-3">
                                                    <select class="form-select" id="wet_sale_type" name="wet_sale_type" style="width: 100px;">
                                                        <option value="EXPORT">Wet Export</option>
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="col">
                                                <label style='font-size:15px' class="col-md-12">Transaction Date</label>
                                                <div class="col-md-12">
                                                    <input type="date" class='form-control' id="transaction_date" value="" name="transaction_date">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col">
                                                <label style='font-size:15px' class="col-md-12">Buyer Name</label>
                                                <div class="input-group mb-3">
                                                    <input type="text" class="form-control" name='buyer_company_name' value='' id='buyer_company_name' tabindex="7" autocomplete='off' style="width: 100px;" />
                                                </div>
                                            </div>

                                            <div class="col">
                                                <label style='font-size:15px' class="col-md-12">Shipping Date</label>
                                                <div class="input-group mb-3">
                                                    <input type="text" class="form-control" name='shipping_date' value='' id='shipping_date' tabindex="7" autocomplete='off' style="width: 100px;" />
                                                </div>
                                            </div>

                                            <div class="col">
                                                <label style='font-size:15px' class="col-md-12">Destination</label>
                                                <div class="input-group mb-3">
                                                    <input type="text" class="form-control" name='destination' id='destination' value='' tabindex="7" autocomplete='off' style="width: 100px;" />
                                                </div>
                                            </div>

                                            <div class="col">
                                                <label style='font-size:15px' class="col-md-12">Containers</label>
                                                <div class="input-group mb-3">
                                                    <input type="text" class="form-control" name='containers' id='containers' value='' tabindex="7" autocomplete='off' style="width: 100px;" />
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col">
                                                <label style='font-size:15px' class="col-md-12">Quantity</label>
                                                <div class="input-group mb-3">
                                                    <input type="text" class="form-control" name='quantity' value='' id='quantity' tabindex="7" autocomplete='off' style="width: 100px;" />
                                                    <span class="input-group-text"> kg</span>
                                                </div>
                                            </div>

                                            <div class="col">
                                                <label style='font-size:15px' class="col-md-12">Price</label>
                                                <div class="input-group mb-3">
                                                    <span class="input-group-text">$</span>
                                                    <input type="text" class="form-control" name='price' value='' id='price'>
                                                </div>
                                            </div>

                                            <div class="col-6">
                                                <label style='font-size:15px' class="col-md-12">Other Terms
                                                    (Optional)</label>
                                                <div class="input-group mb-3">
                                                    <input type="text" class="form-control" name='other_terms' value='' id='other_terms'>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <br>

                                <div class="card">
                                    <div class="card-body d-flex justify-content-between align-items-center">
                                        <h4>Cuplump Costing</h4>

                                        <button id="add-row-btn" class="btn btn-success">Select Container</button>
                                    </div>

                                    <div class="card-body">

                                        <div class="table-responsive">
                                            <table id="container-table" class="table table-bordered table-hover table-striped">
                                                <thead class="table text-center" style="font-size: 14px !important">
                                                    <tr>
                                                        <th scope="col"></th>
                                                        <th scope="col">Container No.</th>
                                                        <th scope="col">Shipment No.</th>
                                                        <th scope="col">Supplier</th>
                                                        <th scope="col">Loading Weight</th>
                                                        <th scope="col">Cuplump Cost</th>
                                                        <th scope="col">Shipping Expense</th>
                                                        <th scope="col">Net Kilo Cost</th>
                                                        <th scope="col">Buyer Reweight</th>
                                                        <th scope="col">Sale</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <td>
                                                            <button class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#updateModal" onclick="openUpdateModal(this)">Remove</button>
                                                        </td>

                                                        <td>
                                                            <input type="text" class="form-control" readonly>
                                                        </td>
                                                        <td>
                                                            <input type="text" class="form-control" readonly>
                                                        </td>
                                                        <td>
                                                            <input type="text" class="form-control" readonly>
                                                        </td>
                                                        <td class="number-cell">
                                                            <div class="input-group">
                                                                <input type="text" class="form-control" name="total_kilo" autocomplete="off" readonly>
                                                                <span class="input-group-text"> kg</span>
                                                            </div>
                                                        </td>
                                                        <td class="number-cell">
                                                            <div class="input-group">
                                                                <span class="input-group-text">₱</span>
                                                                <input type="text" class="form-control" name="total_cogs" readonly>
                                                            </div>
                                                        </td>
                                                        <td class="number-cell">
                                                            <div class="input-group">
                                                                <span class="input-group-text">₱</span>
                                                                <input type="text" class="form-control" name="shipment_expenses" readonly>
                                                            </div>
                                                        </td>
                                                        <td class="number-cell">
                                                            <div class="input-group">
                                                                <span class="input-group-text">₱</span>
                                                                <input type="text" class="form-control" name="net_cost" readonly>
                                                            </div>
                                                        </td>
                                                        <td class="number-cell">
                                                            <div class="input-group">
                                                                <input type="text" class="form-control" name="net_weight">
                                                                <span class="input-group-text"> kg</span>
                                                            </div>
                                                        </td>
                                                        <td class="number-cell">
                                                            <div class="input-group">
                                                                <span class="input-group-text">$</span>
                                                                <input type="text" class="form-control" name="container_sale" readonly>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>

                                        <hr>

                                        <div class="row">
                                            <div class="col">
                                                <label style='font-size:15px' class="col-md-12">Cuplump Weight</label>
                                                <div class="input-group mb-3">
                                                    <input type="text" class="form-control" name='total_kilo' id='total_kilo' tabindex="7" autocomplete='off' style="width: 100px;" readonly>
                                                    <span class="input-group-text"> kg</span>
                                                </div>
                                            </div>
                                            <div class="col">
                                                <label style='font-size:15px' class="col-md-12">Overall Cuplump
                                                    Cost</label>
                                                <div class="input-group mb-3">
                                                    <span class="input-group-text">₱</span>
                                                    <input type="text" class="form-control" name='total_cuplump_cost' id='total_cuplump_cost' readonly>
                                                </div>
                                            </div>
                                            <div class="col">
                                                <label style='font-size:15px' class="col-md-12">Overall Shipping
                                                    Expenses</label>
                                                <div class="input-group mb-3">
                                                    <span class="input-group-text">₱</span>
                                                    <input type="text" class="form-control" name='total_shipping_expenses' id='total_shipping_expenses' readonly>
                                                </div>
                                            </div>

                                            <div class="col">
                                                <label style='font-size:15px' class="col-md-12">Other
                                                    Sale Expenses</label>
                                                <div class="input-group mb-3">
                                                    <span class="input-group-text">₱</span>
                                                    <input type="text" class="form-control" name='other_expenses' id='other_expenses'>
                                                </div>
                                            </div>
                                        </div>


                                        <div class="row">
                                            <div class="col">
                                                <label style='font-size:15px' class="col-md-12">Buyer Reweight</label>
                                                <div class="input-group mb-3">
                                                    <input type="text" class="form-control" name='net_weight' id='net_weight' tabindex="7" autocomplete='off' style="width: 100px;" readonly>
                                                    <span class="input-group-text"> kg</span>
                                                </div>
                                            </div>
                                            <div class="col">
                                                <label style='font-size:15px' class="col-md-12">Peso
                                                    Sale (Collections)</label>
                                                <div class="input-group mb-3">
                                                    <span class="input-group-text">₱</span>
                                                    <input type="text" class="form-control" name='total_peso_sale' id='total_peso_sale' tabindex="7" autocomplete='off' style="width: 100px;" readonly>
                                                </div>
                                            </div>
                                            <div class="col-6">
                                                <label class="col-md-12">NET PROFIT/LOSS (₱)</label>
                                                <div class="input-group mb-3">
                                                    <span class="input-group-text">₱</span>
                                                    <input type="text" class="form-control" name="net_profit_loss" id="net_profit_loss" readonly>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>

                                <br>

                                <div class="card">
                                    <div class="card-body d-flex justify-content-between align-items-center">
                                        <h4>Payment Details</h4>
                                        <button id="add-row-btn" class="btn btn-success">+ New Payment</button>
                                    </div>
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col">
                                                <label style="font-size: 15px" class="col-md-12">Total Sales</label>
                                                <div class="input-group mb-3">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text">$</span>
                                                    </div>
                                                    <input type="text" class="form-control" name="total_sales" id="total_sales" tabindex="7" autocomplete="off" style="width: 100px;">
                                                </div>
                                            </div>
                                            <div class="col">
                                                <label style="font-size: 15px" class="col-md-12">Amount Paid in
                                                    Dollar</label>
                                                <div class="input-group mb-3">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text">$</span>
                                                    </div>
                                                    <input type="text" class="form-control" name="amount_paid" id="amount_paid" tabindex="7" autocomplete="off" style="width: 100px;">
                                                </div>
                                            </div>
                                            <div class="col">
                                                <label style="font-size: 15px" class="col-md-12">Amount Paid in
                                                    Peso</label>
                                                <div class="input-group mb-3">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text">₱</span>
                                                    </div>
                                                    <input type="text" class="form-control" name="amount_in_peso" id="amount_in_peso" tabindex="7" autocomplete="off" style="width: 100px;">
                                                </div>
                                            </div>
                                            <div class="col">
                                                <label style="font-size: 15px" class="col-md-12">Remaining
                                                    Balance</label>
                                                <div class="input-group mb-3">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text">$</span>
                                                    </div>
                                                    <input type="text" class="form-control" name="remaining_balance" id="remaining_balance" tabindex="7" autocomplete="off" style="width: 100px;">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="table-responsive">
                                            <table id="payment-table" class="table table-bordered table-hover table-striped">
                                                <thead class="table text-center" style="font-size: 14px !important">
                                                    <tr>
                                                        <th scope="col">Date</th>
                                                        <th scope="col">Bank Details</th>
                                                        <th scope="col">Amount Paid ($)</th>
                                                        <th scope="col">Exchange Rate</th>
                                                        <th scope="col">Peso Equivalent</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <td>
                                                            <div class="input-group">
                                                                <input type="date" class="form-control" placeholder="Date">
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <div class="input-group">
                                                                <input type="text" class="form-control" placeholder="Bank Details">
                                                            </div>
                                                        </td>
                                                        <td class="number-cell">
                                                            <div class="input-group">
                                                                <span class="input-group-text">$</span>
                                                                <input type="number" class="form-control" placeholder="Amount Paid" step="0.01">
                                                            </div>
                                                        </td>
                                                        <td class="number-cell">
                                                            <div class="input-group">
                                                                <input type="number" class="form-control" placeholder="Exchange Rate" step="0.01">
                                                            </div>
                                                        </td>
                                                        <td class="number-cell">
                                                            <div class="input-group">
                                                                <span class="input-group-text">₱</span>
                                                                <input type="number" class="form-control" placeholder="Peso Equivalent" step="0.01">
                                                            </div>
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>


                                <script>
                                    // Add event listeners for calculations
                                    document.getElementById('total_sales').addEventListener('input',
                                        calculateRemainingBalance);
                                    document.getElementById('amount_paid').addEventListener('input',
                                        calculateRemainingBalance);
                                    document.getElementById('payment-table').addEventListener('input',
                                        calculateAmountInPeso);

                                    // Function to calculate remaining balance
                                    function calculateRemainingBalance() {
                                        const totalSalesInput = document.getElementById('total_sales');
                                        const amountPaidInput = document.getElementById('amount_paid');
                                        const remainingBalanceInput = document.getElementById('remaining_balance');

                                        const totalSales = parseFloat(totalSalesInput.value) || 0;
                                        const amountPaid = parseFloat(amountPaidInput.value) || 0;

                                        const remainingBalance = totalSales - amountPaid;
                                        remainingBalanceInput.value = remainingBalance.toFixed(2);
                                    }

                                    // Function to calculate amount in peso
                                    function calculateAmountInPeso() {
                                        const rows = document.querySelectorAll('#payment-table tbody tr');
                                        let totalAmountInPeso = 0;

                                        rows.forEach(row => {
                                            const amountPaidInput = row.querySelector(
                                                'input[placeholder="Amount Paid"]');
                                            const exchangeRateInput = row.querySelector(
                                                'input[placeholder="Exchange Rate"]');
                                            const pesoEquivalentInput = row.querySelector(
                                                'input[placeholder="Peso Equivalent"]');

                                            const amountPaid = parseFloat(amountPaidInput.value) || 0;
                                            const exchangeRate = parseFloat(exchangeRateInput.value) || 0;
                                            const pesoEquivalent = amountPaid * exchangeRate;

                                            pesoEquivalentInput.value = pesoEquivalent.toFixed(2);
                                            totalAmountInPeso += pesoEquivalent;
                                        });

                                        document.getElementById('amount_in_peso').value = totalAmountInPeso.toFixed(
                                            2);
                                    }

                                    document.getElementById('add-row-btn').addEventListener('click', function() {
                                        var table = document.getElementById('payment-table');
                                        var tbody = table.getElementsByTagName('tbody')[0];

                                        // Create a new row
                                        var newRow = document.createElement('tr');

                                        // Add the cells to the new row
                                        newRow.innerHTML = `
            <td><input type="date" class="form-control" placeholder="Date"></td>
            <td><input type="text" class="form-control" placeholder="Bank Details"></td>
            <td class="number-cell"><span class="input-group-text">$</span><input type="number" class="form-control" placeholder="Amount Paid" step="0.01"></td>
            <td class="number-cell"><input type="number" class="form-control" placeholder="Exchange Rate" step="0.01"></td>
            <td class="number-cell"><span class="input-group-text">₱</span><input type="number" class="form-control" placeholder="Peso Equivalent" step="0.01"></td>
        `;

                                        // Append the new row to the table body
                                        tbody.appendChild(newRow);

                                        // Recalculate the amount in peso
                                        calculateAmountInPeso();
                                    });
                                </script>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>



    <div class="modal fade" id="updateModal" tabindex="-1" aria-labelledby="updateModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="updateModalLabel">Update Container</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="updateForm">
                        <div class="mb-3">
                            <label for="updateShipmentNo" class="form-label">Shipment No.</label>
                            <input type="text" class="form-control" id="updateShipmentNo">
                        </div>
                        <div class="mb-3">
                            <label for="updateContainerNo" class="form-label">Container No.</label>
                            <input type="text" class="form-control" id="updateContainerNo">
                        </div>
                        <!-- Add more form fields as needed -->
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-primary" onclick="updateContainer()">Save
                        Changes</button>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>

    <script>
        function openUpdateModal(button) {
            var row = button.closest('tr');
            var shipmentNo = row.querySelector('input[name="shipment_no"]').value;
            var containerNo = row.querySelector('input[name="container_no"]').value;

            // Set the values in the modal form
            document.getElementById('updateShipmentNo').value = shipmentNo;
            document.getElementById('updateContainerNo').value = containerNo;
        }

        function updateContainer() {
            // Retrieve the input values from the modal form
            var shipmentNo = document.getElementById('updateShipmentNo').value;
            var containerNo = document.getElementById('updateContainerNo').value;

            // Perform your update logic here

            // Close the modal
            var updateModal = document.getElementById('updateModal');
            var bootstrapModal = bootstrap.Modal.getInstance(updateModal);
            bootstrapModal.hide();
        }

        document.getElementById('add-row-btn').addEventListener('click', function() {
            var table = document.getElementById('container-table');
            var tbody = table.getElementsByTagName('tbody')[0];

            // Create a new row
            var newRow = document.createElement('tr');

            // Add the cells to the new row
            newRow.innerHTML = `
      <td>
        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#updateModal" onclick="openUpdateModal(this)">Update</button>
      </td>
      <td>
        <input type="text" class="form-control" readonly>
      </td>
      <td>
        <input type="text" class="form-control">
      </td>
      <td class="number-cell">
        <div class="input-group">
          <input type="text" class="form-control" name="total_kilo" autocomplete="off">
          <span class="input-group-text"> kg</span>
        </div>
      </td>
      <td class="number-cell">
        <div class="input-group">
          <span class="input-group-text">₱</span>
          <input type="text" class="form-control" name="total_cogs" required>
        </div>
      </td>
      <td class="number-cell">
        <div class="input-group">
          <span class="input-group-text">₱</span>
          <input type="text" class="form-control" name="shipment_expenses" required>
        </div>
      </td>
      <td class="number-cell">
        <div class="input-group">
          <span class="input-group-text">₱</span>
          <input type="text" class="form-control" name="net_cost" required>
        </div>
      </td>
    `;

            // Append the new row to the table body
            tbody.appendChild(newRow);
        });
    </script>

    <script>
        document.getElementById('add-row-btn').addEventListener('click', function() {
            var table = document.getElementById('payment-table');
            var tbody = table.getElementsByTagName('tbody')[0];

            // Create a new row
            var newRow = document.createElement('tr');

            // Add the cells to the new row
            newRow.innerHTML = `
            <td><input type="text" placeholder="Date"></td>
            <td class="number-cell">₱<input type="number" placeholder="Details" step="0.01"></td>
            <td class="number-cell">₱<input type="number" placeholder="Amount Paid" step="0.01"></td>
            <td class="number-cell"><input type="number" placeholder="Exchange Rate" step="0.01"></td>
            <td class="number-cell">₱<input type="number" placeholder="Peso Equivalent" step="0.01"></td>
        `;

            // Append the new row to the table body
            tbody.appendChild(newRow);
        });
    </script>