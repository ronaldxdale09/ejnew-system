<div class="modal fade" id='viewBalesRecord' tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg  ">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Copra Purchase Record</h5>

            </div>
            <div class="modal-body">

                <div id='bales_rec'> </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>

    </div>
</div>

<script>
$(document).ready(function() {
    $('.btnView').on('click', function() {
        $tr = $(this).closest('tr');

        var data = $tr.children("td").map(function() {
            return $(this).text();
        }).get();

   
  
        function fetch_table() {
            r_invoice = data[0];
        
            $.ajax({
                url: "modal/dataModal/balesRecord.php",
                method: "POST",
                data: {
                    invoice: r_invoice

                },
                success: function(data) {
                    $('#bales_rec').html(data);
                }
            });
        }
        fetch_table();
        $('#viewBalesRecord').modal('show');
    });
});
</script>






<!-- DELETE RECORD -->

<div class="modal fade" id="deleteRec" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog " role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">DELETE RECORD</h5>
                <button type="button" class="btn" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="function/records_delete.php" method="POST">
                    <!--  total dust-->
                    <center>
                        <div class="col-6 col-md-12">
                            <div class="input-group mb-12">
                                <label style='font-size:25px' class="col-md-12">Confirm to delete record</label>
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="inputGroup-sizing-default"
                                        style='color:black;font-weight: bold;'>Invoice</span>
                                </div>
         
                                <input type="text" style='text-align:left' name='d_bales_id' id='d_bales_id' class="form-control"
                                     readonly />



                            </div>
                        </div>
                        <center>
                            <!-- end -->

            </div>
            <div class="modal-footer">
                <button type='submit' name='bales_remove' class="btn btn-danger text-white">Confirm</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
$(document).ready(function() {
    $('.btnBalesDelete').on('click', function() {
        $tr = $(this).closest('tr');

        var data = $tr.children("td").map(function() {
            return $(this).text();
        }).get();

        $('#d_bales_id').val(data[0]);
   
        $('#deleteRec').modal('show');
    });
});
</script>