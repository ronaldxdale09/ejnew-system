<?php
function numtowords($num) {
    $decones = array(
        '01' => "One",
        '02' => "Two",
        '03' => "Three",
        '04' => "Four",
        '05' => "Five",
        '06' => "Six",
        '07' => "Seven",
        '08' => "Eight",
        '09' => "Nine",
        10 => "Ten",
        11 => "Eleven",
        12 => "Twelve",
        13 => "Thirteen",
        14 => "Fourteen",
        15 => "Fifteen",
        16 => "Sixteen",
        17 => "Seventeen",
        18 => "Eighteen",
        19 => "Nineteen"
    );
    $ones = array(
        0 => " ",
        1 => "One",
        2 => "Two",
        3 => "Three",
        4 => "Four",
        5 => "Five",
        6 => "Six",
        7 => "Seven",
        8 => "Eight",
        9 => "Nine",
        10 => "Ten",
        11 => "Eleven",
        12 => "Twelve",
        13 => "Thirteen",
        14 => "Fourteen",
        15 => "Fifteen",
        16 => "Sixteen",
        17 => "Seventeen",
        18 => "Eighteen",
        19 => "Nineteen"
    );
    $tens = array(
        0 => "",
        2 => "Twenty",
         // ... remaining array elements
    );
    $hundreds = array(
        "Hundred",
        "Thousand",
        "Million",
        "Billion",
        "Trillion",
        "Quadrillion"
    );

    $num = number_format($num, 2, ".", ",");
    $num_arr = explode(".", $num);
    $wholenum = $num_arr[0];
    $decnum = $num_arr[1];

    $whole_arr = array_reverse(explode(",", $wholenum));
    krsort($whole_arr);

    $rettxt = "";

    foreach ($whole_arr as $key => $i) {
        if ($i < 20) {
            $rettxt .= $ones[$i];
        } elseif ($i < 100) {
            $rettxt .= $tens[substr($i, 0, 1)];
            $rettxt .= " " . $ones[substr($i, 1, 1)];
        } else {
            $rettxt .= $ones[substr($i, 0, 1)] . " " . $hundreds[0];
            $rettxt .= " " . $tens[substr($i, 1, 1)];
            $rettxt .= " " . $ones[substr($i, 2, 1)];
        }

        if ($key > 0) {
            $rettxt .= " " . $hundreds[$key] . " ";
        }
    }

    $rettxt = $rettxt . " peso/s";

    if ($decnum != "00") {
        if ($decnum < 20) {
            if ($decnum < 10) {
                $decnum = '0' . $decnum;
            }
            $rettxt .= " and " . $decones[$decnum];
        } elseif ($decnum < 100) {
            $rettxt .= " and " . $tens[substr($decnum, 0, 1)];
            $rettxt .= " " . $ones[substr($decnum, 1, 1)];
        }
        $rettxt = $rettxt . " centavo/s";
    }

    return $rettxt;
}


?>


