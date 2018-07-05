<?php
/*===== Kurmix - PHP =====                           _  __   www.kurmix.com   _      
* @author    Andree Ochoa <andlody@hotmail.com>     | |/ /   _ _ __ _ __ ___ (_)_  __
* @copyright 2017-2018 Andree Ochoa                 | ' / | | | '__| '_ ` _ \| \ \/ /
* @license   The MIT license                        | . \ |_| | |  | | | | | | |>  < 
* @version   1.0.0                                  |_|\_\__,_|_|  |_| |_| |_|_/_/\_\       */

class Connection
{	

	static function start(){
		switch (Config::TYPE) {
			case 1:
				$aux = 'mysql'.':host='.Config::HOST.';port='.Config::PORT.';dbname='.Config::DATABASE;
				break;
		}

		try {
            $con = new PDO($aux, Config::USER,Config::PASS,array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
            return $con;
        }catch(PDOException $e){
        	Controller::setKurmix("",array(306,$aux,$e->getMessage()));
        }
	}

	static function query($sql) {  
		$con = Connection::start();

		$stmt = $con->prepare($sql);              
		$stmt->execute();

		$error = $stmt->errorInfo();
		if($error[0] != 0){
    		Controller::setKurmix("",array(301,$sql,$error[2]));
    	}

        $list = array();
        $row = $stmt->fetchAll(PDO::FETCH_ASSOC);
        for($i=0;$i<sizeof($row);$i++){
        	$j=0;
        	foreach ($row[$i] as $v) {
    			$list[$i][$j]=$v;
    			$j++;
			}
    	}
    	$con=null;
        return $list;
	}

	static function getTable($sql) {
		$con = Connection::start();

		$stmt = $con->prepare($sql);              
		$stmt->execute();

		$error = $stmt->errorInfo();
		if($error[0] != 0){
    		Controller::setKurmix("",array(301,$sql,$error[2]));
    	}

        $list = array();
        $row = $stmt->fetchAll(PDO::FETCH_ASSOC);
        for($i=0;$i<sizeof($row);$i++){
            $j=0;
        	foreach ($row[$i] as $v) {
    			$list[$i][$j]=$v;
    			$j++;
    			if($i==0) $names = array_keys($row[$i]);
			}
    	}
    	$con=null;
        
		require_once('_libs/kurmix/Table.php');
		$table = new Table($names);
		$table->setContent($list);
		return $table;
	}
}
