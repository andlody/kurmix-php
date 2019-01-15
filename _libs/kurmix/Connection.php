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
			case 1: // MySql
				$aux = 'mysql'.':host='.Config::HOST.';port='.Config::PORT.';dbname='.Config::DATABASE.';charset=utf8';
				break;
		}

		try {
            $con = new PDO($aux, Config::USER,Config::PASS);
            return $con;
        }catch(PDOException $e){
        	Controller::setKurmix("",array(306,$aux,$e->getMessage()));
        }
	}

    static function execute($sql,$params=null,$isMap=false){
        $con = Connection::start();
        
        $stmt = $con->prepare($sql);
        if($params==null)
            $stmt->execute();
        else              
            $stmt->execute($params);

        $error = $stmt->errorInfo();
        if($error[0] != 0){
            if($isMap){
                $con=null;
                return null;
            }
            Controller::setKurmix("",array(301,$sql,$error[2]));
        }

        $lastId = $con->lastInsertId();
        if($lastId!="0") return array(array($lastId));

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
}
