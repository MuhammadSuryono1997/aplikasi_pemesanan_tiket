<?php 
namespace customer;
/**
 * 
 */
class Customer
{
	protected $users;
	function __construct($user)
	{
		$this->users = $user;
		print_r($this->users);
	}
}

 ?>