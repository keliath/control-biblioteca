<?php

session_start();
$ruta = ControladorRuta::ctrRuta();


?>

<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">

	<meta name="viewport" content="width=device-width, initial-scale=1">

	<title>Biblioteca Alls</title>

	<!-- =============================== 
    vinculo de href a carpeta base distinta
    ====================================-->

	<link rel="icon" href="vistas/img/icono.png">

	<!--=====================================
	VÍNCULOS CSS
	======================================-->

	<!-- Latest compiled and minified CSS -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css">

	<!-- Font Awesome -->
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">

	<!-- Fuente Open Sans -->
	<link href="https://fonts.googleapis.com/css?family=Roboto+Condensed|Roboto:100|Grand+Hotel" rel="stylesheet">

	<!-- overlayScrollbars -->
    <!-- <link rel="stylesheet" href="admin/vistas/css/plugins/OverlayScrollbars.min.css"> -->

	<!-- Hoja Estilo Personalizada -->
	<link rel="stylesheet" href="vistas/css/style.css">

	<!--=====================================
	VÍNCULOS JAVASCRIPT
	======================================-->

	<!-- jQuery library -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

	<!-- Popper JS -->
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js"></script>

	<!-- Latest compiled bootstrap JavaScript -->
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js"></script>

	<!-- https://easings.net/es# -->
	<script src="vistas/js/plugins/jquery.easing.js"></script>

	<!-- https://markgoodyear.com/labs/scrollup/ -->
	<script src="vistas/js/plugins/scrollUP.js"></script>

	<!-- https://www.jqueryscript.net/loading/Handle-Loading-Progress-jQuery-Nite-Preloader.html -->
	<script src="vistas/js/plugins/jquery.nite.preloader.js"></script>

	<!-- sweetalert2 -->
	<script src="vistas/js/plugins/sweetalert2.all.js"></script>

	<!-- overlayScrollbars -->
    <!-- <script src="admin/vistas/js/plugins/jquery.overlayScrollbars.min.js"></script> -->

</head>

<body>

	<?php

	if (isset($_GET['pagina'])) {

		$item = "usu_emailEncriptado";
		$valor = $_GET['pagina'];

		$validarCorreo = ControladorUsuarios::ctrMostrarUsuarios($item, $valor);


		if ($validarCorreo) {
			if ($validarCorreo['usu_emailEncriptado'] == $valor) {
				$id = $validarCorreo['id_usuario'];
				$item = "usu_activo";
				$valor = 1;

				$respuesta = ControladorUsuarios::ctrActualizarUsuario($id, $item, $valor);

				if ($respuesta == "ok") {
					echo '<script>
							swal({
								type:"success",
								title:"Correcto!",
								text: "Su cuenta ha sido verificada correctamente, ya puede ingresar al sistema",
								showConfirmButton: true,
								confirmButtonText: "Cerrar"
	
							}).then(function(result){
								if(result.value){
									window.location = "' . $ruta . 'ingreso";
								}
							});
						</script>';

					return;
				}
			}
		}


		if ($_GET['pagina'] == 'inicio' || $_GET['pagina'] == 'ingreso' || $_GET['pagina'] == 'registro' || $_GET['pagina'] == 'biblioteca') {
			include("paginas/" . $_GET["pagina"] . ".php");
		}
	} else {
		include("paginas/inicio.php");
	}


	?>

	<input type="hidden" value="<?php echo $ruta; ?>" id="ruta">

	<script src="vistas/js/script.js"></script>

</body>

</html>