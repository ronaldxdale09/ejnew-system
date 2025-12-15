<!DOCTYPE html>

<?php
include "../function/db.php";
include "include/bootstrap.php";
include "include/jquery.php";
//   $loc = $_SESSION['loc'];



$loc = $_SESSION['loc'];
$name = $_SESSION["full_name"];
?>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="cache-control" content="no-cache, no-store, must-revalidate">
    <meta http-equiv="pragma" content="no-cache">
    <meta http-equiv="expires" content="0">
    <!-- Favicon -->
    <link rel='icon' href='assets/img/logo.png' size='10x10' />

    <!-- Bootstrap & DataTables CSS -->
    <link href="assets/libs/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.2.3/css/buttons.bootstrap4.min.css">
    <link href="https://cdn.datatables.net/buttons/2.2.2/css/buttons.dataTables.min.css" rel="stylesheet">

    <!-- Local CSS -->
    <link rel="stylesheet" href="css/chosen.min.css?v=1.1">
    <link rel='stylesheet' href='css/main.css?v=1.1'>
    <link rel='stylesheet' href='css/navbar.css?v=1.1'>
    <link rel="stylesheet" href="css/statistic-card.css?v=1.1">

    <!-- Local JS -->
    <script src="assets/js/numberFormat.js?v=1.1"></script>
    <script src="js/sweetalert2@11.js?v=1.1"></script>

    <!-- External JS Libraries -->
    <script src="https://kit.fontawesome.com/a076d05399.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.3.3/html2canvas.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.66/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.66/vfs_fonts.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.7.1/chart.min.js"
        integrity="sha512-QSkVNOCYLtj73J4hbmVoOV6KVZuMluZlioC+trLpewV8qMjsWqlIQvkn1KGX2StWvPMdWGBqim1xlC8krl1EKQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script
        src="https://cdnjs.cloudflare.com/ajax/libs/chartjs-plugin-datalabels/2.2.0/chartjs-plugin-datalabels.min.js"
        integrity="sha512-JPcRR8yFa8mmCsfrw4TNte1ZvF1e3+1SdGMslZvmrzDYxS69J7J49vkFL8u6u8PlPJK+H3voElBtUCzaXj+6ig=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.30.1/moment.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/chartjs-adapter-moment/1.0.1/chartjs-adapter-moment.min.js"
        integrity="sha512-hVy4KxCKgnXi2ok7rlnlPma4JHXI1VPQeempoaclV1GwRHrDeaiuS1pI6DVldaj5oh6Opy2XJ2CTljQLPkaMrQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <title>EJN RUBBER</title>
</head>

<!-- <script src='assets/js/navbar.js'></script> -->
<?php
include "include/datatables_buttons_css.php";
include "include/datatables_buttons_js.php";

?>
<style>
    .dataTables_length {
        margin-top: 10px;
        margin-left: 20px;
    }

    .floating-refresh-button {
        position: fixed;
        bottom: 20px;
        right: 20px;
        display: flex;
        justify-content: center;
        align-items: center;
        width: 60px;
        height: 60px;
        border-radius: 50%;
        background-color: #0095ff;
        color: #ffffff;
        font-size: 24px;
        border: none;
        outline: none;
        cursor: pointer;
        box-shadow: 0px 3px 6px rgba(0, 0, 0, 0.16);
        transition: background-color 0.2s ease-in-out;
        z-index: 9999;
    }

    .floating-refresh-button:hover {
        background-color: green;
    }

    @keyframes spinning {
        0% {
            transform: rotate(0deg);
        }

        100% {
            transform: rotate(360deg);
        }
    }

    /* Move the animation property to the :hover state */
    .floating-refresh-button:hover i {
        animation: spinning 2s linear infinite;
    }

    .modal-content {
        border-radius: 15px;
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.3);
    }

    .modal-header {
        border-bottom: none;
    }

    .modal-footer {
        border-top: none;
    }

    .nowrap {
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }

    .flex-container {
        display: flex;
        justify-content: space-between;
        font-weight: bold;
        width: 100%;
    }

    .separator {
        border-top: 1px solid #000;
        /* Change color as needed */
        margin: 4px 0;
        /* Add some vertical spacing */
    }

    .stat-card__content {
        font-family: Arial, sans-serif;
        color: #333;
    }

    .card-header {
        font-family: 'Arial', sans-serif;
        /* Use a modern, clean font */
        /* Slightly larger font size */
        font-weight: 800;
        /* Semi-bold weight */
        color: #333333;
        /* Darker text color */
        text-align: center;
        /* Centered text */
        text-transform: uppercase;
        /* Uppercase letters */
        margin-bottom: 15px;
        /* Space below the header */
        border-bottom: 2px solid #f0f0f0;
        /* Underline with a light color */
        padding-bottom: 10px;
        /* Padding below the text */
    }

    .chart-header {
        text-align: center;
        font-family: 'Arial', sans-serif;
        /* You can replace with any modern font-family like 'Roboto', 'Open Sans', etc. */
        font-weight: 600;
        /* A slightly larger size */
        color: #333;
        /* A subtle dark color instead of full black */
        padding: 20px 0;
        /* Adding some vertical spacing */
        border-bottom: 2px solid #e5e5e5;
        /* A subtle border underneath for differentiation */
        margin-bottom: 20px;
        /* Space between header and the chart */
    }
</style>
<!-- <button id="refreshButton" class="floating-refresh-button" onclick="refreshPage()">
    <i class="fas fa-sync-alt"></i>
</button> -->