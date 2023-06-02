

<div class="modal fade" id="modal_produced_record" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header bg-dark text-white">
                <h5 class="modal-title" id="exampleModalLabel"> Production Record</h5>
                <button type="button" class="btn" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true" class="text-white">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="function/rubber_process.php" method="POST">

                    <hr>
                    <div id='produced_modal_table'></div>
                    <hr>

                   
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Close</button>
                
                </form>
            </div>
        </div>
    </div>
</div>



<script>
$('.btnSelectTrans').on('click', function() {
    $tr = $(this).closest('tr');

    var data = $tr.children("td").map(function() {
        return $(this).text();
    }).get();

    var purchase_id = <?php echo $trans_id;?>;

    console.log(purchase_id);
    function fetch_record() {

        $.ajax({
            url: "table/bales_purchasing_table.php",
            method: "POST",
            data: {
                purchase_id: purchase_id,

            },
            success: function(data) {

                
                $('#produced_modal_table').html(data);
               

            }
        });
    }
    fetch_record();
    $('#modal_produced_record').modal('show');

});
</script>