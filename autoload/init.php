<?php 
	spl_autoload_register(function($class){
	    $class = explode("\\", $class);
	    $cek = end($class);
	    if (file_exists(__DIR__."/app/".$cek.".php")) 
	    {
	    	require_once __DIR__."/app/".$cek.".php";
	    }
	    else
	    {
	    	require_once __DIR__."/app/".$class[0]."/".$class[1].".php";
	    }
	});
 ?>