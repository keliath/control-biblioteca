<?php

require_once "../controladores/usuarios.controlador.php";
require_once "../modelos/usuarios.modelo.php";

class TablaUsuarios{

	public function mostrarTabla(){

		$item = null;
		$valor = null;
		$usuarios = ControladorUsuarios::ctrMostrarUsuarios($item, $valor);

		if(count($usuarios) == 0){

			echo '{ "data":[]}';

			return;

		}


		$datosJson = '{"data":[';

		foreach ($usuarios as $key => $value) {

			if($value["usu_perfil"] != "admin"){

				/*=============================================
				FOTO USUARIOS
				=============================================*/	

				if($value["usu_foto"] == ""){

					$foto = "<img src='vistas/img/usuarios/default/default.png' class='img-fluid rounded-circle' width='30px'>";

				}else{

					$foto = "<img src='".$value["usu_foto"]."' class='img-fluid rounded-circle' width='30px'>";

				}

				/*=============================================
				SUSCRIPCIÓN
				=============================================*/	

				if($value["usu_activo"] == 0){

					$suscripcion = "<button type='button' class='btn btn-danger btn-sm' style='cursos:default'>Desactivada</button>";

				}else{

					$suscripcion = "<button type='button' class='btn btn-success btn-sm' style='cursos:default'>Activada</button>";
				}
				
				$datosJson .= '[

					   "'.$key.'",
				       "'.$foto.'",
				       "'.$value["usu_nombre"].'",
				       "'.$value["usu_email"].'",
				       "'.$value["usu_cedula"].'",
				       "'.$value["usu_celular"].'",
				       "'.$value["usu_telefono"].'",
				       "'.$value["usu_direccion"].'",
				       "'.$suscripcion.'"

				],';

			}

		}

		$datosJson = substr($datosJson, 0, -1);

		$datosJson .= ']}';

		echo $datosJson;

	}
	// cierre metodo


}
// cierre clase

$activarTabla = new TablaUsuarios();
$activarTabla -> mostrarTabla();
