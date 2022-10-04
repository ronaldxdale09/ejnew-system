<div class="table-responsive">
    <table class="table" id='sellerTable'> <?php
                                           $results  = mysqli_query($con, "SELECT * from rubber_seller"); ?>
        <thead class="table-dark">
            <tr>
                <th>Image</th>
                <th scope="col">Name</th>
                <th scope="col">Address</th>
                <th scope="col">Contact #</th>
                <th scope="col">Action</th>
            </tr>
        </thead>
        <tbody> <?php while ($row = mysqli_fetch_array($results)) { ?> <tr>
                <td>
                    <nobr> <img src="assets/img/avatar.png" alt="..." class="img img-fluid" width="65">
                    </nobr>
                </td>
                <td> <?php echo $row['name']?> </td>
                <td> <?php echo $row['address']?> </td>
                <td> <?php echo $row['contact']?> </td>
                <td>
                    <a href="seller_profile.php?view=<?php echo $row['id']; ?>" class="btn btn-primary ">
                        <i class='fa-solid fa-eye'></i></a>
                </td>
            </tr> <?php } ?> </tbody>
    </table>
</div>

<script>
$('#newReceiving').on('shown.bs.modal', function() {
    $('.source', this).chosen();
});
</script>