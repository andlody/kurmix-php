<?php
/*===== Kurmix - PHP =====                           _  __   www.kurmix.com   _      
* @author    Andree Ochoa <andlody@hotmail.com>     | |/ /   _ _ __ _ __ ___ (_)_  __
* @copyright 2017-2018 Andree Ochoa                 | ' / | | | '__| '_ ` _ \| \ \/ /
* @license   The MIT license                        | . \ |_| | |  | | | | | | |>  < 
* @version   1.0.0                                  |_|\_\__,_|_|  |_| |_| |_|_/_/\_\       */

class Views {
    protected   $data;
    public      $controller;
    public      $action;
    public      $body;
    
    function __construct($data){
        $this->data = $data;
    }

    function get($val=null){
        return $this->data->get($val);
    }

    function set($name,$value){
        return $this->data->set($name,$value);
    }

    function size($val=null){
        return $this->data->size($val);
    }

    function partial($val){
        return "app/view/_partials/".$val.".php";
    }

    function setKurmix($val){
            $this->body="app/view/".$val.".php";
            if(!file_exists($this->body)){
                $obj = new Controller();
                $obj->setKurmix("",array(402,$this->body)); return;
            }

            $a = explode("/", $val);
            
            if(sizeof($a)<2){
                $obj = new Controller();
                $obj->setKurmix("",array(401,"",$val)); return;
            }

            $this->controller = $a[0];
            $this->action = $a[1];
    }   

}
