<?php 
namespace app;
/**
 * 
 */
class Login
{
	protected $koneksi;
	function __construct(Server $server)
	{
		$this->koneksi = $server;
		// $this->form_login();
	}

	public function check_login($dataLogin)
	{
		if (count($dataLogin) > 0) 
		{
			$checkLogin = array_filter($this->koneksi->get_data_users(), function($v) use($dataLogin) {return $dataLogin['username'] == $v['username'] and $dataLogin['password'] == $v['password']; });

			if (count($checkLogin) > 0) 
			{
				return $checkLogin;
			}
			else
			{
				echo "Username atau password tidak ditemukan!\n";
				echo "=========================================================";
				echo "\n";
				$this->form_login();
			}
		}
	}

	public function form_login()
	{
		$dataUser = array();
		echo "\nSelamat Datang di Aplikasi Terserah lahhh";
		echo "\n===========================================";
		echo "\nUsername : ";
		$username = trim(fgets(STDIN));
		$dataUser['username'] = $username;
		echo "\nPassword : ";
		$password = trim(fgets(STDIN));
		$dataUser['password'] = $password;

		return $dataUser;

	}
}

 ?>