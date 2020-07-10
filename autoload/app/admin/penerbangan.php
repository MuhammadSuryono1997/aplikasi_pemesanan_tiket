<?php 
namespace admin;
/**
 * 
 */
use app\Server;
use admin\Maskapai;
use admin\AirPort;

class Penerbangan extends Jadwal
{

	public function main_menu()
    {
        echo "\nMenu Admin";
        echo "\n========================";
        echo "\n1. Data Maskapai";
        echo "\n2. Data Airport";
        echo "\n3. Jadwal Penerbangan";
        echo "\nMasukkan Nomor : ";
        $userInput1 = trim(fgets(STDIN));
        return $userInput1;
    }

    public function menu_data_maskapai()
    {
        $maskapai = new Maskapai();
        return $maskapai->menu_maskapai();
    }

    public function menu_data_airport()
    {
        $bandara = new AirPort();
        return $bandara->menu_airport();
    }

    public function menu_jadwal_penerbangan(){
        echo "\nMenu Jadwal Penerbangan";
        echo "\n========================";
        echo "\n1. Create Jadwal Penerbangan";
        echo "\n2. Update Jadwal Penerbangan";
        echo "\n3. Delete Jadwal Penerbangan";
        echo "\nMasukkan Nomor : ";
        $userInput1 = trim(fgets(STDIN));
        if($userInput1 == "1"){
            $this->create_data_maskapai();
        }elseif($userInput1 == "2"){
            $this->update_data_maskapai();
        }elseif($userInput1 == "3"){
            $this->delete_data_maskapai();
        }else{
            echo "Masukkan Nomor Menu Dengan Benar!";
        }
        
    }


    public function create_data_maskapai(Server $server)
    {
        $maskapai = new Maskapai();
        return $maskapai->create_maskapai($server);

    }

    public function update_data_maskapai(Server $server){
        $maskapai = new Maskapai();
        return $maskapai->update_maskapai($server);
    }

    public function delete_data_maskapai(Server $server){
        $maskapai = new Maskapai();
        return $maskapai->delete_maskapai($server);
    }

    public function create_data_airport(Server $server)
    {
        $bandara = new AirPort();
        return $bandara->create_airport($server);
    }

    public function update_data_airport(Server $server)
    {
        $bandara = new AirPort();
        return $bandara->update_airport($server);
    }

    public function delete_data_airport(Server $server)
    {
        $bandara = new AirPort();
        return $bandara->delete_airport($server);
    }
}

 ?>