<?php
/*===== Kurmix - PHP =====                           _  __   www.kurmix.com   _      
* @author    Andree Ochoa <andlody@hotmail.com>     | |/ /   _ _ __ _ __ ___ (_)_  __
* @copyright 2017-2018 Andree Ochoa                 | ' / | | | '__| '_ ` _ \| \ \/ /
* @license   The MIT license                        | . \ |_| | |  | | | | | | |>  < 
* @version   1.0.0                                  |_|\_\__,_|_|  |_| |_| |_|_/_/\_\       */

class ReqRes{

	protected $view;
	protected $template;
	protected $data;

	function __construct(){
		$this->template='default';
		//	
		$this->data=new Data();
	}

	public function show(){
		if($this->view == null) return;

		$url="view/".$this->view;

		if($this->template!=null){
            $url = "view/_templates/".$this->template;
        }
		
		require("Views.php");
		$v = new Views($this->data);
		
		//============= Vista php =============
		if($this->template!=null){$v->setKurmix($this->view); }

		if(!file_exists('app/'.$url.'.php')){
			Controller::setKurmix("",array(401,$this->template,$this->view)); return;
		}

        include('app/'.$url.'.php');        
	}

	public function write($value){
 		echo $value;
 	}

 	public function setView($view){
 		$this->view = $view;
 	}

 	public function setTemplate($temp){
 		$this->template = $temp;
 	}

	public function redirect($url){
		if(trim($url)!='') 
			$url='k='.$url;
 		header("Location: ?".$url);
 	}

 	function getParameter($name){
 		if(!empty($_GET[$name])) return $_GET[$name];

 		if(!empty($_POST[$name])) return $_POST[$name];
 					
		return null;
	}

	public function setData($data1,$data2=null){
 		$this->data->setData($data1,$data2);
 	}

 	public function json(){
 		return $this->data->json();
 	}

 	public function error($a){
 		if(!Config::DEV) { 			
 			ReqRes::error404();
 		}

 		switch ($a[0]) {
 			case 101:
 				ReqRes::write("ERROR: En el Router, no existe la accion:<strong> ".$a[1]." </strong> en el controlador:<strong> ".$a[2]."</strong><br>");
 				break;
 			case 103:
 				ReqRes::write("ERROR: En el Router, no existe el controlador:<strong> ".$a[1]."</strong><br>");
 				break;
 			case 201:
                ReqRes::write("ERROR: En el controlador al instanciar el modelo:<strong> ".$a[1]."</strong> - Posiblemente no existe.<br>");
                break;
            case 202:
                ReqRes::write("ERROR: En el controlador al instanciar la libreria:<strong> ".$a[1]."</strong> - Posiblemente no existe.<br>");
                break;
            case 301:
                ReqRes::write("ERROR: En el modelo, al realizar la consulta:<strong> ".$a[1]." </strong>.<br>".$a[2]."<br>");
                break;
            case 306:
                ReqRes::write("ERROR: En el modelo al llamar:<strong> ".$a[1]."</strong><br>".$a[2]."<br>");
                break;
            case 401:
                ReqRes::write("ERROR: En la vista, Template:<strong> ".$a[1]." </strong> | Vista: <strong>".$a[2]."</strong><br>");
                break;
            case 402:
                ReqRes::write("ERROR: En la vista, al llamar a: <strong> ".$a[1]." </strong> - Posiblemente no existe la vista.<br>");
                break;            
 		}
 		die();
 	}

 	public function error404(){
 		$r = new ReqRes();
 		$r->setTemplate(null);
 		$r->setView("_templates/_404");
 		$r->show(); 
 		die();
 	}
}