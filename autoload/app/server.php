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
		$data = json_decode($data);
		return $data;
	}
}

 ?>