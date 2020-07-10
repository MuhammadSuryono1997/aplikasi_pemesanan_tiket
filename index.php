<?php 
require_once("autoload/init.php");
use app\Login as login;
use app\Server as connection;
use customer\Customer;
use admin\Admin;

/**
 * 
 */
class Main
{
    public $login;
    function __construct()
    {
        $this->login = new login(new connection());
        $this->form_login($this->login->form_login());
    }

    function form_login($form)
    {
        if (count($form)>0) 
        {
            $checkLogin = $this->login->check_login($form);
            if (count($checkLogin) > 0) 
            {
                        for ($i=0; $i < count($checkLogin) ; $i++) 
                        { 
                            if (array_key_exists($i, $checkLogin)) 
                            {
                                if ($checkLogin[$i]['hak_akses'] == "admin") 
                                {
                                    new Admin($checkLogin, new connection());
                                }
                                elseif ($checkLogin[$i]['hak_akses'] == "customer") 
                                {
                                    new Customer($checkLogin, new connection());
                                }
                                
                            }
                            else
                            {
                                if ($checkLogin[$i+1]['hak_akses'] == "admin") 
                                {
                                    new Admin($checkLogin, new connection());
                                }
                                elseif ($checkLogin[$i+1]['hak_akses'] == "customer") 
                                {
                                    new Customer($checkLogin, new connection());
                                }
                            }
                        }
            }
        }
    }
}

new Main();

?>