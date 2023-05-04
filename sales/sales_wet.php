<?php 
   include('include/header.php');
   include "include/navbar.php";



    $tab= '';
    if (isset($_GET['tab'])) {
        $tab = filter_var($_GET['tab']) ;
      }
   ?>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<body>
    <link rel='stylesheet' href='css/statistic-card.css'>
    <link rel='stylesheet' href='css/record-tab.css'>

    <input type='hidden' id='selected-cart' value=''>
    <div class='main-content' style='position:relative; height:100%;'>
        <div class="container home-section h-100" style="max-width:95%;">

            <!-- ============================================================== -->
            <div class="container-fluid">

                <div class="row">
                    <h2 class="page-title"><B>
                            <font color="#0C0070"> CUPLUMP </font>
                            <font color="#046D56"> SHIPMENT </font>
                        </b></h2>
                    <div class="inventory-table">
                        <div class="container-fluid">
                            <div class="wrapper" id="myTab">
                                <div class="title"><?php include('sales/wet_sales.php');?> </div>
                            </div>

                        </div>
                    </div>



                </div>

            </div>
        </div>
    </div>

</body>

</html>
<script>

    
function submitForm() {


    const formData = new FormData(document.querySelector('#transaction_form'));

    // Perform an AJAX request
    fetch('function/wet_export_sales.php', {
            method: 'POST',
            body: formData,
        })
        .then(response => {
            if (!response.ok) {
                throw new Error('Network response was not ok');
            }
            return response.json();
        })
        .then(result => {
            console.log('Success:', result);
            if (result.success) {
               
            } else {
                console.error('Error:', result.error);
            }
        })
        .catch(error => {
            console.error('Error:', error);
        })
        .finally(() => {
            Swal.fire({
                icon: 'success',
                title: 'Transaction Successful!',
                showConfirmButton: true,
                confirmButtonText: 'Confirm'
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = '../sales/cuplumps_export.php';
                }
            });
        });
}
</script>