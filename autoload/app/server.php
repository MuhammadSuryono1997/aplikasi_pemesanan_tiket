<?php 
namespace app;
/**
 * 
 */
class Server
{
	
	function __construct()
	{
		
	}

	public function get_data_users()
	{
		$data = file_get_contents("database/users.json");
		$data = json_decode($data, true);
		return $data;
	}

	public function get_data_penerbangan()
	{
		$data = file_get_contents("database/code_flights_dom_or_inter.json");
		$data = json_decode($data, true);
		return $data;
	}
}

 ?>