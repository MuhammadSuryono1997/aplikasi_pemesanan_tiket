<?php 
require_once("autoload/init.php");
use app\Login as login;
use app\Server as connection;

$login = new login();
// $login->check_login('{"Nama": "Saya"}');
$koneksi = new connection();
// print_r($koneksi->get_data_users());

$data_user = array();
echo "\nSelamat Datang di Aplikasi Terserah lahhh";
echo "\n===========================================";
echo "\nUsername : ";
$username = trim(fgets(STDIN));
// array_push($data_user['username'], $username);
$data_user['username'] = $username;
echo "\nPassword : ";
$password = trim(fgets(STDIN));
$data_user['password'] = $password;
// array_push($data_user['password'], $password);
print_r($data_user);
// echo "\n".$username;
// echo "\n".$password;

 ?>