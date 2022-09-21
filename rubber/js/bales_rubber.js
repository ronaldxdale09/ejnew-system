function currencyFormat(num) {
    return num.toFixed(2).replace(/(\d)(?=(\d{3})+(?!\d))/g, "")
}



function bales_compute(entry, net_1, net_2, kilo_bales_1, kilo_bales_2, price_1, price_2, less) {
    let nf = new Intl.NumberFormat('en-US');


    total_net = (+net_1 + +net_2);
    total_net = $("#total_net_weight").val((total_net.toFixed(2)));



    total_net = $("#total_net_weight").val().replace(/,/g, '')
    drc = (((+total_net) / (+entry)) * 100);
    $("#drc").val(drc.toFixed(2));


    bales_1 = (((+net_1) / (+kilo_bales_1)));
    $("#total_bales_1").val(nf.format(Math.floor(parseInt(bales_1))));

    bales_2 = (((+net_2) / (+kilo_bales_2)));
    $("#total_bales_2").val(nf.format(Math.floor(parseInt(bales_2))));


    first_total = (+price_1) * (+net_1);
    second_total = (+price_2) * (+net_1);

    $("#first_total").val(nf.format(first_total.toFixed(2)));
    $("#second_total").val(nf.format(second_total.toFixed(2)));

    first_total = $("#first_total").val().replace(/,/g, '');
    second_total = $("#second_total").val().replace(/,/g, '');


    total_amount = (+first_total) + (+second_total);

    $("#total_amount").val(nf.format(total_amount.toFixed(2)));

    total_amount = (+$("#total_amount").val().replace(/,/g, ''));
    amount_paid = (+total_amount) - (+less);
    $("#amount_paid").val(nf.format(amount_paid.toFixed(2)));


    // x = (((net) / (bales_kilo)));
    // bales = (parseInt(parseInt(net) / parseInt(bales_kilo)));
    // bales_excess = parseInt(Number((x - bales).toFixed(2)) * bales_kilo);
    // $("#excess_kg").val(bales_excess);

    // var contract = document.getElementById("contract").value;
    // if (contract === 'SPOT') {
    //     document.getElementById("second_price").readOnly = false;


    //     $("#first_total").val(nf.format((parseInt(price) * parseInt(net))));
    //     $("#total_amount").val(nf.format((parseInt(price) * parseInt(net))));


    //     amount_paid = $("#amount_paid").val(nf.format((parseInt(price) * parseInt(net))));


    // }



}