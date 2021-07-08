<?php

require_once "../../controladores/autores.controlador.php";
require_once "../../modelos/autores.modelo.php";

class ModAutores
{

    public function mostrarLista()
    {

        $item = "id_autor";
        $valor = $_POST['dato'];
        $autores = ControladorAutores::ctrMostrarAutores($item, $valor);

        $idAutor = $autores["id_autor"];
        $nombreAutor = $autores["aut_autor"];

        echo "
        <input type='text' name='idModificarAutor' id='idModificarAutor' value='$idAutor' hidden>

        <div class='form-group'>
            <label for='inputNombreAutor' class='control-label'>Autor</label>
            <input type='text' class='form-control' placeholder='Nombre del Autor' name='modNombreAutor' id='modNombreAutor' value='$nombreAutor'
                required>
        </div>
        ";
    }
    // cierre metodo


}
// cierre clase

$mostrarLista = new ModAutores();
$mostrarLista->mostrarLista();
