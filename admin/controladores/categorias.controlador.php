<?php

class ControladorCategorias
{


    /* ==========================================
    AGREGAR CATEGORIA
    =========================================== */

    public function ctrAgregarCategoria()
    {
        if (isset($_POST['inputNombreCategoria'])) {

            $ruta = ControladorGeneral::ctrRuta();

            if (
                preg_match('/^[a-zA-ZñÑáéíóúÁÉÍÓÚ\- ]+$/', $_POST["inputNombreCategoria"])
            ) {

                $tabla = 'categorias';
                $valor = trim($_POST["inputNombreCategoria"]);

                $respuesta = ModeloCategorias::mdlAgregarCategoria($tabla, $valor);

                if ($respuesta == "ok") {

                    echo '<script>
                                window.location = "' . $ruta . 'admin/categorias?ex";
                             </script>';
                    return;
                } else {

                    echo '<script>
                        swal({
                            type:"error",
                            title:"Error",
                            text: "no se ha podido agregar a la Categoria",
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
    MOSTRAR CATEGORIAS
    =========================================== */

    static public function ctrMostrarCategoria($item, $valor)
    {
        $tabla = "categorias";

        $respuesta = ModeloCategorias::mdlMostrarCategoria($tabla, $item, $valor);

        return $respuesta;
    }


    /* ==========================================
    ACTUALIZAR CATEGORIAS
    =========================================== */

    static public function ctrActualizarCategoria()
    {
        if (isset($_POST['idModificarCategoria']) && isset($_POST['inputCategoriaMod'])) {

            $ruta = ControladorGeneral::ctrRuta();

            if (
                preg_match('/^[a-zA-ZñÑáéíóúÁÉÍÓÚ\- ]+$/', $_POST["inputCategoriaMod"])
            ) {

                $item = "cat_categoria";
                $id = $_POST['idModificarCategoria'];
                $valor = $_POST["inputCategoriaMod"];

                $tabla = "categorias";

                $respuesta = ModeloCategorias::mdlActualizarCategoria($tabla, $id, $item, $valor);

                if ($respuesta == 'ok') {

                    echo '<script>
                                window.location = "' . $ruta . 'admin/categorias?ex";
                             </script>';
                    return;
                } else {

                    echo '<script>
                        swal({
                            type:"error",
                            title:"Error",
                            text: "no se ha podido agregar la Categoria",
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
