<div class="modal fade" id="categoryModal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg  ">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Category</h5>
            </div>
            <div class="modal-body">
                <div class="inventory-table">
                    <div class="row">
                        <form class="col-md-5" method='POST' a action="function/addCategory.php">
                            <div class="card mb-5">
                                <div class="card-header">
                                    New Brand Category
                                </div>
                                <div class="card-body">
                                    <label for="category1" class="form-label"> Brand</label>
                                    <select class="form-control" id="brand" name="brand" required>
                                        <option value="" selected disabled>Select...</option>
                                        <option value="La Cafe">La Cafe</option>
                                        <option value="Kalunkopi">Kalunkopi</option>
                                    </select>
                                    <label for="category2" class="form-label"> Category</label>
                                    <input type="text" class="form-control" id="category" name="category" aria-describedby="categoryHelp2" required>

                                    <div id="categoryHelp1" class="form-text mb-3">Enter category.</div>
                                    <button type="submit" name='add' class="btn btn-success">Add Category</button>
                                </div>
                            </div>

                        </form>
                        <div class="col-md-7">

                            <div class="card mb-7">
                                <div class="card-header">
                                  List of Category
                                </div>
                                <div class="card-body">
                                    <?php
                                    $results  = mysqli_query($con, "SELECT * from coffee_product_category  "); ?>
                                    <table id="expense_category" class="table table-hover" style="width:100%">
                                        <thead class="table-dark">
                                            <tr>
                                                <th hidden></th>
                                                <th>Brand </th>
                                                <th>Category</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>

                                        <tbody style='font-size:15px'>
                                            <?php
                                            $count = 1;
                                            while ($row = mysqli_fetch_array($results)) {
                                            ?>
                                                <tr>
                                                    <td hidden> <?php echo $row['category_id'] ?> </td>
                                                    
                                                    <td> <?php echo $row['coffee_brand'] ?> </td>
                                                    <td> <?php echo $row['category_name'] ?> </td>
                                                    <td>
                                                        <button type="button" class="btn btn-info btn-sm catUpdate"><i class="fa fa-edit"></i></button>

                                                        <button class="btn btn-danger btn-sm  m-1 btnDelete" type="button" class="btn btn-info"><i class="fa fa-trash"></i></button>
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
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
            </div>
        </div>

    </div>
</div>




<!-- update -->
<div class="modal fade" id="ModalEdit" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Update Category List</h5>
                <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form class="col-md-12" method='POST' a action="function/addCategory.php">
                    <div class="mb-3 text-center">
                        <input id='u_id' name='id' hidden>
                        <label for="category" class="form-label">Category Name</label>
                        <input type="text" class="form-control text-center" id="u_name" name="name" aria-describedby="category">

                    </div>

            </div>
            <div class="modal-footer">
                <button type="submit" name='update' class="btn btn-success">Save changes</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Delete -->
<div class="modal fade" id="catDelete" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Remove from Category List</h5>
                <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form class="col-md-12" method='POST' a action="function/addCategory.php">
                    <div class="mb-3">
                        <input id='d_id' name='d_id' hidden>
                        <div id="category" class="form-text mb-3">Please be advice that it will remove permanently.
                        </div>
                    </div>

            </div>
            <div class="modal-footer">
                <button type="submit" name='delete' class="btn btn-danger">Continue</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>

                </form>
            </div>
        </div>
    </div>
</div>



<script>
    $('.catUpdate').on('click', function() {


        $('#ModalEdit').modal('show');
        $tr = $(this).closest('tr');

        var data = $tr.children("td").map(function() {
            return $(this).text();
        }).get();
        $('#u_id').val(data[0]);
        $('#u_name').val(data[1]);

    });


    $('.btnDelete').on('click', function() {


        $('#catDelete').modal('show');
        $tr = $(this).closest('tr');

        var data = $tr.children("td").map(function() {
            return $(this).text();
        }).get();
        $('#d_id').val(data[0]);


    });
</script>