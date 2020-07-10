<?php 
namespace admin;

/**
 * 
 */
use admin\Maskapai;
class Jadwal
{
	public $maskapai;
	function __construct()
	{
		$this->maskapai = new Maskapai();
	}
}

 ?>