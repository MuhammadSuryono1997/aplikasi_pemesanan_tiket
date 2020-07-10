<?php 
namespace customer;

use app\Server;
/**
 * 
 */
class Customer
{
	protected $users,$koneksi;
	function __construct($user, Server $server)
	{
		$this->users = $user;
		$this->koneksi = $server;
		$this->form_menu_utama();
	}

	public function form_menu_utama()
	{
		echo "\nPilih Menu dibawah ini";
        echo "\n========================";
        echo "\n1. Jadwal Penerbangan";
        echo "\n2. Pemesanan Tiket";
        echo "\nMasukkan Nomor : ";
        $userInput1 = trim(fgets(STDIN));
        if($userInput1 == "1"){
            $this->flight_schedule();
        }elseif($userInput1 == "2"){
            $this->booking_ticket();
        }else{
            echo "Masukkan Nomor Menu Dengan Benar!";
        }
	}

	public function flight_schedule(){
		$flightSchedule = $this->koneksi->get_data_penerbangan();
        for ($i=0; $i<count($flightSchedule); $i++){
            echo "========================";
            echo "\nMaskapai : ".$flightSchedule[$i]['flight'];
            echo "\nKode Penerbangan : ".$flightSchedule[$i]['flight_code'];
            echo "\nKelas Penerbangan : ".$flightSchedule[$i]['flight_class'];
            echo "\nRute Penerbangan : ".$flightSchedule[$i]['flight_route'];
            echo "\nTanggal Penerbangan : ".$flightSchedule[$i]['flight_date']. "||".$flightSchedule[$i]['flight_datetime'];
            echo "\nTransit  : ".$flightSchedule[$i]['flight_transit'];
            echo "\nJadwal Transit : ".$flightSchedule[$i]['flight_infotransit'];
            echo "\nHarga : Rp.".$flightSchedule[$i]['flight_price'];
            echo "\n========================";
    
        }
        echo "\n";
        echo "Kembali ke menuu utama?(Y/n) : ";
        $userInput2 = trim(fgets(STDIN));
        if(strtolower($userInput2) == "y" ){
            $this->form_menu_utama();
        }elseif(strtolower($userInput2) == "n"){
            $this->flight_schedule();
        }else{
            echo "Masukkan huruf 'y' atau 'n' saja!";
        }
    }

    public function booking_ticket(){
        $transactionData = array();
        $flightSchedule = $this->koneksi->get_data_penerbangan();
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

        $this->get_filter_jadwal($transactionData);
    }

    public function get_filter_jadwal($data)
    {
    	$data = array_filter($this->koneksi->get_data_penerbangan(), function($value) use($data){return $value['flight_from'] == $data["kota_asal"] and $value['flight_to'] == $data["kota_tujuan"] and $value['flight_date'] == $data["tanggal_pergi"] and $value['flight_class'] == $data["kelas_penerbangan"];});

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

	        array_splice($this->users, 1);
	        echo "NAMA LENGKAP			: ".$this->users[0]['nama_lengkap'];
	        echo "\n";
	        echo "EMAIL				: ".$this->users[0]['email'];
	        echo "\n";
	        echo "NOMOR TELEPON			: ".$this->users[0]['telp'];
	        echo "\n";
	        echo "ALAMAT				: ".$this->users[0]['alamat'];
	        echo "\n";
	        echo "\n";
	        echo "\n";
	        echo "=============== DATA BOOKING ====================";
	        $checkPilihan[0]['kode_booking'] = "HA-".time();
	        $data = $checkPilihan;
	        print_r($data);
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
	        $merge = [array_merge($checkPilihan[0],$this->users[0])];
	        $merge = json_encode($merge,JSON_PRETTY_PRINT);
	        if(file_put_contents("Data Pemesanan.json", $merge))
	        {
	        	echo "Booking anda telah berhasil dibuat!";
	        }
        }
        else
        {
        	echo "ERROR!";
        }
    }
}
 ?>