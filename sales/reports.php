<!DOCTYPE html>
<html lang="en">

<?php
    include('include/header.php');
    include "include/navbar.php";

?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sales Report</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>

<style>
table {
    width: 100%;
    border-collapse: collapse;
    font-family: Arial, sans-serif;
}

th,
td {
    padding: 8px;
    text-align: left;
    border-bottom: 1px solid #ddd;
}

th {
    background-color: #f2f2f2;
    font-weight: bold;
}

tr:nth-child(even) {
    background-color: #f8f8f8;
}

tr:hover {
    background-color: #e0e0e0;
}
</style>

<script>
async function fetchSalesData() {
    try {
        const response = await fetch("sales_data.json");
        const salesData = await response.json();
        return salesData;
    } catch (error) {
        console.error("Error fetching sales data:", error);
    }
}

async function populateTable() {
    const salesData = await fetchSalesData();
    if (!salesData) return;

    // Your code for populating the table with sales data goes here
}

populateTable();


function sortTable() {
    let table = document.getElementById("sales-report-table");
    let rows, switching, i, x, y, shouldSwitch;
    switching = true;
    while (switching) {
        switching = false;
        rows = table.rows;
        for (i = 1; i < rows.length - 1; i++) {
            shouldSwitch = false;
            x = rows[i].getElementsByTagName("TD")[1];
            y = rows[i + 1].getElementsByTagName("TD")[1];
            if (parseFloat(x.innerHTML) < parseFloat(y.innerHTML)) {
                shouldSwitch = true;
                break;
            }
        }
        if (shouldSwitch) {
            rows[i].parentNode.insertBefore(rows[i + 1], rows[i]);
            switching = true;
        }
    }
}
</script>

<body>
    <header style="text-align: center; padding: 20px 0;">
        <img src="your-logo-url-here" alt="EN Rubber Logo" style="max-width: 150px;">
        <h1 style="font-family: Arial, sans-serif;">EN Rubber</h1>
    </header>

    <div class="container">
        <h1 class="text-center my-4">Sales Report</h1>
        <table class="table table-bordered" id="sales-report-table">
            <thead>
                <tr id="table-header">

                    <th scope="col">Accounts</th>
                    <th scope="col">
                        <select id="year-select" onchange="updateYear()">
                            <option value="2022">2022</option>
                            <option value="2023">2023</option>
                        </select>
                    </th>
                    <th scope="col">Jan</th>
                    <th scope="col">Feb</th>
                    <th scope="col">Mar</th>
                    <th scope="col">Apr</th>
                    <th scope="col">May</th>
                    <th scope="col">Jun</th>
                    <th scope="col">Jul</th>
                    <th scope="col">Aug</th>
                    <th scope="col">Sep</th>
                    <th scope="col">Oct</th>
                    <th scope="col">Nov</th>
                    <th scope="col">Dec</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <th scope="row">Sales</th>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
                <tr>
                    <td>&emsp; Bale Local Sales</td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
                <tr>
                    <td>&emsp; Bale Export Sales</td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
                <tr>
                    <td>&emsp; Cuplump Sale</td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
                <tr>
                    <th scope="row">Net Sales</th>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
                <tr>
                    <th scope="row">COGS</th>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
                <tr>
                    <td>&emsp; Bale Local COGS</td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
                <tr>
                    <td>&emsp; Bale Export COGS</td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
                <tr>
                    <td>&emsp; Cuplump COGS</td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
                <tr>
                    <th scope="row">Total COGS</th>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
                <tr>
                    <th scope="row">Milling Fee</th>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
                <tr>
                    <th scope="row">Shipping Expenses</th>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
                <tr>
                    <td>&emsp; Loading & Unloading</td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
                <tr>
                    <td>&emsp; Trucking</td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
                <tr>
                    <td>&emsp; Freight</td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
                <tr>
                    <td>&emsp; Insurance</td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
                <tr>
                    <td>&emsp; Customs & Duties</td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
                <tr>
                    <th scope="row">Total Shipping Expenses</th>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
                <tr>
                    <th scope="row">Gross Profit</th>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
            </tbody>
        </table>


        <footer style="text-align: center; padding: 20px 0; background-color: #f2f2f2;">
            <p style="font-family: Arial, sans-serif; margin: 0;">EN Rubber &copy; 2023 | All Rights Reserved</p>
            <p style="font-family: Arial, sans-serif; margin: 0;">1234 Example St., City, Country</p>
            <p style="font-family: Arial, sans-serif; margin: 0;">Phone: +1 (123) 456-7890 | Email: info@enrubber.com
            </p>
        </footer>



    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>


</body>
<!-- 
<script>
function updateYear() {
    const yearSelect = document.getElementById("year-select");
    const selectedYear = yearSelect.value;
    const tableHeader = document.getElementById("table-header");

    // Clear the table header
    tableHeader.innerHTML = "";

    // Generate the table header based on the selected year
    const headerContent = `
            <th scope="col">Accounts</th>
            <th scope="col">Total</th>
            <th scope="col">${selectedYear}-01</th>
            <th scope="col">${selectedYear}-02</th>
        <th scope="col">${selectedYear}-03</th>
        <th scope="col">${selectedYear}-04</th>
        <th scope="col">${selectedYear}-05</th>
        <th scope="col">${selectedYear}-06</th>
        <th scope="col">${selectedYear}-07</th>
        <th scope="col">${selectedYear}-08</th>
        <th scope="col">${selectedYear}-09</th>
        <th scope="col">${selectedYear}-10</th>
        <th scope="col">${selectedYear}-11</th>
        <th scope="col">${selectedYear}-12</th>
    `;

    // Insert the new header content
    tableHeader.innerHTML = headerContent;
}


// Initialize the table header on page load
updateYear();
</script> -->


</html>