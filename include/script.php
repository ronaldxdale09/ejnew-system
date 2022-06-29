<!-- CHOSEN -->


<script>
$(function() {
   $(".select_seller").chosen({search_threshold: 10});
});
</script>

<!-- DISPLAY ADDRESS -->
<script type="text/javascript">
   $(document).ready(function(){
   // Country dependent ajax
   $("#name").on("change",function(){
   var name = $(this).val();
  
    $.ajax({
    	url :"include/fetch/fetchAddress.php",
	type:"POST",
	cache:false,
	data:{name:name},
  cache: false,
success: function(address)
{
$("#address").html(address);
} 
});
 
});
});
</script>

<script type="text/javascript">
            $(document).ready(function() {



                $('#print_voucher').click(function() {
                    var nw = window.open("voucher/print_voucher.php", "_blank", "height=623,width=812")
                    setTimeout(function() {
                        nw.print()
                        setTimeout(function() {
                            nw.close()
                        }, 500)
                    }, 1000)
                })



            });
            </script>



<!-- END -->

<!-- Auto add comma (,) in text-box with numbers -->
<script>
function FormatCurrency(ctrl) {
            //Check if arrow keys are pressed - we want to allow navigation around textbox using arrow keys
            if (event.keyCode == 37 || event.keyCode == 38 || event.keyCode == 39 || event.keyCode == 40) {
                return;
            }

            var val = ctrl.value;

            val = val.replace(/,/g, "")
            ctrl.value = "";
            val += '';
            x = val.split('.');
            x1 = x[0];
            x2 = x.length > 1 ? '.' + x[1] : '';

            var rgx = /(\d+)(\d{3})/;

            while (rgx.test(x1)) {
                x1 = x1.replace(rgx, '$1' + ',' + '$2');
            }

            ctrl.value = x1 + x2;
        }

        function CheckNumeric() {
            return event.keyCode >= 48 && event.keyCode <= 57 || event.keyCode == 46;
        }

</script>



<!-- COMPUTE MOISTURE DISCOUNT -->

<!-- add netweight -->
<script>

$(function () {
  $("#gross, #tare").keyup(function () {
      
    $("#net").val(((+$("#gross").val().replace(/,/g, '') - +$("#tare").val().replace(/,/g, ''))).toLocaleString());
  });
});

</script>
<!-- end net weight -->

<!-- autput DISCOUNT -->
<!-- get total DUST -->
<script>

$(function () {
  $("#dust").keyup(function () {
      
    $("#new").val(Math.round((((+$("#dust").val().replace(/,/g, '')/100) * +$("#net").val().replace(/,/g, ''))).toLocaleString()));
    $("#total-dust").val(((+$("#net").val().replace(/,/g, '') - +$("#new").val().replace(/,/g, ''))).toLocaleString());
  });
});

</script>

<!-- total -->
<script>

$(function () {
  $("#first-rese").keyup(function () {
      
    $("#total-amount").val(((+$("#first-rese").val().replace(/,/g, '') * +$("#total-res").val().replace(/,/g, ''))).toLocaleString());
    document.getElementById
                      ("amount-paid").value = $("#total-amount").val();
    getWords($("#amount-paid").val())
    
  });
});

</script>

<script>

$(function () {
  $("#less").keyup(function () {
      
    $("#amount-paid").val(((+$("#total-amount").val().replace(/,/g, '') - +$("#less").val().replace(/,/g, ''))).toLocaleString());
    
  });
});

</script>



<script>
  
  // onkeyup event will occur when the user 
  // release the key and calls the function
  // assigned to this event
  function GetDetail(str) {
      if (str.length == 0) {
          document.getElementById("discount_reading").value = "";
          return;
      }
      else {

          // Creates a new XMLHttpRequest object
          var xmlhttp = new XMLHttpRequest();
          xmlhttp.onreadystatechange = function () {

              // Defines a function to be called when
              // the readyState property changess
              if (this.readyState == 4 && 
                      this.status == 200) {
                    
                  // Typical action to be performed
                  // when the document is ready
                  var myObj = JSON.parse(this.responseText);

                  // Returns the response data as a
                  // string and store this array in
                  // a variable assign the value 
                  // received to first name input field
                
                document.getElementById
                      ("discount_reading").value = myObj[0];
                  
                document.getElementById
                      ("total-moisture").value = Math.round(-(+$("#total-dust").val().replace(/,/g, '')*str)/100);

                $total_dust = $("#total-dust").val().replace(/,/g, '');
                $total_moisture =$("#total-moisture").val()

                document.getElementById
                      ("total-res").value = (+(Number($total_dust))-(Math.abs($total_moisture)));

                document.getElementById
                      ("rese-total").value = $("#total-res").val();

                
                
                // 


                // var total = document.getElementById('val2').value;
                // var sum = Number(val1) + Number(val2);

              }
          };

          // xhttp.open("GET", "filename", true);
          xmlhttp.open("GET", "function/discount.php?moisture="+str, true);
            
          // Sends the request to the server
          xmlhttp.send();
      }
  }
</script>


<script>
  
  // onkeyup event will occur when the user 
  // release the key and calls the function
  // assigned to this event
  function getWords(str) {
      if (str.length == 0) {
          document.getElementById("amount-paid-words").value = "";
          return;
      }
      else {

          // Creates a new XMLHttpRequest object
          var xmlhttp = new XMLHttpRequest();
          xmlhttp.onreadystatechange = function () {

              // Defines a function to be called when
              // the readyState property changess
              if (this.readyState == 4 && 
                      this.status == 200) {
                    
                  // Typical action to be performed
                  // when the document is ready
                  var myObj = JSON.parse(this.responseText);

                  // Returns the response data as a
                  // string and store this array in
                  // a variable assign the value 
                  // received to first name input field
                
                document.getElementById
                      ("amount-paid-words").value = myObj;
              }
          };

          // xhttp.open("GET", "filename", true);
          xmlhttp.open("GET", "function/fetchWords.php?number="+str.replace(/,/g, ''), true);
            
          // Sends the request to the server
          xmlhttp.send();
      }
  }
</script>