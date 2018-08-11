<?php
/*===== Kurmix - PHP =====                           _  __   www.kurmix.com   _      
* @author    Andree Ochoa <andlody@hotmail.com>     | |/ /   _ _ __ _ __ ___ (_)_  __
* @copyright 2017-2018 Andree Ochoa                 | ' / | | | '__| '_ ` _ \| \ \/ /
* @license   The MIT license                        | . \ |_| | |  | | | | | | |>  < 
* @version   1.0.0                                  |_|\_\__,_|_|  |_| |_| |_|_/_/\_\       */

class Router 
{
	static function main()
	{
		require '_libs/kurmix/Controller.php';
		require '_libs/kurmix/Model.php';
		
		$controller = 'index';
		$accion = 'index';

		if(!empty($_GET['k'])){
			$a = explode('/',$_GET['k']);
			
			if(sizeof($a)>0) $controller = $a[0];
				
			if(sizeof($a)>1) $accion = $a[1];
		}

		require('app/_config/Config.php');
		require('_libs/kurmix/ReqRes.php');
		require("_libs/kurmix/Data.php");	

		if (!file_exists ('app/controller/'.$controller.'_controller.php')) {
			Controller::setKurmix("",array(103,$controller));
		}
		
		require ('app/controller/'.$controller.'_controller.php');
		$controlador_class = $controller.'_controller';
		$controler = new $controlador_class();
		
		if (!method_exists($controler,$accion)){
			Controller::setKurmix("",array(101,$accion,$controller));
		} 	

		$rf = new ReflectionMethod($controlador_class, $accion);
		$n = $rf->getNumberOfParameters();        

		$params = array();
		$j=2;
        for ($i = 0; $i < $n; $i++) {   
            $params[$i] = ($j<sizeof($a))?$a[$j]:"";  
            $j++;
        }

        if($controller == 'index') 
        	$controler->start();
        else{
        	require ('app/controller/index_controller.php');
			$controler2 = new index_controller($controler->setKurmix(1,1,1));
			$controler2->start();
        }

        $controler->before(); 

		call_user_func_array(array($controler, $accion), $params);
		$controler->setKurmix($controller.'/'.$accion); 

		$controler->after(); 

		if($controller == 'index') 
        	$controler->finish();
        else
			$controler2->finish();
	}
}