<?php

session_start();

$ruta = ControladorGeneral::ctrRuta();

if (!isset($_SESSION["validarSesion"])) {


    echo '
    <script>
    window.location = "' . $ruta . 'ingreso";
    </script>
    ';
}

$item = "id_usuario";
$valor = $_SESSION["id"];

$usuario = ControladorUsuarios::ctrMostrarUsuarios($item, $valor);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Administrador | Biblioteca Alls</title>
    <link rel="icon" href="vistas/img/plantilla/icono.png">
    <!-- ==================
        PLANTILLAS CSS
    ================== -->

    <!-- bootstrap 4 -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">

    <!-- font awesome -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">

    <!-- Google Font: Source Sans Pro -->
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">

    <!-- Theme style -->
    <link rel="stylesheet" href="vistas/css/plugins/adminlte.min.css">

    <!-- carrusel -->
    <link rel="stylesheet" href="vistas/css/plugins/slick.css">
    <link rel="stylesheet" href="vistas/css/plugins/slick-theme.css">

    <!-- overlayScrollbars -->
    <link rel="stylesheet" href="vistas/css/plugins/OverlayScrollbars.min.css">

    <!-- select 2  -->
    <link rel="stylesheet" href="vistas/css/plugins/select2.min.css">

    <!-- estilo personalizado -->
    <link rel="stylesheet" href="vistas/css/style.css">

    <!-- DataTables -->
    <link rel="stylesheet" href="vistas/css/plugins/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="vistas/css/plugins/responsive.bootstrap.min.css">



    <!-- ================
        PLANTILLAS JS
    ================= -->

    <!-- jQuery library -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

    <!-- Popper JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js"></script>

    <!-- Latest compiled JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js"></script>

    <!-- AdminLTE App -->
    <script src="vistas/js/plugins/adminlte.min.js"></script>

    <!-- overlayScrollbars -->
    <script src="vistas/js/plugins/jquery.overlayScrollbars.min.js"></script>

    <!-- carrusel -->
    <script src="vistas/js/plugins/slick.min.js"></script>

    <!-- Select2 -->
    <!-- https://github.com/select2/select2 -->
    <script src="vistas/js/plugins/select2.full.min.js"></script>

    <!-- InputMask -->
    <!-- https://github.com/RobinHerbots/Inputmask -->
    <script src="vistas/js/plugins/jquery.inputmask.js"></script>


    <!-- seetalert2 -->
    <script src="vistas/js/plugins/sweetalert2.all.js"></script>

    <!-- DataTables 
	https://datatables.net/-->
    <script src="vistas/js/plugins/jquery.dataTables.min.js"></script>
    <script src="vistas/js/plugins/dataTables.bootstrap4.min.js"></script>
    <script src="vistas/js/plugins/dataTables.responsive.min.js"></script>
    <script src="vistas/js/plugins/responsive.bootstrap.min.js"></script>

</head>

<body class="sidebar-mini layout-fixed">

    <div class="wrapper">


        <?php

        include("paginas/modulos/header.php");
        include("paginas/modulos/menu.php");

        // ================================
        //     scrpits cambiantes
        // ================================

        if (isset($_GET['pagina'])) {
            if (
                $_GET['pagina'] == 'inicio' ||  $_GET['pagina'] == 'perfil' ||  $_GET['pagina'] == 'usuarios' ||  $_GET['pagina'] == 'uninivel'
                ||  $_GET['pagina'] == 'binaria' ||  $_GET['pagina'] == 'matriz' || $_GET['pagina'] == 'ingresos-uninivel'
                ||  $_GET['pagina'] == 'ingresos-binaria' ||  $_GET['pagina'] == 'ingresos-matriz' || $_GET['pagina'] == 'plan-compensacion' || $_GET['pagina'] == 'soporte' || $_GET['pagina'] == 'salir'
            ) {
                include("paginas/" . $_GET["pagina"] . ".php");
            } else if ($_GET['pagina'] == 'libros' || $_GET['pagina'] == 'autores' || $_GET['pagina'] == 'editoriales' || $_GET['pagina'] == 'categorias' || $_GET['pagina'] == 'perchas-hileras') {
                include("paginas/optio-bibliografica.php");
            } else if ($_GET['pagina'] == 'solicitudes' || $_GET['pagina'] == 'prestamos') {
                include("paginas/procesos.php");
            } else if ($_GET['pagina'] == 'reporte-general' || $_GET['pagina'] == 'mi-reporte') {
                include("paginas/reportes.php");
            } else {
                include("paginas/error404.php");
            }
        } else {
            include("paginas/inicio.php");
        }


        // ================================

        include("paginas/modulos/footer.php");
        ?>

    </div>






    <!-- script  -->
    <script src="vistas/js/script.js"></script>
    <script src="vistas/js/usuarios.js"></script>
    <script src="vistas/js/biblioteca.js"></script>
    <script src="vistas/js/prestamos.js"></script>
    <script src="vistas/js/parche-ajax.js"></script>
    <script src="vistas/js/reportes.js"></script>
</body>

</html>