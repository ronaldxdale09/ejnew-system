<!DOCTYPE html>

<?php
// Remove redundant database include to prevent multiple connections
include "../function/db.php";
include "include/bootstrap.php";
include "include/jquery.php";



$loc = str_replace(' ', '', $_SESSION['loc']);
$user_name = $_SESSION["full_name"];

?>
<html>

<head>
  <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <link rel="stylesheet" href="css/bootstrap.min.css">
  <link rel="stylesheet" href="css/chosen.min.css">
  <link rel='stylesheet' href='css/main.css'>
  <link rel='stylesheet' href='css/navbar.css'>
  <script src="assets/js/numberFormat.js"></script>
  <title>EJN General Ledger</title>
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
  <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js"></script>
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
</head>

<?php
include "include/datatables_buttons_css.php";
include "include/datatables_buttons_js.php";
?>


<style>
  .header-design {
    font-size: 24px;
    /* Increase font size */
    font-weight: 600;
    /* Make it bold */
    color: #204562;
    /* Deep blue color */
    padding-bottom: 10px;
    /* Add some padding at the bottom */
    border-bottom: 2px solid #ddd;
    /* Add a subtle bottom border */
    margin-bottom: 20px;
    /* Add some margin after the header */
    letter-spacing: 0.5px;
    /* Increase letter spacing for better readability */
    text-transform: uppercase;
    text-align: center;
    /* Center the text */

  }

  input[readonly] {
    background-color: lightgray;
  }
</style>
<script>
  function formatWithComma(value) {
    // Ensure value is a number
    let parsedValue = parseFloat(value);

    // Ensure parsed value is a valid number
    if (isNaN(parsedValue)) {
      return "0.00"; // or some default value, or you can throw an error
    }

    // Convert to string with 2 decimal places
    let fixedValue = parsedValue.toFixed(2);

    // Return with comma as thousands separator
    return parseFloat(fixedValue).toLocaleString('en-US', {
      minimumFractionDigits: 2,
      maximumFractionDigits: 2
    });
  }
</script>