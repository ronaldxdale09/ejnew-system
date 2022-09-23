<div class="modal fade" id='viewRecord' tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg  ">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Copra Purchase Record</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
               
            <div id='wet_body'> </div>
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
        // $tr = $(this).closest('tr');

        // var data = $tr.children("td").map(function() {
        //     return $(this).text();
        // }).get();

        // $('#v_date').val(data[2]);
        // $('#v_voucher').val(data[3]);
        // $('#v_company').val(data[4]);


        function fetch_table() {

            invoice = 1;

            $.ajax({
                url: "modal/dataModal/wetRecord.php",
                method: "POST",
                data: {
                    invoice:invoice,

                },
                success: function(data) {
                    $('#wet_body').html(data);
                }
            });
        }
        fetch_table();
        $('#viewRecord').modal('show');
    });
});
</script>