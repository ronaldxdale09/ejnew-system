


<script>
function BalesRubber() {

    var entry = $("#entry").val().replace(/,/g, '');
    var net = $("#net_weight").val().replace(/,/g, '');
    var price1 = $("#price1").val().replace(/,/g, '');
    var price2 = $("#price2").val().replace(/,/g, '');
    var less = $("#cash_advance").val().replace(/,/g, '');


    bales_compute(entry, net, price1, price2, less);

};
</script>




<!-- add netweight -->
<script>
$(function() {
    $("#entry").keyup(function() {
        BalesRubber();
    });




});
</script>


<script>
$(function() {
    $("#net_weight").keyup(function() {
        BalesRubber();

    });




});
</script>

<!-- total -->
<script>
$(function() {
    $("#price1").keyup(function() {

        BalesRubber();


    });
});
</script>

<script>
$(function() {
    $("#price2").keyup(function() {

        BalesRubber();


    });
});
</script>
<script>
$(function() {
    $("#cash_advance").keyup(function() {
        BalesRubber();
    });
});
</script>
