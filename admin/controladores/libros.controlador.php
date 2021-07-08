<?php

class ControladorLibros
{


    /* ==========================================
    AGREGAR LIBRO
    =========================================== */

    public function ctrAgregarLibro()
    {
        if (
            isset($_POST['inputTitulo']) && isset($_POST['inputYear']) && isset($_POST['inputEdicion']) && isset($_POST['inputIsbn'])
            && isset($_POST['inputAutor']) && isset($_POST['inputCategoria']) && isset($_POST['inputUbicacion'])
            && isset($_POST['inputEditorial'])
        ) {

            $ruta = ControladorGeneral::ctrRuta();

            if (
                preg_match('/^[a-zA-ZñÑáéíóúÁÉÍÓÚ\- ]+$/', $_POST["inputTitulo"]) && preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ\- ]+$/', $_POST["inputEdicion"])
                && preg_match('/^[0-9]+$/', $_POST["inputAutor"])  && preg_match('/^[0-9]+$/', $_POST["inputEditorial"])
                && preg_match('/^[0-9]+$/', $_POST["inputCategoria"]) && preg_match('/^[0-9]+$/', $_POST["inputUbicacion"])
                && preg_match('/^[0-9]+$/', $_POST["inputIsbn"]) && preg_match('/^[0-9]+$/', $_POST["inputYear"])
            ) {

                if (isset($_FILES["inputPortada"]["tmp_name"]) && !empty($_FILES["inputPortada"]["tmp_name"])) {

                    $portada = "";
                    if ($_FILES["inputPortada"]["type"] == "image/jpg") {

                        $portada = mt_rand(100, 999) . ".jpg";
                    } elseif ($_FILES["inputPortada"]["type"] == "image/jpeg") {

                        $portada = mt_rand(100, 999) . ".jpeg";
                    } elseif ($_FILES["inputPortada"]["type"] == "image/png") {

                        $portada = mt_rand(100, 999) . ".png";
                    } else {

                        echo '<script>
                                swal({
                                    type:"error",
                                    title:"Error",
                                    text: "no se permiten Diferentes a jpg, jpeg y/o png ' . $_FILES["inputPortada"]["type"] . '!",
                                    showConfirmButton: true,
                                    confirmButtonText: "Cerrar"
    
                                }).then(function(result){
                                    if(result.value){
                                        history.back();
                                    }
                                });
                            </script>';

                        return;
                    }

                    $tituoLibro = trim($_POST["inputTitulo"]);
                    $year = trim($_POST["inputYear"]);
                    $edicion = trim($_POST['inputEdicion']);
                    $isbn = trim($_POST['inputIsbn']);
                    $descripcion = trim($_POST["inputDescripcion"]);


                    $tabla = 'libros';
                    $datos = array(
                        "id_autor" => $_POST['inputAutor'],
                        "id_ubicacion" => $_POST['inputUbicacion'],
                        "id_categoria" => $_POST['inputCategoria'],
                        "id_editorial" => $_POST['inputEditorial'],
                        "lib_titulo" => $tituoLibro,
                        "lib_year" => $year,
                        "lib_edicion" => $edicion,
                        "lib_isbn" => $isbn,
                        "lib_descripcion" => $descripcion,
                        "lib_portada" => $portada
                    );

                    $respuesta = ModeloLibros::mdlAgregarLibro($tabla, $datos);

                    if ($respuesta != 0) {

                        list($ancho, $atlo) = getimagesize($_FILES["inputPortada"]["tmp_name"]);

                        $nuevoAncho = 300;
                        $nuevoAlto = 450;

                        /* ==========================
                        CREAR DIRECTORIO DONDE IRA LA FOTO
                        =========================== */

                        $directorio = "vistas/img/libros/$respuesta";


                        if (!file_exists($directorio)) {
                            mkdir($directorio, 0755);
                        }

                        $fotoActual = $directorio . "/" . $portada;

                        if ($_FILES["inputPortada"]["type"] == "image/jpg" || $_FILES["inputPortada"]["type"] == "image/jpeg") {

                            $origen = imagecreatefromjpeg($_FILES["inputPortada"]["tmp_name"]);

                            $destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);

                            imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $atlo);

                            imagejpeg($destino, $fotoActual);
                        } elseif ($_FILES["inputPortada"]["type"] == "image/png") {

                            $origen = imagecreatefrompng($_FILES["inputPortada"]["tmp_name"]);

                            $destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);

                            imagealphablending($destino, false);

                            imagesavealpha($destino, true);

                            imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $atlo);

                            imagepng($destino, $fotoActual);
                        }

                        echo '<script>
                                window.location = "' . $ruta . 'admin/libros?ex";
                             </script>';
                        return;
                    } else {

                        echo '<script>
                        swal({
                            type:"error",
                            title:"Error",
                            text: "no se ha podido agregar el libro ' . $respuesta . '",
                            showConfirmButton: true,
                            confirmButtonText: "Cerrar"

                        }).then(function(result){
                            if(result.value){
                                history.back();
                            }
                        });
                    </script>';
                        return;
                    }
                } else {

                    echo '<script>
                    swal({
                        type:"error",
                        title:"Error",
                        text: "no hay imagen de portada",
                        showConfirmButton: true,
                        confirmButtonText: "Cerrar"

                    }).then(function(result){
                        if(result.value){
                            history.back();
                        }
                    });
                </script>';
                    return;
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
                return;
            }
        }
    }

    /* ==========================================
    MOSTRAR LIBRO/S
    =========================================== */

    static public function ctrMostrarLibro($item, $valor)
    {
        $tabla = "libros";

        $respuesta = ModeloLibros::mdlMostrarLibro($tabla, $item, $valor);

        return $respuesta;
    }

    /* ==========================================
    MOSTRAR LIBRO/S
    =========================================== */

    static public function ctrMostrarLibrosJoin($item, $valor)
    {
        $tabla = array(
            "libros" => "libros",
            "autores" => "autores",
            "editoriales" => "editoriales",
            "ubicaciones" => "ubicaciones",
            "categorias" => "categorias"
        );

        $respuesta = ModeloLibros::mdlMostrarLibrosJoin($tabla, $item, $valor);

        return $respuesta;
    }



    /* ==========================================
    AGREGAR LIBRO
    =========================================== */

    public function ctrActualizarLibro()
    {
        if (
            isset($_POST['inputModTitulo']) && isset($_POST['inputModYear']) && isset($_POST['inputModEdicion']) && isset($_POST['inputModIsbn'])
            && isset($_POST['inputModAutor']) && isset($_POST['inputModCategoria']) && isset($_POST['inputModUbicacion'])
            && isset($_POST['inputModEditorial'])
        ) {

            $ruta = ControladorGeneral::ctrRuta();

            if (
                preg_match('/^[a-zA-ZñÑáéíóúÁÉÍÓÚ\- ]+$/', $_POST["inputModTitulo"]) && preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ\- ]+$/', $_POST["inputModEdicion"])
                && preg_match('/^[0-9]+$/', $_POST["inputModAutor"])  && preg_match('/^[0-9]+$/', $_POST["inputModEditorial"])
                && preg_match('/^[0-9]+$/', $_POST["inputModCategoria"]) && preg_match('/^[0-9]+$/', $_POST["inputModUbicacion"])
                && preg_match('/^[0-9]+$/', $_POST["inputModIsbn"]) && preg_match('/^[0-9]+$/', $_POST["inputModYear"])
            ) {

                $portada = $_POST['portadaActual'];
                $idLibro = $_POST['idLibro'];

                $portadaAntigua = $_POST['portadaActual'];

                if (isset($_FILES["inputModPortada"]["tmp_name"]) && !empty($_FILES["inputModPortada"]["tmp_name"])) {


                    if ($_FILES["inputModPortada"]["type"] == "image/jpg") {

                        $portada = mt_rand(100, 999) . ".jpg";
                    } elseif ($_FILES["inputModPortada"]["type"] == "image/jpeg") {

                        $portada = mt_rand(100, 999) . ".jpeg";
                    } elseif ($_FILES["inputModPortada"]["type"] == "image/png") {

                        $portada = mt_rand(100, 999) . ".png";
                    } else {

                        echo '<script>
                                swal({
                                    type:"error",
                                    title:"Error",
                                    text: "no se permiten Diferentes a jpg, jpeg y/o png ' . $_FILES["inputModPortada"]["type"] . '!",
                                    showConfirmButton: true,
                                    confirmButtonText: "Cerrar"
    
                                }).then(function(result){
                                    if(result.value){
                                        history.back();
                                    }
                                });
                            </script>';

                        return;
                    }
                }

                $tituoLibro = trim($_POST["inputModTitulo"]);
                $year = trim($_POST["inputModYear"]);
                $edicion = trim($_POST['inputModEdicion']);
                $isbn = trim($_POST['inputModIsbn']);

                $descripcion = trim($_POST["inputModDescripcion"]);


                $tabla = 'libros';
                $item = "id_libro";
                $datos = array(
                    "id_libro" => $idLibro,
                    "id_autor" => $_POST['inputModAutor'],
                    "id_ubicacion" => $_POST['inputModUbicacion'],
                    "id_categoria" => $_POST['inputModCategoria'],
                    "id_editorial" => $_POST['inputModEditorial'],
                    "lib_titulo" => $tituoLibro,
                    "lib_year" => $year,
                    "lib_edicion" => $edicion,
                    "lib_isbn" => $isbn,
                    "lib_descripcion" => $descripcion,
                    "lib_portada" => $portada
                );

                $respuesta = ModeloLibros::mdlActualizarLibro($tabla, $item, $datos);

                if ($respuesta =='ok') {

                    if (isset($_FILES["inputModPortada"]["tmp_name"]) && !empty($_FILES["inputModPortada"]["tmp_name"])) {

                        list($ancho, $atlo) = getimagesize($_FILES["inputModPortada"]["tmp_name"]);

                        $nuevoAncho = 300;
                        $nuevoAlto = 450;

                        /* ==========================
                        CREAR DIRECTORIO DONDE IRA LA FOTO
                        =========================== */

                        $directorio = "vistas/img/libros/$idLibro";

                        unlink($directorio . "/" . $portadaAntigua);

                        if (!file_exists($directorio)) {
                            mkdir($directorio, 0755);
                        }

                        $fotoActual = $directorio . "/" . $portada;

                        if ($_FILES["inputModPortada"]["type"] == "image/jpg" || $_FILES["inputModPortada"]["type"] == "image/jpeg") {

                            $origen = imagecreatefromjpeg($_FILES["inputModPortada"]["tmp_name"]);

                            $destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);

                            imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $atlo);

                            imagejpeg($destino, $fotoActual);
                        } elseif ($_FILES["inputModPortada"]["type"] == "image/png") {

                            $origen = imagecreatefrompng($_FILES["inputModPortada"]["tmp_name"]);

                            $destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);

                            imagealphablending($destino, false);

                            imagesavealpha($destino, true);

                            imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $atlo);

                            imagepng($destino, $fotoActual);
                        }
                    }

                    echo '<script>
                                window.location = "' . $ruta . 'admin/libros?ex";
                             </script>';
                    return;
                } else {

                    echo '<script>
                        swal({
                            type:"error",
                            title:"Error",
                            text: "no se ha podido agregar el libro ' . $respuesta . '",
                            showConfirmButton: true,
                            confirmButtonText: "Cerrar"

                        }).then(function(result){
                            if(result.value){
                                history.back();
                            }
                        });
                    </script>';
                    return;
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
                return;
            }
        }
    }



    /* ==========================================
    FIN DE LA CLASE
    =========================================== */
}
