<?php
/*===== Kurmix - PHP =====                           _  __   www.kurmix.com   _      
* @author    Andree Ochoa <andlody@hotmail.com>     | |/ /   _ _ __ _ __ ___ (_)_  __
* @copyright 2017-2018 Andree Ochoa                 | ' / | | | '__| '_ ` _ \| \ \/ /
* @license   The MIT license                        | . \ |_| | |  | | | | | | |>  < 
* @version   1.0.0                                  |_|\_\__,_|_|  |_| |_| |_|_/_/\_\       */

class Config {
	//Si la pagina esta en produccion, cambiar el valor a false.
    const DEV = true;

	//Base de Datos | type > 1:mysql   2:postgres   3:oracle
	const TYPE 		= 1;
	const HOST 		= 'localhost';
	const PORT 		= '3306';
	const USER 		= 'root';
	const PASS 		= '';
	const DATABASE  = 'kurmix';
}