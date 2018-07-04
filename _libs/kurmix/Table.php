<?php
/*===== Kurmix - PHP =====                           _  __   www.kurmix.com   _      
* @author    Andree Ochoa <andlody@hotmail.com>     | |/ /   _ _ __ _ __ ___ (_)_  __
* @copyright 2017-2018 Andree Ochoa                 | ' / | | | '__| '_ ` _ \| \ \/ /
* @license   The MIT license                        | . \ |_| | |  | | | | | | |>  < 
* @version   1.0.0                                  |_|\_\__,_|_|  |_| |_| |_|_/_/\_\       */

class Table {
	protected $columnNames;
    protected $content;
    
    public function table($columnNames=null){
        $this->columnNames = $columnNames;
        $this->content = Array();
    }

    public function add($row){      
        $this->content[sizeof($this->content)] = $row;        
    }

    public function setContent($content){
    	$this->content = $content;
    }

    public function get($row = null,$column = null){  
    	if($row === null && $column === null) return $this->content;

    	if($column===null) return $this->content[$row];

    	if(is_int($column)) return $this->content[$row][$column];

    	$col = -1;
        for ($i = 0; $i < sizeof($this->columnNames); $i++) {
        	if(strcasecmp($this->columnNames[$i], $column) == 0){
                $col = $i;break;
            }
        }
        return $this->content[$row][$col];
    }

    public function rows(){
    	return sizeof($this->content);
    }

    public function columns(){
    	return sizeof($this->columnNames);
    }
}