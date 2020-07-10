<?php 
namespace app;
/**
 * 
 */
class Server
{
	public function get_data($url)
	{
		$data = file_get_contents($url);
		$data = json_decode($data, true);
		return $data;
	}
}

 ?>