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

    function get($val=null){
        if($val===null) 
            return $this->obj;
        else{
            if(is_int($val))
                return $this->objy[$val];
            else
                return $this->objx[$val];
        }
    }
    
    function setData($data1,$data2){
        if($data2===null) 
            $this->obj = $data1;
        else{
            if(is_int($data1))
                $this->objy[$data1]=$data2;
            else
                $this->objx[$data1]=$data2;
        }
    }

    function size($val=null){
        if($val===null)
            return sizeof($this->objy);
        else
            return sizeof($this->objx);
    }

    function json(){
    	return json_encode($this->objx);
    }
}