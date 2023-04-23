<?php
	class AccesoBD{
		private static $textoErrorConsulta = "Error de conexión, reintente más tarde";
		private static $enlace=null;

		//Devuelve siempre la misma conexión, si no existe se crea una.
		public static function Conexion(){
			if(self::$enlace==null){
				$direccion="localhost";
				//Usar usuario de nivel bajo (no administrador)<<<<<<<<<<<<<<<<<<<<
				$usuario="root";
				$contrasena="";
				$nombreBd="registro_de_empresas";
				$sql = "mysql:host=$direccion;dbname=$nombreBd;";
				$dsn_Options = [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION];
				try { 
  					self::$enlace = new PDO($sql, $usuario, $contrasena, $dsn_Options);
  					
				} catch (PDOException $error) {
  					header("Location: ../front/pagina_mensaje.php?mensaje=" . self::$textoErrorConsulta);
				}
			}
			return self::$enlace;
		}

		//Cierra la conexión si está abierta.
		public static function Desconexion(){
			self::$enlace=null;
		}
	}
?>