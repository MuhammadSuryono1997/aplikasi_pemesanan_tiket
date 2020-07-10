<?php 
namespace customer;
/**
 * 
 */
class Schedule
{
	public function flight_schedule($koneksi)
	{
		$flightSchedule = $koneksi->get_data("database/code_flights_dom_or_inter.json");
        $no = 1;
        for ($i=0; $i<count($flightSchedule); $i++){
            echo "=============================================";
            echo "\n |    |Maskapai : ".$flightSchedule[$i]['flight'];
            echo "\n |    |Kode Penerbangan : ".$flightSchedule[$i]['flight_code'];
            echo "\n |    |Kelas Penerbangan : ".$flightSchedule[$i]['flight_class'];
            echo "\n |".$no++."|Rute Penerbangan : ".$flightSchedule[$i]['flight_route'];
            echo "\n |    |Tanggal Penerbangan : ".$flightSchedule[$i]['flight_date']. "||".$flightSchedule[$i]['flight_datetime'];
            echo "\n |    |Transit  : ".$flightSchedule[$i]['flight_transit'];
            echo "\n |    |Jadwal Transit : ".$flightSchedule[$i]['flight_infotransit'];
            echo "\n |    |Harga : Rp.".$flightSchedule[$i]['flight_price'];
            echo "\n===========================================";
    
        }
        echo "\n";
        echo "Kembali ke menuu utama?(Y/n) : ";
        $userInput2 = trim(fgets(STDIN));
        if(strtolower($userInput2) == "y" ){
            return "Ya";
        }elseif(strtolower($userInput2) == "n"){
            return "Tidak";
        }
	}
}
 ?>