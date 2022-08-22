function bales_compute(entry, net, price1, price2) {
    // let nf = new Intl.NumberFormat('en-US');

    console.log(entry);
    console.log(net);

    $("#drc").val(Math.round((parseInt(net) / parseInt(entry)) * 100));

}