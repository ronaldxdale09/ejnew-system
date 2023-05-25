<?php
include 'include/header.php';
include 'include/navbar.php';

// Assuming $results is the variable containing the container records fetched from the database

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
                                <font color="#0C0070">BALE </font>
                                <font color="#046D56"> CONTAINER </font>
                            </b>
                        </h2>

                        <br>

                        <div class="container-fluid shadow p-3 mb-5 bg-white rounded">
                            <button type="button" class="btn btn-success text-white" data-toggle="modal"
                                data-target="#newContainer">NEW CONTAINER</button>
                            <hr>
                            <div class="table-responsive">
                                <table class="table table-bordered table-hover table-striped"
                                    id='recording_table-receiving'>
                                    <thead class="table-dark text-center" style="font-size: 14px !important">
                                        <tr>
                                            <th scope="col">Ref No.</th>
                                            <th scope="col">Container No.</th>
                                            <th scope="col">Loading Date</th>
                                            <th scope="col">Quality</th>
                                            <th scope="col">Kilo per Bale</th>
                                            <th scope="col">No. of Bales</th>
                                            <th scope="col">Total Weight</th>
                                            <th scope="col">Remarks</th>
                                            <th scope="col">Recorded</th>
                                            <th scope="col">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php while ($row = mysqli_fetch_array($results)) { ?>
                                        <tr>
                                            <td><?php echo $row['container_id']; ?></td>
                                            <td><?php echo $row['container_no']; ?></td>
                                            <td><?php echo $row['load_date']; ?></td>
                                            <td><?php echo $row['quality']; ?></td>
                                            <td class="number-cell">
                                                <?php echo number_format($row['bale_kilo'], 0, '.', ','); ?> kg
                                            </td>
                                            <td class="number-cell">
                                                <?php echo number_format($row['no_bales'], 2, '.', ','); ?>
                                            </td>
                                            <td class="number-cell">
                                                <?php echo number_format($row['total_weight'], 2, '.', ','); ?>
                                            </td>
                                            <td><?php echo $row['remarks']; ?></td>
                                            <td><?php echo $row['user']; ?></td>
                                            <td class="text-center">
                                                <button type="button" class="btn btn-success btn-sm btnViewRecord">
                                                    <i class="fas fa-book"></i>
                                                </button>
                                            </td>
                                        </tr>
                                        <?php } ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php include 'modal/modal_container.php'; ?>

    <script>
    $(document).ready(function() {
        var table = $('#recording_table-receiving').DataTable({
            dom: '<"top"<"left-col"B><"center-col"f>>lrtip',
            order: [
                [0, 'desc']
            ],
            buttons: [
                'excelHtml5',
                'pdfHtml5',
                'print'
            ],
            columnDefs: [{
                orderable: false,
                targets: -1
            }],
            lengthChange: false,
            orderCellsTop: true,
            paging: false,
            info: false,
        });
    });
    </script>
</body>

</html>

<?php include 'modal/modal_container.php'; ?>

<script>
$(document).ready(function() {
    document.getElementById('printButton').addEventListener('click', function() {
        const transactionRecord = document.getElementById('transaction_record');
        html2canvas(transactionRecord).then(function(canvas) {
            const imgData = canvas.toDataURL('image/png');
            const pdf = pdfMake.createPdf({
                content: [{
                    image: imgData,
                    width: 500
                }]
            });
            pdf.download('containers.pdf');
        });
    });

    document.getElementById('editButton').addEventListener('click', function() {
        var sale_id = document.getElementById('m_sale_id').value;
        // Redirect to the sales_wet.php page with the sale_id in the URL
        window.location.href = 'container.php?id=' + sale_id;
    });
});
</script>
