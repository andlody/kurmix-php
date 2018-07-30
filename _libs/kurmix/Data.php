<?php
/*===== Kurmix - PHP =====                           _  __   www.kurmix.com   _      
* @author    Andree Ochoa <andlody@hotmail.com>     | |/ /   _ _ __ _ __ ___ (_)_  __
* @copyright 2017-2018 Andree Ochoa                 | ' / | | | '__| '_ ` _ \| \ \/ /
* @license   The MIT license                        | . \ |_| | |  | | | | | | |>  < 
* @version   1.0.0                                  |_|\_\__,_|_|  |_| |_| |_|_/_/\_\       */

class Data
{	
	protected $obj;
    protected $objx;
    protected $objy;

    protected $id;

    function __construct(){
        $this->obj  = null;        
        $this->objx = array();
        $this->objy = array();
        $this->id = null;
    }

    function get($val=null){
        if($val===null) 
            return $this->obj;
        else{
            if(is_int($val)){
                if(!array_key_exists($val, $this->objy)) return null; 
                return $this->objy[$val];
            }
            else{
                if(!array_key_exists($val, $this->objx)) return null; 
                return $this->objx[$val];
            }
        }
    }
    
    function set($data1,$data2){
        if($data2===null) 
            $this->obj = $data1;
        else{
            if(is_int($data1))
                $this->objy[$data1]=$data2;
            else
                $this->objx[$data1]=$data2;
        }
    }

    function getTable(){
        return $this->objx;
    }

    function identifier($val=null){
        if($val===null) return $this->id;
        $this->id = $val;
    }

    function size($val=null){
        if($val===null)
            return sizeof($this->objy);
        else
            return sizeof($this->objx);
    }

    function json(){
    	return json_encode($this->objx,JSON_UNESCAPED_UNICODE);
    }
}