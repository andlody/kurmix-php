<?php
/*===== Kurmix - PHP =====                           _  __   www.kurmix.com   _      
* @author    Andree Ochoa <andlody@hotmail.com>     | |/ /   _ _ __ _ __ ___ (_)_  __
* @copyright 2017-2018 Andree Ochoa                 | ' / | | | '__| '_ ` _ \| \ \/ /
* @license   The MIT license                        | . \ |_| | |  | | | | | | |>  < 
* @version   1.0.0                                  |_|\_\__,_|_|  |_| |_| |_|_/_/\_\       */

require_once 'ActiveRecord.php'; 

class Table {
    protected $table_name;
    protected $class_name;
    protected $table;
    protected $data;

    function __construct($data=null){
        if($data==null)
            $this->data=new Data();
        else
            $this->data=$data;
    }

    function setTable($class_name,$value){
        $this->class_name = $class_name;
        $this->table_name = $value;
        $this->table = ActiveRecord::map($this->table_name);
    }

    function getTableArray(){
        return $this->table;
    }

    function new($data=null){
        $table = new Table($data);
        $table->table_name = $this->table_name;
        $table->class_name = $this->class_name;
        $table->table = $this->table;
        return new $this->class_name(null,$table);
    }

    function find($value){
        $this->data = ActiveRecord::find($this->table_name,$this->table,$value); 
    }

    function set($index,$value){
        $this->data->set($index,$value);
    }

    function get($index){
        return $this->data->get($index);
    }

    function save(){
        ActiveRecord::save($this->table_name,$this->table,$this->data);
    }

    function destroy(){
        ActiveRecord::destroy($this->table_name,$this->table,$this->data);   
        $this->data = new Data(); 
    }

    function were($value){
        return ActiveRecord::were($this->table_name,$this,$value); 
    }

    function create($value){
        ActiveRecord::create($this->table_name,$this->table,$value); 
    }
}