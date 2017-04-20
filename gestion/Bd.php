<?php
	//Clase para gestionar todas las interacciones con la base de datos
	class Bd{



		protected static function ejecutaConsulta($sql){

			$dsn = "mysql:host=localhost;dbname=dgym_gestion";
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


	





		public static function obtenerClientes(){
			$sql = "SELECT * FROM usuarios WHERE permiso = 2";
			return (self::ejecutaConsulta($sql));
		}


		public static function obtenerPagos(){



			$sql = "SELECT selec1.*
					FROM (	SELECT usuarios.id_usuario,usuarios.dni, usuarios.nombre, usuarios.activo, pago.fecha_pago, pago.fecha_vencimiento 
							FROM usuarios, pago 
							WHERE usuarios.id_usuario = pago.id_usuario AND usuarios.permiso = '2'
							ORDER BY pago.fecha_pago DESC
                    	) AS selec1
					GROUP BY selec1.id_usuario
					ORDER BY selec1.fecha_pago DESC";



			return(self::ejecutaConsulta($sql));
		}



		public static function obtenerTodosPagos(){

			$sql = "SELECT * FROM pago, usuarios WHERE usuarios.id_usuario = pago.id_usuario ORDER BY fecha_pago DESC";
			return(self::ejecutaConsulta($sql));
		}

		public static function buscaTodosPagos($nombre){
			$nombre = "%".$nombre."%";
			$sql = "SELECT * FROM pago, usuarios WHERE usuarios.id_usuario = pago.id_usuario AND usuarios.nombre LIKE '$nombre' ORDER BY fecha_pago DESC";
			return(self::ejecutaConsulta($sql));
		}		


		/**
		*Recibe una cadena y devuelve el array con los registros en los que parte del nombre coincida con la cadena
		*/
		public static function buscaUsuarios($nombre){
			$nombre = "%".$nombre."%";
			$sql = "SELECT * FROM usuarios WHERE nombre LIKE '$nombre'";
			return (self::ejecutaConsulta($sql));
		}

/*

		public static function buscaUsuariosPagos($nombre){
			$nombre = "%".$nombre."%";
			$sql = "SELECT * FROM usuarios WHERE nombre LIKE '$nombre' AND permiso=2";
			return (self::ejecutaConsulta($sql));
		}		
*/




		public static function buscaUsuariosPagos($nombre){
			$nombre = "%".$nombre."%";



			$sql = "SELECT selec1.*
					FROM (	SELECT usuarios.id_usuario,usuarios.dni, usuarios.nombre, usuarios.activo, pago.fecha_pago, pago.fecha_vencimiento 
							FROM usuarios, pago 
							WHERE usuarios.id_usuario = pago.id_usuario AND usuarios.permiso = '2' AND usuarios.nombre LIKE '$nombre'
							ORDER BY pago.fecha_pago DESC
                    	) AS selec1
					GROUP BY selec1.id_usuario
					ORDER BY selec1.fecha_pago DESC";





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







		public static function annadeUsuario($nombre,$contrasenna,$permiso,$dni,$email,$nacimiento,$telefono,$peso,$altura){


			$sql = "INSERT INTO usuarios (nombre,contrasenna,permiso,dni,email,nacimiento,telefono,peso,altura,activo) VALUES ('$nombre','$contrasenna','$permiso','$dni','$email','$nacimiento','$telefono','$peso','$altura',1)";
			self::ejecutaConsulta($sql);



			$id = self::obtenerIdUsuario($nombre);

			$fecha_pago = date("Y-m-d");

			$fecha_vencimiento = strtotime ( '+1 month' , strtotime ( $fecha_pago ) ) ;
			$fecha_vencimiento = date ( 'Y-m-j' , $fecha_vencimiento );


			if ($permiso = 2) {
				$sql2 = "INSERT INTO pago (id_usuario,fecha_pago,fecha_vencimiento) VALUES ('$id','$fecha_pago','$fecha_vencimiento')";
				self::ejecutaConsulta($sql2);
			}
			

		}

		public function annadePago($id){

			$fecha_pago = date("Y-m-d");

			$fecha_vencimiento = strtotime ( '+1 month' , strtotime ( $fecha_pago ) ) ;
			$fecha_vencimiento = date ( 'Y-m-j' , $fecha_vencimiento );



			$sql = "INSERT INTO pago (id_usuario,fecha_pago,fecha_vencimiento) VALUES ('$id','$fecha_pago','$fecha_vencimiento')";
			self::ejecutaConsulta($sql);
		}



		public static function eliminaUsuario($id){
			$sql = "DELETE FROM usuarios WHERE id_usuario ='$id'";
			self::ejecutaConsulta($sql);
		}





		public static function modificaUsuario($id,$nombre,$contrasenna,$permiso,$dni,$email,$nacimiento,$telefono,$peso,$altura){
			$sql = "UPDATE usuarios SET nombre='$nombre',contrasenna='$contrasenna',permiso='$permiso',dni='$dni',email='$email',nacimiento='$nacimiento',telefono='$telefono',peso='$peso',altura='$altura' WHERE id_usuario = '$id'";
			self::ejecutaConsulta($sql);
		}


		public static function modificaUsuario2($id,$contrasenna,$email,$telefono,$peso,$altura){
			$sql = "UPDATE usuarios SET contrasenna='$contrasenna',email='$email',telefono='$telefono',peso='$peso',altura='$altura' WHERE id_usuario = '$id'";
			self::ejecutaConsulta($sql);
		}



		public static function activarUsuario($id){
			$sql = "UPDATE usuarios SET activo='1' WHERE id_usuario = '$id'";
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


		function obtenerNombre($id){
			$sql = "SELECT nombre FROM usuarios WHERE id_usuario='$id'";
			$resultado = self::ejecutaConsulta($sql);
			$fila = $resultado->fetch();			
			return ($fila['nombre']);
		}

		/**
		*Devuelve el número de usuarios existentes con el permiso recibido por paremtro
		*/
		function cuentaUsuariosPermiso($id_permiso){
			$sql = "SELECT count(*) AS 'n_usuarios' FROM usuarios WHERE permiso='$id_permiso'";
			$resultado = self::ejecutaConsulta($sql);
			$fila = $resultado->fetch();			
			return ($fila['n_usuarios']);			
		}


		/**
		*Recibe 0 (usuarios pendiente de pago) o 1(usuarios activos) y devuelve el numero de usuarios de ese tipo
		*
		*/

		function cuentaUsuariosPago($opcion){
			$sql = "SELECT count(*) AS 'n_usuarios' FROM usuarios WHERE activo='$opcion' AND permiso=2";
			$resultado = self::ejecutaConsulta($sql);
			$fila = $resultado->fetch();			
			return ($fila['n_usuarios']);			
		}





//=============================================================================================================
//=============================                 DIETAS              ===========================================
//=============================================================================================================




		/**
		*Devulve array PDO con todas las lineas de la tabla dietas
		*/



		public static function obtenerDietas(){
			$sql = "SELECT * FROM dieta";
			return (self::ejecutaConsulta($sql));
		}


		/**
		* Rebice el id de una dieta y devuelve el array de su linea
		*/
		public static function obtenerDieta($id){
			$sql = "SELECT * FROM dieta WHERE id_dieta='$id'";		
			return (self::ejecutaConsulta($sql));
		}	


		public function obtenerDietaDeUsuario($id){
			$sql = "SELECT * FROM usuarios WHERE id_usuario='$id'";		
			$resultado = self::ejecutaConsulta($sql);			
			$fila = $resultado->fetch();			
			return ($fila['dieta']);
		}



		public static function obtenerNombreDieta($id){
			$sql = "SELECT * FROM dieta WHERE id_dieta='$id'";
			$resultado = self::ejecutaConsulta($sql);
			$fila = $resultado->fetch();			
			return ($fila['nombre']);
		}




		public static function annadeDieta($nombre,$funcion,$descripcion,$tabla){
			$sql = "INSERT INTO dieta (nombre,funcion,descripcion,tabla) VALUES ('$nombre','$funcion','$descripcion','$tabla')";
			self::ejecutaConsulta($sql);
		}		



		public static function eliminaDieta($id){
			$sql = "DELETE FROM dieta WHERE id_dieta ='$id'";
			self::ejecutaConsulta($sql);
		}




		public static function comprobarDietaExistente($nombre){
			$existe = false;
			$resultado = self::obtenerDietas();
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







//=============================================================================================================
//=============================                 ENTRENAMIENTOS      ===========================================
//=============================================================================================================




		/**
		*Devulve array PDO con todas las lineas de la tabla dietas
		*/



		public static function obtenerEntrenamientos(){
			$sql = "SELECT * FROM entrenamiento";
			return (self::ejecutaConsulta($sql));
		}


		/**
		* Rebice el id de una dieta y devuelve el array de su linea
		*/
		public static function obtenerEntrenamiento($id){
			$sql = "SELECT * FROM entrenamiento WHERE id_entrenamiento='$id'";		
			return (self::ejecutaConsulta($sql));
		}	

		public function obtenerEntrenamientoDeUsuario($id){
			$sql = "SELECT * FROM usuarios WHERE id_usuario='$id'";		
			$resultado = self::ejecutaConsulta($sql);			
			$fila = $resultado->fetch();			
			return ($fila['entrenamiento']);
		}


		public static function obtenerNombreEntrenamiento($id){
			$sql = "SELECT * FROM entrenamiento WHERE id_entrenamiento='$id'";
			$resultado = self::ejecutaConsulta($sql);
			$fila = $resultado->fetch();			
			return ($fila['nombre']);
		}	




		public static function annadeEntrenamiento($nombre,$funcion,$descripcion,$tabla){
			$sql = "INSERT INTO entrenamiento (nombre,funcion,descripcion,tabla) VALUES ('$nombre','$funcion','$descripcion','$tabla')";
			self::ejecutaConsulta($sql);
		}		



		public static function eliminaEntrenamiento($id){
			$sql = "DELETE FROM entrenamiento WHERE id_entrenamiento ='$id'";
			self::ejecutaConsulta($sql);
		}




		public static function comprobarEntrenamientoExistente($nombre){
			$existe = false;
			$resultado = self::obtenerEntrenamientos();
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





		public static function modificaDietaEntrenamiento($id,$dieta,$entrenamiento){
			$sql = "UPDATE usuarios SET dieta='$dieta',entrenamiento='$entrenamiento' WHERE id_usuario = '$id'";
			self::ejecutaConsulta($sql);
		}



		function annadeFoto($id,$nombreFichero){
			$sql = "UPDATE usuarios SET foto='$nombreFichero' WHERE id_usuario = '$id'";
			self::ejecutaConsulta($sql);			
		}



		function obtenerFotoUsuario($id){
			$sql = "SELECT * FROM usuarios WHERE id_usuario='$id'";
			$resultado = self::ejecutaConsulta($sql);
			$fila = $resultado->fetch();			
			return ($fila['foto']);		
		}



		public static function funcionEntrar($id){
			$sql = "SELECT * FROM usuarios WHERE id_usuario='$id'";
			$resultado = self::ejecutaConsulta($sql);
			$fila = $resultado->fetch();
			$activo = ($fila['activo']);
			$dentro = ($fila['dentro']);

			if($activo == "1"){//Si esta al dia en el pago
				if($dentro == "0"){//Si esta fuera del gimnasio
					$sql2 = "UPDATE usuarios SET dentro='1' WHERE id_usuario = '$id'";
					self::ejecutaConsulta($sql2);
					return("<h1>Torno desbloqueado para entrar.</h1>");
				}else{//Si esta dentro del gimnasio
					$sql2 = "UPDATE usuarios SET dentro='0' WHERE id_usuario = '$id'";
					self::ejecutaConsulta($sql2);
					return("<h1>Torno desbloqueado para salir.</h1>");
				}

			}else{//si no esta al dia en el pago
				return("<h2>Fecha de pago vencida.</h2><h3>Pongase en contacto con el personal del centro para abonar la cuota.</h3>");
			}


		}



			function actualizarCuentas(){
				$sql = "SELECT * FROM pago";
				$resultado = self::ejecutaConsulta($sql);
				$fila = $resultado->fetch();

				while($fila != null){

					if((date("Y-m-d")) > ($fila['fecha_vencimiento']) ){

						$id = $fila['id_usuario'];

						$sql2 = "UPDATE usuarios SET activo='0' WHERE id_usuario = '$id'";
						self::ejecutaConsulta($sql2);
					}
					$fila = $resultado->fetch();
				}
			}




			function obtenerInfoFactura($id){

				$sql = "SELECT * FROM usuarios, pago WHERE pago.id_usuario = usuarios.id_usuario AND pago.id_pago = $id";

				$resultado = self::ejecutaConsulta($sql);

				return($resultado->fetch());

			}





			function obtenerPrecioCuota(){
				$sql = "SELECT precio FROM precio_cuota WHERE id = 1";
				$resultado = self::ejecutaConsulta($sql);
				$fila = $resultado->fetch();
				return($fila['precio']);
			}




			function insertaSugerencia($id,$asunto,$mensaje){
				$sql = "INSERT INTO sugerencia (id_usuario,asunto,mensaje) VALUES ('$id','$asunto','$mensaje')";
				self::ejecutaConsulta($sql);
			}


		public static function obtenerSugerencias(){
			$sql = "SELECT * FROM sugerencia";
			return (self::ejecutaConsulta($sql));
		}


		public static function eliminaSugerencia($id){
			$sql = "DELETE FROM sugerencia WHERE id_sugerencia ='$id'";
			self::ejecutaConsulta($sql);
		}


		public static function actualizaPrecio($precio){

			$sql = "UPDATE precio_cuota SET precio='$precio' WHERE id = 1";
			self::ejecutaConsulta($sql);
		}		






	

























	}
?>