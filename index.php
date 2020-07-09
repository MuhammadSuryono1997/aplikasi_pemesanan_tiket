<?php 
require_once("autoload/init.php");
use app\Login as login;
use app\Server as connection;

$login = new login(new connection());

?>