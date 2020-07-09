<?php 
require_once("autoload/init.php");
use app\Login as login;
use app\Server as connection;

$login = new login();
// $login->check_login('{"Nama": "Saya"}');
$koneksi = new connection();
print_r($koneksi->get_data_users());
 ?>