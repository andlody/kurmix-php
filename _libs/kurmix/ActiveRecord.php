<?php
/*===== Kurmix - PHP =====                           _  __   www.kurmix.com   _      
* @author    Andree Ochoa <andlody@hotmail.com>     | |/ /   _ _ __ _ __ ___ (_)_  __
* @copyright 2017-2018 Andree Ochoa                 | ' / | | | '__| '_ ` _ \| \ \/ /
* @license   The MIT license                        | . \ |_| | |  | | | | | | |>  < 
* @version   1.0.0                                  |_|\_\__,_|_|  |_| |_| |_|_/_/\_\       */

class ActiveRecord
{	
	static function map($name){
		return Connection::execute("DESCRIBE $name",null,true);
	}

	static function save($name,$table,$data){
		if($data->identifier()===null) return self::insert($name,$table,$data);
		self::update($name,$table,$data);
	}

 	static function insert($name,$table,$data){
        $column ="";
        $simbol ="";
        $values = array();
        for ($i=0; $i < sizeof($table); $i++) {
        	foreach ($data->getTable() as $index => $value) {
        		if(strtolower($table[$i][0])==strtolower($index)){
                    $column .= $index.",";
                    $simbol .= "?,";
                    $values[sizeof($values)] = $value;
                    break;
                }
        	}
        }
        $column = substr($column, 0, -1);
        $simbol = substr($simbol, 0, -1);
        Connection::execute("INSERT INTO $name ($column) VALUES ($simbol)",$values);
	}

	static function update($name,$table,$data){
		$set = '';
        $identifier = $data->identifier();

        $values = array();
		$a = Connection::execute("SELECT * FROM $name WHERE $identifier LIMIT 1");	
		for ($i=0; $i < sizeof($table); $i++) {
        	foreach ($data->getTable() as $index => $value) {
        		if(strtolower($table[$i][0])==strtolower($index)){
        			if($a[0][$i]!=$value){
                    	$set .= $index."=?,";
                    	$values[sizeof($values)] = $value;
                    	break;
                	}
                }
        	}
        }
        if(strlen($set)==0) return;
        $set = substr($set, 0, -1);
        Connection::execute("UPDATE $name SET $set WHERE $identifier",$values);	
	}

	static function find($name,$table,$value){
		$dat = new Data();
		if(is_int($value)){
			$column = "id";
			for($i=0;$i<sizeof($table);$i++){
				if($table[$i][3]=='PRI'){
					$column=$table[$i][0];
					break;
				}
			}
		}
		else{
			$x = explode(":",$value);
			$column = $x[0];
			$value 	= $x[1];
		}

		$a = Connection::execute("SELECT * FROM $name WHERE $column = ? LIMIT 1",array($value));	
		
		if(sizeof($a)>0){
			for ($i=0; $i < sizeof($table); $i++) { 
				$dat->set($table[$i][0],$a[0][$i]);
			}
			$dat->identifier($table[0][0]."='".$a[0][0]."'");
		}
		return $dat;
	}

	static function destroy($name,$table,$data){
		$identifier = $data->identifier();
		Connection::execute("DELETE FROM $name WHERE $identifier");
	} 

	static function were($name,$table_obj,$condition){
		$table = $table_obj->getTableArray();
		$a = Connection::execute("SELECT * FROM $name WHERE $condition");
		$array = array();	
		if(sizeof($a)>0){
			for($j=0;$j<sizeof($a);$j++){
				$dat = new Data();
				for ($i=0; $i < sizeof($table); $i++) { 
					$dat->set($table[$i][0],$a[$j][$i]);
				}
				$dat->identifier($table[0][0]."='".$a[0][0]."'");
				$array[$j] = $table_obj->new($dat);
			}
		}
		return $array;
	}

	static function create($name,$table,$value){
		$column ="";
        $simbol ="";
        $data = explode("','",$value);
        $data[0] = substr($data[0], 1);
        $data[sizeof($data)-1] = substr($data[sizeof($data)-1], 0, -1);
        $k=0;
        if(sizeof($table)>sizeof($data)) $k=1;
        for($i=$k; $i < sizeof($table); $i++) {        	
            $column .= $table[$i][0].",";
            $simbol .= "?,";
        }
        $column = substr($column, 0, -1);
        $simbol = substr($simbol, 0, -1);
		return Connection::execute("INSERT INTO $name ($column) VALUES ($simbol)",$data)[0][0];		
	}
}