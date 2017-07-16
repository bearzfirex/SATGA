<?php
	/**
	* Conexión
	*/
	class conexion
	{
		private $servidor;
		private $nombrebd;
		private $usuario;
		private $pass;
		public $con;
		function __construct()
		{
			$this->servidor="localhost";
			//$this->servidor="p:192.168.1.100";
			$this->nombrebd="satga";
			$this->usuario="root";
			$this->pass="123456";
			//$this->pass="comercialhl";
		}


		function conectar ()
		{
			$con = mysqli_connect($this->servidor,$this->usuario,$this->pass,$this->nombrebd);
			return $con;
		}
	}
?>