<?php

use Dompdf\Dompdf;
use Dompdf\Options;
function generateRandomNumber()
{
    $min = 1;
    $max = 99999;
    return rand($min, $max);
}
function AmountInWordsRussian(float $amount)
{
    $amount_after_decimal = round($amount - ($num = floor($amount)), 2) * 100;

    // Check if there is any number after decimal
    $amt_hundred = null;
    $count_length = strlen($num);
    $x = 0;
    $string = [];
    $change_words = [
        0 => "",
        1 => "Один",
        2 => "Два",
        3 => "Три",
        4 => "Четыре",
        5 => "Пять",
        6 => "Шесть",
        7 => "Семь",
        8 => "Восемь",
        9 => "Девять",
        10 => "Десять",
        11 => "Одиннадцать",
        12 => "Двенадцать",
        13 => "Тринадцать",
        14 => "Четырнадцать",
        15 => "Пятнадцать",
        16 => "Шестнадцать",
        17 => "Семнадцать",
        18 => "Восемнадцать",
        19 => "Девятнадцать",
        20 => "Двадцать",
        30 => "Тридцать",
        40 => "Сорок",
        50 => "Пятьдесят",
        60 => "Шестьдесят",
        70 => "Семьдесят",
        80 => "Восемьдесят",
        90 => "Девяносто",
    ];

    $here_digits = ["", "Сто", "Тысяча", "Лакх", "Крор"];

    while ($x < $count_length) {
        $get_divider = $x == 2 ? 10 : 100;
        $amount = floor($num % $get_divider);
        $num = floor($num / $get_divider);
        $x += $get_divider == 10 ? 1 : 2;

        if ($amount) {
            $add_plural =
                ($counter = count($string)) && $amount > 9 ? "ов" : null;
            $amt_hundred = $counter == 1 && $string[0] ? " и " : null;

            $string[] =
                $amount < 21
                    ? $change_words[$amount] .
                        " " .
                        $here_digits[$counter] .
                        $add_plural .
                        " " .
                        $amt_hundred
                    : $change_words[floor($amount / 10) * 10] .
                        " " .
                        $change_words[$amount % 10] .
                        " " .
                        $here_digits[$counter] .
                        $add_plural .
                        " " .
                        $amt_hundred;
        } else {
            $string[] = null;
        }
    }

    $implode_to_Ruble = implode("", array_reverse($string));
    $get_paise =
        $amount_after_decimal > 0
            ? "и " .
                ($change_words[$amount_after_decimal / 10] .
                    " " .
                    $change_words[$amount_after_decimal % 10]) .
                " копеек"
            : "";

    return ($implode_to_Ruble ? $implode_to_Ruble . "рублей " : "") .
        $get_paise;
}

function AmountInWords(float $amount)
{
    $amount_after_decimal = round($amount - ($num = floor($amount)), 2) * 100;
    // Check if there is any number after decimal
    $amt_hundred = null;
    $count_length = strlen($num);
    $x = 0;
    $string = [];
    $change_words = [
        0 => "",
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
        19 => "Nineteen",
        20 => "Twenty",
        30 => "Thirty",
        40 => "Forty",
        50 => "Fifty",
        60 => "Sixty",
        70 => "Seventy",
        80 => "Eighty",
        90 => "Ninety",
    ];
    $here_digits = ["", "Hundred", "Thousand", "Lakh", "Crore"];
    while ($x < $count_length) {
        $get_divider = $x == 2 ? 10 : 100;
        $amount = floor($num % $get_divider);
        $num = floor($num / $get_divider);
        $x += $get_divider == 10 ? 1 : 2;
        if ($amount) {
            $add_plural =
                ($counter = count($string)) && $amount > 9 ? "s" : null;
            $amt_hundred = $counter == 1 && $string[0] ? " and " : null;
            $string[] =
                $amount < 21
                    ? $change_words[$amount] .
                        " " .
                        $here_digits[$counter] .
                        $add_plural .
                        ' 
       ' .
                        $amt_hundred
                    : $change_words[floor($amount / 10) * 10] .
                        " " .
                        $change_words[$amount % 10] .
                        ' 
       ' .
                        $here_digits[$counter] .
                        $add_plural .
                        " " .
                        $amt_hundred;
        } else {
            $string[] = null;
        }
    }
    $implode_to_Euro = implode("", array_reverse($string));
    $get_paise =
        $amount_after_decimal > 0
            ? "And " .
                ($change_words[$amount_after_decimal / 10] .
                    " 
   " .
                    $change_words[$amount_after_decimal % 10]) .
                " ct"
            : "";
    return ($implode_to_Euro ? $implode_to_Euro . "Euro " : "") . $get_paise;
}

// function skaicius_zodziais( $skaicius ) {

// 	// neskaiciuosim neigiamu ir itin dideliu skaiciu (iki milijardu)
// 	if ( $skaicius < 0 || strlen( $skaicius ) > 9 ) return;

// 	if ( $skaicius == 0 ) return 'nulis';

// 	$vienetai = array( '', 'vienas', 'du', 'trys', 'keturi', 'penki', 'šeši', 'septyni', 'aštuoni', 'devyni' );

// 	$niolikai = array( '', 'vienuolika', 'dvylika', 'trylika', 'keturiolika', 'penkiolika', 'šešiolika', 'septyniolika', 'aštuoniolika', 'devyniolika' );

// 	$desimtys = array( '', 'dešimt', 'dvidešimt', 'trisdešimt', 'keturiasdešimt', 'penkiasdešimt', 'šešiasdešimt', 'septyniasdešimt', 'aštuoniasdešimt', 'devyniasdešimt' );

// 	$pavadinimas = array(
// 		array( 'milijonas', 'milijonai', 'milijonų' ),
// 		array( 'tūkstantis', 'tūkstančiai', 'tūkstančių' ),
// 	);

// 	$skaicius = sprintf( '%09d', $skaicius ); // iki milijardu 10^9 (milijardu neskaiciuosim)
// 	$skaicius = str_split( $skaicius, 3 ); // kertam kas tris simbolius

// 	$zodziais = array();

// 	foreach ( $skaicius as $i => $tripletas ) {

// 		// resetinam linksni
// 		$linksnis = 0;

// 		// pridedam simtu pavadinima, jei pirmas tripleto skaitmuo > 0
// 		if ( $tripletas[0] > 0 ) {
// 			$zodziais[] = $vienetai[ $tripletas[0] ];
// 			$zodziais[] = ( $tripletas[0] > 1 ) ? 'šimtai' : 'šimtas';
// 		}

// 		// du paskutiniai tripleto skaiciai
// 		$du = substr( $tripletas, 1 );

// 		// pacekinam nioliktus skaicius
// 		if ( $du > 10 && $du < 20 ) {
// 			$zodziais[] = $niolikai[ $du[1] ];
// 			$linksnis = 2;
// 		} else {

// 			// pacekinam desimtis
// 			if ( $du[0] > 0 ) {
// 				$zodziais[] = $desimtys[ $du[0] ];
// 			}

// 			// pridedam vienetus
// 			if ( $du[1] > 0 ) {
// 				$zodziais[] = $vienetai[ $du[1] ];
// 				$linksnis = ( $du[1] > 1 ) ? 1 : 0;
// 			} else {
// 				$linksnis = 2;
// 			}

// 		}

// 		// pridedam pavadinima isskyrus paskutiniam ir nuliniams tripletams
// 		if ( $i < count( $pavadinimas ) && $tripletas != '000' ) {
// 			$zodziais[] = $pavadinimas[ $i ][ $linksnis ];
// 		}

// 	}

// 	return implode( ' ', $zodziais );
// }

function skaicius_zodziais($skaicius)
{
    // Check if the number is negative or too large
    if ($skaicius < 0 || strlen($skaicius) > 9) {
        return;
    }

    // Split the input into euros and cents
    list($euros, $cents) = explode(".", $skaicius);

    // Handle euros part
    $euros_text = "";
    if ($euros == 0) {
        $euros_text = "nulis Eur.";
    } else {
        $euros_text = skaicius_zodziais_helper($euros) . " Eur.";
    }

    // Handle cents part
    $cents_text = "";
    if (!empty($cents)) {
        $cents_text = " " . $cents . " cnt.";
    }

    // Combine euros and cents
    $result = $euros_text . $cents_text;

    return $result;
}

function skaicius_zodziais_helper($skaicius)
{
    $vienetai = [
        "",
        "vienas",
        "du",
        "trys",
        "keturi",
        "penki",
        "šeši",
        "septyni",
        "aštuoni",
        "devyni",
    ];
    $niolikai = [
        "",
        "vienuolika",
        "dvylika",
        "trylika",
        "keturiolika",
        "penkiolika",
        "šešiolika",
        "septyniolika",
        "aštuoniolika",
        "devyniolika",
    ];
    $desimtys = [
        "",
        "dešimt",
        "dvidešimt",
        "trisdešimt",
        "keturiasdešimt",
        "penkiasdešimt",
        "šešiasdešimt",
        "septyniasdešimt",
        "aštuoniasdešimt",
        "devyniasdešimt",
    ];
    $pavadinimas = [
        ["milijonas", "milijonai", "milijonų"],
        ["tūkstantis", "tūkstančiai", "tūkstančių"],
    ];

    $skaicius = sprintf("%09d", $skaicius); // Up to a billion (10^9)
    $skaicius = str_split($skaicius, 3); // Split into triplets

    $zodziais = [];

    foreach ($skaicius as $i => $tripletas) {
        // Reset the declension
        $linksnis = 0;

        // Add the hundreds name if the first digit of the triplet > 0
        if ($tripletas[0] > 0) {
            $zodziais[] = $vienetai[$tripletas[0]];
            $zodziais[] = $tripletas[0] > 1 ? "šimtai" : "šimtas";
        }

        // Last two digits
        $du = substr($tripletas, 1);

        // Handle the teens
        if ($du > 10 && $du < 20) {
            $zodziais[] = $niolikai[$du[1]];
            $linksnis = 2;
        } else {
            // Handle the tens
            if ($du[0] > 0) {
                $zodziais[] = $desimtys[$du[0]];
            }

            // Add the units
            if ($du[1] > 0) {
                $zodziais[] = $vienetai[$du[1]];
                $linksnis = $du[1] > 1 ? 1 : 0;
            } else {
                $linksnis = 2;
            }
        }

        // Add the unit name except for the last and zero triplets
        if ($i < count($pavadinimas) && $tripletas != "000") {
            $zodziais[] = $pavadinimas[$i][$linksnis];
        }
    }

    return implode(" ", $zodziais);
}

function valiutos_galune($number, $saknis = "eur")
{
    if ($number < 0 || strlen($number) > 9) {
        return;
    }

    if ($number == 0) {
        return $saknis . "ų";
    }

    $last = substr($number, -1);
    $du = substr($number, -2, 2);

    if ($du > 10 && $du < 20) {
        return $saknis . "ų";
    } else {
        if ($last == 0) {
            return $saknis . "ų";
        } elseif ($last == 1) {
            return $saknis . "as";
        } else {
            return $saknis . "ai";
        }
    }
}

function generate_invoice_fixed($invoice_num)
{
    $currentLanguage = defined("ICL_LANGUAGE_CODE")
        ? ICL_LANGUAGE_CODE
        : "default";
    $single_order_ids = [];
    $current_month = date("m");
    $current_year = date("Y");
    $user_ID = get_current_user_id();
    $company_name = get_field("company_name", "user_" . $user_ID);
    $company_code = get_field("company_code", "user_" . $user_ID);
    $vat_code = get_field("vat_code", "user_" . $user_ID);
    $previous_month_start = strtotime("first day of last month");
    $previous_month_end = strtotime("last day of last month");
    $args = [
        "limit" => -1,
        "date" => [
            "after" => date("Y-m-d H:i:s", $previous_month_start),
            "before" => date(
                "Y-m-d H:i:s",
                strtotime("+1 day", $previous_month_end)
            ), // Adding one day to include orders on the last day
        ],
        "meta_key" => "_company_name", // Postmeta key field
        "meta_value" => $company_name, // Postmeta value field
        "meta_compare" => "=",
        "post_status" => "wc-processing",
    ];

    $orders = wc_get_orders($args);
    $currentYear = date("Y");
    $currentMonth = date("m");

    // Get the first and last date of the current month
    $firstDate = date("Y-m-01", strtotime("$currentYear-$currentMonth-01"));
    $lastDate = date("Y-m-t", strtotime("$currentYear-$currentMonth-01"));

    $nextMonth = $currentMonth + 1;

    // Check if the next month is January of the next year
    if ($nextMonth > 12) {
        $nextMonth = 1;
        $currentYear++;
    }

    // Create a date string for the first day of the next month
    $firstDayOfNextMonth = "$currentYear-$nextMonth-01";

    // Calculate the last day of the next month
    $lastDayOfNextMonth = date("Y-m-d", strtotime("last day of this month"));
    $randomNumber = generateRandomNumber();

    $invoice_pdf_name = __("EAT-", "synergy");

    $invoice_number = $invoice_num;

    $company_name = get_field("company_name", "user_" . $user_ID);
    $company_code = get_field("company_code", "user_" . $user_ID);
    $vat_code = get_field("vat_code", "user_" . $user_ID);

    $billing_first_name = get_user_meta($user_ID, "billing_first_name", true);
    $billing_last_name = get_user_meta($user_ID, "billing_last_name", true);
    $billing_address_1 = get_user_meta($user_ID, "billing_address_1", true);
    $billing_postcode = get_user_meta($user_ID, "billing_postcode", true);
    $billing_city = get_user_meta($user_ID, "billing_city", true);

    $html = "
<style>
html { margin: 0}
@page { margin: 0; }
table{
    border-collapse: collapse;
    border: none;
    width: 100%;
}
body {
	background-size: contain;
	font-family:  DejaVu Sans;
	margin: 0;
    font-size: 13px;
    line-height: 18px;
    color: #1D1D1B;
}
.header-left{
     width: 20%; 
     padding: 0px 35px 0px 35px;
}
.header-right{
    width: 80%; 
    font-style: normal;
    font-weight: 400;
    font-size: 11px;
    line-height: 9px;
    color: #32EDB4;
    padding: 0px 35px 0px 35px;
	float:right;
}
.title{
    font-style: normal;
    font-weight: 700;
    font-size: 19px;
    line-height: 25px;
    color: #1D1D1B;
    text-align: center;
    margin-top: 20px;
    margin-bottom: 20px;
}
.table th{
    background-color: #000;
    height: 40px;
    font-style: normal;
    font-weight: 400;
    text-align: left;
	color:#fff;
	font-size:16px;
	padding: 10px;
}
.table td{
	padding: 10px;
}

.table td:nth-child(1),
thead th:nth-child(1){
    padding-left: 15px;
}
.table td:last-child,
thead th:last-child{
    padding-left: 15px;
}
.footer{
    position: absolute;
    right: 44px;
    bottom: 20px;
}
.text{
    font-weight: 700;
    font-size: 9px;
    line-height: 13px;
    color: #9D9D9C;
    padding-right: 10px;
}
.table-summary{
    width: 50%;
    margin-left: auto;
    text-align: right;
    margin-top: 10px;
    margin-right: 60px;
    font-weight: 400;
}
.content{
    margin-top: 00px;
    padding-left: 54px;
}
.content-title{
    margin-top: 10px;
}
.main_invoice_data h3{
	font-size:30px;
	font-weight:bold;
	margin-bottom:5px;
}
.main_invoice_data div div div{
	font-size:16px;
	font-weight:400;
	margin-bottom:0px;
}
.order_data{
	display:flex;
	justify-content: space-between;
}
.flex{
	display:flex;
}
.space-between{
	justify-content: space-between;
}
.gap-3{
	gap:20px;
}
.order_details_total div{
	text-align:right;
	margin-bottom:10px;
}
.order_details_total div span{
 font-size:16px;
 margin-right:10px;
}
.data_table{
	font-size:16px;
}
.shipping tr td{
	text-align:center;
}
.left{
	float:left;
}
.right{
	float:right;
}
.table-summary td{
font-size:20px;
font-weight:bold;
margin-bottom:5px;
}
.w-1\/2 {
    width: 50%;
}
.border-bottom {
    border-bottom: 1px solid #000; /* Change this to your desired border style */
	margin:0px 0px;
}
.bottom_data{
	width:40%;
	float:right;
	border-top:1px solid #000;
	margin-top:10px;
}
.bottom_data div{
 	border-bottom: 1px solid #000;
}
.bottom_data div span{
	display:inline-block;
	width:48%;
}
.header-right span {
    font-size: 16px;
    color: #000;
    display: block;
    margin-bottom: 3px;
    text-align: left;
    line-height: normal;
}
.clearfix::after {
  content: '';
  display: table;
  clear: both;
}
.border-bottom {
padding:0px;
}
.border-bottom td{
padding-top:0px;
}
.border-bottom td ul{
	margin-top:0px;
}
.border-bottom td ul li{
	margin-top:0px;
}
</style>
<link href='https://api.fontshare.com/v2/css?f[]=satoshi@900,700,500,400&amp;display=swap' rel='stylesheet'>";
    $html .=
        "<table style='margin:0px;'>
    <tr>
        <td class='header-left'>
            <img width='100'  src='https://seatisfy.lt/wp-content/uploads/2023/01/Vector-1.png'> 
        </td>
		<td class='header-right' style='padding-top:00px;'>
			<h3 style='font-size:20px;clear:both;width:100%;padding:0px 0px 0px 0px;line-height:30px;margin-bottom:10px;color:#000;clear:both;display:block;'>Pardavėjas:</h3>

				<div class='' style='margin-right:0px;display:inline-block;width:45%; text-align:left;margin-top:10px; font-size:16px;'>
					<span style='margin:0px;line-height:16px;' class=''>" .
        __("Įmonės pavadinimas:", "synergy") .
        "</span>
					<span style='margin:0px;line-height:16px;' class=''>" .
        __("Adresas:", "synergy") .
        "</span>
					<span style='margin:0px;line-height:16px;' class=''>" .
        __("Įmonės kodas: ", "synergy") .
        "</span>
					<span style='margin:0px;line-height:16px;' class=''>" .
        __("PVM mokėtojo kodas: ", "synergy") .
        "</span>
					<span style='margin:0px;line-height:16px;font-weight:bold;' class=''>" .
        __("PVM sąskaitos numeris: ", "synergy") .
        "</span>

				</div>
				<div class='' style='display:inline-block;width:50%;text-align:left;' >
					<span style='margin:0px;line-height:16px;' class=''>" .
        __("UAB Jogundė", "synergy") .
        "</span>
					<span style='margin:0px;line-height:16px;' class=''>" .
        __("Liepų g. 19, Klaipėda", "synergy") .
        "</span>
					<span style='margin:0px;line-height:16px;' class=''>140809765</span>
					<span style='margin:0px;line-height:16px;' class=''>LT408097610</span>
					<span style='margin:0px;line-height:16px;font-weight:bold;' class=''>" .
        $invoice_number .
        "</span>

					
				</div>
				
				

		</td>
    </tr>
</table>

	<h3 style='font-size:20px;clear:both;width:100%;padding:0px 20px 0px 20px;margin:0px!important;'>" .
        __("PVM SĄSKAITA FAKTŪRA", "synergy") .
        "</h3>
	<span  style='font-size:18px;clear:both;width:100%;padding:0px 20px 0px 20px;display:block;margin-bottom:20px;line-height:30px;font-weight:bold;'>" .
        __("Pirkėjas:", "synergy") .
        "</span>
	<div class='main_invoice_data' style='padding:0px 20px 0px 20px;clear:both;margin-bottom:0px;'>
		
		<div class='order_dataa'  style='margin-bottom:0px;'>
			<div class='left' style='clear:both;width:60%;'>
				<div class='' style='margin-right:0px;display:inline-block;width:40%;'>
					<div class=''>" .
        __("Įmonės pavadinimas:", "synergy") .
        "</div>
					<div class=''>" .
        __("Adresas:", "synergy") .
        "</div>
					<div class=''>" .
        __("Įmonės kodas:", "synergy") .
        "</div>
					<div class=''>" .
        __("PVM mokėtojo kodas:", "synergy") .
        "</div>
				</div>
				<div class='' style='display:inline-block;width:58%;' >
					<div class=''>" .
        $company_name .
        "</div>
					<div class=''>" .
        $billing_address_1 .
        ", " .
        $billing_postcode .
        " " .
        $billing_city .
        "</div>
					<div class=''>" .
        $company_code .
        "</div>
					<div class=''>" .
        $vat_code .
        "</div>
				</div>
			</div>

			<div class='right' style='width:42%;margin-bottom:0px;'>
				<div style='margin-right: 0px; display: inline-block; width: 40%;margin-top:0px;'>
					<div style='margin-top:0px;font-size:13px;'>" .
        __("Užsakymo laikotarpis:", "synergy") .
        "</div>
					<div style='font-weight: bold;font-size:13px;'>" .
        __("Apmokėti iki:", "synergy") .
        "</div>
				</div>
				<div class='' style='display: inline-block; width: 58%;'>
					<div style='font-size:13px;'>" .
        date("Y-m-d", $previous_month_start) .
        " / " .
        date("Y-m-d", $previous_month_end) .
        "</div>
					<div style='font-weight: bold;font-size:13px;'>" .
        $lastDayOfNextMonth .
        "</div>
				</div>

			</div>
			
				<div class='clearfix' style='margin-bottom:0px;'></div>

		</div>
	</div>
";
    $html .=
        "<table class='table data_table' style='margin:0px 50px 0px 0px;clear:both;'>
    <thead>
        <tr>
            <th>
            " .
        __("Produktas", "synergy") .
        "
            </th>
            <th>
            " .
        __("Kiekis", "synergy") .
        "
            </th>
            <th>
            " .
        __("Kaina be PVM", "synergy") .
        "
            </th>
            <th>
            " .
        __("Suma be PVM", "synergy") .
        "
            </th>
            <th>
            " .
        __("PVM tarifas", "synergy") .
        "
            </th>
            <th>
            " .
        __("PVM suma", "synergy") .
        "
            </th>
            <th>
            " .
        __("Suma EUR", "synergy") .
        "
            </th>

			
			
        </tr>
    </thead>
	<tbody>
	";
    foreach ($orders as $order) {
        $orderDateObj = $order->date_created;
        $orderDate = $orderDateObj->format("Y-m-d");
        if (strtotime($orderDate) <= $previous_month_end) {
            //             $html .= "<h3>".$order->ID." hh</h3>";
            $single_order_ids = processOrder($order->ID, $single_order_ids);
        }
    }
    $count_1 = 0;
    $count_2 = 0;
    $count_3 = 0;
    $total_vat_21 = 0;
    $total_vat_9 = 0;
    $totalSum = 0;
    $shippingMethodCount = 0;
    $totalShippingCost = 0;
    $total_amount_without_vat = 0;
    $total_amount_with_vat = 0; // Check if _wuoc_merged_orders is an array and not empty // $printsinglearray = print_r($single_order_ids); // 	$html .= "<h3>{$printsinglearray}</h3>"; // 	$html.="<h3>hiiii</h3>";
    foreach ($single_order_ids as $order_id) {
        //                 $html.="<h3>{$order_id}</h3>";
        $order_data = wc_get_order($order_id);
        if ($order_data) {
            $discount_type = get_post_meta($order_id, "_discount_type", true);
            $discount_fixed_am = get_post_meta(
                $order_id,
                "_discount_fixed_am",
                true
            );
            $order_total = $order_data->get_total();
            $applied_fee = 0; // foreach ($order->get_items("fee") as $item) { // $applied_fee = $item->get_total(); // } // if ($item->get_name() === "Nuolaidos") { // } // break;
            $firstRowDisplayed = false; // Initialize a boolean variable //             if ( $discount_type != "fixed" || ($order_total > 0 && $discount_type == "fixed") ) {  Condition change due to Invoice calculation Issue order with 100% discount and delivery pickup total will be zero so not included in invoice Date 25/7/24
            if ($discount_type == "fixed" && $order_total > 0) {
                foreach ($order_data->get_items() as $item) {
                    $product = $item->get_product();
                    $product_id = $product->get_id();
                    $item_subtotal = $item->get_subtotal();
                    $deal_price = get_field("deal_price", $product_id); // Calculate totals and VAT values
                    $subtotal = $item->get_subtotal();
                    $tax_amount = $item->get_subtotal_tax();
                    $item_total_without_vat = $subtotal - $tax_amount;
                    $total_amount_without_vat += $item_total_without_vat;
                    $orderTotal = $item->get_total();
                    $totalValue += $orderTotal;
                    $quantity = $item->get_quantity();
                    // Calculate total amount for this item including VAT and quantity
                    $item_total_with_vat =
                        ($subtotal + $tax_amount) * $quantity;
                    $total_amount_with_vat += $item_total_with_vat; // Get variation data if applicable
                    $variation_data = "";
                    if ($product->is_type("variation")) {
                        $variation_attributes = $product->get_variation_attributes();
                        foreach ($variation_attributes as $name => $value) {
                            if ($name == "attribute_karstas-garnyras") {
                                $att_name = __("Karštas garnyras", "synergy");
                            } elseif ($name == "attribute_saltas-garnyras") {
                                $att_name = __("Šaltas garnyras", "synergy");
                            } elseif ($name == "attribute_padazas") {
                                $att_name = __("Padažas", "synergy");
                            } elseif ($name == "attribute_papildomai") {
                                $att_name = __("Papildomai", "synergy");
                            } elseif ($name == "attribute_sviestas") {
                                $att_name = __("Sviestas", "synergy");
                            } elseif ($name == "attribute_uogiene") {
                                $att_name = __("Uogienė", "synergy");
                            }
                            $variation_data .= "<span style='font-size: 14px;margin:0px;'><strong>{$att_name}:</strong>
            {$value}</span><br>";
                        }
                    } // Calculate tax rate percentage
                    $tax_rate_percent = "";
                    $tax_rates = $item->get_taxes();
                    foreach ($tax_rates as $tax_rate_id => $tax) {
                        $tax_rate_data = WC_Tax::get_rates($tax_rate_id);
                        if ($tax_rate_data) {
                            $tax_rate_percent =
                                reset($tax_rate_data)["rate"] * 100; // Convert to percentage
                        }
                    }
                    $global = wc_get_product($item->get_product_id());
                    $item_price = $item->get_subtotal();
                    $global_price = $global->get_price();
                    $item_id = $item->get_id();
                    $package_value = wc_get_order_item_meta(
                        $item_id,
                        "_package",
                        true
                    );
                    if ($package_value) {
                        if ($package_value == "0.10") {
                            $count_3 = $count_3 + $item->get_quantity();
                        } elseif ($package_value == "0.15") {
                            $count_2 = $count_2 + $item->get_quantity();
                        } elseif ($package_value == "0.30") {
                            $count_1 = $count_1 + $item->get_quantity();
                        }
                    }
                    $total_value_of_order = $order->get_total();
                    // Assuming this gets the raw order total value
                    // Format the order total without the euro sign
                    $formatted_order_total = number_format(
                        $total_value_of_order,
                        2,
                        ".",
                        ""
                    ); // Formats as X.XX
                    $single_product_price =
                        $item_subtotal / $item->get_quantity();
                    if ($package_value) {
                        $single_product_price =
                            $single_product_price - $package_value;
                    }
                    $ninePercent =
                        $single_product_price - $single_product_price / 1.21;
                    $item_subtotal_without_vat =
                        $single_product_price - $ninePercent;
                    // Format the item subtotal with exactly two decimal places
                    $formatted_item_subtotal = number_format(
                        $item_subtotal_without_vat,
                        2,
                        ".",
                        ""
                    );
                    $ninePercent = $ninePercent * (int) $item->get_quantity();
                    $total_order_without_vat =
                        $item_subtotal_without_vat * $item->get_quantity();
                    $total_order_with_vat =
                        $total_order_without_vat + $ninePercent;
                    $totalSum += $total_order_with_vat;
                    $ninePercent = round($ninePercent, 2);
                    $total_order_with_vat = round($total_order_with_vat, 2);
                    $ammount_without_vat__nine =
                        $ammount_without_vat__nine + $ninePercent;
                    $total_order_nine =
                        $total_order_nine + $total_order_with_vat;
                    if (!$firstRowDisplayed) {
                        // Display the first row with product information
                        $html .=
                            "
        <tr style='margin-bottom:0px;padding:0px;'>
            <td style='padding-bottom:0px;'>{$product->get_name()}</td>
            <td style='padding-bottom:0px;'>{$item->get_quantity()}</td>
            <td style='padding-bottom:0px;'>{$formatted_item_subtotal} €</td>
            <td style='padding-bottom:0px;'>" .
                            round($total_order_without_vat, 2) .
                            " €</td>
            <td style='padding-bottom:0px;'>21 %</td>
            <td style='padding-bottom:0px;'>" .
                            $ninePercent .
                            "</td>
            <td style='padding-bottom:0px;'>" .
                            $total_order_with_vat .
                            " €</td>
        </tr>"; // $firstRowDisplayed = true; // Set the boolean variable to true after the first row is displayed
                    } else {
                        // For subsequent iterations, leave the entire row empty
                        $html .= "
        <tr style='margin-bottom:0px;padding:0px;'>
            <td style='padding-bottom:0px;'></td>
            <td style='padding-bottom:0px;'></td>
            <td style='padding-bottom:0px;'></td>
            <td style='padding-bottom:0px;'></td>
            <td style='padding-bottom:0px;'></td>
            <td style='padding-bottom:0px;'></td>
            <td style='padding-bottom:0px;'></td>
        </tr>";
                    }
                    $deal_data = $item->get_meta("deal_data", true);
                    if (!empty($variation_data)) {
                        $html .= "
        <tr class='' style='margin-top:0px;'>
            <td colspan='7'>{$variation_data}</td>
        </tr>
        <tr class='' style='margin-top:0px;'>
            <td colspan='7' style='padding:0px;'>{$deal_price}</td>
        </tr>";
                    }
                    if ($deal_data) {
                        foreach ($deal_data as $data):
                            $html .= "
        <tr class='' style='margin-top:0px;'>
            <td colspan='7' style='padding:0 15px; margin: 0;'>{$data["addon_p_name"]}</td>
        </tr>";
                        endforeach;
                    }
                    $html .= "
        <tr class='border-bottom' style='margin-top:0px;'>
            <td colspan='7' style='padding:0px;'></td>
        </tr>";
                    // Increment after using
                    $x++;
                }
                // Retrieve order shipping charges
                $order = wc_get_order($order_id); // Assuming $order_id is the order ID
                $shipping_total = $order->get_shipping_total();
                $shipping_methods = $order->get_shipping_methods();
                $billing_pvm = $order->get_meta("_billing_pvm", true);
                foreach ($order->get_items() as $item_id => $item) {
                    $product = $item->get_product();
                    $with_tax = wc_get_price_including_tax($product);
                    $without_tax = wc_get_price_excluding_tax($product);
                    $tax_amount = $with_tax - $without_tax;
                }
                $date = $order->get_meta("_jckwds_date");
                $time_slot = $order->get_meta("_jckwds_timeslot");
                $timestamp = $order->get_meta("_jckwds_timestamp");
                $cleanedTime = str_replace(["AM", "PM"], "", $time_slot);
                foreach (
                    $shipping_methods
                    as $shipping_item_id => $shipping_item
                ) {
                    $shipping_method = $shipping_item->get_method_id();
                    $shipping_cost = $shipping_item->get_total();
                    if ($shipping_cost) {
                        $shippingMethodCount++;
                        $totalShippingCost += $shipping_cost;
                    }
                }
            }
        }
    }
    $totalDealPackageWithVat = 0;
    if ($count_3 > 0) {
        $Depozitas_total = 0.1 * $count_3;
        $total_order_nine = $total_order_nine + $Depozitas_total;
        $html .=
            "
        <tr class='border-bottom'>
            <td style=''>" .
            __("Depozitas", "synergy") .
            "</td>
            <td style=''>" .
            $count_3 .
            "</td>
            <td style=''>0.10 €</td>
            <td style=''>" .
            $Depozitas_total .
            " €</td>
            <td style=''>0%</td>
            <td style=''>0 €</td>
            <td style=''>" .
            $Depozitas_total .
            " €</td>
        </tr>";
    }
    if ($count_2 > 0) {
        $Pakuote_total = 0.15 * $count_2;
        $Pakuote_amountToSubtract = $Pakuote_total - $Pakuote_total / 1.21;
        $Pakuote_total_without_vat = $Pakuote_total - $Pakuote_amountToSubtract;
        $ammount_without_vat_21 =
            $ammount_without_vat_21 + $Pakuote_amountToSubtract;
        $total_order_nine = $total_order_nine + $Pakuote_total_without_vat;
        $html .=
            "
        <tr class='border-bottom'>
            <td style=''>" .
            __("Pakuotė", "synergy") .
            "</td>
            <td style=''>" .
            $count_2 .
            "</td>
            <td style=''>" .
            number_format(0.15 / 1.21, 2) .
            " €</td>
            <td style=''>" .
            number_format($Pakuote_total_without_vat, 2) .
            " €</td>
            <td style=''>21%</td>
            <td style=''>" .
            number_format($Pakuote_amountToSubtract, 2) .
            " €</td>
            <td style=''>" .
            number_format($Pakuote_total, 2) .
            " €</td>
        </tr>";
    }
    if ($count_1 > 0) {
        $Pakuotedienospasiulymo_total = 0.3 * $count_1;
        $Pakuotedienospasiulymo_amountToSubtract =
            $Pakuotedienospasiulymo_total -
            $Pakuotedienospasiulymo_total / 1.21;
        $Pakuotedienospasiulymo_total_without_vat =
            $Pakuotedienospasiulymo_total - $Pakuote_amountToSubtract;
        $ammount_without_vat_21 =
            $ammount_without_vat_21 + $Pakuotedienospasiulymo_amountToSubtract;
        $total_order_nine =
            $total_order_nine + $Pakuotedienospasiulymo_total_without_vat;
        $html .=
            "
        <tr class='border-bottom'>
            <td style=''>" .
            __("Pakuotė (dienos pasiūlymo)", "synergy") .
            "</td>
            <td style=''>" .
            $count_1 .
            "</td>
            <td style=''>" .
            number_format(0.3 / 1.21, 2) .
            " €</td>
            <td style=''>" .
            number_format($Pakuotedienospasiulymo_total_without_vat, 2) .
            " €</td>
            <td style=''>21%</td>
            <td style=''>" .
            number_format($Pakuotedienospasiulymo_amountToSubtract, 2) .
            " €</td>
            <td style=''>" .
            number_format($Pakuotedienospasiulymo_total, 2) .
            " €</td>
        </tr>";
    }
    $totalDealPackageWithVat =
        $Pakuotedienospasiulymo_total + $Pakuote_total + $Depozitas_total;
    $total_shipping_ = $shippingMethodCount;
    $total_shipping_cost = $totalShippingCost;
    if ($total_shipping_) {
        $one_shipping_cost_ = $totalShippingCost / $shippingMethodCount;
    } else {
        $one_shipping_cost_ = $totalShippingCost;
    }
    $vat_of_one_shipping_ = $one_shipping_cost_ - $one_shipping_cost_ / 1.21;
    $one_shipping_without_vat_ = $one_shipping_cost_ - $vat_of_one_shipping_;
    $total_shipping_without_vat = $one_shipping_without_vat_ * $total_shipping_;
    $vat_of_all_shipping_ = $vat_of_one_shipping_ * $total_shipping_;
    $total_shipping_with_vat =
        $total_shipping_without_vat + $vat_of_all_shipping_;
    $ammount_without_vat_21 = $ammount_without_vat_21 + $vat_of_all_shipping_;
    $total_order_nine = $total_order_nine + $total_shipping_without_vat;
    $html .=
        "
        <tr class='border-bottom'>
            <td style=''>" .
        __("Pristatymas", "synergy") .
        "</td>
            <td style=''>{$shippingMethodCount}</td>
            <td style=''>" .
        number_format($one_shipping_without_vat_, 2) .
        " €</td>
            <td style=''>" .
        number_format($total_shipping_without_vat, 2) .
        " €</td>
            <td style=''>21%</td>
            <td style=''>" .
        number_format($vat_of_all_shipping_, 2) .
        " €</td>
            <td style=''>" .
        number_format($total_shipping_with_vat, 2) .
        " €</td>
        </tr>";
    $html .= "
    </tbody>
</table>";
    $html .= "
<table style='margin:0px auto;margin-top:40px!important;'>
    <tbody>";
    $html .=
        "
        <tr class=''>
            <td style='font-size:18px;padding:0px 30px !important;float:left;font-weight:bold;'> " .
        __("Suma be PVM Eur", "synergy") .
        "</td>
            <td style='font-size:18px;padding:0px 30px !important;float:right;font-weight:bold;'>" .
        number_format($total_order_nine - $ammount_without_vat__nine, 2) .
        "</td>
        </tr>"; // $html .= //     " //     <tr class=''> //         <td style='font-size:18px;padding:0px 30px !important;float:left;font-weight:bold;'> " . //     __("PVM 21%", "synergy") . //     "</td> //         <td style='font-size:18px;padding:0px 30px !important;float:right;font-weight:bold;'>" . //     number_format($ammount_without_vat__nine, 2) . //     "</td> //     </tr>";
    $html .=
        "
        <tr class=''>
            <td style='font-size:18px;padding:0px 30px !important;float:left;font-weight:bold;'> " .
        __("PVM 21%", "synergy") .
        "</td>
            <td style='font-size:18px;padding:0px 30px !important;float:right;font-weight:bold;'>" .
        number_format($ammount_without_vat__nine + $ammount_without_vat_21, 2) .
        "</td>
        </tr>";
    $html .= "
    </tbody>
</table>";
    $total_order = $totalValue + $total_shipping_with_vat;
    $formatted_total_ = number_format($total_order, 2, ".", "");
    $html .=
        "
<div style='margin-top:30px;margin-bottom:20px;clear:both;display:block;'>
    <div><span style='font-size:22px;padding:0px 30px !important;float:left;font-weight:bold;w'>" .
        __("MOKĖTINA SUMA", "synergy") .
        "</span>
    </div>
    <div><span style='font-size:22px;padding:0px 30px !important;float:right;font-weight:bold;'>" .
        $total_order .
        " €</span></div>
</div>



<div style='margin-top:50px;margin-bottom:20px;clear:both;display:block;'>
    <div><span style='font-size:18px;padding:0px 30px !important;float:left;font-weight:bold;'>" .
        __("Suma žodžiais:", "synergy") .
        "</span>
    </div>
    <div><span style='font-size:18px;padding:0px 30px !important;float:right;font-weight:bold;'>";
    ?>
<?php if ($currentLanguage == "lt") {
    $html .= skaicius_zodziais($formatted_total_);
} elseif ($currentLanguage == "en") {
    $html .= AmountInWords($formatted_total_);
} else {
    $html .= AmountInWordsRussian($formatted_total_);
} ?>
<?php
$html .=
    "</span></div>
</div>

<div style='margin-top:30px;margin-bottom:20px;clear:both;display:block;'>
    <div><span style='font-size:18px;padding:0px 30px !important;float:left;font-weight:bold;'>" .
    __("Sąskaitą išrašė:", "synergy") .
    "</span>
    </div>
    <div><span style='font-size:18px;padding:0px 30px !important;float:right;font-weight:bold;'>" .
    __("UAB Jogundė", "synergy") .
    "</span></div>
</div>";
$invoice_pdf_name = __("Juridiniai_asmenys_fiksuota_PVM_saskaita", "synergy");
$filename = $invoice_pdf_name . $invoice_number . ".pdf";
$options = new Options();
$options->set("isRemoteEnabled", true);
$options->setTempDir("temp");
$options->set("defaultFont", "DejaVuSans");
$dompdf = new Dompdf($options);
$html = mb_convert_encoding($html, "HTML-ENTITIES", "UTF-8");
$dompdf->loadHtml($html);
$dompdf->setPaper("Legal", "portrait");
$dompdf->set_option("isRemoteEnabled", true);
$dompdf->render();
$output = $dompdf->output();
file_put_contents(ABSPATH . "/wp-content/uploads/pdf/" . $filename, $output);
return $filename;
} /////Company Fixed Amount
function generate_invoice($invoice_num)
{
    $currentLanguage = defined("ICL_LANGUAGE_CODE")
        ? ICL_LANGUAGE_CODE
        : "default";
    $single_order_ids = [];
    $current_month = date("m");
    $current_year = date("Y");
    $user_ID = get_current_user_id();
    $company_name = get_field("company_name", "user_" . $user_ID);
    $company_code = get_field("company_code", "user_" . $user_ID);
    $vat_code = get_field("vat_code", "user_" . $user_ID);
    $previous_month_start = strtotime("first day of last month");
    $previous_month_end = strtotime("last day of last month");
    $args = [
        "limit" => -1,
        "date" => [
            "after" => date("Y-m-d H:i:s", $previous_month_start),
            "before" => date(
                "Y-m-d H:i:s",
                strtotime("+1 day", $previous_month_end)
            ), // Adding one day to include orders on the last day
        ],
        "meta_key" => "_company_name",
        // Postmeta key field
        "meta_value" => $company_name,
        // Postmeta value field
        "meta_compare" => "=",
        "post_status" => "wc-processing",
    ];
    $orders = wc_get_orders($args);
    $currentYear = date("Y");
    $currentMonth = date("m"); // Get the first and last date of the current month
    $firstDate = date("Y-m-01", strtotime("$currentYear-$currentMonth-01"));
    $lastDate = date("Y-m-t", strtotime("$currentYear-$currentMonth-01"));
    $nextMonth = $currentMonth + 1; // Check if the next month is January of the next year
    if ($nextMonth > 12) {
        $nextMonth = 1;
        $currentYear++;
    }
    // Create a date string for the first day of the next month
    $firstDayOfNextMonth = "$currentYear-$nextMonth-01"; // Calculate the last day of the next month
    $lastDayOfNextMonth = date("Y-m-d", strtotime("last day of this month"));
    $randomNumber = generateRandomNumber();
    $invoice_pdf_name = __("EAT-", "synergy");
    $invoice_number = $invoice_num;
    $billing_first_name = get_user_meta($user_ID, "billing_first_name", true);
    $billing_last_name = get_user_meta($user_ID, "billing_last_name", true);
    $billing_address_1 = get_user_meta($user_ID, "billing_address_1", true);
    $billing_postcode = get_user_meta($user_ID, "billing_postcode", true);
    $billing_city = get_user_meta($user_ID, "billing_city", true);
    $html = "
<style>
html { margin: 0}
@page { margin: 0; }
table{
    border-collapse: collapse;
    border: none;
    width: 100%;
}
body {
	background-size: contain;
	font-family:  DejaVu Sans;
	margin: 0;
    font-size: 13px;
    line-height: 18px;
    color: #1D1D1B;
}
.header-left{
     width: 20%; 
     padding: 0px 35px 0px 35px;
}
.header-right{
    width: 80%; 
    font-style: normal;
    font-weight: 400;
    font-size: 11px;
    line-height: 9px;
    color: #32EDB4;
    padding: 0px 35px 0px 35px;
	float:right;
}
.title{
    font-style: normal;
    font-weight: 700;
    font-size: 19px;
    line-height: 25px;
    color: #1D1D1B;
    text-align: center;
    margin-top: 20px;
    margin-bottom: 20px;
}
.table th{
    background-color: #000;
    height: 40px;
    font-style: normal;
    font-weight: 400;
    text-align: left;
	color:#fff;
	font-size:16px;
	padding: 10px;
}
.table td{
	padding: 10px;
}

.table td:nth-child(1),
thead th:nth-child(1){
    padding-left: 15px;
}
.table td:last-child,
thead th:last-child{
    padding-left: 15px;
}
.footer{
    position: absolute;
    right: 44px;
    bottom: 20px;
}
.text{
    font-weight: 700;
    font-size: 9px;
    line-height: 13px;
    color: #9D9D9C;
    padding-right: 10px;
}
.table-summary{
    width: 50%;
    margin-left: auto;
    text-align: right;
    margin-top: 10px;
    margin-right: 60px;
    font-weight: 400;
}
.content{
    margin-top: 00px;
    padding-left: 54px;
}
.content-title{
    margin-top: 10px;
}
.main_invoice_data h3{
	font-size:30px;
	font-weight:bold;
	margin-bottom:5px;
}
.main_invoice_data div div div{
	font-size:16px;
	font-weight:400;
	margin-bottom:0px;
}
.order_data{
	display:flex;
	justify-content: space-between;
}
.flex{
	display:flex;
}
.space-between{
	justify-content: space-between;
}
.gap-3{
	gap:20px;
}
.order_details_total div{
	text-align:right;
	margin-bottom:10px;
}
.order_details_total div span{
 font-size:16px;
 margin-right:10px;
}
.data_table{
	font-size:16px;
}
.shipping tr td{
	text-align:center;
}
.left{
	float:left;
}
.right{
	float:right;
}
.table-summary td{
font-size:20px;
font-weight:bold;
margin-bottom:5px;
}
.w-1\/2 {
    width: 50%;
}
.border-bottom {
    border-bottom: 1px solid #000; /* Change this to your desired border style */
	margin:0px 0px;
}
.bottom_data{
	width:40%;
	float:right;
	border-top:1px solid #000;
	margin-top:10px;
}
.bottom_data div{
 	border-bottom: 1px solid #000;
}
.bottom_data div span{
	display:inline-block;
	width:48%;
}
.header-right span {
    font-size: 16px;
    color: #000;
    display: block;
    margin-bottom: 3px;
    text-align: left;
    line-height: normal;
}
.clearfix::after {
  content: '';
  display: table;
  clear: both;
}
.border-bottom {
padding:0px;
}
.border-bottom td{
padding-top:0px;
}
.border-bottom td ul{
	margin-top:0px;
}
.border-bottom td ul li{
	margin-top:0px;
}
</style>
<link href='https://api.fontshare.com/v2/css?f[]=satoshi@900,700,500,400&amp;display=swap' rel='stylesheet'>";
    echo $orders;
    $html .=
        "<table style='margin:0px;'>
    <tr>
        <td class='header-left'>
            <img width='100'  src='https://seatisfy.lt/wp-content/uploads/2023/01/Vector-1.png'> 
        </td>
		<td class='header-right' style='padding-top:00px;'>
			<h3 style='font-size:20px;clear:both;width:100%;padding:0px 0px 0px 0px;line-height:30px;margin-bottom:10px;color:#000;clear:both;display:block;'>Pardavėjas:</h3>

				<div class='' style='margin-right:0px;display:inline-block;width:45%; text-align:left;margin-top:10px; font-size:16px;'>
					<span style='margin:0px;line-height:16px;' class=''>" .
        __("Įmonės pavadinimas:", "synergy") .
        "</span>
					<span style='margin:0px;line-height:16px;' class=''>" .
        __("Adresas:", "synergy") .
        "</span>
					<span style='margin:0px;line-height:16px;' class=''>" .
        __("Įmonės kodas:", "synergy") .
        "</span>
					<span style='margin:0px;line-height:16px;' class=''>" .
        __("PVM mokėtojo kodas:", "synergy") .
        "</span>
					<span style='margin:0px;line-height:16px;font-weight:bold;' class=''>" .
        __("PVM sąskaitos numeris:", "synergy") .
        "</span>

				</div>
				<div class='' style='display:inline-block;width:35%;text-align:left;' >
					<span style='margin:0px;line-height:16px;' class=''>" .
        __("UAB Jogundė", "synergy") .
        "</span>
					<span style='margin:0px;line-height:16px;' class=''>" .
        __("Liepų g. 19, Klaipėda", "synergy") .
        "</span>
					<span style='margin:0px;line-height:16px;' class=''>140809765</span>
					<span style='margin:0px;line-height:16px;' class=''>LT408097610</span>
					<span style='margin:0px;line-height:16px;font-weight:bold;' class=''>" .
        $invoice_number .
        "</span>

					
				</div>
				
				

		</td>
    </tr>
</table>

	<h3 style='font-size:20px;clear:both;width:100%;padding:0px 20px 0px 20px;margin:0px!important;'>PVM SĄSKAITA FAKTŪRA</h3>
	<span  style='font-size:18px;clear:both;width:100%;padding:0px 20px 0px 20px;display:block;margin-bottom:20px;line-height:30px;font-weight:bold;'>Pirkėjas:</span>
	<div class='main_invoice_data' style='padding:0px 20px 0px 20px;clear:both;margin-bottom:0px;'>
		
		<div class='order_dataa'  style='margin-bottom:0px;'>
			<div class='left' style='clear:both;width:60%;'>
				<div class='' style='margin-right:0px;display:inline-block;width:40%;'>
					<div class=''>" .
        __("Įmonės pavadinimas:", "synergy") .
        "</div>
					<div class=''>" .
        __("Adresas:", "synergy") .
        "</div>
					<div class=''>" .
        __("Įmonės kodas:", "synergy") .
        "</div>
					<div class=''>" .
        __("PVM mokėtojo kodas:", "synergy") .
        "</div>
				</div>
				<div class='' style='display:inline-block;width:58%;' >
					<div class=''>" .
        $company_name .
        "</div>
					<div class=''>" .
        $billing_address_1 .
        ", " .
        $billing_postcode .
        " " .
        $billing_city .
        "</div>
					<div class=''>" .
        $company_code .
        "</div>
					<div class=''>" .
        $vat_code .
        "</div>
				</div>
			</div>

			<div class='right' style='width:42%;margin-bottom:0px;'>
				<div style='margin-right: 0px; display: inline-block; width: 40%;margin-top:0px;'>
					<div style='margin-top:0px;font-size:13px;'>" .
        __("Užsakymo laikotarpis:", "synergy") .
        "</div>
					<div style='font-weight: bold;font-size:13px;'>" .
        __("Apmokėti iki:", "synergy") .
        "</div>
				</div>
				<div class='' style='display: inline-block; width: 58%;'>
					<div style='font-size:13px;'>" .
        date("Y-m-d", $previous_month_start) .
        " / " .
        date("Y-m-d", $previous_month_end) .
        "</div>
					<div style='font-weight: bold;font-size:13px;'>" .
        $lastDayOfNextMonth .
        "</div>
				</div>

			</div>
			
				<div class='clearfix' style='margin-bottom:0px;'></div>

		</div>
	</div>
";
    $html .=
        "<table class='table data_table' style='margin:0px 50px 0px 0px;clear:both;'>
    <thead>
        <tr>
            <th>
                " .
        __("Produktas", "synergy") .
        "
            </th>
            <th>
            " .
        __("Kiekis", "synergy") .
        "
            </th>
            <th>
            " .
        __("Kaina be PVM", "synergy") .
        "
            </th>
            <th>
            " .
        __("Suma be PVM", "synergy") .
        "
            </th>
            <th>
            " .
        __("PVM tarifas", "synergy") .
        "
            </th>
            <th>
            " .
        __("PVM suma", "synergy") .
        "
            </th>
            <th>
            " .
        __("Suma EUR", "synergy") .
        "
            </th>
        </tr>
    </thead>
	<tbody>
	";
// 	$html.= "<h2>order count ". count($orders). "</h2>";
    foreach ($orders as $order) {
        $orderDateObj = $order->date_created;
        $orderDate = $orderDateObj->format("Y-m-d");

        if (strtotime($orderDate) <= strtotime("+1 day", $previous_month_end)) {
//                         $html .= "<h3>".$order->ID." Date" .$orderDate ."</h3>";
            $single_order_ids = processOrder($order->ID, $single_order_ids);
        }
    }
		
    $count_1 = 0;
    $count_2 = 0;
    $count_3 = 0;
    $total_vat_21 = 0;
    $total_vat_9 = 0;
    $totalSum = 0;
    $shippingMethodCount = 0;
    $totalShippingCost = 0;
    $total_amount_without_vat = 0;
    $total_amount_with_vat = 0;
    // Check if _wuoc_merged_orders is an array and not empty
    foreach ($single_order_ids as $order_id) {
//         $html.="<h3>{$order_id}</h3>";
        // $html.="<h3>hiiii</h3>";
        $order_data = wc_get_order($order_id);
        $discount_type = get_post_meta($order_id, "_discount_type", true);
        $discount_fixed_am = get_post_meta(
            $order_id,
            "_discount_fixed_am",
            true
        );
        $order_total = is_bool($order_data) ? null : $order_data->get_total();
        $applied_fee = 0; // foreach ($order->get_items("fee") as $item) { // if ($item->get_name() === "Nuolaidos") { // break; // } // } // $applied_fee = $item->get_total();
        $firstRowDisplayed = false; // Initialize a boolean variable
        //         if ( $discount_type != "fixed" || ($order_total > 0 && $discount_type == "fixed") ) { Condition change due to Invoice calculation Issue order with 100% discount and delivery pickup total will be zero so not included in invoice Date 25/7/24
        if ($discount_type != "fixed") {
            foreach (
                is_bool($order_data) ? null : $order_data->get_items()
                as $item
            ) {
                $product = $item->get_product();
// 				error_log( " Date start " .date("Y-m-d H:i:s", $previous_month_start). " Date End ". date("Y-m-d H:i:s", strtotime("+1 day", $previous_month_end)));

// 				if(!is_object($product)){
// error_log("This is the mistake object". var_dump($product). " item ".$item . " Order ". $order_id . " Date start " .$previous_month_start. " Date End ". $previous_month_end);
// }
                $product_id = $product->get_id();
                $item_subtotal = $item->get_subtotal();
                $deal_price = get_field("deal_price", $product_id); // Calculate totals and VAT values
                $subtotal = $item->get_subtotal();
                $tax_amount = $item->get_subtotal_tax();
                $item_total_without_vat = $subtotal - $tax_amount;
                $total_amount_without_vat += $item_total_without_vat;
                $orderTotal = $item->get_total();
                $totalValue += $orderTotal;
                $quantity = $item->get_quantity(); // Calculate total amount for this item including VAT and quantity
                $item_total_with_vat = ($subtotal + $tax_amount) * $quantity;
                $total_amount_with_vat += $item_total_with_vat; // Get variation data if applicable
                $variation_data = "";
                if ($product->is_type("variation")) {
                    $variation_attributes = $product->get_variation_attributes();
                    foreach ($variation_attributes as $name => $value) {
                        if ($name == "attribute_karstas-garnyras") {
                            $att_name = __("Karštas garnyras", "synergy");
                        } elseif ($name == "attribute_saltas-garnyras") {
                            $att_name = __("Šaltas garnyras", "synergy");
                        } elseif ($name == "attribute_padazas") {
                            $att_name = __("Padažas", "synergy");
                        } elseif ($name == "attribute_papildomai") {
                            $att_name = __("Papildomai", "synergy");
                        } elseif ($name == "attribute_sviestas") {
                            $att_name = __("Sviestas", "synergy");
                        } elseif ($name == "attribute_uogiene") {
                            $att_name = __("Uogienė", "synergy");
                        }
                        $variation_data .= "<span style='font-size: 14px;margin:0px;'><strong>{$att_name}:</strong>
               {$value}</span><br>";
                    }
                } // Calculate tax rate percentage
                $tax_rate_percent = "";
                $tax_rates = $item->get_taxes();
                foreach ($tax_rates as $tax_rate_id => $tax) {
                    $tax_rate_data = WC_Tax::get_rates($tax_rate_id);
                    if ($tax_rate_data) {
                        $tax_rate_percent = reset($tax_rate_data)["rate"] * 100;
                        // Convert to percentage
                    }
                }
                $global = wc_get_product($item->get_product_id());
                $item_price = $item->get_subtotal();
                $global_price = $global->get_price();
                $item_id = $item->get_id();
                $package_value = wc_get_order_item_meta(
                    $item_id,
                    "_package",
                    true
                );
                if ($package_value) {
                    if ($package_value == "0.10") {
                        $count_3 = $count_3 + $item->get_quantity();
                    } elseif ($package_value == "0.15") {
                        $count_2 = $count_2 + $item->get_quantity();
                    } elseif ($package_value == "0.30") {
                        $count_1 = $count_1 + $item->get_quantity();
                    }
                }
                if (is_object($order)) {
                    $total_value_of_order = $order->get_total();
                }
                // Assuming this gets the raw order total value
                // Format the order total without the euro sign
                $formatted_order_total = number_format(
                    $total_value_of_order,
                    2,
                    ".",
                    ""
                ); // Formats as X.XX
                $single_product_price = $item_subtotal / $item->get_quantity();
                if ($package_value) {
                    $single_product_price =
                        $single_product_price - $package_value;
                }
                $ninePercent =
                    $single_product_price - $single_product_price / 1.21;
                $item_subtotal_without_vat =
                    $single_product_price - $ninePercent;
                // Format the item subtotal with exactly two decimal places
                $formatted_item_subtotal = number_format(
                    $item_subtotal_without_vat,
                    2,
                    ".",
                    ""
                );
                $ninePercent = $ninePercent * (int) $item->get_quantity();
                $total_order_without_vat =
                    $item_subtotal_without_vat * $item->get_quantity();
                $total_order_with_vat = $total_order_without_vat + $ninePercent;
                $totalSum += $total_order_with_vat;
                $ninePercent = round($ninePercent, 2);
                $total_order_with_vat = round($total_order_with_vat, 2);
                $ammount_without_vat__nine =
                    $ammount_without_vat__nine + $ninePercent;
                $total_order_nine = $total_order_nine + $total_order_with_vat;
                if (!$firstRowDisplayed) {
                    // Display the first row with product information
                    $html .=
                        "
           <tr style='margin-bottom:0px;padding:0px;'>
               <td style='padding-bottom:0px;'>{$product->get_name()}</td>
               <td style='padding-bottom:0px;'>{$item->get_quantity()}</td>
               <td style='padding-bottom:0px;'>{$formatted_item_subtotal} €</td>
               <td style='padding-bottom:0px;'>" .
                        round($total_order_without_vat, 2) .
                        " €</td>
               <td style='padding-bottom:0px;'>21 %</td>
               <td style='padding-bottom:0px;'>" .
                        $ninePercent .
                        "</td>
               <td style='padding-bottom:0px;'>" .
                        $total_order_with_vat .
                        " €</td>
           </tr>"; // $firstRowDisplayed = true; // Set the boolean variable to true after the first row is displayed
                } else {
                    // For subsequent iterations, leave the entire row empty
                    $html .= "
           <tr style='margin-bottom:0px;padding:0px;'>
               <td style='padding-bottom:0px;'></td>
               <td style='padding-bottom:0px;'></td>
               <td style='padding-bottom:0px;'></td>
               <td style='padding-bottom:0px;'></td>
               <td style='padding-bottom:0px;'></td>
               <td style='padding-bottom:0px;'></td>
               <td style='padding-bottom:0px;'></td>
           </tr>";
                }
                $deal_data = $item->get_meta("deal_data", true);
                if (!empty($variation_data)) {
                    $html .= "
           <tr class='' style='margin-top:0px;'>
               <td colspan='7'>{$variation_data}</td>
           </tr>
           <tr class='' style='margin-top:0px;'>
               <td colspan='7' style='padding:0px;'>{$deal_price}</td>
           </tr>";
                }
                if ($deal_data) {
                    foreach ($deal_data as $data):
                        $html .= "
           <tr class='' style='margin-top:0px;'>
               <td colspan='7' style='padding:0 15px; margin: 0;'>{$data["addon_p_name"]}</td>
           </tr>";
                    endforeach;
                }
                $html .= "
           <tr class='border-bottom' style='margin-top:0px;'>
               <td colspan='7' style='padding:0px;'></td>
           </tr>"; // Increment after using
                $x++;
            } // Retrieve order shipping charges
            $order = wc_get_order($order_id); // Assuming $order_id is the order ID
            $shipping_total = is_bool($order)
                ? null
                : $order->get_shipping_total();
            $shipping_methods = is_bool($order)
                ? null
                : $order->get_shipping_methods();
            $billing_pvm = is_bool($order)
                ? null
                : $order->get_meta("_billing_pvm", true);
            foreach (
                is_bool($order) ? null : $order->get_items()
                as $item_id => $item
            ) {
                $product = $item->get_product();
                $with_tax = wc_get_price_including_tax($product);
                $without_tax = wc_get_price_excluding_tax($product);
                $tax_amount = $with_tax - $without_tax;
            }
            $date = is_bool($order) ? null : $order->get_meta("_jckwds_date");
            $time_slot = is_bool($order)
                ? null
                : $order->get_meta("_jckwds_timeslot");
            $timestamp = is_bool($order)
                ? null
                : $order->get_meta("_jckwds_timestamp");
            $cleanedTime = str_replace(["AM", "PM"], "", $time_slot);
            foreach ($shipping_methods as $shipping_item_id => $shipping_item) {
                $shipping_method = $shipping_item->get_method_id();
                $shipping_cost = $shipping_item->get_total();
                if ($shipping_cost) {
                    $shippingMethodCount++;
                    $totalShippingCost += $shipping_cost;
                }
            }
        }
    }
    $totalDealPackageWithVat = 0;
    if ($count_3 > 0) {
        $Depozitas_total = 0.1 * $count_3;
        $total_order_nine = $total_order_nine + $Depozitas_total;
        $html .=
            "
           <tr class='border-bottom'>
               <td style=''>" .
            __("Depozitas", "synergy") .
            "</td>
               <td style=''>" .
            $count_3 .
            "</td>
               <td style=''>0.10 €</td>
               <td style=''>" .
            $Depozitas_total .
            " €</td>
               <td style=''>0%</td>
               <td style=''>0 €</td>
               <td style=''>" .
            $Depozitas_total .
            " €</td>
           </tr>";
    }
    if ($count_2 > 0) {
        $Pakuote_total = 0.15 * $count_2;
        $Pakuote_amountToSubtract = $Pakuote_total - $Pakuote_total / 1.21;
        $Pakuote_total_without_vat = $Pakuote_total - $Pakuote_amountToSubtract;
        $ammount_without_vat_21 =
            $ammount_without_vat_21 + $Pakuote_amountToSubtract;
        $total_order_nine = $total_order_nine + $Pakuote_total_without_vat;
        $html .=
            "
           <tr class='border-bottom'>
               <td style=''>" .
            __("Pakuotė", "synergy") .
            "</td>
               <td style=''>" .
            $count_2 .
            "</td>
               <td style=''>" .
            number_format(0.15 / 1.21, 2) .
            " €</td>
               <td style=''>" .
            number_format($Pakuote_total_without_vat, 2) .
            " €</td>
               <td style=''>21%</td>
               <td style=''>" .
            number_format($Pakuote_amountToSubtract, 2) .
            " €</td>
               <td style=''>" .
            number_format($Pakuote_total, 2) .
            " €</td>
           </tr>";
    }
    if ($count_1 > 0) {
        $Pakuotedienospasiulymo_total = 0.3 * $count_1;
        $Pakuotedienospasiulymo_amountToSubtract =
            $Pakuotedienospasiulymo_total -
            $Pakuotedienospasiulymo_total / 1.21;
        $Pakuotedienospasiulymo_total_without_vat =
            $Pakuotedienospasiulymo_total - $Pakuote_amountToSubtract;
        $ammount_without_vat_21 =
            $ammount_without_vat_21 + $Pakuotedienospasiulymo_amountToSubtract;
        $total_order_nine =
            $total_order_nine + $Pakuotedienospasiulymo_total_without_vat;
        $html .=
            "
           <tr class='border-bottom'>
               <td style=''>" .
            __("Pakuotė (dienos pasiūlymo)", "synergy") .
            "</td>
               <td style=''>" .
            $count_1 .
            "</td>
               <td style=''>" .
            number_format(0.3 / 1.21, 2) .
            " €</td>
               <td style=''>" .
            number_format($Pakuotedienospasiulymo_total_without_vat, 2) .
            " €</td>
               <td style=''>21%</td>
               <td style=''>" .
            number_format($Pakuotedienospasiulymo_amountToSubtract, 2) .
            " €</td>
               <td style=''>" .
            number_format($Pakuotedienospasiulymo_total, 2) .
            " €</td>
           </tr>";
    }
    $totalDealPackageWithVat =
        $Pakuotedienospasiulymo_total + $Pakuote_total + $Depozitas_total;
    $total_shipping_ = $shippingMethodCount;
    $total_shipping_cost = $totalShippingCost;
    if ($total_shipping_) {
        $one_shipping_cost_ = $totalShippingCost / $shippingMethodCount;
    } else {
        $one_shipping_cost_ = $totalShippingCost;
    }
    $vat_of_one_shipping_ = $one_shipping_cost_ - $one_shipping_cost_ / 1.21;
    $one_shipping_without_vat_ = $one_shipping_cost_ - $vat_of_one_shipping_;
    $total_shipping_without_vat = $one_shipping_without_vat_ * $total_shipping_;
    $vat_of_all_shipping_ = $vat_of_one_shipping_ * $total_shipping_;
    $total_shipping_with_vat =
        $total_shipping_without_vat + $vat_of_all_shipping_;
    $ammount_without_vat_21 = $ammount_without_vat_21 + $vat_of_all_shipping_;
    $total_order_nine = $total_order_nine + $total_shipping_without_vat;
    $html .=
        "
           <tr class='border-bottom'>
               <td style=''>" .
        __("Pristatymas", "synergy") .
        "</td>
               <td style=''>{$shippingMethodCount}</td>
               <td style=''>" .
        number_format($one_shipping_without_vat_, 2) .
        " €</td>
               <td style=''>" .
        number_format($total_shipping_without_vat, 2) .
        " €</td>
               <td style=''>21%</td>
               <td style=''>" .
        number_format($vat_of_all_shipping_, 2) .
        " €</td>
               <td style=''>" .
        number_format($total_shipping_with_vat, 2) .
        " €</td>
           </tr>";
    $html .= "
       </tbody>
   </table>";
    $html .= "
   <table style='margin:0px auto;margin-top:40px!important;'>
       <tbody>";
    $html .=
        "
           <tr class=''>
               <td style='font-size:18px;padding:0px 30px !important;float:left;font-weight:bold;'>" .
        __("Suma be PVM Eur", "synergy") .
        "</td>
               <td style='font-size:18px;padding:0px 30px !important;float:right;font-weight:bold;'>" .
        number_format($total_order_nine - $ammount_without_vat__nine, 2) .
        "</td>
           </tr>"; // $html .= //     " //        <tr class=''> //            <td style='font-size:18px;padding:0px 30px !important;float:left;font-weight:bold;'>" . //     __("PVM 21%", "synergy") . //     "</td> //            <td style='font-size:18px;padding:0px 30px !important;float:right;font-weight:bold;'>" . //     number_format($ammount_without_vat__nine, 2) . //        </tr>";
    //     "</td>
    $html .=
        "
           <tr class=''>
               <td style='font-size:18px;padding:0px 30px !important;float:left;font-weight:bold;'>" .
        __("PVM 21%", "synergy") .
        "</td>
               <td style='font-size:18px;padding:0px 30px !important;float:right;font-weight:bold;'>" .
        number_format($ammount_without_vat__nine + $ammount_without_vat_21, 2) .
        "</td>
           </tr>";
    $html .= "
       </tbody>
   </table>";
    $total_order = $totalValue + $total_shipping_with_vat;
    $formatted_total_ = number_format($total_order, 2, ".", "");
    $html .=
        "
   <div style='margin-top:30px;margin-bottom:20px;clear:both;display:block;'>
       <div><span style='font-size:22px;padding:0px 30px !important;float:left;font-weight:bold;w'>" .
        __("MOKĖTINA SUMA", "synergy") .
        "</span>
       </div>
       <div><span style='font-size:22px;padding:0px 30px !important;float:right;font-weight:bold;'>" .
        $total_order .
        " €</span></div>
   </div>
   
   
   
   <div style='margin-top:50px;margin-bottom:20px;clear:both;display:block;'>
       <div><span style='font-size:18px;padding:0px 30px !important;float:left;font-weight:bold;'>" .
        __("Suma žodžiais:", "synergy") .
        "</span>
       </div>
       <div><span style='font-size:18px;padding:0px 30px !important;float:right;font-weight:bold;'>";
    ?>
<?php if ($currentLanguage == "lt") {
    $html .= skaicius_zodziais($formatted_total_);
} elseif ($currentLanguage == "en") {
    $html .= AmountInWords($formatted_total_);
} else {
    $html .= AmountInWordsRussian($formatted_total_);
} ?>
<?php
$html .=
    "</span></div>
   </div>
   
   <div style='margin-top:30px;margin-bottom:20px;clear:both;display:block;'>
       <div><span style='font-size:18px;padding:0px 30px !important;float:left;font-weight:bold;w'>" .
    __("Sąskaitą išrašė:", "synergy") .
    "</span>
       </div>
       <div><span style='font-size:18px;padding:0px 30px !important;float:right;font-weight:bold;'>" .
    __("UAB Jogundė", "synergy") .
    "</span></div>
   </div>";
// 	$html.= "<h2>order id count ". count($single_order_ids). "</h2>";
$invoice_pdf_name = __("Juridiniu_asmenu_PVM_saskaita_faktura_Nr.", "synergy");
$filename = $invoice_pdf_name . $invoice_number . ".pdf";
$options = new Options();
$options->set("isRemoteEnabled", true);
$options->setTempDir("temp");
$options->set("defaultFont", "DejaVuSans");
$dompdf = new Dompdf($options);
$html = mb_convert_encoding($html, "HTML-ENTITIES", "UTF-8");
$dompdf->loadHtml($html);
$dompdf->setPaper("Legal", "portrait");
$dompdf->set_option("isRemoteEnabled", true);
$dompdf->render();
$output = $dompdf->output();
file_put_contents(ABSPATH . "/wp-content/uploads/pdf/" . $filename, $output);
return $filename;
} ///company///
function generate_invoice_company(
    $company_id,
    $invoice_num // admin side left
) {
    $single_order_ids = [];
    $currentLanguage = defined("ICL_LANGUAGE_CODE")
        ? ICL_LANGUAGE_CODE
        : "default";
    $current_month = date("m");
    $current_year = date("Y");
    $user_ID = $company_id;
    $company_name = get_the_title($company_id);
    $currentDate = date("d-m-Y");
    $randomNumber = generateRandomNumber();
    $invoice_pdf_name = __("EAT-", "synergy");
    $invoice_number = $invoice_num;
    $previous_month_start = strtotime("first day of last month");
    $previous_month_end = strtotime("last day of last month");
    $args = [
        "limit" => -1,
        "date" => [
            "after" => date("Y-m-d H:i:s", $previous_month_start),
            "before" => date(
                "Y-m-d H:i:s",
                strtotime("+1 day", $previous_month_end)
            ), // Adding one day to include orders on the last day
        ],
        "meta_key" => "_company_name",
        // Postmeta key field
        "meta_value" => $company_name, // Postmeta value field
        "meta_compare" => "=",
        "post_status" => "wc-processing",
    ];
    $argsString = print_r($args, true);
    $orders = wc_get_orders($args);
    $currentYear = date("Y");
    $currentMonth = date("m"); // Get the first and last date of the current month
    $firstDate = date("Y-m-01", strtotime("$currentYear-$currentMonth-01"));
    $lastDate = date("Y-m-t", strtotime("$currentYear-$currentMonth-01"));
    $nextMonth = $currentMonth + 1; // Check if the next month is January of the next year
    if ($nextMonth > 12) {
        $nextMonth = 1;
        $currentYear++;
    } // Create a date string for the first day of the next month
    $firstDayOfNextMonth = "$currentYear-$nextMonth-01";
    // Calculate the last day of the next month
    $lastDayOfNextMonth = date("Y-m-d", strtotime("last day of this month")); // $company_name = get_field('company_name','user_'.$user_ID);
    $_parent_user = get_post_meta($company_id, "ref_user_id", true);
    $company_code = get_field("company_code", "user_" . $_parent_user);
    $vat_code = get_field("vat_code", "user_" . $_parent_user);
    $billing_first_name = get_user_meta(
        $_parent_user,
        "billing_first_name",
        true
    );
    $billing_last_name = get_user_meta(
        $_parent_user,
        "billing_last_name",
        true
    );
    $billing_address_1 = get_user_meta(
        $_parent_user,
        "billing_address_1",
        true
    );
    // $html = "<h3>" . $argsString . "</h3>";
    $billing_postcode = get_user_meta($_parent_user, "billing_postcode", true);
    $billing_city = get_user_meta($_parent_user, "billing_city", true);
    $html .= "
<style>
html {
    margin: 0
}

@page {
    margin: 0;
}

table {
    border-collapse: collapse;
    border: none;
    width: 100%;
}

body {
    background-size: contain;
    font-family:  DejaVu Sans;
    margin: 0;
    font-size: 13px;
    line-height: 18px;
    color: #1D1D1B;
}

.header-left {
    width: 20%;
    padding: 0px 35px 0px 35px;
}

.header-right {
    width: 80%;
    font-style: normal;
    font-weight: 400;
    font-size: 11px;
    line-height: 9px;
    color: #32EDB4;
    padding: 0px 35px 0px 35px;
    float: right;
}

.title {
    font-style: normal;
    font-weight: 700;
    font-size: 19px;
    line-height: 25px;
    color: #1D1D1B;
    text-align: center;
    margin-top: 20px;
    margin-bottom: 20px;
}

.table th {
    background-color: #000;
    height: 40px;
    font-style: normal;
    font-weight: 400;
    text-align: left;
    color: #fff;
    font-size: 16px;
    padding: 10px;
}

.table td {
    padding: 10px;
}

.table td:nth-child(1),
thead th:nth-child(1) {
    padding-left: 15px;
}

.table td:last-child,
thead th:last-child {
    padding-left: 15px;
}

.footer {
    position: absolute;
    right: 44px;
    bottom: 20px;
}

.text {
    font-weight: 700;
    font-size: 9px;
    line-height: 13px;
    color: #9D9D9C;
    padding-right: 10px;
}

.table-summary {
    width: 50%;
    margin-left: auto;
    text-align: right;
    margin-top: 10px;
    margin-right: 60px;
    font-weight: 400;
}

.content {
    margin-top: 00px;
    padding-left: 54px;
}

.content-title {
    margin-top: 10px;
}

.main_invoice_data h3 {
    font-size: 30px;
    font-weight: bold;
    margin-bottom: 5px;
}

.main_invoice_data div div div {
    font-size: 16px;
    font-weight: 400;
    margin-bottom: 0px;
}

.order_data {
    display: flex;
    justify-content: space-between;
}

.flex {
    display: flex;
}

.space-between {
    justify-content: space-between;
}

.gap-3 {
    gap: 20px;
}

.order_details_total div {
    text-align: right;
    margin-bottom: 10px;
}

.order_details_total div span {
    font-size: 16px;
    margin-right: 10px;
}

.data_table {
    font-size: 16px;
}

.shipping tr td {
    text-align: center;
}

.left {
    float: left;
}

.right {
    float: right;
}

.table-summary td {
    font-size: 20px;
    font-weight: bold;
    margin-bottom: 5px;
}

.w-1\/2 {
    width: 50%;
}

.border-bottom {
    border-bottom: 1px solid #000;
    /* Change this to your desired border style */
    margin: 0px 0px;
}

.bottom_data {
    width: 40%;
    float: right;
    border-top: 1px solid #000;
    margin-top: 10px;
}

.bottom_data div {
    border-bottom: 1px solid #000;
}

.bottom_data div span {
    display: inline-block;
    width: 48%;
}

.header-right span {
    font-size: 16px;
    color: #000;
    display: block;
    margin-bottom: 3px;
    text-align: left;
    line-height: normal;
}

.clearfix::after {
    content: '';
    display: table;
    clear: both;
}

.border-bottom {
    padding: 0px;
}

.border-bottom td {
    padding-top: 0px;
}

.border-bottom td ul {
    margin-top: 0px;
}

.border-bottom td ul li {
    margin-top: 0px;
}
</style>
<meta charset='UTF-8'>

<link href='https://api.fontshare.com/v2/css?f[]=satoshi@900,700,500,400&amp;display=swap' rel='stylesheet'>";
    $html .=
        "<table style='margin:0px;'>
    <tr>
        <td class='header-left'>
            <img width='100' src='https://seatisfy.lt/wp-content/uploads/2023/01/Vector-1.png'>
        </td>
        <td class='header-right' style='padding-top:00px;'>
            <h3 style='font-size:20px;clear:both;width:100%;padding:0px 0px 0px 0px;line-height:30px;margin-bottom:10px;color:#000;clear:both;display:block;'> 
				 " .
        __("Pardavėjas:", "synergy") .
        "
			</h3>

            <div class=''
                style='margin-right:0px;display:inline-block;width:55%; text-align:left;margin-top:10px; font-size:16px;'>
                <span style='margin:0px;line-height:16px;' class=''>" .
        __("Įmonės pavadinimas:", "synergy") .
        "</span>
                <span style='margin:0px;line-height:16px;' class=''>" .
        __("Adresas:", "synergy") .
        "<</span>
                <span style='margin:0px;line-height:16px;' class=''>" .
        __("Įmonės kodas:", "synergy") .
        "<</span>
                <span style='margin:0px;line-height:16px;' class=''>" .
        __("PVM mokėtojo kodas:", "synergy") .
        "<</span>
                <span style='margin:0px;line-height:16px;font-weight:bold;' class=''>" .
        __("PVM sąskaitos faktūros numeris:", "synergy") .
        "<</span>

            </div>
            <div class='' style='display:inline-block;width:35%;text-align:left;'>
                <span style='margin:0px;line-height:16px;' class=''>" .
        __("UAB Jogundė", "synergy") .
        "</span>
                <span style='margin:0px;line-height:16px;' class=''>" .
        __("Liepų g. 19, Klaipėda", "synergy") .
        "</span>
                <span style='margin:0px;line-height:16px;' class=''>140809765</span>
                <span style='margin:0px;line-height:16px;' class=''>LT408097610</span>
                <span style='margin:0px;line-height:16px;font-weight:bold;' class=''>" .
        $invoice_number .
        "</span>


            </div>



        </td>
    </tr>
</table>

<h3 style='font-size:20px;clear:both;width:100%;padding:0px 20px 0px 20px;margin:0px!important;'>" .
        __("PVM SĄSKAITA FAKTŪRA", "synergy") .
        "</h3>
<span
    style='font-size:18px;clear:both;width:100%;padding:0px 20px 0px 20px;display:block;margin-bottom:20px;line-height:30px;font-weight:bold;'>" .
        __("Pirkėjas:", "synergy") .
        "</span>
<div class='main_invoice_data' style='padding:0px 20px 0px 20px;clear:both;margin-bottom:0px;'>

    <div class='order_dataa' style='margin-bottom:0px;'>
        <div class='left' style='clear:both;width:60%;'>
            <div class='' style='margin-right:0px;display:inline-block;width:40%;'>
                <div class=''>" .
        __("Įmonės pavadinimas", "synergy") .
        "</div>
                <div class=''>" .
        __("Adresas:", "synergy") .
        "</div>
                <div class=''>" .
        __("Įmonės kodas:", "synergy") .
        "</div>
                <div class=''>" .
        __("PVM mokėtojo kodas:", "synergy") .
        "</div>
            </div>
            <div class='' style='display:inline-block;width:58%;'>
                <div class=''>" .
        $company_name .
        "</div>
                <div class=''>" .
        $billing_address_1 .
        ", " .
        $billing_postcode .
        " " .
        $billing_city .
        "</div>
                <div class=''>" .
        $company_code .
        "</div>
                <div class=''>" .
        $vat_code .
        "</div>
            </div>
        </div>

        <div class='right' style='width:42%;margin-bottom:0px;'>
            <div style='margin-right: 0px; display: inline-block; width: 40%;margin-top:0px;'>
                <div style='margin-top:0px;font-size:13px;'>" .
        __("Užsakymo laikotarpis:", "synergy") .
        "</div>
                <div style='font-weight: bold;font-size:13px;'>" .
        __("Apmokėti iki:", "synergy") .
        "</div>
            </div>
            <div class='' style='display: inline-block; width: 58%;'>
                <div style='font-size:13px;'>" .
        date("Y-m-d", $previous_month_start) .
        " / " .
        date("Y-m-d", $previous_month_end) .
        "</div>
                <div style='font-weight: bold;font-size:13px;'>" .
        $lastDayOfNextMonth .
        "</div>
            </div>

        </div>

        <div class='clearfix' style='margin-bottom:0px;'></div>

    </div>
</div>
";
    $html .=
        "<table class='table data_table' style='margin:0px 50px 0px 0px;clear:both;'>
    <thead>
        <tr>
            <th>
                " .
        __("Produktas", "synergy") .
        "
            </th>
            <th>
                " .
        __("Kiekis", "synergy") .
        "
            </th>
            <th>
                " .
        __("Kaina be PVM", "synergy") .
        "
            </th>
            <th>
                " .
        __("Suma be PVM", "synergy") .
        "
            </th>
            <th>
                " .
        __("PVM tarifas", "synergy") .
        "
            </th>
            <th>
                " .
        __("PVM suma", "synergy") .
        "
            </th>
            <th>
                " .
        __("Suma EUR", "synergy") .
        "
            </th>
        </tr>
    </thead>
    <tbody>
        ";
    foreach ($orders as $order) {
        $orderDateObj = $order->date_created;
        $orderDate = $orderDateObj->format("Y-m-d");
        if (strtotime($orderDate) <= $previous_month_end) {
            //             $html .= "<h3>".$order->ID." hh</h3>";
            $single_order_ids = processOrder($order->ID, $single_order_ids);
        }
    }
    $count_1 = 0;
    $count_2 = 0;
    $count_3 = 0;
    $total_vat_21 = 0;
    $total_vat_9 = 0;
    $totalSum = 0;
    $shippingMethodCount = 0;
    $totalShippingCost = 0;
    $total_amount_without_vat = 0;
    $total_amount_with_vat = 0; // Check if _wuoc_merged_orders is an array and not empty // $printsinglearray = print_r($single_order_ids); // 	$html .= "<h3>{$printsinglearray}</h3>"; // 	$html.="<h3>hiiii</h3>";
    foreach ($single_order_ids as $order_id) {
        //                 $html.="<h3>{$order_id}</h3>";
        $order_data = wc_get_order($order_id);
        if ($order_data) {
            $discount_type = get_post_meta($order_id, "_discount_type", true);
            $discount_fixed_am = get_post_meta(
                $order_id,
                "_discount_fixed_am",
                true
            );
            $order_total = $order_data->get_total();
            $applied_fee = 0; // foreach ($order->get_items("fee") as $item) { // $applied_fee = $item->get_total(); // } // if ($item->get_name() === "Nuolaidos") { // } // break;
            $firstRowDisplayed = false; // Initialize a boolean variable //             if ( $discount_type != "fixed" || ($order_total > 0 && $discount_type == "fixed") ) {  Condition change due to Invoice calculation Issue order with 100% discount and delivery pickup total will be zero so not included in invoice Date 25/7/24
            if ($discount_type != "fixed") {
                foreach ($order_data->get_items() as $item) {
                    $product = $item->get_product();
                    $product_id = $product->get_id();
                    $item_subtotal = $item->get_subtotal();
                    $deal_price = get_field("deal_price", $product_id); // Calculate totals and VAT values
                    $subtotal = $item->get_subtotal();
                    $tax_amount = $item->get_subtotal_tax();
                    $item_total_without_vat = $subtotal - $tax_amount;
                    $total_amount_without_vat += $item_total_without_vat;
                    $orderTotal = $item->get_total();
                    $totalValue += $orderTotal;
                    $quantity = $item->get_quantity();
                    // Calculate total amount for this item including VAT and quantity
                    $item_total_with_vat =
                        ($subtotal + $tax_amount) * $quantity;
                    $total_amount_with_vat += $item_total_with_vat; // Get variation data if applicable
                    $variation_data = "";
                    if ($product->is_type("variation")) {
                        $variation_attributes = $product->get_variation_attributes();
                        foreach ($variation_attributes as $name => $value) {
                            if ($name == "attribute_karstas-garnyras") {
                                $att_name = __("Karštas garnyras", "synergy");
                            } elseif ($name == "attribute_saltas-garnyras") {
                                $att_name = __("Šaltas garnyras", "synergy");
                            } elseif ($name == "attribute_padazas") {
                                $att_name = __("Padažas", "synergy");
                            } elseif ($name == "attribute_papildomai") {
                                $att_name = __("Papildomai", "synergy");
                            } elseif ($name == "attribute_sviestas") {
                                $att_name = __("Sviestas", "synergy");
                            } elseif ($name == "attribute_uogiene") {
                                $att_name = __("Uogienė", "synergy");
                            }
                            $variation_data .= "<span style='font-size: 14px;margin:0px;'><strong>{$att_name}:</strong>
            {$value}</span><br>";
                        }
                    } // Calculate tax rate percentage
                    $tax_rate_percent = "";
                    $tax_rates = $item->get_taxes();
                    foreach ($tax_rates as $tax_rate_id => $tax) {
                        $tax_rate_data = WC_Tax::get_rates($tax_rate_id);
                        if ($tax_rate_data) {
                            $tax_rate_percent =
                                reset($tax_rate_data)["rate"] * 100; // Convert to percentage
                        }
                    }
                    $global = wc_get_product($item->get_product_id());
                    $item_price = $item->get_subtotal();
                    $global_price = $global->get_price();
                    $item_id = $item->get_id();
                    $package_value = wc_get_order_item_meta(
                        $item_id,
                        "_package",
                        true
                    );
                    if ($package_value) {
                        if ($package_value == "0.10") {
                            $count_3 = $count_3 + $item->get_quantity();
                        } elseif ($package_value == "0.15") {
                            $count_2 = $count_2 + $item->get_quantity();
                        } elseif ($package_value == "0.30") {
                            $count_1 = $count_1 + $item->get_quantity();
                        }
                    }
                    $total_value_of_order = $order->get_total();
                    // Assuming this gets the raw order total value
                    // Format the order total without the euro sign
                    $formatted_order_total = number_format(
                        $total_value_of_order,
                        2,
                        ".",
                        ""
                    ); // Formats as X.XX
                    $single_product_price =
                        $item_subtotal / $item->get_quantity();
                    if ($package_value) {
                        $single_product_price =
                            $single_product_price - $package_value;
                    }
                    $ninePercent =
                        $single_product_price - $single_product_price / 1.21;
                    $item_subtotal_without_vat =
                        $single_product_price - $ninePercent;
                    // Format the item subtotal with exactly two decimal places
                    $formatted_item_subtotal = number_format(
                        $item_subtotal_without_vat,
                        2,
                        ".",
                        ""
                    );
                    $ninePercent = $ninePercent * (int) $item->get_quantity();
                    $total_order_without_vat =
                        $item_subtotal_without_vat * $item->get_quantity();
                    $total_order_with_vat =
                        $total_order_without_vat + $ninePercent;
                    $totalSum += $total_order_with_vat;
                    $ninePercent = round($ninePercent, 2);
                    $total_order_with_vat = round($total_order_with_vat, 2);
                    $ammount_without_vat__nine =
                        $ammount_without_vat__nine + $ninePercent;
                    $total_order_nine =
                        $total_order_nine + $total_order_with_vat;
                    if (!$firstRowDisplayed) {
                        // Display the first row with product information
                        $html .=
                            "
        <tr style='margin-bottom:0px;padding:0px;'>
            <td style='padding-bottom:0px;'>{$product->get_name()}</td>
            <td style='padding-bottom:0px;'>{$item->get_quantity()}</td>
            <td style='padding-bottom:0px;'>{$formatted_item_subtotal} €</td>
            <td style='padding-bottom:0px;'>" .
                            round($total_order_without_vat, 2) .
                            " €</td>
            <td style='padding-bottom:0px;'>21 %</td>
            <td style='padding-bottom:0px;'>" .
                            $ninePercent .
                            "</td>
            <td style='padding-bottom:0px;'>" .
                            $total_order_with_vat .
                            " €</td>
        </tr>"; // $firstRowDisplayed = true; // Set the boolean variable to true after the first row is displayed
                    } else {
                        // For subsequent iterations, leave the entire row empty
                        $html .= "
        <tr style='margin-bottom:0px;padding:0px;'>
            <td style='padding-bottom:0px;'></td>
            <td style='padding-bottom:0px;'></td>
            <td style='padding-bottom:0px;'></td>
            <td style='padding-bottom:0px;'></td>
            <td style='padding-bottom:0px;'></td>
            <td style='padding-bottom:0px;'></td>
            <td style='padding-bottom:0px;'></td>
        </tr>";
                    }
                    $deal_data = $item->get_meta("deal_data", true);
                    if (!empty($variation_data)) {
                        $html .= "
        <tr class='' style='margin-top:0px;'>
            <td colspan='7'>{$variation_data}</td>
        </tr>
        <tr class='' style='margin-top:0px;'>
            <td colspan='7' style='padding:0px;'>{$deal_price}</td>
        </tr>";
                    }
                    if ($deal_data) {
                        foreach ($deal_data as $data):
                            $html .= "
        <tr class='' style='margin-top:0px;'>
            <td colspan='7' style='padding:0 15px; margin: 0;'>{$data["addon_p_name"]}</td>
        </tr>";
                        endforeach;
                    }
                    $html .= "
        <tr class='border-bottom' style='margin-top:0px;'>
            <td colspan='7' style='padding:0px;'></td>
        </tr>";
                    // Increment after using
                    $x++;
                }
                // Retrieve order shipping charges
                $order = wc_get_order($order_id); // Assuming $order_id is the order ID
                $shipping_total = $order->get_shipping_total();
                $shipping_methods = $order->get_shipping_methods();
                $billing_pvm = $order->get_meta("_billing_pvm", true);
                foreach ($order->get_items() as $item_id => $item) {
                    $product = $item->get_product();
                    $with_tax = wc_get_price_including_tax($product);
                    $without_tax = wc_get_price_excluding_tax($product);
                    $tax_amount = $with_tax - $without_tax;
                }
                $date = $order->get_meta("_jckwds_date");
                $time_slot = $order->get_meta("_jckwds_timeslot");
                $timestamp = $order->get_meta("_jckwds_timestamp");
                $cleanedTime = str_replace(["AM", "PM"], "", $time_slot);
                foreach (
                    $shipping_methods
                    as $shipping_item_id => $shipping_item
                ) {
                    $shipping_method = $shipping_item->get_method_id();
                    $shipping_cost = $shipping_item->get_total();
                    if ($shipping_cost) {
                        $shippingMethodCount++;
                        $totalShippingCost += $shipping_cost;
                    }
                }
            }
        }
    }
    $totalDealPackageWithVat = 0;
    if ($count_3 > 0) {
        $Depozitas_total = 0.1 * $count_3;
        $total_order_nine = $total_order_nine + $Depozitas_total;
        $html .=
            "
        <tr class='border-bottom'>
            <td style=''>" .
            __("Depozitas", "synergy") .
            "</td>
            <td style=''>" .
            $count_3 .
            "</td>
            <td style=''>0.10 €</td>
            <td style=''>" .
            $Depozitas_total .
            " €</td>
            <td style=''>0%</td>
            <td style=''>0 €</td>
            <td style=''>" .
            $Depozitas_total .
            " €</td>
        </tr>";
    }
    if ($count_2 > 0) {
        $Pakuote_total = 0.15 * $count_2;
        $Pakuote_amountToSubtract = $Pakuote_total - $Pakuote_total / 1.21;
        $Pakuote_total_without_vat = $Pakuote_total - $Pakuote_amountToSubtract;
        $ammount_without_vat_21 =
            $ammount_without_vat_21 + $Pakuote_amountToSubtract;
        $total_order_nine = $total_order_nine + $Pakuote_total_without_vat;
        $html .=
            "
        <tr class='border-bottom'>
            <td style=''>" .
            __("Pakuotė", "synergy") .
            "</td>
            <td style=''>" .
            $count_2 .
            "</td>
            <td style=''>" .
            number_format(0.15 / 1.21, 2) .
            " €</td>
            <td style=''>" .
            number_format($Pakuote_total_without_vat, 2) .
            " €</td>
            <td style=''>21%</td>
            <td style=''>" .
            number_format($Pakuote_amountToSubtract, 2) .
            " €</td>
            <td style=''>" .
            number_format($Pakuote_total, 2) .
            " €</td>
        </tr>";
    }
    if ($count_1 > 0) {
        $Pakuotedienospasiulymo_total = 0.3 * $count_1;
        $Pakuotedienospasiulymo_amountToSubtract =
            $Pakuotedienospasiulymo_total -
            $Pakuotedienospasiulymo_total / 1.21;
        $Pakuotedienospasiulymo_total_without_vat =
            $Pakuotedienospasiulymo_total - $Pakuote_amountToSubtract;
        $ammount_without_vat_21 =
            $ammount_without_vat_21 + $Pakuotedienospasiulymo_amountToSubtract;
        $total_order_nine =
            $total_order_nine + $Pakuotedienospasiulymo_total_without_vat;
        $html .=
            "
        <tr class='border-bottom'>
            <td style=''>" .
            __("Pakuotė (dienos pasiūlymo)", "synergy") .
            "</td>
            <td style=''>" .
            $count_1 .
            "</td>
            <td style=''>" .
            number_format(0.3 / 1.21, 2) .
            " €</td>
            <td style=''>" .
            number_format($Pakuotedienospasiulymo_total_without_vat, 2) .
            " €</td>
            <td style=''>21%</td>
            <td style=''>" .
            number_format($Pakuotedienospasiulymo_amountToSubtract, 2) .
            " €</td>
            <td style=''>" .
            number_format($Pakuotedienospasiulymo_total, 2) .
            " €</td>
        </tr>";
    }
    $totalDealPackageWithVat =
        $Pakuotedienospasiulymo_total + $Pakuote_total + $Depozitas_total;
    $total_shipping_ = $shippingMethodCount;
    $total_shipping_cost = $totalShippingCost;
    if ($total_shipping_) {
        $one_shipping_cost_ = $totalShippingCost / $shippingMethodCount;
    } else {
        $one_shipping_cost_ = $totalShippingCost;
    }
    $vat_of_one_shipping_ = $one_shipping_cost_ - $one_shipping_cost_ / 1.21;
    $one_shipping_without_vat_ = $one_shipping_cost_ - $vat_of_one_shipping_;
    $total_shipping_without_vat = $one_shipping_without_vat_ * $total_shipping_;
    $vat_of_all_shipping_ = $vat_of_one_shipping_ * $total_shipping_;
    $total_shipping_with_vat =
        $total_shipping_without_vat + $vat_of_all_shipping_;
    $ammount_without_vat_21 = $ammount_without_vat_21 + $vat_of_all_shipping_;
    $total_order_nine = $total_order_nine + $total_shipping_without_vat;
    $html .=
        "
        <tr class='border-bottom'>
            <td style=''>" .
        __("Pristatymas", "synergy") .
        "</td>
            <td style=''>{$shippingMethodCount}</td>
            <td style=''>" .
        number_format($one_shipping_without_vat_, 2) .
        " €</td>
            <td style=''>" .
        number_format($total_shipping_without_vat, 2) .
        " €</td>
            <td style=''>21%</td>
            <td style=''>" .
        number_format($vat_of_all_shipping_, 2) .
        " €</td>
            <td style=''>" .
        number_format($total_shipping_with_vat, 2) .
        " €</td>
        </tr>";
    $html .= "
    </tbody>
</table>";
    $html .= "
<table style='margin:0px auto;margin-top:40px!important;'>
    <tbody>";
    $html .=
        "
        <tr class=''>
            <td style='font-size:18px;padding:0px 30px !important;float:left;font-weight:bold;'> " .
        __("Suma be PVM Eur", "synergy") .
        "</td>
            <td style='font-size:18px;padding:0px 30px !important;float:right;font-weight:bold;'>" .
        number_format($total_order_nine - $ammount_without_vat__nine, 2) .
        "</td>
        </tr>"; // $html .= //     " //     <tr class=''> //         <td style='font-size:18px;padding:0px 30px !important;float:left;font-weight:bold;'> " . //     __("PVM 21%", "synergy") . //     "</td> //         <td style='font-size:18px;padding:0px 30px !important;float:right;font-weight:bold;'>" . //     number_format($ammount_without_vat__nine, 2) . //     "</td> //     </tr>";
    $html .=
        "
        <tr class=''>
            <td style='font-size:18px;padding:0px 30px !important;float:left;font-weight:bold;'> " .
        __("PVM 21%", "synergy") .
        "</td>
            <td style='font-size:18px;padding:0px 30px !important;float:right;font-weight:bold;'>" .
        number_format($ammount_without_vat__nine + $ammount_without_vat_21, 2) .
        "</td>
        </tr>";
    $html .= "
    </tbody>
</table>";
    $total_order = $totalValue + $total_shipping_with_vat;
    $formatted_total_ = number_format($total_order, 2, ".", "");
    $html .=
        "
<div style='margin-top:30px;margin-bottom:20px;clear:both;display:block;'>
    <div><span style='font-size:22px;padding:0px 30px !important;float:left;font-weight:bold;w'>" .
        __("MOKĖTINA SUMA", "synergy") .
        "</span>
    </div>
    <div><span style='font-size:22px;padding:0px 30px !important;float:right;font-weight:bold;'>" .
        $total_order .
        " €</span></div>
</div>



<div style='margin-top:50px;margin-bottom:20px;clear:both;display:block;'>
    <div><span style='font-size:18px;padding:0px 30px !important;float:left;font-weight:bold;'>" .
        __("Suma žodžiais:", "synergy") .
        "</span>
    </div>
    <div><span style='font-size:18px;padding:0px 30px !important;float:right;font-weight:bold;'>";
    ?>
<?php if ($currentLanguage == "lt") {
    $html .= skaicius_zodziais($formatted_total_);
} elseif ($currentLanguage == "en") {
    $html .= AmountInWords($formatted_total_);
} else {
    $html .= AmountInWordsRussian($formatted_total_);
} ?>
<?php
$html .=
    "</span></div>
</div>

<div style='margin-top:30px;margin-bottom:20px;clear:both;display:block;'>
    <div><span style='font-size:18px;padding:0px 30px !important;float:left;font-weight:bold;w'>" .
    __("Sąskaitą išrašė:", "synergy") .
    "</span>
    </div>
    <div><span style='font-size:18px;padding:0px 30px !important;float:right;font-weight:bold;'>" .
    __("UAB Jogundė", "synergy") .
    "</span></div>
</div>";
$currentDate = date("d-m-Y");
$invoice_pdf_name = __("Juridiniu_asmenu_PVM_saskaita_faktura_Nr.", "synergy");
$filename = $invoice_pdf_name . $invoice_number . ".pdf";
$options = new Options();
$options->set("isRemoteEnabled", true);
$options->setTempDir("temp");
$options->set("defaultFont", "DejaVuSans");
$dompdf = new Dompdf($options);
$html = mb_convert_encoding($html, "HTML-ENTITIES", "UTF-8");
$dompdf->loadHtml($html);
$dompdf->setPaper("Legal", "portrait");
$dompdf->set_option("isRemoteEnabled", true);
$dompdf->render();
$output = $dompdf->output();
file_put_contents(ABSPATH . "/wp-content/uploads/pdf/" . $filename, $output);
return $filename;
} ///company fixed///
function generate_invoice_company_fixed($company_id, $invoice_num)
{
    // admin panel right
    $single_order_ids = [];
    $currentLanguage = defined("ICL_LANGUAGE_CODE")
        ? ICL_LANGUAGE_CODE
        : "default";
    $current_month = date("m");
    $current_year = date("Y");
    $user_ID = $company_id;
    $only_one = true;
    $company_name = get_the_title($company_id);
    $currentDate = date("d-m-Y");
    $randomNumber = generateRandomNumber();
    $invoice_pdf_name = __("EAT-", "synergy");
    $invoice_number = $invoice_num;
    $previous_month_start = strtotime("first day of last month");
    $previous_month_end = strtotime("last day of last month");
    $args = [
        "limit" => -1,
        "date" => [
            "after" => date("Y-m-d H:i:s", $previous_month_start),
            "before" => date(
                "Y-m-d H:i:s",
                strtotime("+1 day", $previous_month_end)
            ), // Adding one day to include orders on the last day
        ],
        "meta_key" => "_company_name", // Postmeta key field
        "meta_value" => $company_name, // Postmeta value field
        "meta_compare" => "=",
        "post_status" => "wc-processing", //'post_status'   => array('trash', 'draft'), // Exclude 'trash' and 'draft'
    ];
    $orders = wc_get_orders($args);
    $currentYear = date("Y");
    $currentMonth = date("m"); // Get the first and last date of the current month
    $firstDate = date("Y-m-01", strtotime("$currentYear-$currentMonth-01"));
    $lastDate = date("Y-m-t", strtotime("$currentYear-$currentMonth-01"));
    $nextMonth = $currentMonth + 1; // Check if the next month is January of the next year
    if ($nextMonth > 12) {
        $nextMonth = 1;
        $currentYear++;
    } // Create a date string for the first day of the next month
    $firstDayOfNextMonth = "$currentYear-$nextMonth-01"; // Calculate the last day of the next month
    $lastDayOfNextMonth = date("Y-m-d", strtotime("last day of this month")); //	$company_name	=	get_field('company_name','user_'.$user_ID);
    $_parent_user = get_post_meta($company_id, "ref_user_id", true);
    $company_code = get_field("company_code", "user_" . $_parent_user);
    $vat_code = get_field("vat_code", "user_" . $_parent_user);
    $billing_first_name = get_user_meta(
        $_parent_user,
        "billing_first_name",
        true
    );
    $billing_last_name = get_user_meta(
        $_parent_user,
        "billing_last_name",
        true
    );
    $billing_address_1 = get_user_meta(
        $_parent_user,
        "billing_address_1",
        true
    );
    $billing_postcode = get_user_meta($_parent_user, "billing_postcode", true);
    $billing_city = get_user_meta($_parent_user, "billing_city", true);
    $html = "
<style>
html { margin: 0}
@page { margin: 0; }
table{
    border-collapse: collapse;
    border: none;
    width: 100%;
}
body {
	background-size: contain;
	font-family:  DejaVu Sans;
	margin: 0;
    font-size: 13px;
    line-height: 18px;
    color: #1D1D1B;
}
.header-left{
     width: 20%; 
     padding: 0px 35px 0px 35px;
}
.header-right{
    width: 80%; 
    font-style: normal;
    font-weight: 400;
    font-size: 11px;
    line-height: 9px;
    color: #32EDB4;
    padding: 0px 35px 0px 35px;
	float:right;
}
.title{
    font-style: normal;
    font-weight: 700;
    font-size: 19px;
    line-height: 25px;
    color: #1D1D1B;
    text-align: center;
    margin-top: 20px;
    margin-bottom: 20px;
}
.table th{
    background-color: #000;
    height: 40px;
    font-style: normal;
    font-weight: 400;
    text-align: left;
	color:#fff;
	font-size:16px;
	padding: 10px;
}
.table td{
	padding: 10px;
}

.table td:nth-child(1),
thead th:nth-child(1){
    padding-left: 15px;
}
.table td:last-child,
thead th:last-child{
    padding-left: 15px;
}
.footer{
    position: absolute;
    right: 44px;
    bottom: 20px;
}
.text{
    font-weight: 700;
    font-size: 9px;
    line-height: 13px;
    color: #9D9D9C;
    padding-right: 10px;
}
.table-summary{
    width: 50%;
    margin-left: auto;
    text-align: right;
    margin-top: 10px;
    margin-right: 60px;
    font-weight: 400;
}
.content{
    margin-top: 00px;
    padding-left: 54px;
}
.content-title{
    margin-top: 10px;
}
.main_invoice_data h3{
	font-size:30px;
	font-weight:bold;
	margin-bottom:5px;
}
.main_invoice_data div div div{
	font-size:16px;
	font-weight:400;
	margin-bottom:0px;
}
.order_data{
	display:flex;
	justify-content: space-between;
}
.flex{
	display:flex;
}
.space-between{
	justify-content: space-between;
}
.gap-3{
	gap:20px;
}
.order_details_total div{
	text-align:right;
	margin-bottom:10px;
}
.order_details_total div span{
 font-size:16px;
 margin-right:10px;
}
.data_table{
	font-size:16px;
}
.shipping tr td{
	text-align:center;
}
.left{
	float:left;
}
.right{
	float:right;
}
.table-summary td{
font-size:20px;
font-weight:bold;
margin-bottom:5px;
}
.w-1\/2 {
    width: 50%;
}
.border-bottom {
    border-bottom: 1px solid #000; /* Change this to your desired border style */
	margin:0px 0px;
}
.bottom_data{
	width:40%;
	float:right;
	border-top:1px solid #000;
	margin-top:10px;
}
.bottom_data div{
 	border-bottom: 1px solid #000;
}
.bottom_data div span{
	display:inline-block;
	width:48%;
}
.header-right span {
    font-size: 16px;
    color: #000;
    display: block;
    margin-bottom: 3px;
    text-align: left;
    line-height: normal;
}
.clearfix::after {
  content: '';
  display: table;
  clear: both;
}
.border-bottom {
padding:0px;
}
.border-bottom td{
padding-top:0px;
}
.border-bottom td ul{
	margin-top:0px;
}
.border-bottom td ul li{
	margin-top:0px;
}
</style>
<link href='https://api.fontshare.com/v2/css?f[]=satoshi@900,700,500,400&amp;display=swap' rel='stylesheet'>";
    $html .=
        "<table style='margin:0px;'>
    <tr>
        <td class='header-left'>
            <img width='100'  src='https://seatisfy.lt/wp-content/uploads/2023/01/Vector-1.png'> 
        </td>
		<td class='header-right' style='padding-top:00px;'>
			<h3 style='font-size:20px;clear:both;width:100%;padding:0px 0px 0px 0px;line-height:30px;margin-bottom:10px;color:#000;clear:both;display:block;'>" .
        __("Pardavėjas:", "synergy") .
        "</h3>

				<div class='' style='margin-right:0px;display:inline-block;width:55%; text-align:left;margin-top:10px; font-size:16px;'>
					<span style='margin:0px;line-height:16px;' class=''>" .
        __("Įmonės pavadinimas:", "synergy") .
        "</span>
					<span style='margin:0px;line-height:16px;' class=''>" .
        __("Adresas:", "synergy") .
        "</span>
					<span style='margin:0px;line-height:16px;' class=''>" .
        __("Įmonės kodas:", "synergy") .
        "</span>
					<span style='margin:0px;line-height:16px;' class=''>" .
        __("PVM mokėtojo kodas:", "synergy") .
        "</span>
					<span style='margin:0px;line-height:16px;font-weight:bold;' class=''>" .
        __("PVM sąskaitos faktūros numeris:", "synergy") .
        "</span>

				</div>
				<div class='' style='display:inline-block;width:35%;text-align:left;' >
					<span style='margin:0px;line-height:16px;' class=''>" .
        __("UAB Jogundė", "synergy") .
        "</span>
					<span style='margin:0px;line-height:16px;' class=''>" .
        __("Liepų g. 19, Klaipėda", "synergy") .
        "</span>
					<span style='margin:0px;line-height:16px;' class=''>140809765</span>
					<span style='margin:0px;line-height:16px;' class=''>LT408097610</span>
					<span style='margin:0px;line-height:16px;font-weight:bold;' class=''>" .
        $invoice_number .
        "</span>

					
				</div>
				
				

		</td>
    </tr>
</table>

	<h3 style='font-size:20px;clear:both;width:100%;padding:0px 20px 0px 20px;margin:0px!important;'>" .
        __("PVM SĄSKAITA FAKTŪRA", "synergy") .
        "</h3>
	<span  style='font-size:18px;clear:both;width:100%;padding:0px 20px 0px 20px;display:block;margin-bottom:20px;line-height:30px;font-weight:bold;'>" .
        __("Pirkėjas:", "synergy") .
        "</span>
	<div class='main_invoice_data' style='padding:0px 20px 0px 20px;clear:both;margin-bottom:0px;'>
		
		<div class='order_dataa'  style='margin-bottom:0px;'>
			<div class='left' style='clear:both;width:60%;'>
				<div class='' style='margin-right:0px;display:inline-block;width:40%;'>
					<div class=''>" .
        __("Įmonės pavadinimas:", "synergy") .
        "</div>
					<div class=''>" .
        __("Adresas:", "synergy") .
        "</div>
					<div class=''>" .
        __("Įmonės kodas:", "synergy") .
        "</div>
					<div class=''>" .
        __("PVM mokėtojo kodas:", "synergy") .
        "</div>
				</div>
				<div class='' style='display:inline-block;width:58%;' >
					<div class=''>" .
        $company_name .
        "</div>
					<div class=''>" .
        $billing_address_1 .
        ", " .
        $billing_postcode .
        " " .
        $billing_city .
        "</div>
					<div class=''>" .
        $company_code .
        "</div>
					<div class=''>" .
        $vat_code .
        "</div>
				</div>
			</div>

			<div class='right' style='width:42%;margin-bottom:0px;'>
				<div style='margin-right: 0px; display: inline-block; width: 40%;margin-top:0px;'>
					<div style='margin-top:0px;font-size:13px;'>" .
        __("Užsakymo laikotarpis:", "synergy") .
        "</div>
					<div style='font-weight: bold;font-size:13px;'>" .
        __("Apmokėti iki:", "synergy") .
        "</div>
				</div>
				<div class='' style='display: inline-block; width: 58%;'>
					<div style='font-size:13px;'>" .
        date("Y-m-d", $previous_month_start) .
        " / " .
        date("Y-m-d", $previous_month_end) .
        "</div>
					<div style='font-weight: bold;font-size:13px;'>" .
        $lastDayOfNextMonth .
        "</div>
				</div>

			</div>
			
				<div class='clearfix' style='margin-bottom:0px;'></div>

		</div>
	</div>
";
    $html .=
        "<table class='table data_table' style='margin:0px 50px 0px 0px;clear:both;'>
    <thead>
        <tr>
            <th>
                " .
        __("Produktas", "synergy") .
        "
            </th>
            <th>
                " .
        __("Kiekis", "synergy") .
        "
            </th>
            <th>
                " .
        __("Kaina be PVM", "synergy") .
        "
            </th>
            <th>
                " .
        __("Suma be PVM", "synergy") .
        "
            </th>
            <th>
                " .
        __("PVM tarifas", "synergy") .
        "
            </th>
            <th>
				" .
        __("PVM suma", "synergy") .
        "
            </th>
            <th>
                " .
        __("Suma EUR", "synergy") .
        "
            </th>

			
			
        </tr>
    </thead>
	<tbody>
	";foreach ($orders as $order) {
        $orderDateObj = $order->date_created;
        $orderDate = $orderDateObj->format("Y-m-d");
        if (strtotime($orderDate) <= $previous_month_end) {
            //             $html .= "<h3>".$order->ID." hh</h3>";
            $single_order_ids = processOrder($order->ID, $single_order_ids);
        }
    }
    $count_1 = 0;
    $count_2 = 0;
    $count_3 = 0;
    $total_vat_21 = 0;
    $total_vat_9 = 0;
    $totalSum = 0;
    $shippingMethodCount = 0;
    $totalShippingCost = 0;
    $total_amount_without_vat = 0;
    $total_amount_with_vat = 0; // Check if _wuoc_merged_orders is an array and not empty // $printsinglearray = print_r($single_order_ids); // 	$html .= "<h3>{$printsinglearray}</h3>"; // 	$html.="<h3>hiiii</h3>";
    foreach ($single_order_ids as $order_id) {
        //                 $html.="<h3>{$order_id}</h3>";
        $order_data = wc_get_order($order_id);
        if ($order_data) {
            $discount_type = get_post_meta($order_id, "_discount_type", true);
            $discount_fixed_am = get_post_meta(
                $order_id,
                "_discount_fixed_am",
                true
            );
            $order_total = $order_data->get_total();
            $applied_fee = 0; // foreach ($order->get_items("fee") as $item) { // $applied_fee = $item->get_total(); // } // if ($item->get_name() === "Nuolaidos") { // } // break;
            $firstRowDisplayed = false; // Initialize a boolean variable //             if ( $discount_type != "fixed" || ($order_total > 0 && $discount_type == "fixed") ) {  Condition change due to Invoice calculation Issue order with 100% discount and delivery pickup total will be zero so not included in invoice Date 25/7/24
            if ($discount_type == "fixed" && $order_total > 0) {
                foreach ($order_data->get_items() as $item) {
                    $product = $item->get_product();
                    $product_id = $product->get_id();
                    $item_subtotal = $item->get_subtotal();
                    $deal_price = get_field("deal_price", $product_id); // Calculate totals and VAT values
                    $subtotal = $item->get_subtotal();
                    $tax_amount = $item->get_subtotal_tax();
                    $item_total_without_vat = $subtotal - $tax_amount;
                    $total_amount_without_vat += $item_total_without_vat;
                    $orderTotal = $item->get_total();
                    $totalValue += $orderTotal;
                    $quantity = $item->get_quantity();
                    // Calculate total amount for this item including VAT and quantity
                    $item_total_with_vat =
                        ($subtotal + $tax_amount) * $quantity;
                    $total_amount_with_vat += $item_total_with_vat; // Get variation data if applicable
                    $variation_data = "";
                    if ($product->is_type("variation")) {
                        $variation_attributes = $product->get_variation_attributes();
                        foreach ($variation_attributes as $name => $value) {
                            if ($name == "attribute_karstas-garnyras") {
                                $att_name = __("Karštas garnyras", "synergy");
                            } elseif ($name == "attribute_saltas-garnyras") {
                                $att_name = __("Šaltas garnyras", "synergy");
                            } elseif ($name == "attribute_padazas") {
                                $att_name = __("Padažas", "synergy");
                            } elseif ($name == "attribute_papildomai") {
                                $att_name = __("Papildomai", "synergy");
                            } elseif ($name == "attribute_sviestas") {
                                $att_name = __("Sviestas", "synergy");
                            } elseif ($name == "attribute_uogiene") {
                                $att_name = __("Uogienė", "synergy");
                            }
                            $variation_data .= "<span style='font-size: 14px;margin:0px;'><strong>{$att_name}:</strong>
            {$value}</span><br>";
                        }
                    } // Calculate tax rate percentage
                    $tax_rate_percent = "";
                    $tax_rates = $item->get_taxes();
                    foreach ($tax_rates as $tax_rate_id => $tax) {
                        $tax_rate_data = WC_Tax::get_rates($tax_rate_id);
                        if ($tax_rate_data) {
                            $tax_rate_percent =
                                reset($tax_rate_data)["rate"] * 100; // Convert to percentage
                        }
                    }
                    $global = wc_get_product($item->get_product_id());
                    $item_price = $item->get_subtotal();
                    $global_price = $global->get_price();
                    $item_id = $item->get_id();
                    $package_value = wc_get_order_item_meta(
                        $item_id,
                        "_package",
                        true
                    );
                    if ($package_value) {
                        if ($package_value == "0.10") {
                            $count_3 = $count_3 + $item->get_quantity();
                        } elseif ($package_value == "0.15") {
                            $count_2 = $count_2 + $item->get_quantity();
                        } elseif ($package_value == "0.30") {
                            $count_1 = $count_1 + $item->get_quantity();
                        }
                    }
                    $total_value_of_order = $order->get_total();
                    // Assuming this gets the raw order total value
                    // Format the order total without the euro sign
                    $formatted_order_total = number_format(
                        $total_value_of_order,
                        2,
                        ".",
                        ""
                    ); // Formats as X.XX
                    $single_product_price =
                        $item_subtotal / $item->get_quantity();
                    if ($package_value) {
                        $single_product_price =
                            $single_product_price - $package_value;
                    }
                    $ninePercent =
                        $single_product_price - $single_product_price / 1.21;
                    $item_subtotal_without_vat =
                        $single_product_price - $ninePercent;
                    // Format the item subtotal with exactly two decimal places
                    $formatted_item_subtotal = number_format(
                        $item_subtotal_without_vat,
                        2,
                        ".",
                        ""
                    );
                    $ninePercent = $ninePercent * (int) $item->get_quantity();
                    $total_order_without_vat =
                        $item_subtotal_without_vat * $item->get_quantity();
                    $total_order_with_vat =
                        $total_order_without_vat + $ninePercent;
                    $totalSum += $total_order_with_vat;
                    $ninePercent = round($ninePercent, 2);
                    $total_order_with_vat = round($total_order_with_vat, 2);
                    $ammount_without_vat__nine =
                        $ammount_without_vat__nine + $ninePercent;
                    $total_order_nine =
                        $total_order_nine + $total_order_with_vat;
                    if (!$firstRowDisplayed) {
                        // Display the first row with product information
                        $html .=
                            "
        <tr style='margin-bottom:0px;padding:0px;'>
            <td style='padding-bottom:0px;'>{$product->get_name()}</td>
            <td style='padding-bottom:0px;'>{$item->get_quantity()}</td>
            <td style='padding-bottom:0px;'>{$formatted_item_subtotal} €</td>
            <td style='padding-bottom:0px;'>" .
                            round($total_order_without_vat, 2) .
                            " €</td>
            <td style='padding-bottom:0px;'>21 %</td>
            <td style='padding-bottom:0px;'>" .
                            $ninePercent .
                            "</td>
            <td style='padding-bottom:0px;'>" .
                            $total_order_with_vat .
                            " €</td>
        </tr>"; // $firstRowDisplayed = true; // Set the boolean variable to true after the first row is displayed
                    } else {
                        // For subsequent iterations, leave the entire row empty
                        $html .= "
        <tr style='margin-bottom:0px;padding:0px;'>
            <td style='padding-bottom:0px;'></td>
            <td style='padding-bottom:0px;'></td>
            <td style='padding-bottom:0px;'></td>
            <td style='padding-bottom:0px;'></td>
            <td style='padding-bottom:0px;'></td>
            <td style='padding-bottom:0px;'></td>
            <td style='padding-bottom:0px;'></td>
        </tr>";
                    }
                    $deal_data = $item->get_meta("deal_data", true);
                    if (!empty($variation_data)) {
                        $html .= "
        <tr class='' style='margin-top:0px;'>
            <td colspan='7'>{$variation_data}</td>
        </tr>
        <tr class='' style='margin-top:0px;'>
            <td colspan='7' style='padding:0px;'>{$deal_price}</td>
        </tr>";
                    }
                    if ($deal_data) {
                        foreach ($deal_data as $data):
                            $html .= "
        <tr class='' style='margin-top:0px;'>
            <td colspan='7' style='padding:0 15px; margin: 0;'>{$data["addon_p_name"]}</td>
        </tr>";
                        endforeach;
                    }
                    $html .= "
        <tr class='border-bottom' style='margin-top:0px;'>
            <td colspan='7' style='padding:0px;'></td>
        </tr>";
                    // Increment after using
                    $x++;
                }
                // Retrieve order shipping charges
                $order = wc_get_order($order_id); // Assuming $order_id is the order ID
                $shipping_total = $order->get_shipping_total();
                $shipping_methods = $order->get_shipping_methods();
                $billing_pvm = $order->get_meta("_billing_pvm", true);
                foreach ($order->get_items() as $item_id => $item) {
                    $product = $item->get_product();
                    $with_tax = wc_get_price_including_tax($product);
                    $without_tax = wc_get_price_excluding_tax($product);
                    $tax_amount = $with_tax - $without_tax;
                }
                $date = $order->get_meta("_jckwds_date");
                $time_slot = $order->get_meta("_jckwds_timeslot");
                $timestamp = $order->get_meta("_jckwds_timestamp");
                $cleanedTime = str_replace(["AM", "PM"], "", $time_slot);
                foreach (
                    $shipping_methods
                    as $shipping_item_id => $shipping_item
                ) {
                    $shipping_method = $shipping_item->get_method_id();
                    $shipping_cost = $shipping_item->get_total();
                    if ($shipping_cost) {
                        $shippingMethodCount++;
                        $totalShippingCost += $shipping_cost;
                    }
                }
            }
        }
    }
    $totalDealPackageWithVat = 0;
    if ($count_3 > 0) {
        $Depozitas_total = 0.1 * $count_3;
        $total_order_nine = $total_order_nine + $Depozitas_total;
        $html .=
            "
        <tr class='border-bottom'>
            <td style=''>" .
            __("Depozitas", "synergy") .
            "</td>
            <td style=''>" .
            $count_3 .
            "</td>
            <td style=''>0.10 €</td>
            <td style=''>" .
            $Depozitas_total .
            " €</td>
            <td style=''>0%</td>
            <td style=''>0 €</td>
            <td style=''>" .
            $Depozitas_total .
            " €</td>
        </tr>";
    }
    if ($count_2 > 0) {
        $Pakuote_total = 0.15 * $count_2;
        $Pakuote_amountToSubtract = $Pakuote_total - $Pakuote_total / 1.21;
        $Pakuote_total_without_vat = $Pakuote_total - $Pakuote_amountToSubtract;
        $ammount_without_vat_21 =
            $ammount_without_vat_21 + $Pakuote_amountToSubtract;
        $total_order_nine = $total_order_nine + $Pakuote_total_without_vat;
        $html .=
            "
        <tr class='border-bottom'>
            <td style=''>" .
            __("Pakuotė", "synergy") .
            "</td>
            <td style=''>" .
            $count_2 .
            "</td>
            <td style=''>" .
            number_format(0.15 / 1.21, 2) .
            " €</td>
            <td style=''>" .
            number_format($Pakuote_total_without_vat, 2) .
            " €</td>
            <td style=''>21%</td>
            <td style=''>" .
            number_format($Pakuote_amountToSubtract, 2) .
            " €</td>
            <td style=''>" .
            number_format($Pakuote_total, 2) .
            " €</td>
        </tr>";
    }
    if ($count_1 > 0) {
        $Pakuotedienospasiulymo_total = 0.3 * $count_1;
        $Pakuotedienospasiulymo_amountToSubtract =
            $Pakuotedienospasiulymo_total -
            $Pakuotedienospasiulymo_total / 1.21;
        $Pakuotedienospasiulymo_total_without_vat =
            $Pakuotedienospasiulymo_total - $Pakuote_amountToSubtract;
        $ammount_without_vat_21 =
            $ammount_without_vat_21 + $Pakuotedienospasiulymo_amountToSubtract;
        $total_order_nine =
            $total_order_nine + $Pakuotedienospasiulymo_total_without_vat;
        $html .=
            "
        <tr class='border-bottom'>
            <td style=''>" .
            __("Pakuotė (dienos pasiūlymo)", "synergy") .
            "</td>
            <td style=''>" .
            $count_1 .
            "</td>
            <td style=''>" .
            number_format(0.3 / 1.21, 2) .
            " €</td>
            <td style=''>" .
            number_format($Pakuotedienospasiulymo_total_without_vat, 2) .
            " €</td>
            <td style=''>21%</td>
            <td style=''>" .
            number_format($Pakuotedienospasiulymo_amountToSubtract, 2) .
            " €</td>
            <td style=''>" .
            number_format($Pakuotedienospasiulymo_total, 2) .
            " €</td>
        </tr>";
    }
    $totalDealPackageWithVat =
        $Pakuotedienospasiulymo_total + $Pakuote_total + $Depozitas_total;
    $total_shipping_ = $shippingMethodCount;
    $total_shipping_cost = $totalShippingCost;
    if ($total_shipping_) {
        $one_shipping_cost_ = $totalShippingCost / $shippingMethodCount;
    } else {
        $one_shipping_cost_ = $totalShippingCost;
    }
    $vat_of_one_shipping_ = $one_shipping_cost_ - $one_shipping_cost_ / 1.21;
    $one_shipping_without_vat_ = $one_shipping_cost_ - $vat_of_one_shipping_;
    $total_shipping_without_vat = $one_shipping_without_vat_ * $total_shipping_;
    $vat_of_all_shipping_ = $vat_of_one_shipping_ * $total_shipping_;
    $total_shipping_with_vat =
        $total_shipping_without_vat + $vat_of_all_shipping_;
    $ammount_without_vat_21 = $ammount_without_vat_21 + $vat_of_all_shipping_;
    $total_order_nine = $total_order_nine + $total_shipping_without_vat;
    $html .=
        "
        <tr class='border-bottom'>
            <td style=''>" .
        __("Pristatymas", "synergy") .
        "</td>
            <td style=''>{$shippingMethodCount}</td>
            <td style=''>" .
        number_format($one_shipping_without_vat_, 2) .
        " €</td>
            <td style=''>" .
        number_format($total_shipping_without_vat, 2) .
        " €</td>
            <td style=''>21%</td>
            <td style=''>" .
        number_format($vat_of_all_shipping_, 2) .
        " €</td>
            <td style=''>" .
        number_format($total_shipping_with_vat, 2) .
        " €</td>
        </tr>";
    $html .= "
    </tbody>
</table>";
    $html .= "
<table style='margin:0px auto;margin-top:40px!important;'>
    <tbody>";
    $html .=
        "
        <tr class=''>
            <td style='font-size:18px;padding:0px 30px !important;float:left;font-weight:bold;'> " .
        __("Suma be PVM Eur", "synergy") .
        "</td>
            <td style='font-size:18px;padding:0px 30px !important;float:right;font-weight:bold;'>" .
        number_format($total_order_nine - $ammount_without_vat__nine, 2) .
        "</td>
        </tr>"; // $html .= //     " //     <tr class=''> //         <td style='font-size:18px;padding:0px 30px !important;float:left;font-weight:bold;'> " . //     __("PVM 21%", "synergy") . //     "</td> //         <td style='font-size:18px;padding:0px 30px !important;float:right;font-weight:bold;'>" . //     number_format($ammount_without_vat__nine, 2) . //     "</td> //     </tr>";
    $html .=
        "
        <tr class=''>
            <td style='font-size:18px;padding:0px 30px !important;float:left;font-weight:bold;'> " .
        __("PVM 21%", "synergy") .
        "</td>
            <td style='font-size:18px;padding:0px 30px !important;float:right;font-weight:bold;'>" .
        number_format($ammount_without_vat__nine + $ammount_without_vat_21, 2) .
        "</td>
        </tr>";
    $html .= "
    </tbody>
</table>";
    $total_order = $totalValue + $total_shipping_with_vat;
    $formatted_total_ = number_format($total_order, 2, ".", "");
    $html .=
        "
<div style='margin-top:30px;margin-bottom:20px;clear:both;display:block;'>
    <div><span style='font-size:22px;padding:0px 30px !important;float:left;font-weight:bold;w'>" .
        __("MOKĖTINA SUMA", "synergy") .
        "</span>
    </div>
    <div><span style='font-size:22px;padding:0px 30px !important;float:right;font-weight:bold;'>" .
        $total_order .
        " €</span></div>
</div>



<div style='margin-top:50px;margin-bottom:20px;clear:both;display:block;'>
    <div><span style='font-size:18px;padding:0px 30px !important;float:left;font-weight:bold;'>" .
        __("Suma žodžiais:", "synergy") .
        "</span>
    </div>
    <div><span style='font-size:18px;padding:0px 30px !important;float:right;font-weight:bold;'>";
    ?>
<?php if ($currentLanguage == "lt") {
    $html .= skaicius_zodziais($formatted_total_);
} elseif ($currentLanguage == "en") {
    $html .= AmountInWords($formatted_total_);
} else {
    $html .= AmountInWordsRussian($formatted_total_);
} ?>
<?php
$html .=
    "</span></div>
</div>

<div style='margin-top:30px;margin-bottom:20px;clear:both;display:block;'>
    <div><span style='font-size:18px;padding:0px 30px !important;float:left;font-weight:bold;w'>" .
    __("Sąskaitą išrašė:", "synergy") .
    "</span>
    </div>
    <div><span style='font-size:18px;padding:0px 30px !important;float:right;font-weight:bold;'>" .
    __("UAB Jogundė", "synergy") .
    "</span></div>
</div>";
$invoice_pdf_name = __("Juridiniai_asmenys_fiksuota_PVM_saskaita", "synergy");
$filename = $invoice_pdf_name . $invoice_number . ".pdf";
$options = new Options();
$options->set("isRemoteEnabled", true);
$options->setTempDir("temp");
$options->set("defaultFont", "DejaVuSans");
$dompdf = new Dompdf($options);
$html = mb_convert_encoding($html, "HTML-ENTITIES", "UTF-8");
$dompdf->loadHtml($html);
$dompdf->setPaper("Legal", "portrait");
$dompdf->set_option("isRemoteEnabled", true);
$dompdf->render();
$output = $dompdf->output();
file_put_contents(ABSPATH . "/wp-content/uploads/pdf/" . $filename, $output);
return $filename;
}
