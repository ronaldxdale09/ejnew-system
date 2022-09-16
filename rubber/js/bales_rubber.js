function bales_compute(entry, net, bales_kilo, price, price2) {
    let nf = new Intl.NumberFormat('en-US');


    $("#drc").val(Math.round((parseInt(net) / parseInt(entry)) * 100));


    $("#drc").val(Math.round((parseInt(net) / parseInt(entry)) * 100));



    bales = ((parseInt(net) / parseInt(bales_kilo)));
    $("#bales_qty").val(nf.format(parseInt(bales)));

    x = (((net) / (bales_kilo)));
    bales = (parseInt(parseInt(net) / parseInt(bales_kilo)));
    bales_excess = parseInt(Number((x - bales).toFixed(2)) * bales_kilo);
    $("#excess_kg").val(bales_excess);


    var contract = document.getElementById("contract").value;
    if (contract === 'SPOT') {
        $("#first_total").val(nf.format((parseInt(price) * parseInt(net))));
        $("#total_amount").val(nf.format((parseInt(price) * parseInt(net))));
        amount_paid = $("#amount_paid").val(nf.format((parseInt(price) * parseInt(net))));


    }



}