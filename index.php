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
                                    $this->result_login(new Admin($checkLogin, new connection()));
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
                                    $this->result_login(new Admin($checkLogin, new connection()));
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

    function result_login($res)
    {
    	if($res->menu_utama() == "1"){
    		
    		$nilai = $res->menu_data_maskapai();
    		if ($nilai == "1") 
    		{
    			if ($res->create_data_maskapai(new connection()) == true) 
    			{
    				echo "\n Penambahan data berhasil!";
    				$this->result_login($res);
    			}
    			else
    			{
    				echo "\n Gagal ditambahkan!";
    			}
    		}
    		elseif ($nilai == "2") 
    		{
    			if ($res->update_data_maskapai(new connection()) == true) 
    			{
    				echo "\n Data berhasil di ubah!";
    				$this->result_login($res);
    			}
    			else
    			{
    				echo "\n Gagal diubah!";
    			}
    		}
    		elseif ($nilai == "3")
    		{
    			if ($res->delete_data_maskapai(new connection()) == true) 
    			{
    				echo "\n Data berhasil di hapus!";
    				$this->result_login($res);
    			}
    			else
    			{
    				echo "\n Gagal dihapus!";
    			}
    		}
        }
        elseif($res->menu_utama() == "2")
        {
            $value = $res->menu_data_airport();
            if ($value == "create") 
            {
            	switch ($res->create_data_airport(new connection())) {
            		case 'true':
            			echo "Data berhasil ditambahkan";
    					$this->result_login($res);
            			break;
            		
            		default:
            			echo "Terjadi kesalahan ketika menambahkan!";
            			$this->result_login($res);
            			break;
            	}
            }
            elseif ($value == "update") 
            {
            	switch ($res->update_data_airport(new connection())) {
            		case 'true':
            			echo "Data berhasil diubah";
    					$this->result_login($res);
            			break;
            		
            		default:
            			$this->result_login($res);
            			break;
            	}
            }
            elseif ($value == "delete") 
            {
            	switch ($res->delete_data_airport(new connection())) {
            		case 'true':
            			echo "Data berhasil dihapus";
    					$this->result_login($res);
            			break;
            		
            		default:
            			echo "Terjadi kesalahan ketika menghapus data!";
            			$this->result_login($res);
            			break;
            	}
            }

        }elseif($res->menu_utama() == "3"){
            // $this->menu_jadwal_penerbangan();
        }
    }
}

new Main();

?>