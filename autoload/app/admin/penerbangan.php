<?php 
namespace admin;
/**
 * 
 */
class Penerbangan extends Jadwal
{
	
	function __construct()
	{
		# code...
	}

	public function main_menu(){
        echo "\nMenu Admin";
        echo "\n========================";
        echo "\n1. Data Maskapai";
        echo "\n2. Data Airport";
        echo "\n3. Jadwal Penerbangan";
        echo "\nMasukkan Nomor : ";
        $userInput1 = trim(fgets(STDIN));
        if($userInput1 == "1"){
            $this->menu_data_maskapai();
        }elseif($userInput1 == "2"){
            $this->menu_data_airport();
        }elseif($userInput1 == "3"){
            $this->menu_jadwal_penerbangan();
        }else{
            echo "Masukkan Nomor Menu Dengan Benar!";
        }
    }
}

 ?>