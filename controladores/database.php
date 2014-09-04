<?php 
/**
* 	Clase para conectar a la base de datos
*/
class Database
{
	 private static $dbName='BD_TECNICA_FUNCIONAL';
	 private static $dbHost='localhost';
	 private static $dbUsername='root';
	 private static $dbUserPassword='';
	 private static $cont = null;
	function __construct()
	{
		die('La funcion no esta permitida');
	}

	public static function connect(){
		//Una conexion a travez de toda la aplicacion
		if( null==self::$cont )
		{
			try
			{
				self::$cont =  new PDO( "mysql:host=".self::$dbHost.";"."dbname=".self::$dbName, self::$dbUsername, self::$dbUserPassword);
			}
			catch(PDOException $e)
			{
				die($e->getMessage());
			}
		}
		return self::$cont;
	}

	public static function disconnect(){
		self::$cont=null;
	}

}


 ?>