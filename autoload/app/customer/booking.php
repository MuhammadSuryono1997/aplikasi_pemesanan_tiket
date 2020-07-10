<?php 
namespace customer;
/**
 * 
 */
class Booking
{
	public function booking_ticket($koneksi,$users){
        $transactionData = array();
        $flightSchedule = $koneksi->get_data("database/code_flights_dom_or_inter.json");
        echo "=====Menu Booking Ticket======";

        echo "\nPilih Kota Asal";
        $count = 1;
        for ($i=0; $i<count($flightSchedule); $i++){
            echo "\n$count. ".$flightSchedule[$i]['flight_from'];
            $count++;
        }
        echo "\nKota Asal : ";
        $inputKotaAsal = trim(fgets(STDIN));
        for ($i=0; $i<count($flightSchedule); $i++){
            if ($inputKotaAsal-1 == $i) 
            {
            	$transactionData['kota_asal'] = $flightSchedule[$i]['flight_from'];
            }
        }
        
        echo "========================";

        echo "\nPilih Kota Tujuan";
        $count = 1;
        for ($i=0; $i<count($flightSchedule); $i++){
            echo "\n$count. ".$flightSchedule[$i]['flight_to'];
            $count++;
        }
        echo "\nKota Tujuan : ";
        $inputKotaTujuan = trim(fgets(STDIN));
        for ($i=0; $i<count($flightSchedule); $i++){
            if ($inputKotaAsal-1 == $i) 
            {
            	$transactionData['kota_tujuan'] = $flightSchedule[$i]['flight_to'];
            }
        }
        echo "========================";

        echo "\nMasukkan Tanggal Pergi (Example : 2020-01-01) : ";
        $inputTglPergi = trim(fgets(STDIN));
        $transactionData['tanggal_pergi'] = $inputTglPergi;
        echo "========================";

        $count = 1;
        for ($i=0; $i<count($flightSchedule); $i++){
            echo "\n$count. ".$flightSchedule[$i]['flight_class'];
            $count++;
        }
        echo "\nKelas Penerbangan : ";
        $inputKlsPenerbangan = trim(fgets(STDIN));
        for ($i=0; $i<count($flightSchedule); $i++){
            if ($inputKotaAsal-1 == $i) 
            {
            	$transactionData['kelas_penerbangan'] = $flightSchedule[$i]['flight_class'];
            }
        }

        $this->get_filter_jadwal($transactionData,$koneksi,$users);
    }

    public function get_filter_jadwal($data,$koneksi,$users)
    {
    	$data = array_filter($koneksi->get_data("database/code_flights_dom_or_inter.json"), function($value) use($data){return $value['flight_from'] == $data["kota_asal"] and $value['flight_to'] == $data["kota_tujuan"] and $value['flight_date'] == $data["tanggal_pergi"] and $value['flight_class'] == $data["kelas_penerbangan"];});

    	$urutan = 1;
    	for ($i=0; $i<count($data); $i++){
            echo "========================";
            echo "\n |  |Maskapai : ".$data[$i]['flight'];
            echo "\n |  |Kode Penerbangan : ".$data[$i]['flight_code'];
            echo "\n |  |Kelas Penerbangan : ".$data[$i]['flight_class'];
            echo "\n |".$urutan++." |Rute Penerbangan : ".$data[$i]['flight_route'];
            echo "\n |  |Tanggal Penerbangan : ".$data[$i]['flight_date']. "||".$data[$i]['flight_datetime'];
            echo "\n |  |Transit  : ".$data[$i]['flight_transit'];
            echo "\n |  |Jadwal Transit : ".$data[$i]['flight_infotransit'];
            echo "\n |  |Harga : Rp.".$data[$i]['flight_price'];
            echo "\n========================";
        }

        echo "\nMasukkan kode penerbangan untuk booking : ";
        $inputKode = trim(fgets(STDIN));
        echo "\n";
        
        $checkPilihan = array_filter($data, function($v) use($inputKode){return $v['flight_code'] == $inputKode;});
        if (count($checkPilihan)>0) 
        {
        	echo "\nKonfirmasi data pribadi : ";
	        echo "\n";

	        array_splice($users, 1);
	        echo "NAMA LENGKAP			: ".$users[0]['nama_lengkap'];
	        echo "\n";
	        echo "EMAIL				: ".$users[0]['email'];
	        echo "\n";
	        echo "NOMOR TELEPON			: ".$users[0]['telp'];
	        echo "\n";
	        echo "ALAMAT				: ".$users[0]['alamat'];
	        echo "\n";
	        echo "\n";
	        echo "\n";
	        echo "=============== DATA BOOKING ====================";
	        $checkPilihan[0]['kode_booking'] = "HA-".time();
	        $data = $checkPilihan;
	        // print_r($data);
	        // for ($i=0; $i<count($data); $i++){
	            echo "========================";
	            echo "\n |  |Kode Booking 		: ".$data[0]['kode_booking'];
	            echo "\n |  |Maskapai 			: ".$data[0]['flight'];
	            echo "\n |  |Kode Penerbangan 		: ".$data[0]['flight_code'];
	            echo "\n |  |Kelas Penerbangan 		: ".$data[0]['flight_class'];
	            echo "\n |  |Rute Penerbangan 		: ".$data[0]['flight_route'];
	            echo "\n |  |Tanggal Penerbangan 	: ".$data[0]['flight_date']. "||".$data[0]['flight_datetime'];
	            echo "\n |  |Transit  				: ".$data[0]['flight_transit'];
	            echo "\n |  |Jadwal Transit 	: ".$data[0]['flight_infotransit'];
	            echo "\n |  |Harga 			: Rp.".$data[0]['flight_price'];
	            echo "\n========================";
	        // }
	        $merge = [array_merge($checkPilihan[0],$users[0])];
	        $merge = json_encode($merge,JSON_PRETTY_PRINT);
	        if(file_put_contents("Data Pemesanan.json", $merge))
	        {
	        	echo "Booking anda telah berhasil dibuat!";
                echo "\n";
                echo "\n";
                echo "\nApakah anda ingin kembali ke menu utama ?(y/n) : ";
                $inputKembali = trim(fgets(STDIN));
                if(strtolower($inputKembali) == "y" ){
                    return "Ya";
                }elseif(strtolower($inputKembali) == "n"){
                    return "Tidak";
                }
	        }
        }
        else
        {
        	echo "ERROR!";
        }
    }
}

 ?>