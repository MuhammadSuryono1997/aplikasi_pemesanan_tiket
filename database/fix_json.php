<?php 
// $code_area = file_get_contents("code_area.json");
// $fix_code_area = json_decode($code_area, true);

// $flights_per_maskapai = file_get_contents("flights_per_maskapai.json");
// $fix_flights_per_maskapai = json_decode($flights_per_maskapai, true);

$code_maskapai = file_get_contents("code_maskapai.json");
$fix_code_maskapai = json_decode($code_maskapai, true);

// $code_flights_dom_or_inter = file_get_contents("code_flights_dom_or_inter.json");
// $fix_code_flights_dom_or_inter = json_decode($code_flights_dom_or_inter, true);

// $fix1 = json_encode($fix_code_area, JSON_PRETTY_PRINT);
// file_put_contents("code_area.json",$fix1);

// $fix2 = json_encode($fix_code_flights, JSON_PRETTY_PRINT);
// file_put_contents("code_flights.json",$fix2);

$fix3 = json_encode($fix_code_maskapai, JSON_PRETTY_PRINT);
file_put_contents("code_maskapai.json",$fix3);

// $fix4 = json_encode($fix_code_flights_dom_or_inter, JSON_PRETTY_PRINT);
// file_put_contents("code_flights_dom_or_inter.json",$fix4);
// $fix_code_flights_dom_or_inter = null;

// print_r($fix_code_flights_dom_or_inter);

?>