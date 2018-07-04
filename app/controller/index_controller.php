<?php

class index_controller extends Controller
{ 
	function index(){
	}

	function hola(){
		$this->template("esmeralda");
		$this->set("Hola Andree..! ");
	}

	function enviar_datos_vista(){
		$this->set("num",123456);
		$this->set("name","Andree Ochoa");
		$this->set("mail","aochoa@kurmix.org");
		$this->set("json", $this->json());
	}

	function otra_plantilla(){
		$this->view("index/index");
		$this->template("esmeralda");
	}
}


