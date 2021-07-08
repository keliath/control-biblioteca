<?php

class ControladorAutores
{


    /* ==========================================
    AGREGAR AUTORES
    =========================================== */

    public function ctrAgregarAutor()
    {
        if (isset($_POST['inputNombreAutor'])) {

            $ruta = ControladorGeneral::ctrRuta();

            if (preg_match('/^[a-zA-ZñÑáéíóúÁÉÍÓÚ\-\.\,\: ]+$/', $_POST["inputNombreAutor"])) {

                $tabla = 'autores';
                $valor = trim($_POST['inputNombreAutor']);

                $respuesta = ModeloAutores::mdlAgregarAutor($tabla, $valor);

                if ($respuesta == "ok") {

                    echo '<script>
                                window.location = "' . $ruta . 'admin/autores?ex";
                             </script>';
                    return;
                } else {

                    echo '<script>
                        swal({
                            type:"error",
                            title:"Error",
                            text: "no se ha podido agregar al autor",
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
                            text: "no se permiten caracteres especiales! ' . $_POST['inputNombreAutor'] . '",
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

    /* ==========================================
    MOSTRAR AUTORES
    =========================================== */

    static public function ctrMostrarAutores($item, $valor)
    {
        $tabla = "autores";

        $respuesta = ModeloAutores::mdlMostrarAutor($tabla, $item, $valor);

        return $respuesta;
    }

    /* ==========================================
    ACTUALIZAR AUTORES
    =========================================== */

    public function ctrActualizarAutor()
    {

        if (isset($_POST['idModificarAutor']) && isset($_POST['modNombreAutor'])) {

            $ruta = ControladorGeneral::ctrRuta();

            if (preg_match('/^[a-zA-ZñÑáéíóúÁÉÍÓÚ\-\.\,\: ]+$/', $_POST["modNombreAutor"])) {

                $tabla = "autores";
                $item = "aut_autor";
                $id = $_POST['idModificarAutor'];
                $valor = $_POST["modNombreAutor"];

                    $respuesta = ModeloAutores::mdlActualizarAutor($tabla, $id, $item, $valor);

                if ($respuesta == 'ok') {

                    echo '<script>
                                window.location = "' . $ruta . 'admin/autores?ex";
                             </script>';
                    return;
                } else {

                    echo '<script>
                        swal({
                            type:"error",
                            title:"Error",
                            text: "no se ha podido modificar al autor",
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

    /* ==========================================
    FIN DE LA CLASE
    =========================================== */
}
