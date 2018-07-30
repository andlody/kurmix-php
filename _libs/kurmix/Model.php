<?php
/*===== Kurmix - PHP =====                           _  __   www.kurmix.com   _      
* @author    Andree Ochoa <andlody@hotmail.com>     | |/ /   _ _ __ _ __ ___ (_)_  __
* @copyright 2017-2018 Andree Ochoa                 | ' / | | | '__| '_ ` _ \| \ \/ /
* @license   The MIT license                        | . \ |_| | |  | | | | | | |>  < 
* @version   1.0.0                                  |_|\_\__,_|_|  |_| |_| |_|_/_/\_\       */

require_once 'Connection.php';
require_once 'Table.php'; 

abstract class Model
{
    protected $sql;
    protected $parameter;
    protected $table;
    public $name;
    
    function __construct($name=null,$table=null){
        $this->parameter = array();
        if($name!=null){
            $this->table = new Table();
            $this->name = $name;            
            $this->init();
            $this->table->setTable($name,$this->name);
        }else{
            $this->table = $table;
        }
    }

    public function init(){}
    
    public function new(){
        return $this->table->new();
    }

    public function find($val){
        $this->table->find($val);       
    }

    public function set($index,$value){
        $this->table->set($index,$value);
    } 

    public function get($index){
        return $this->table->get($index);
    }

    public function save(){
        $this->table->save();
    }

    public function destroy(){
        $this->table->destroy();
    }

    public function were($were){
        return $this->table->were($were);
    }

    public function create($value){
        $this->table->create($value);
    }    

    public function query($query){
        return Connection::execute($query);
    }

    public function prepare($sql){
        $this->sql = $sql;
    }

    public function parameter($value){
        $this->parameter[sizeof($this->parameter)] = $value;
    }

    public function execute($array=null){
        $parameter = $this->parameter;
        if($array!=null)
            $parameter=$array;

        $this->parameter = array();
        return Connection::execute($this->sql,$parameter);
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

    public function lib($lib){
        return Controller::lib($lib);
    }

    public function model($model){
        return Controller::model($model);
    }

    public function json(){
        return $this->table->json();
    }
} 
