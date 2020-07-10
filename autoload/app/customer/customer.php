<?php 
namespace customer;

use app\Server;
use customer\Booking;
use customer\Schedule;
/**
 * 
 */
class Customer implements jadwal_penerbangan
{
	protected $users,$koneksi,$booking,$schedule;
	function __construct($user, Server $server)
	{
		$this->users = $user;
		$this->koneksi = $server;
        $this->booking = new Booking();
        $this->schedule = new Schedule();
		// $this->form_menu_utama();
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
            return "jadwal";
        }elseif($userInput1 == "2"){
            return "booking";
        }
	}

	public function flight_schedule()
    {
		return $this->schedule->flight_schedule($this->koneksi);
    }

    public function booking_ticket()
    {
        return $this->booking->booking_ticket($this->koneksi, $this->users); 
    }
}
 ?>