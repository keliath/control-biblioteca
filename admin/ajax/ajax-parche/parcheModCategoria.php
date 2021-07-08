<?php

require_once "../../controladores/categorias.controlador.php";
require_once "../../modelos/categorias.modelo.php";

class ModCategorias
{

    public function mostrarLista()
    {

        $item = "id_categoria";
        $valor = $_POST['dato'];
        $categorias = ControladorCategorias::ctrMostrarCategoria($item, $valor);

        $idCategoria = $categorias["id_categoria"];
        $nombreCategoria = $categorias["cat_categoria"];

        echo "
        <input type='text' name='idModificarCategoria' id='idModificarCategoria' value='$idCategoria' hidden>

        <div class='form-group'>
            <label for='inputCategoriaMod' class='control-label'>Categoria</label>
            <input type='text' class='form-control' placeholder='Nombre de la categoria' name='inputCategoriaMod' id='inputCategoriaMod' value='$nombreCategoria'
                required>
        </div>
        ";
    }
    // cierre metodo


}
// cierre clase

$mostrarLista = new ModCategorias();
$mostrarLista->mostrarLista();
