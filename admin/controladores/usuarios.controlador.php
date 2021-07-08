<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

class ControladorUsuarios
{

    /* ==========================
        REGISTRO DE USUARIOS
    =========================== */

    public function crtRegistroUsuario()
    {

        if (isset($_POST['registroNombre'])) {

            $ruta = ControladorRuta::ctrRuta();

            if (
                preg_match('/^[a-zA-ZñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["registroNombre"]) &&
                preg_match('/^[^0-9][a-zA-Z0-9_\-]+([.][a-zA-Z0-9_\-]+)*[@][a-zA-Z0-9_\-]+([.][a-zA-Z0-9_\-]+)*[.][a-zA-Z\-]{2,4}$/', $_POST["registroEmail"]) &&
                preg_match('/^[a-zA-Z0-9]+$/', $_POST["registroPassword"])
            ) {
                $encriptar = crypt($_POST["registroPassword"], '$2a$07$asxx54ahjppf45sd87a5a4dDDGsystemdev$');

                $encriptarEmail = md5($_POST["registroEmail"]);

                $tabla = "usuarios";
                $datos = array(
                    "usu_perfil" => "usuario",
                    "usu_nombre" => $_POST["registroNombre"],
                    "usu_email" => $_POST["registroEmail"],
                    "usu_password" => "$encriptar",
                    "usu_cedula" => $_POST["registroCedula"],
                    "usu_activo" => 0,
                    "usu_emailEncriptado" => $encriptarEmail
                );

                $respuesta = ModeloUsuarios::mdlRegistroUsuario($tabla, $datos);



                if ($respuesta == 'ok') {

                    /* ==========================
                    PHP MAILER
                    =========================== */

                    date_default_timezone_set("America/Guayaquil");

                    $mail = new PHPMailer;

                    $mail->Charset = "UTF-8";

                    $mail->isMail();

                    $mail->setFrom("info@biblioteca.com", "biblioteca");

                    $mail->addReplyTo("info@biblioteca.com", "biblioteca");

                    $mail->Subject = "Por favor verifique su correo elctrónico";

                    $mail->addAddress($_POST['registroEmail']);

                    $mail->msgHTML('<div style="width:100%; background:#eee; position:relative; font-family:sans-serif; padding-bottom:40px">
	
                    <center>
                            
                        <img style="padding:20px; width:10%" src="https://tutorialesatualcance.com/tienda/logo.png">

                    </center>

                    <div style="position:relative; margin:auto; width:600px; background:white; padding:20px">
                        
                        <center>

                            <img style="padding:20px; width:15%" src="https://tutorialesatualcance.com/tienda/icon-email.png">

                            <h3 style="font-weight:100; color:#999">VERIFIQUE SU DIRECCIÓN DE CORREO ELECTRÓNICO</h3>

                            <hr style="border:1px solid #ccc; width:80%">

                            <h4 style="font-weight:100; color:#999; padding:0 20px">Para comenzar a usar su cuenta, debe confirmar su dirección de correo electrónico</h4>

                            <a href="' . $ruta . $encriptarEmail . '" target="_blank" style="text-decoration:none">
                                
                                <div style="line-height:60px; background:#0aa; width:60%; color:white">Verifique su dirección de correo electrónico</div>

                            </a>

                            <br>

                            <hr style="border:1px solid #ccc; width:80%">

                            <h5 style="font-weight:100; color:#999">Si no se inscribió en esta cuenta, puede ignorar este correo electrónico y eliminarlo.</h5>

                        </center>	

                    </div>

                </div>');

                    $envio = $mail->send();

                    if (!$envio) {

                        echo '<script>

                        swal({

                            type:"error",
                            title: "¡ERROR!",
                            text: "¡¡Ha ocurrido un problema enviando verificación de correo electrónico a ' . $_POST["registroEmail"] . ' ' . $mail->ErrorInfo . ', por favor inténtelo nuevamente",
                            showConfirmButton: true,
                            confirmButtonText: "Cerrar"

                        }).then(function(result){

                            if(result.value){

                                history.back();

                            }


                        });	

                    </script>';
                    } else {


                        echo '<script>

                        swal({

                            type:"success",
                            title: "¡SU CUENTA HA SIDO CREADA CORRECTAMENTE!",
                            text: "¡Por favor revise la bandeja de entrada o la carpeta SPAM de su correo electrónico para verificar la cuenta!",
                            showConfirmButton: true,
                            confirmButtonText: "Cerrar"

                        }).then(function(result){

                            if(result.value){

                                window.location = "' . $ruta . 'ingreso";

                            }


                        });	

                    </script>';
                    }


                    echo '<script>
                        swal({
                            type:"success",
                            title:"Su cuenta ha sido creada correctamente",
                            text: "Porfavor revise la bandeja de entrada o spam de su correo electrónico para verificar su cuenta",
                            showConfirmButton: true,
                            confirmButtonText: "Cerrar"

                        }).then(function(result){
                            if(result.value){
                                window.location = "' . $ruta . 'ingreso";
                            }
                        });
                    </script>';
                }
            } else {

                echo '<script>
                        swal({
                            type:"error",
                            title:"Error",
                            text: "no se permiten caracteres especiales!",
                            showConfirmButton: true,
                            confirmButtonText: "Cerrar"

                        }).then(function(result){
                            if(result.value){
                                history.back();
                            }
                        });
                    </script>';
            }
        }
    }

    /* ==========================
    Mostrar Usuarios
    =========================== */

    static public function ctrMostrarUsuarios($item, $valor)
    {

        $tabla = "usuarios";

        $respuesta = ModeloUsuarios::mdlMostrarUsuario($tabla, $item, $valor);

        return $respuesta;
    }

    /* ==========================
    ACTUALIZAR USUARIO
    =========================== */

    static public function ctrActualizarUsuario($id, $item, $valor)
    {

        $tabla = 'usuarios';

        $respuesta = ModeloUsuarios::mdlActualizarUsuario($tabla, $id, $item, $valor);

        return $respuesta;
    }


    /* ==========================
    INGRESO USUARIO
    =========================== */

    public function crtIngresoUsuario()
    {


        if (isset($_POST['ingresoEmail'])) {

            $ruta = ControladorRuta::ctrRuta();

            if (
                preg_match('/^[^0-9][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[@][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[.][a-zA-Z]{2,4}$/', $_POST["ingresoEmail"]) &&
                preg_match('/^[a-zA-Z0-9]+$/', $_POST["ingresoPassword"])
            ) {

                $encriptar = crypt($_POST["ingresoPassword"], '$2a$07$asxx54ahjppf45sd87a5a4dDDGsystemdev$');

                $tabla = 'usuarios';
                $item = 'usu_email';
                $valor = $_POST["ingresoEmail"];

                $respuesta = ModeloUsuarios::mdlMostrarUsuario($tabla, $item, $valor);

                if ($respuesta["usu_email"] == $valor && $respuesta['usu_password'] == $encriptar) {

                    if ($respuesta['usu_activo'] == 0) {

                        echo '<script>
                        swal({
                            type:"error",
                            title:"Error",
                            text: "la cuenta no ha sido verificada, porfavor revise la bandeja de entrada o la carpeta SPAM de su correo electrónico para verificar su cuenta, o contáctese con nuestro soporte a info@biblioteca.com",
                            showConfirmButton: true,
                            confirmButtonText: "Cerrar"

                        }).then(function(result){
                            if(result.value){
                                history.back();
                            }
                        });
                    </script>';

                        return;
                    } else {

                        $_SESSION["validarSesion"] = "ok";
                        $_SESSION["id"] = $respuesta['id_usuario'];

                        echo '<script>
                            window.location = "' . $ruta . 'admin"
                        </script>';
                    }
                } else {

                    echo '<script>
                        swal({
                            type:"error",
                            title:"Error",
                            text: "El correo o la contraseña no coinciden!",
                            showConfirmButton: true,
                            confirmButtonText: "Cerrar"

                        }).then(function(result){
                            if(result.value){
                                history.back();
                            }
                        });
                    </script>';
                }
            } else {

                echo '<script>
                        swal({
                            type:"error",
                            title:"Error",
                            text: "no se permiten caracteres especiales!",
                            showConfirmButton: true,
                            confirmButtonText: "Cerrar"

                        }).then(function(result){
                            if(result.value){
                                history.back();
                            }
                        });
                    </script>';
            }
        }
    }

    /* ==========================
    CAMBIO DE FOTO DE PERFIL
    =========================== */

    public function ctrCambiarFotoPerfil()
    {
        if (isset($_POST["idUsuarioFoto"])) {

            $fotoActual = $_POST["fotoActual"];

            if (isset($_FILES["cambiarImagen"]["tmp_name"]) && !empty($_FILES["cambiarImagen"]["tmp_name"])) {


                list($ancho, $atlo) = getimagesize($_FILES["cambiarImagen"]["tmp_name"]);

                $nuevoAncho = 500;
                $nuevoAlto = 500;

                /* ==========================
                CREAR DIRECTORIO DONDE IRA LA FOTO
                =========================== */

                $directorio = "vistas/img/usuarios/" . $_POST["idUsuarioFoto"];

                if ($fotoActual != "") {
                    unlink($fotoActual);
                } else {

                    if (!file_exists($directorio)) {

                        mkdir($directorio, 0755);
                    }
                }

                if ($_FILES["cambiarImagen"]["type"] == "image/jpg") {

                    $aleatorio = mt_rand(100, 999);

                    $fotoActual = $directorio . "/" . $aleatorio . "." . "jpg";

                    $origen = imagecreatefromjpeg($_FILES["cambiarImagen"]["tmp_name"]);

                    $destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);

                    imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $atlo);

                    imagejpeg($destino, $fotoActual);
                } elseif ($_FILES["cambiarImagen"]["type"] == "image/jpeg") {

                    $aleatorio = mt_rand(100, 999);

                    $fotoActual = $directorio . "/" . $aleatorio . "." . "jpeg";

                    $origen = imagecreatefromjpeg($_FILES["cambiarImagen"]["tmp_name"]);

                    $destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);

                    imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $atlo);

                    imagejpeg($destino, $fotoActual);
                } elseif ($_FILES["cambiarImagen"]["type"] == "image/png") {

                    $aleatorio = mt_rand(100, 999);

                    $fotoActual = $directorio . "/" . $aleatorio . "." . "png";

                    $origen = imagecreatefrompng($_FILES["cambiarImagen"]["tmp_name"]);

                    $destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);

                    imagealphablending($destino, false);

                    imagesavealpha($destino, true);

                    imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $atlo);

                    imagepng($destino, $fotoActual);
                } else {

                    echo '<script>
                            swal({
                                type:"error",
                                title:"Error",
                                text: "no se permiten Diferentes a jpg y/o png!",
                                showConfirmButton: true,
                                confirmButtonText: "Cerrar"

                            }).then(function(result){
                                if(result.value){
                                    history.back();
                                }
                            });
                        </script>';
                }

                //final condicion

                $tabla = 'usuarios';
                $id = $_POST["idUsuarioFoto"];
                $item = "usu_foto";
                $valor = $fotoActual;

                $respuesta = ModeloUsuarios::mdlActualizarUsuario($tabla, $id, $item, $valor);

                if ($respuesta == "ok") {

                    echo '<script>
                            swal({
                                type:"success",
                                title:"Correcto!",
                                text: "La foto de perfil ha sido actualizada!",
                                showConfirmButton: true,
                                confirmButtonText: "Cerrar"

                            }).then(function(result){
                                if(result.value){
                                    history.back();
                                }
                            });
                        </script>';
                }
            }
        }
    }

    /* ==========================
    INGRESO USUARIO
    =========================== */

    public function ctrCambiarPassword()
    {

        if (isset($_POST["idUsuarioPassword"])) {

            if (preg_match('/^[a-zA-Z0-9]+$/', $_POST["cambiarPassword"])) {

                $encriptar = crypt($_POST["cambiarPassword"], '$2a$07$asxx54ahjppf45sd87a5a4dDDGsystemdev$');

                $tabla = 'usuarios';
                $id = $_POST["idUsuarioPassword"];
                $item = "password";
                $valor = $encriptar;

                $respuesta = ModeloUsuarios::mdlActualizarUsuario($tabla, $id, $item, $valor);

                if ($respuesta == "ok") {

                    echo '<script>
                            swal({
                                type:"success",
                                title:"Correcto!",
                                text: "La contraseña ha sido actualizada!",
                                showConfirmButton: true,
                                confirmButtonText: "Cerrar"

                            }).then(function(result){
                                if(result.value){
                                    history.back();
                                }
                            });
                        </script>';
                }
            } else {

                echo '<script>
                            swal({
                                type:"error",
                                title:"Error!",
                                text: "No se permiten caracteres especiales!",
                                showConfirmButton: true,
                                confirmButtonText: "Cerrar"

                            }).then(function(result){
                                if(result.value){
                                    history.back();
                                }
                            });
                        </script>';
            }
        }
    }

    /* ==========================
    RECUPERAR PASSWORD
    =========================== */

    public function ctrRecuperarPassword()
    {

        if (isset($_POST["emailRecuperarPassword"])) {

            if (preg_match('/^[^0-9][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[@][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[.][a-zA-Z]{2,4}$/', $_POST["emailRecuperarPassword"])) {

                /*=============================================
				GENERAR CONTRASEÑA ALEATORIA
				=============================================*/

                function generarPassword($longitud)
                {

                    $password = "";
                    $patron = "1234567890abcdefghijklmnopqrstuvwxyz";

                    $max = strlen($patron) - 1;

                    for ($i = 0; $i < $longitud; $i++) {

                        $password .= $patron[mt_rand(0, $max)];
                    }

                    return $password;
                }

                $nuevoPassword = generarPassword(11);

                $encriptar = crypt($nuevoPassword, '$2a$07$asxx54ahjppf45sd87a5a4dDDGsystemdev$');

                $tabla = "usuarios";
                $item = "email";
                $valor = $_POST["emailRecuperarPassword"];

                $traerUsuario = ModeloUsuarios::mdlMostrarUsuario($tabla, $item, $valor);

                if ($traerUsuario) {

                    $id = $traerUsuario["id_usuario"];
                    $item = "password";
                    $valor = $encriptar;

                    $actualizarPassword = ModeloUsuarios::mdlActualizarUsuario($tabla, $id, $item, $valor);

                    if ($actualizarPassword  == "ok") {

                        /*=============================================
						Verificación Correo Electrónico
						=============================================*/

                        $ruta = ControladorRuta::ctrRuta();

                        date_default_timezone_set("America/Bogota");

                        $mail = new PHPMailer;

                        $mail->Charset = "UTF-8";

                        $mail->isMail();

                        $mail->setFrom("info@biblioteca.com", "biblioteca");

                        $mail->addReplyTo("info@biblioteca.com", "biblioteca");

                        $mail->Subject  = "Solicitud nueva contraseña";

                        $mail->addAddress($traerUsuario["email"]);

                        $mail->msgHTML('<div style="width:100%; background:#eee; position:relative; font-family:sans-serif; padding-bottom:40px">
	
							<center>
								
								<img style="padding:20px; width:10%" src="https://tutorialesatualcance.com/tienda/logo.png">

							</center>

							<div style="position:relative; margin:auto; width:600px; background:white; padding:20px">
							
								<center>
								
								<img style="padding:20px; width:15%" src="https://tutorialesatualcance.com/tienda/icon-pass.png">

								<h3 style="font-weight:100; color:#999">SOLICITUD DE NUEVA CONTRASEÑA</h3>

								<hr style="border:1px solid #ccc; width:80%">

								<h4 style="font-weight:100; color:#999; padding:0 20px"><strong>Su nueva contraseña: </strong>' . $nuevoPassword . '</h4>

								<a href="' . $ruta . 'ingreso" target="_blank" style="text-decoration:none">

								<div style="line-height:30px; background:#0aa; width:60%; padding:20px; color:white">			
									Haz click aquí
								</div>

								</a>

								<h4 style="font-weight:100; color:#999; padding:0 20px">Ingrese nuevamente al sitio con esta contraseña y recuerde cambiarla en el panel de perfil de usuario</h4>

								<br>

								<hr style="border:1px solid #ccc; width:80%">

								<h5 style="font-weight:100; color:#999">Si no se inscribió en esta cuenta, puede ignorar este correo electrónico y la cuenta se eliminará.</h5>

								</center>

							</div>

						</div>');

                        $envio = $mail->Send();

                        if (!$envio) {

                            echo '<script>

								swal({

									type:"error",
									title: "¡ERROR!",
									text: "¡¡Ha ocurrido un problema enviando verificación de correo electrónico a ' . $traerUsuario["email"] . ' ' . $mail->ErrorInfo . ', por favor inténtelo nuevamente",
									showConfirmButton: true,
									confirmButtonText: "Cerrar"

								}).then(function(result){

									if(result.value){

										history.back();

									}


								});	

							</script>';
                        } else {


                            echo '<script>

								swal({

									type:"success",
									title: "¡SU NUEVA CONTRASEÑA HA SIDO ENVIADA!",
									text: "¡Por favor revise la bandeja de entrada o la carpeta SPAM de su correo electrónico para tomar la nueva contraseña!",
									showConfirmButton: true,
									confirmButtonText: "Cerrar"

								}).then(function(result){

									if(result.value){

										window.location = "' . $ruta . 'ingreso";

									}


								});	

							</script>';
                        }
                    }
                } else {

                    echo '<script>

						swal({
							type:"error",
						  	title: "¡ERROR!",
						  	text: "¡El correo no existe en el sistema, puede registrase nuevamente con ese correo!",
						  	showConfirmButton: true,
							confirmButtonText: "Cerrar"
						  
						}).then(function(result){

								if(result.value){   
								    history.back();
								  } 
						});

					</script>';
                }
            } else {


                echo '<script>

					swal({

						type:"error",
						title: "¡CORREGIR!",
						text: "¡Error al escribir el correo!",
						showConfirmButton: true,
						confirmButtonText: "Cerrar"

					}).then(function(result){

						if(result.value){

							history.back();

						}

					});	

				</script>';
            }
        }
    }



    /*=============================================
		ACTUALIZAR PERFIL CAPOS EXTRA USUARIO
	=============================================*/

    public function ctrActualizarPerfilUsuario()
    {

        if (isset($_POST['inputMovil']) && isset($_POST['inputTelefono']) && isset($_POST['inputDireccion'])) {

            $ruta = ControladorGeneral::ctrRuta();

            if (
                preg_match('/^[0-9\(\)\- ]+$/', $_POST["inputMovil"]) && preg_match('/^[0-9\(\)\- ]+$/', $_POST["inputTelefono"])
            ) {
                var_dump($_POST);

                $idUsuario = $_POST['idUsuario'];
                //$pais = $_POST["inputPais"];
                $movil = $_POST["inputMovil"];
                $telefono = $_POST["inputTelefono"];
                $direccion = $_POST["inputDireccion"];

                $tabla = "usuarios";
                $item = "id_usuario";
                $datos = [
                    "id_usuario" => $idUsuario,
                    "usu_celular" => $movil,
                    "usu_telefono" => $telefono,
                    "usu_direccion" => $direccion,
                ];

                $respuesta = ModeloUsuarios::mdlActualizarPerfilUsuario($tabla, $item, $datos);

                if ($respuesta == 'ok') {

                    echo '<script>
                        window.location = "' . $ruta . 'admin/perfil?ex";
                    </script>';
                } else {

                    echo '<script>
                    swal({
                        type:"success",
                        title:"Correcto!",
                        text: "La contraseña ha sido actualizada!",
                        showConfirmButton: true,
                        confirmButtonText: "Cerrar"

                    }).then(function(result){
                        if(result.value){
                            history.back();
                        }
                    });
                </script>';
                }
            } else {

                echo '<script>
                            swal({
                                type:"error",
                                title:"Error!",
                                text: "No se permiten caracteres especiales!",
                                showConfirmButton: true,
                                confirmButtonText: "Cerrar"

                            }).then(function(result){
                                if(result.value){
                                    history.back();
                                }
                            });
                        </script>';
            }
        } else {
        }
    }


    /* ==========================
    FIN DE CLASE
    =========================== */
}
