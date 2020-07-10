<?php 
namespace admin;
/**
 * 
 */
class Admin extends Penerbangan
{
	protected $users;
	function __construct($user)
	{
		$this->users = $user;
	}

	function menu_utama()
	{
		return $this->main_menu();
	}

	
}

 ?>