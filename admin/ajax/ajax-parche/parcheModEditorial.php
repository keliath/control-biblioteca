<?php

require_once "../../controladores/editoriales.controlador.php";
require_once "../../modelos/editoriales.modelo.php";

class ModEditorial
{

    public function mostrarLista()
    {

        $item = "id_editorial";
        $valor = $_POST['dato'];
        $editorial = ControladorEditoriales::ctrMostrarEditorial($item, $valor);

        $idEditorial = $editorial["id_editorial"];
        $nombreEditorial = $editorial["edi_editorial"];
        $paisEditorial = $editorial["edi_pais"];
        $ciudadEditorial = $editorial["edi_ciudad"];
        $detalleEditorial = $editorial["edi_detalle"];

        echo "
        <input type='text' name='idModificarEditorial' id='idModificarEditorial' value='$idEditorial' hidden>

        <div class='form-group'>
            <label for='modNombreEditorial' class='control-label'>Editorial</label>
            <input type='text' class='form-control' placeholder='Nombre de la editorial' name='modNombreEditorial'
                id='modNombreEditorial' value='$nombreEditorial' required>
        </div>

        <div class='form-group'>
            <label for='inputModPais' class='control-label'>País</label>
            <div>
                <select class='form-control select2' name='inputModPais' id='inputModPais' required>
                    <option value='$paisEditorial' selected>$paisEditorial</option>
                </select>
            </div>
        </div>

        <div class='form-group'>
            <label for='inputModCiudad' class='control-label'>Editorial</label>
            <input type='text' class='form-control' placeholder='Ciudad de la editorial' name='inputModCiudad'
                id='inputModCiudad' value='$ciudadEditorial' required>
        </div>

        <div class='form-group'>
            <label for='inputModDetalle' class='control-label'>Editorial</label>
            <textarea class='form-control' name='inputModDetalle' id='' cols='10' rows='3' maxlength='250'
                placeholder='detalle de la editorial'>$detalleEditorial</textarea>
        </div>
        ";
    }
    // cierre metodo


}
// cierre clase

$mostrarLista = new ModEditorial();
$mostrarLista->mostrarLista();
