function currencyFormat(num) {
    return num.toFixed(2).replace(/(\d)(?=(\d{3})+(?!\d))/g, "")
}

function getDecimalPart(num) {
    if (Number.isInteger(num)) {
        return 0;
    }

    const decimalStr = num.toString().split('.')[1];
    return Number(decimalStr);
}