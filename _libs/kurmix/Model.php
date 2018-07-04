<?php
/*===== Kurmix - PHP =====                           _  __   www.kurmix.com   _      
* @author    Andree Ochoa <andlody@hotmail.com>     | |/ /   _ _ __ _ __ ___ (_)_  __
* @copyright 2017-2018 Andree Ochoa                 | ' / | | | '__| '_ ` _ \| \ \/ /
* @license   The MIT license                        | . \ |_| | |  | | | | | | |>  < 
* @version   1.0.0                                  |_|\_\__,_|_|  |_| |_| |_|_/_/\_\       */

require_once 'Connection.php'; 
abstract class Model
{
	protected $table;
	public function query($query){
		return Connection::query($query);
    }

	public function table($row = null,$column = null){
		if($row === null && $column === null) return $this->table;
		
		if(is_string($row) && $column === null) {$this->table = Connection::getTable($row); return;}
		
		return $this->table->get($row,$column);
    }

    public function isNumeric($val){
    	return is_numeric($val);
    }

    public function isInteger($val){
    	return is_int($val);
    } 

    public function filterSql($val){
    	$val = str_replace("'", "\'", $val);
    	return $val;
    }

    function lib($lib){
        return Controller::lib($lib);
    }
} 
