function bales_compute(entry, net, bales_kilo, price, price2) {
    // let nf = new Intl.NumberFormat('en-US');


    $("#drc").val(Math.round((parseInt(net) / parseInt(entry)) * 100));


    $("#drc").val(Math.round((parseInt(net) / parseInt(entry)) * 100));

    $("#total_amount").val(((parseInt(price) * parseInt(net))));

    bales = ((parseInt(net) / parseInt(bales_kilo)));
    $("#bales_qty").val(parseInt(bales));


    bales_excess = bales - (parseInt(net) / parseInt(bales_kilo))
    $("#excess_kg").val(bales_excess);


}