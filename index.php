<?php 
require_once("autoload/init.php");
use app\Login as login;
use app\Server as connection;

// $login = new login(new connection());
// // $login->check_login('{"Nama": "saya"}');
class first{
    public $flightJson;
    public $flightSchedule;
    function __construct()
    {
        $this->flightJson = file_get_contents("database/code_flights_dom_or_inter.json");
        $this->flightSchedule = json_decode($this->flightJson, true);
        $this->main_menu();
        $this->schedule();
        $this->bookingTicket();
    }
    function main_menu(){
        echo "\nPilih Menu dibawah ini";
        echo "\n========================";
        echo "\n1. Jadwal Penerbangan";
        echo "\n2. Pemesanan Tiket";
        echo "\nMasukkan Nomor : ";
        $userInput1 = trim(fgets(STDIN));
        if($userInput1 == "1"){
            $this->schedule();
        }elseif($userInput1 == "2"){
            $this->bookingTicket();
        }else{
            echo "Masukkan Nomor Menu Dengan Benar!";
        }
    }
    
    function schedule(){
        for ($i=0; $i<count($this->flightSchedule); $i++){
            echo "========================";
            echo "\nMaskapai : ".$this->flightSchedule[$i]['flight'];
            echo "\nKode Penerbangan : ".$this->flightSchedule[$i]['flight_code'];
            echo "\nKelas Penerbangan : ".$this->flightSchedule[$i]['flight_class'];
            echo "\nRute Penerbangan : ".$this->flightSchedule[$i]['flight_route'];
            echo "\nTanggal Penerbangan : ".$this->flightSchedule[$i]['flight_date']. "||".$this->flightSchedule[$i]['flight_datetime'];
            echo "\nTransit  : ".$this->flightSchedule[$i]['flight_transit'];
            echo "\nJadwal Transit : ".$this->flightSchedule[$i]['flight_infotransit'];
            echo "\nHarga : Rp.".$this->flightSchedule[$i]['flight_price'];
            echo "\n========================";
    
        }
        echo "\n";
        echo "Kembali ke menu utama?(Y/n) : ";
        $userInput2 = trim(fgets(STDIN));
        if(strtolower($userInput2) == "y" ){
            $this->main_menu();
        }elseif(strtolower($userInput2) == "n"){
            $this->schedule();
        }else{
            echo "Masukkan huruf 'y' atau 'n' saja!";
        }
    }
    function bookingTicket(){
        $transactionData = array();
        echo "=====Menu Booking Ticket======";

        echo "\nPilih Kota Asal";
        $count = 1;
        for ($i=0; $i<count($this->flightSchedule); $i++){
            echo "\n$count. ".$this->flightSchedule[$i]['flight_from'];
            $count++;
        }
        echo "\nKota Asal : ";
        $inputKotaAsal = trim(fgets(STDIN));
        $transactionData['kota_asal'] = $inputKotaAsal;
        // for ($i=0; $i<count($this->flightSchedule); $i++){
        //     $transactionData['kota_asal'] = $inputKotaAsal - $i;
        // }
        // echo "========================";

        // echo "\nPilih Kota Tujuan";
        // $count = 1;
        // for ($i=0; $i<count($this->flightSchedule); $i++){
        //     echo "\n$count. ".$this->flightSchedule[$i]['flight_to'];
        //     $count++;
        // }
        // echo "\nKota Tujuan : ";
        // $inputKotaTujuan = trim(fgets(STDIN));
        // $transactionData['kota tujuan'] = $count - $i;
        // echo "========================";

        // echo "\nMasukkan Tanggal Pergi (Example : 11-07-2020) : ";
        // $inputTglPergi = trim(fgets(STDIN));
        // $transactionData['tanggal pergi'] = $inputTglPergi;
        // echo "========================";

        // $count = 1;
        // for ($i=0; $i<count($this->flightSchedule); $i++){
        //     echo "\n$count. ".$this->flightSchedule[$i]['flight_class'];
        //     $count++;
        // }
        // echo "\nKelas Penerbangan : ";
        // $inputKlsPenerbangan = trim(fgets(STDIN));
        // $transactionData['kelas penerbangan'] = $inputKlsPenerbangan;

        print_r($transactionData);
    }
}
$first = new first();

?>