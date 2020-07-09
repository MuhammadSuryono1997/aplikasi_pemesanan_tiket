<?php 
namespace admin;
/**
 * 
 */
class Admin
{
	protected $users;
	function __construct($user)
	{
		$this->users = $user;
		print_r($this->users);
	}
}

 ?>