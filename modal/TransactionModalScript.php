
   
<script>

$('#confirm').click(function()
{
      if( !document.getElementById('total-amount').value || 
          !document.getElementById('date').value || 
          !document.getElementById('name').value
      ) {
        Swal.fire({
          icon: 'error',
          title: 'Oops...',
          text: 'Fill all the necessary fields ',
        })
                
      }
      else{
        $('#confirmModal').modal('show');
              $tr = $(this).closest('tr');

                  var data =$tr.children("td").map(function(){
                    return $(this).text();
                  }).get();
                  $('#m_invoice').val($("#invoice").val());
                  $('#m_name').val($("#name").val());
                  $('#m_date').val($("#date").val());
                  $('#m_address').val($("#address").val());
                  $('#m_contract').val($("#contract").val());

                  $('#m_quantity').val($("#quantity").val());

                  // purchase info
                  $('#m_noSack').val($("#noSack").val());
                  $('#m_gross').val($("#gross").val());
                  $('#m_tare').val($("#tare").val());
                  $('#m_net').val($("#net").val());
                  
                  $('#m_dust').val($("#dust").val());
                  $('#m_new-dust').val($("#new").val());
                  $('#m_moisture').val($("#moisture").val());
                  $('#m_discount').val($("#discount_reading").val());
                  $('#m_total-dust').val($("#total-dust").val());

                  $('#m_total-moisture').val($("#total-moisture").val());
                  $('#m_net-resecada').val($("#total-res").val());
                  $('#m_1resecada').val($("#first-rese").val());
                  $('#m_2resecada').val($("#second-rese").val());
                  $('#m_3resecada').val($("#third-rese").val());
                  // total res

                  $('#m_1rese-weight').val($("#1rese-weight").val());
                  $('#m_2rese-weight').val($("#2rese-weight").val());
                  
                  $('#m_total_1res').val($("#total-1res").val());
                  $('#m_total_2res').val($("#total-2res").val());
                  $('#m_total_3res').val($("#total-3res").val());
                  // 
                  $('#m_total-amount').val($("#total-amount").val());
                  $('#m_less').val($("#less").val());
                  $('#m_total-paid').val($("#amount-paid").val());
                  $('#m_total-words').val($("#amount-paid-words").val());
      }
});
</script>

<!-- end -->
   
<script>
// validation

$('#vouchBtn').click(function()
{

      if( !document.getElementById('total-amount').value || 
          !document.getElementById('date').value || 
          !document.getElementById('name').value
      ) {
        Swal.fire({
          icon: 'error',
          title: 'Oops...',
          text: 'Fill all the necessary fields ',
        })
                
      }
      else{
        $('#print_vouch').modal('show');
              $tr = $(this).closest('tr');

                  var data =$tr.children("td").map(function(){
                    return $(this).text();
                  }).get();
                  $('#v_invoice').val($("#invoice").val());
                  $('#v_name').val($("#name").val());
                  $('#v_date').val($("#date").val());
                  $('#v_contract').val($("#contract").val());
                  $('#v_address').val($("#address").val());
                  // purchase info
                  $('#v_noSack').val($("#noSack").val());
                  $('#v_gross').val($("#gross").val());
                  $('#v_tare').val($("#tare").val());
                  $('#v_net').val($("#net").val());
                  
                  $('#v_dust').val($("#dust").val());
                  $('#v_new-dust').val($("#new").val());


                  $('#v_moisture').val($("#moisture").val());
                  $('#v_discount').val($("#discount_reading").val());
                  $('#v_total-dust').val($("#total-dust").val());


                  $('#v_total-moisture').val($("#total-moisture").val());
                  $('#v_net-resecada').val($("#total-res").val());
                  $('#v_1resecada').val($("#first-rese").val());
                  $('#v_2resecada').val($("#second-rese").val());
                  $('#v_3resecada').val($("#third-rese").val());
                  // total res
                  $('#v_total_1res').val($("#total-1res").val());
                  $('#v_total_2res').val($("#total-2res").val());
                  $('#v_total_3res').val($("#total-3res").val());
                  // 

                  $('#v_total-amount').val($("#total-amount").val());
                  $('#v_less').val($("#less").val());
                  $('#v_total-paid').val($("#amount-paid").val());
                  $('#v_total-words').val($("#amount-paid-words").val());

                }
      
});
</script>
