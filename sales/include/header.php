<!DOCTYPE html>

<?php
include "../function/db.php";
include "function/authenticate.php";
//   $loc = $_SESSION['loc'];



$loc = $_SESSION['loc'] ?? 'Basilan';
$name = $_SESSION["full_name"];
?>
<html>

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="theme-color" content="#2452af">
    <link href="assets/libs/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/main.css">

    <link rel="stylesheet" href="css/chosen.min.css">
    <link rel="stylesheet" href="static/css/buttons.bootstrap4.min.css">
    <link rel="stylesheet" href="static/css/buttons.dataTables.min.css">
    <link href="css/includes/dataTables.bootstrap5.min.css" rel="stylesheet">
    <link href="css/includes/buttons.dataTables.min.css" rel="stylesheet">
    <link href="css/includes/responsive.dataTables.min.css" rel="stylesheet">
    <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css'
        integrity='sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g=='
        crossorigin='anonymous' referrerpolicy='no-referrer' />
    <!-- date filter -->
    <link rel="stylesheet" type="text/css" href="css/includes/dataTables.dateTime.min.css" />
    <link rel='icon' href='assets/img/logo.png' size='10x10' />

    <title>EJN RUBBER</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="css/statistic-card.css">
</head>

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
</style>


<script>
// Helper function to set formatted value to an element
const setFormattedValue = (elementId, value) => {
    document.getElementById(elementId).value = value.toLocaleString('en-US', {
        minimumFractionDigits: 2,
        maximumFractionDigits: 2
    });
};
</script>

<?php include "include/footer.php";?>