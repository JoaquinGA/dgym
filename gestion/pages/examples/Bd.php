<?php
	//Clase para gestionar todas las interacciones con la base de datos
	class Bd{



		protected static function ejecutaConsulta($sql){

			$dsn = "mysql:host=localhost;dbname=gestion";
			$usuario = "alumno";
			$contrasena = "velazquez";
			$opc = array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8");

			$conexion = new PDO($dsn, $usuario, $contrasena, $opc);
			$resultado = null;
			if(isset($conexion)){
				$resultado = $conexion->query($sql);
			}
			return $resultado;
		}



		public static function verificaUsuario($nombre,$contrasenna){
			//$sql = "SELECT id_usuario, nombre, permiso FROM usuarios WHERE nombre='$nombre' AND contrasenna='$contrasenna'";

			$sql = "SELECT id_usuario, nombre, permiso FROM usuarios WHERE nombre='".mysql_real_escape_string($nombre)."' AND contrasenna='".mysql_real_escape_string($contrasenna)."'";			


			$resultado = self::ejecutaConsulta($sql);
			$verificado = false;

			if(isset($resultado)){
				$fila = $resultado->fetch();
				if($fila !== false){
					$verificado = true;
				}
			}
			return $verificado;
		}



		public static function obtenerPermisos($nombre){

			$sql = "SELECT permiso FROM usuarios WHERE nombre ='$nombre'";
			$resultado = self::ejecutaConsulta($sql);

			if(isset($resultado)){
				$fila = $resultado->fetch();
				return ($fila['permiso']);
			}

		}



		/**
		*Devulve array PDO con todas las lineas de la tabla usuario
		*/
		public static function obtenerUsuarios(){
			$sql = "SELECT * FROM usuarios";
			return (self::ejecutaConsulta($sql));
		}

		/**
		*Devulve array PDO con todas las lineas de la tabla historial_usuarios
		*/
		public static function obtenerHistorial(){
			$sql = "SELECT * FROM historial_usuarios";
			return (self::ejecutaConsulta($sql));
		}




		public static function obtenerNombreUsuario($id){
			$sql = "SELECT * FROM usuarios WHERE id_usuario='$id'";
			$resultado = self::ejecutaConsulta($sql);
			$fila = $resultado->fetch();			
			return ($fila['nombre']);
		}


		public static function obtenerIdUsuario($nombre){
			$sql = "SELECT * FROM usuarios WHERE nombre='$nombre'";
			$resultado = self::ejecutaConsulta($sql);
			$fila = $resultado->fetch();
			return ($fila['id_usuario']);
		}

		/**
		* Rebice el id de un usuario y devuelve el array de su linea
		*/
		public static function obtenerUsuario($id){
			$sql = "SELECT * FROM usuarios WHERE id_usuario='$id'";		
			return (self::ejecutaConsulta($sql));
		}		





		public static function annadeUsuario($nombre,$contrasenna,$permiso){

			$fecha = date("Y-m-d");

			$sql = "INSERT INTO usuarios (nombre,contrasenna,permiso,fecha_alta) VALUES ('$nombre','$contrasenna','$permiso','$fecha')";
			self::ejecutaConsulta($sql);

		}

		public static function eliminaUsuario($id){
			$sql = "DELETE FROM usuarios WHERE id_usuario ='$id'";
			self::ejecutaConsulta($sql);
		}




		public static function modificaUsuario($id,$nombre,$contrasenna,$permiso){
			$sql = "UPDATE usuarios SET nombre='$nombre',contrasenna='$contrasenna',permiso='$permiso' WHERE id_usuario = '$id'";
			self::ejecutaConsulta($sql);
		}



		public static function comprobarNombreExistente($nombre){

			$existe = false;

			$resultado = self::obtenerUsuarios();

			if(isset($resultado)){

				$linea = $resultado->fetch();


				while($linea != null && !$existe){

					if($linea['nombre'] == $nombre){
						$existe = true;
					}

					$linea = $resultado->fetch(PDO::FETCH_BOTH);
				}

			}
			return $existe;
		}




		/**
		* Añade al historial de usuarios un registro dependiendo del tipo de evento recibido como parametro
		* 1.- Usuario creado
		* 2.- Usuario eliminado
		*/

		function annadir_historial_usuarios($codigo,$usuario1,$id_usuario1,$usuario2){

			$sql = "";
			$mensaje = "";
			$fecha = date("Y-m-d");

			switch ($codigo) {
				case '1':
					$mensaje = $usuario1."(".$id_usuario1.") añadio a ".$usuario2.".";
					
					break;

				case '2':
					$mensaje = $usuario1."(".$id_usuario1.") elimino a ".$usuario2.".";
					
					break;					
				
				default:
					$mensaje = "Error al indicar el codigo del evento.";
					break;
			}

			$sql = "INSERT INTO historial_usuarios (evento,fecha) VALUES ('$mensaje','$fecha')";

			self::ejecutaConsulta($sql);
		}




		function obtenerFechaDeAlta($id){
			$sql = "SELECT fecha_alta FROM usuarios WHERE id_usuario='$id'";
			$resultado = self::ejecutaConsulta($sql);
			$fila = $resultado->fetch();			
			return ($fila['fecha_alta']);			
		}




	}
?>