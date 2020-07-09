<?php 
namespace app;
use app\Server;
/**
 * 
 */
class Login
{
	protected $koneksi;
	function __construct(Server $server)
	{
		$this->koneksi = $server;
		$this->form_login();
	}

	public function check_login($dataLogin)
	{
		if (count($dataLogin) > 0) 
		{
			print_r($dataLogin);
		}
	}

	public function form_login()
	{
		$this->check_login('{"nama": "saya"}');
	}
}

 ?>