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
		$data_user = array();
		echo "\nSelamat Datang di Aplikasi Terserah lahhh";
		echo "\n===========================================";
		echo "\nUsername : ";
		$username = trim(fgets(STDIN));
		// array_push($data_user['username'], $username);
		$data_user['username'] = $username;
		echo "\nPassword : ";
		$password = trim(fgets(STDIN));
		$data_user['password'] = $password;
		// array_push($data_user['password'], $password);
		print_r($data_user);
	}
}

 ?>