<?php
/*===== Kurmix - PHP =====                           _  __   www.kurmix.com   _      
* @author    Andree Ochoa <andlody@hotmail.com>     | |/ /   _ _ __ _ __ ___ (_)_  __
* @copyright 2017-2018 Andree Ochoa                 | ' / | | | '__| '_ ` _ \| \ \/ /
* @license   The MIT license                        | . \ |_| | |  | | | | | | |>  < 
* @version   1.0.0                                  |_|\_\__,_|_|  |_| |_| |_|_/_/\_\       */

class Controller {
		
	protected $vista;
	protected $band;
	
    function __construct($rqrs=null){
    	if($rqrs==null)
        	$this->reqres = new ReqRes();
        else
        	$this->reqres = $rqrs;
        $this->band = true;
    }

	function index(){}

	function start(){}
	function before(){}
	function after(){}
	function finish(){}
    
    function setKurmix($view,$a = null,$b=null){
    	if($b!=null) return $this->reqres;
    	if($a!=null){
    		ReqRes::error($a);
    		return;
    	}
    	if($this->band) $this->reqres->setView($view);
        $this->reqres->show();
    }

	function view($view,$temp = ''){
    	$this->reqres->setView($view);
    	$this->band = false;
    	if($temp !== '') $this->template($temp);
    }

    function template($temp){
    	$this->reqres->setTemplate($temp);
    }

	function write($value){
		$this->reqres->write($value);
		$this->view(null);
	}

	function redirect($url){
		$this->reqres->redirect($url);
	}

	function session($name,$value=null){
		if (session_status() == PHP_SESSION_NONE) session_start();
		
		if($name===null) {session_destroy(); return;}
		
		if($value===null) return @$_SESSION[$name];
		
		$_SESSION[$name] = $value;
	}

	function parameter($name){
		return $this->reqres->getParameter($name);
	}

	function model($model){
		if (!file_exists ('app/model/'.$model.'.php')){ 
			Controller::setKurmix("",array(201,$model));
		}
		require ('app/model/'.$model.'.php');
		return new $model();
	}

	function lib($lib){
		if (!file_exists ('_libs/kurmix/'.$lib.'.php')){ 
			Controller::setKurmix("",array(202,$lib));
		}
		require ('_libs/kurmix/'.$lib.'.php');
		return new $lib();
	}

	function set($dat1,$dat2=null){
		$this->reqres->setData($dat1,$dat2);
	}

	function isNumeric($val){
    	return Model::isNumeric($val);
    }

    function isInteger($val){
    	return Model::isInteger($val);
    } 

    function json(){
    	return $this->reqres->json();
    } 
}