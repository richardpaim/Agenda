<?php
	//Conexão com Banco de dados PostgresSQL
	class Mysql{

	private static $pdo;

	public static function conectar(){
		$user = "root";
		$password = "";
		if(self::$pdo == null){
		try {
			
		self::$pdo = new PDO('mysql:host=localhost;dbname=agenda',$user,$password, array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8" ));
		self::$pdo->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
		} catch (Exception $e) {
		echo 'erro ao concetar';
			}
		}

		return self::$pdo;
	  }
	}

?>