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
		$this->main_menu();
	}

	
}

 ?>